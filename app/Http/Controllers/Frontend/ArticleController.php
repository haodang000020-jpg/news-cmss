<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function __invoke(string $slug): View
    {
        $article = Article::query()
            ->with(['category', 'user'])
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        $article->increment('view_count');

        $relatedArticles = Article::query()
            ->with('category')
            ->published()
            ->where('category_id', $article->category_id)
            ->whereKeyNot($article->id)
            ->limit(4)
            ->get();

        return view('frontend.articles.show', [
            'article' => $article,
            'relatedArticles' => $relatedArticles,
            'metaTitle' => $article->meta_title ?: $article->title,
            'metaDescription' => $article->meta_description ?: $article->summary,
        ]);
    }
}
