<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuItemRequest;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MenuItemController extends Controller
{
    public function index(Menu $menu): View
    {
        $items = MenuItem::query()
            ->where('menu_id', $menu->id)
            ->with(['parent', 'children'])
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return view('admin.menus.items.index', [
            'menu' => $menu,
            'items' => $this->buildTreeRows($items),
        ]);
    }

    public function create(Menu $menu): View
    {
        return view('admin.menus.items.create', [
            'menu' => $menu,
            'item' => new MenuItem([
                'target' => '_self',
                'sort_order' => 0,
                'is_active' => true,
            ]),
            'parentOptions' => $this->parentOptions($menu),
        ]);
    }

    public function store(MenuItemRequest $request, Menu $menu): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['menu_id'] = $menu->id;

        MenuItem::create($data);

        return redirect()
            ->route('admin.menus.items.index', $menu)
            ->with('status', 'Da them menu item.');
    }

    public function edit(Menu $menu, MenuItem $item): View
    {
        abort_unless($item->menu_id === $menu->id, 404);

        return view('admin.menus.items.edit', [
            'menu' => $menu,
            'item' => $item,
            'parentOptions' => $this->parentOptions($menu, $item),
        ]);
    }

    public function update(MenuItemRequest $request, Menu $menu, MenuItem $item): RedirectResponse
    {
        abort_unless($item->menu_id === $menu->id, 404);

        $item->update($this->validatedData($request));

        return redirect()
            ->route('admin.menus.items.index', $menu)
            ->with('status', 'Da cap nhat menu item.');
    }

    public function destroy(Menu $menu, MenuItem $item): RedirectResponse
    {
        abort_unless($item->menu_id === $menu->id, 404);

        if ($item->children()->exists()) {
            return redirect()
                ->route('admin.menus.items.index', $menu)
                ->with('error', 'Khong the xoa menu item dang co menu con.');
        }

        $item->delete();

        return redirect()
            ->route('admin.menus.items.index', $menu)
            ->with('status', 'Da xoa menu item.');
    }

    private function validatedData(MenuItemRequest $request): array
    {
        $data = $request->validated();
        $data['route_params'] = $data['route_params']
            ? json_decode($data['route_params'], true)
            : null;

        return $data;
    }

    private function parentOptions(Menu $menu, ?MenuItem $current = null): array
    {
        $items = MenuItem::query()
            ->where('menu_id', $menu->id)
            ->whereNull('parent_id')
            ->when($current, fn ($query) => $query->whereKeyNot($current->id))
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return $items->map(fn (MenuItem $item) => [
            'item' => $item,
            'label' => $item->title,
        ])->all();
    }

    private function buildTreeRows($items, ?int $parentId = null, int $depth = 0): array
    {
        $rows = [];

        foreach ($items->where('parent_id', $parentId) as $item) {
            $rows[] = [
                'item' => $item,
                'depth' => $depth,
                'label' => str_repeat('-- ', $depth).$item->title,
            ];

            $rows = array_merge($rows, $this->buildTreeRows($items, $item->id, $depth + 1));
        }

        return $rows;
    }
}
