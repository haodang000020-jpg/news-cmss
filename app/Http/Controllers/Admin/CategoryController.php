<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()
            ->with('parent')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.categories.index', [
            'categories' => $this->buildTreeRows($categories),
        ]);
    }

    public function create(): View
    {
        return view('admin.categories.create', [
            'category' => new Category(['is_active' => true, 'sort_order' => 0]),
            'parentOptions' => $this->parentOptions(),
        ]);
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return redirect()
            ->route('admin.categories.index')
            ->with('status', 'Da them chuyen muc.');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', [
            'category' => $category,
            'parentOptions' => $this->parentOptions($category),
        ]);
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        return redirect()
            ->route('admin.categories.index')
            ->with('status', 'Da cap nhat chuyen muc.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->children()->exists()) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'Khong the xoa chuyen muc dang co chuyen muc con.');
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('status', 'Da xoa chuyen muc.');
    }

    private function parentOptions(?Category $current = null): array
    {
        $categories = Category::query()
            ->when($current, fn ($query) => $query->whereKeyNot($current->id))
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return $this->buildTreeRows($categories);
    }

    private function buildTreeRows($categories, ?int $parentId = null, int $depth = 0): array
    {
        $rows = [];

        foreach ($categories->where('parent_id', $parentId) as $category) {
            $rows[] = [
                'category' => $category,
                'depth' => $depth,
                'label' => str_repeat('-- ', $depth).$category->name,
            ];

            $rows = array_merge($rows, $this->buildTreeRows($categories, $category->id, $depth + 1));
        }

        return $rows;
    }
}
