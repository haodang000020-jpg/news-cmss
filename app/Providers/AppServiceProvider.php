<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('frontend.layouts.app', function ($view): void {
            $frontendMenuCategories = Category::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get();

            $introPage = Page::query()
                ->active()
                ->where('slug', 'gioi-thieu')
                ->first();

            $siteHeaderBanners = Banner::query()
                ->where('position', 'site_header_banner')
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

            $view->with([
                'frontendMenuCategories' => $frontendMenuCategories,
                'introPage' => $introPage,
                'siteHeaderBanners' => $siteHeaderBanners,
            ]);
        });
    }
}
