<?php

namespace App\Providers;

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

            $view->with([
                'frontendMenuCategories' => $frontendMenuCategories,
                'introPage' => $introPage,
            ]);
        });
    }
}
