<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Document;
use App\Models\Page;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $urls = [
            [
                'loc' => route('home'),
                'lastmod' => now()->format('Y-m-d'),
            ],
        ];

        Article::query()
            ->published()
            ->whereNotNull('slug')
            ->get()
            ->each(function (Article $article) use (&$urls): void {
                $urls[] = [
                    'loc' => route('frontend.articles.show', $article->slug),
                    'lastmod' => $article->updated_at?->format('Y-m-d'),
                ];
            });

        Category::query()
            ->where('is_active', true)
            ->whereNotNull('slug')
            ->get()
            ->each(function (Category $category) use (&$urls): void {
                $urls[] = [
                    'loc' => route('frontend.categories.show', $category->slug),
                    'lastmod' => $category->updated_at?->format('Y-m-d'),
                ];
            });

        Document::query()
            ->where('is_active', true)
            ->whereNotNull('slug')
            ->get()
            ->each(function (Document $document) use (&$urls): void {
                $urls[] = [
                    'loc' => route('frontend.documents.show', $document->slug),
                    'lastmod' => $document->updated_at?->format('Y-m-d'),
                ];
            });

        Page::query()
            ->where('is_active', true)
            ->whereNotNull('slug')
            ->get()
            ->each(function (Page $page) use (&$urls): void {
                $urls[] = [
                    'loc' => route('frontend.pages.show', $page->slug),
                    'lastmod' => $page->updated_at?->format('Y-m-d'),
                ];
            });

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        foreach ($urls as $url) {
            $xml .= "    <url>\n";
            $xml .= '        <loc>'.htmlspecialchars($url['loc'], ENT_XML1, 'UTF-8')."</loc>\n";

            if ($url['lastmod']) {
                $xml .= '        <lastmod>'.$url['lastmod']."</lastmod>\n";
            }

            $xml .= "    </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
