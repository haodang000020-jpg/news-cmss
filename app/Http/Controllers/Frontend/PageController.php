<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __invoke(string $slug): View
    {
        $page = Page::query()
            ->where('is_active', true)
            ->where('slug', $slug)
            ->firstOrFail();

        return view('frontend.pages.show', [
            'page' => $page,
            'metaTitle' => $page->meta_title ?: $page->title,
            'metaDescription' => $page->meta_description ?: $page->summary,
        ]);
    }
}
