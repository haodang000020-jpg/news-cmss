<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(): View
    {
        $menus = Menu::query()
            ->withCount('items')
            ->orderBy('location')
            ->paginate(10);

        return view('admin.menus.index', [
            'menus' => $menus,
        ]);
    }

    public function create(): View
    {
        return view('admin.menus.create', [
            'menu' => new Menu(['is_active' => true]),
        ]);
    }

    public function store(MenuRequest $request): RedirectResponse
    {
        Menu::create($request->validated());

        return redirect()
            ->route('admin.menus.index')
            ->with('status', 'Da them menu.');
    }

    public function edit(Menu $menu): View
    {
        return view('admin.menus.edit', [
            'menu' => $menu,
        ]);
    }

    public function update(MenuRequest $request, Menu $menu): RedirectResponse
    {
        $menu->update($request->validated());

        return redirect()
            ->route('admin.menus.index')
            ->with('status', 'Da cap nhat menu.');
    }

    public function destroy(Menu $menu): RedirectResponse
    {
        if ($menu->items()->exists()) {
            return redirect()
                ->route('admin.menus.index')
                ->with('error', 'Khong the xoa menu dang co menu item.');
        }

        $menu->delete();

        return redirect()
            ->route('admin.menus.index')
            ->with('status', 'Da xoa menu.');
    }
}
