<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function __invoke(Request $request): View
    {
        $keyword = trim((string) $request->query('q', ''));

        $articles = Article::query()
            ->with(['category', 'user'])
            ->published()
            ->when($keyword !== '', function ($query) use ($keyword): void {
                $query->where(function ($query) use ($keyword): void {
                    $query
                        ->where('title', 'like', '%'.$keyword.'%')
                        ->orWhere('summary', 'like', '%'.$keyword.'%');
                });
            })
            ->when($keyword === '', fn ($query) => $query->whereRaw('1 = 0'))
            ->paginate(10)
            ->withQueryString();

        return view('frontend.search.index', [
            'articles' => $articles,
            'keyword' => $keyword,
            'metaTitle' => 'Tìm kiếm',
            'metaDescription' => 'Tìm kiếm bài viết',
        ]);
    }
}
