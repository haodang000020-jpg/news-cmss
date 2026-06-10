<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Throwable;

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
            $mainMenu = Menu::query()
                ->where('location', 'main_menu')
                ->where('is_active', true)
                ->with([
                    'items' => function ($query): void {
                        $query->whereNull('parent_id')
                            ->where('is_active', true)
                            ->orderBy('sort_order')
                            ->orderBy('title')
                            ->with([
                                'children' => function ($query): void {
                                    $query->where('is_active', true)
                                        ->orderBy('sort_order')
                                        ->orderBy('title');
                                },
                            ]);
                    },
                ])
                ->first();

            $mainMenu?->items->each(function ($item): void {
                $this->prepareMenuItem($item);
                $item->children->each(fn ($child) => $this->prepareMenuItem($child));
            });

            $view->with('mainMenu', $mainMenu);
        });
    }

    private function prepareMenuItem($item): void
    {
        $item->setAttribute('resolved_url', $this->resolveMenuItemUrl($item));
        $item->setAttribute('safe_target', in_array($item->target, ['_self', '_blank'], true) ? $item->target : '_self');
    }

    private function resolveMenuItemUrl($item): string
    {
        if ($item->route_name && Route::has($item->route_name)) {
            try {
                return route($item->route_name, $item->route_params ?? []);
            } catch (Throwable) {
                return $item->url ?: '#';
            }
        }

        return $item->url ?: '#';
    }
}
