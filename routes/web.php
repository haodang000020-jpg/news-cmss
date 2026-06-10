<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\ArticleController as FrontendArticleController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/chuyen-muc/{slug}', FrontendCategoryController::class)->name('frontend.categories.show');
Route::get('/bai-viet/{slug}', FrontendArticleController::class)->name('frontend.articles.show');
Route::get('/tim-kiem', SearchController::class)->name('frontend.search');

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'permission:dashboard.view'])
    ->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::resource('categories', CategoryController::class)
            ->except('show')
            ->middleware('permission:categories.manage');
        Route::resource('articles', ArticleController::class)
            ->except('show')
            ->middleware('permission:articles.manage');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
