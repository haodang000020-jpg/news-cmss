<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Document;
use App\Models\WorkSchedule;
use App\Models\SchoolLink;
use App\Models\LookupLink;
use App\Models\SiteVisit;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(Request $request): View
    {

        $schoolLinks = SchoolLink::active()
            ->ordered()
            ->get();
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

        $homeSliders = Banner::query()
            ->where('position', 'home_slider')
            ->where('is_active', true)
            ->where(function ($query): void {
                $query->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', now());
            })
            ->where(function ($query): void {
                $query->whereNull('ends_at')
                    ->orWhere('ends_at', '>=', now());
            })
            ->orderBy('sort_order')
            ->latest()
            ->get();

        $workScheduleBanners = Banner::query()
            ->where('position', 'work_schedule_banner')
            ->where('is_active', true)
            ->where(function ($query): void {
                $query->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', now());
            })
            ->where(function ($query): void {
                $query->whereNull('ends_at')
                    ->orWhere('ends_at', '>=', now());
            })
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

      $documentCategories = DocumentCategory::query()
    ->where('is_active', true)
    ->orderBy('name')
    ->get();

        $selectedDocumentCategoryId = $request->integer('document_category_id');

        if (
            $selectedDocumentCategoryId <= 0 ||
            ! $documentCategories->contains('id', $selectedDocumentCategoryId)
        ) {
            $selectedDocumentCategoryId = null;
        }

        $selectedDocumentCategory = $selectedDocumentCategoryId
            ? $documentCategories->firstWhere('id', $selectedDocumentCategoryId)
            : null;

        $latestDocuments = Document::query()
            ->where('is_active', true)
            ->when(
                $selectedDocumentCategoryId,
                fn ($query) => $query->where(
                    'document_category_id',
                    $selectedDocumentCategoryId
                )
            )
            ->orderByDesc('issued_at')
            ->orderByDesc('created_at')
            ->limit(7)
            ->get();

        $workSchedules = WorkSchedule::active()
            ->ordered()
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

        $siteVisitCount = SiteVisit::count();

        $lookupLinks = LookupLink::active()
            ->ordered()
            ->get();
        $primaryCategories = $categories->take(5);
        $noticeCategory = $categories->first(
            fn (Category $category): bool => str_contains((string) $category->name, 'Thông báo')
        );
        $noticeArticles = $noticeCategory?->articles ?? $latestArticles;

        return view('frontend.home', [
            'featuredArticles' => $featuredArticles,
            'latestArticles' => $latestArticles,
            'categories' => $categories,
            'homeSliders' => $homeSliders,
            'workScheduleBanners' => $workScheduleBanners,
            'latestDocuments' => $latestDocuments,
            'workSchedules' => $workSchedules,
            'primaryCategories' => $primaryCategories,
            'noticeCategory' => $noticeCategory,
            'noticeArticles' => $noticeArticles,
            'schoolLinks' => $schoolLinks,
            'lookupLinks' => $lookupLinks,
            'siteVisitCount' => $siteVisitCount,
            'documentCategories' => $documentCategories,
            'selectedDocumentCategoryId' => $selectedDocumentCategoryId,
            'selectedDocumentCategory' => $selectedDocumentCategory,
            'metaTitle' => 'Trang chủ',
            'metaDescription' => 'Tin tức mới nhất',
        ]);
    }
}
