<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __invoke(string $slug): View
    {
        $category = Category::query()
            ->where('is_active', true)
            ->where('slug', $slug)
            ->firstOrFail();

        $articles = $category->articles()
            ->with('user')
            ->published()
            ->paginate(10);

        return view('frontend.categories.show', [
            'category' => $category,
            'articles' => $articles,
            'metaTitle' => $category->name,
            'metaDescription' => $category->description ?: $category->name,
        ]);
    }
}
