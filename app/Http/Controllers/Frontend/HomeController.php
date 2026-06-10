<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $featuredArticles = Article::query()
            ->with(['category', 'user'])
            ->published()
            ->where('is_featured', true)
            ->limit(4)
            ->get();

        $latestArticles = Article::query()
            ->with(['category', 'user'])
            ->published()
            ->limit(8)
            ->get();

        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->limit(6)
            ->get();

        $categories->each(function (Category $category): void {
            $category->setRelation(
                'articles',
                $category->articles()
                    ->with('user')
                    ->published()
                    ->limit(4)
                    ->get()
            );
        });

        return view('frontend.home', [
            'featuredArticles' => $featuredArticles,
            'latestArticles' => $latestArticles,
            'categories' => $categories,
            'metaTitle' => 'Trang chủ',
            'metaDescription' => 'Tin tức mới nhất',
        ]);
    }
}
