<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(Request $request): View
    {
        $pages = Page::query()
            ->when($request->filled('q'), function ($query) use ($request): void {
                $keyword = $request->string('q');

                $query->where('title', 'like', '%'.$keyword.'%');
            })
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.pages.index', [
            'pages' => $pages,
            'filters' => $request->only(['q']),
        ]);
    }

    public function create(): View
    {
        return view('admin.pages.create', [
            'page' => new Page([
                'sort_order' => 0,
                'is_active' => true,
            ]),
        ]);
    }

    public function store(PageRequest $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        Page::create($data);

        return redirect()
            ->route('admin.pages.index')
            ->with('status', 'Đã thêm trang tĩnh.');
    }

    public function edit(Page $page): View
    {
        return view('admin.pages.edit', [
            'page' => $page,
        ]);
    }

    public function update(PageRequest $request, Page $page): RedirectResponse
    {
        $data = $this->validatedData($request, $page);

        $page->update($data);

        return redirect()
            ->route('admin.pages.index')
            ->with('status', 'Đã cập nhật trang tĩnh.');
    }

    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();

        return redirect()
            ->route('admin.pages.index')
            ->with('status', 'Đã xóa trang tĩnh.');
    }

    private function validatedData(PageRequest $request, ?Page $page = null): array
    {
        $data = $request->validated();

        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title'], $page);

        return $data;
    }

    private function uniqueSlug(string $value, ?Page $page = null): string
    {
        $slug = Str::slug($value);
        $baseSlug = $slug;
        $index = 2;

        while (Page::query()
            ->where('slug', $slug)
            ->when($page, fn ($query) => $query->whereKeyNot($page->getKey()))
            ->exists()) {
            $slug = $baseSlug.'-'.$index;
            $index++;
        }

        return $slug;
    }
}
