<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(Request $request): View
    {
        $articles = Article::query()
            ->with(['category', 'user'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $keyword = trim((string) $request->input('search'));

                $query->where('title', 'like', '%' . $keyword . '%');
            })
            ->when($request->filled('category_id'), function ($query) use ($request) {
                $query->where('category_id', $request->integer('category_id'));
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', (string) $request->input('status'));
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.articles.index', [
            'articles' => $articles,

            // Lấy cả chuyên mục hiện và chuyên mục ẩn
            'categories' => $this->categories(),

            'filters' => $request->only(['search', 'category_id', 'status']),
        ]);
    }

    public function create(): View
    {
        return view('admin.articles.create', [
            'article' => new Article([
                'status' => 'draft',
                'is_featured' => false,
            ]),

            // Chuyên mục ẩn vẫn xuất hiện trong form thêm bài viết
            'categories' => $this->categories(),
        ]);
    }

    public function store(ArticleRequest $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['user_id'] = $request->user()->id;

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
        }

        Article::create($data);

        return redirect()->route('admin.articles.index')->with('status', 'Đã thêm bài viết.');
    }

    public function edit(Article $article): View
    {
        return view('admin.articles.edit', [
            'article' => $article,

            // Chuyên mục ẩn vẫn xuất hiện khi sửa bài viết
            'categories' => $this->categories(),
        ]);
    }

    public function update(ArticleRequest $request, Article $article): RedirectResponse
    {
        $data = $this->validatedData($request, $article);

        if ($request->hasFile('thumbnail')) {
            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }

            $data['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')->with('status', 'Đã cập nhật bài viết.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        if ($article->thumbnail) {
            Storage::disk('public')->delete($article->thumbnail);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')->with('status', 'Đã xóa bài viết.');
    }

    private function validatedData(ArticleRequest $request, ?Article $article = null): array
    {
        $data = $request->validated();

        unset($data['thumbnail']);

        if ($data['status'] === 'published' && !$article?->published_at) {
            $data['published_at'] = now();
        }

        if ($data['status'] === 'draft') {
            $data['published_at'] = null;
        }

        return $data;
    }

    /**
     * Lấy toàn bộ chuyên mục cho khu vực Admin bài viết.
     *
     * is_active chỉ dùng để quyết định chuyên mục có xuất hiện
     * trên menu frontend hay không.
     */
    private function categories()
    {
        return Category::query()->orderByDesc('is_active')->orderBy('sort_order')->orderBy('name')->get();
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],
        ]);

        $path = $request->file('image')->store('articles/content', 'public');

        $url = Storage::url($path);

        return response()->json([
            'url' => $url,
            'location' => $url,
        ]);
    }
}
