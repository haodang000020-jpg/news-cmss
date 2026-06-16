<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SchoolLinkRequest;
use App\Models\SchoolLink;
use Illuminate\Support\Facades\Storage;

class SchoolLinkController extends Controller
{
    public function index()
    {
        $schoolLinks = SchoolLink::query()
            ->ordered()
            ->paginate(15);

        return view('admin.school-links.index', compact('schoolLinks'));
    }

    public function create()
    {
        $schoolLink = new SchoolLink();

        return view('admin.school-links.create', compact('schoolLink'));
    }

    public function store(SchoolLinkRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $data['logo_path'] = $request->file('logo')->store('school-links', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');

        SchoolLink::create($data);

        return redirect()
            ->route('admin.school-links.index')
            ->with('success', 'Thêm liên kết trường học thành công.');
    }

    public function edit(SchoolLink $schoolLink)
    {
        return view('admin.school-links.edit', compact('schoolLink'));
    }

    public function update(SchoolLinkRequest $request, SchoolLink $schoolLink)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            if ($schoolLink->logo_path) {
                Storage::disk('public')->delete($schoolLink->logo_path);
            }

            $data['logo_path'] = $request->file('logo')->store('school-links', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');

        $schoolLink->update($data);

        return redirect()
            ->route('admin.school-links.index')
            ->with('success', 'Cập nhật liên kết trường học thành công.');
    }

    public function destroy(SchoolLink $schoolLink)
    {
        if ($schoolLink->logo_path) {
            Storage::disk('public')->delete($schoolLink->logo_path);
        }

        $schoolLink->delete();

        return redirect()
            ->route('admin.school-links.index')
            ->with('success', 'Xóa liên kết trường học thành công.');
    }
}