<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BannerController extends Controller
{
    public function index(): View
    {
        $banners = Banner::query()
            ->orderBy('sort_order')
            ->latest()
            ->paginate(10);

        return view('admin.banners.index', [
            'banners' => $banners,
            'positions' => Banner::POSITIONS,
        ]);
    }

    public function create(): View
    {
        return view('admin.banners.create', [
            'banner' => new Banner([
                'position' => 'home_slider',
                'sort_order' => 0,
                'is_active' => true,
            ]),
            'positions' => Banner::POSITIONS,
        ]);
    }

    public function store(BannerRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['image'] = $request->file('image')->store('banners', 'public');

        Banner::create($data);

        return redirect()
            ->route('admin.banners.index')
            ->with('status', 'Đã thêm banner.');
    }

    public function edit(Banner $banner): View
    {
        return view('admin.banners.edit', [
            'banner' => $banner,
            'positions' => Banner::POSITIONS,
        ]);
    }

    public function update(BannerRequest $request, Banner $banner): RedirectResponse
    {
        $data = $request->validated();
        unset($data['image']);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($banner->image);
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        $banner->update($data);

        return redirect()
            ->route('admin.banners.index')
            ->with('status', 'Đã cập nhật banner.');
    }

    public function destroy(Banner $banner): RedirectResponse
    {
        Storage::disk('public')->delete($banner->image);
        $banner->delete();

        return redirect()
            ->route('admin.banners.index')
            ->with('status', 'Đã xóa banner.');
    }
}
