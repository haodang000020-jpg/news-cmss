<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LookupLinkRequest;
use App\Models\LookupLink;
use Illuminate\Support\Facades\Storage;

class LookupLinkController extends Controller
{
    public function index()
    {
        $lookupLinks = LookupLink::query()
            ->ordered()
            ->paginate(15);

        return view('admin.lookup-links.index', compact('lookupLinks'));
    }

    public function create()
    {
        $lookupLink = new LookupLink();

        return view('admin.lookup-links.create', compact('lookupLink'));
    }

    public function store(LookupLinkRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('lookup-links', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');
        $data['open_new_tab'] = $request->boolean('open_new_tab');

        LookupLink::create($data);

        return redirect()
            ->route('admin.lookup-links.index')
            ->with('success', 'Thêm mục tra cứu thành công.');
    }

    public function edit(LookupLink $lookupLink)
    {
        return view('admin.lookup-links.edit', compact('lookupLink'));
    }

    public function update(LookupLinkRequest $request, LookupLink $lookupLink)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($lookupLink->image_path) {
                Storage::disk('public')->delete($lookupLink->image_path);
            }

            $data['image_path'] = $request->file('image')->store('lookup-links', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');
        $data['open_new_tab'] = $request->boolean('open_new_tab');

        $lookupLink->update($data);

        return redirect()
            ->route('admin.lookup-links.index')
            ->with('success', 'Cập nhật mục tra cứu thành công.');
    }

    public function destroy(LookupLink $lookupLink)
    {
        if ($lookupLink->image_path) {
            Storage::disk('public')->delete($lookupLink->image_path);
        }

        $lookupLink->delete();

        return redirect()
            ->route('admin.lookup-links.index')
            ->with('success', 'Xóa mục tra cứu thành công.');
    }
}