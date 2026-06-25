<?php

use App\Http\Controllers\Admin\SchoolLinkController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DocumentCategoryController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WorkScheduleController;
use App\Http\Controllers\Admin\LookupLinkController;
use App\Http\Controllers\Admin\OrganizationMemberController;
use App\Http\Controllers\Admin\ProcedureController;
use App\Http\Controllers\Admin\ProcedureGroupController;
use App\Http\Controllers\Frontend\ArticleController as FrontendArticleController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\Frontend\DocumentController as FrontendDocumentController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PageController as FrontendPageController;
use App\Http\Controllers\Frontend\RobotsController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\SitemapController;
use App\Http\Controllers\Frontend\IntroductionController;
use App\Http\Controllers\Frontend\ProcedureController as FrontendProcedureController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', HomeController::class)->name('home');
Route::get('/sitemap.xml', SitemapController::class)->name('frontend.sitemap');
Route::get('/robots.txt', RobotsController::class)->name('frontend.robots');
Route::get('/gioi-thieu', [IntroductionController::class, 'index']) ->name('frontend.introduction');
Route::get('/chuyen-muc/{slug}', FrontendCategoryController::class)->name('frontend.categories.show');
Route::get('/bai-viet/{slug}', FrontendArticleController::class)->name('frontend.articles.show');
Route::get('/trang/{slug}', FrontendPageController::class)->name('frontend.pages.show');
Route::get('/van-ban', [FrontendDocumentController::class, 'index'])
    ->name('frontend.documents.index');
Route::get('/van-ban/{document}/download', [FrontendDocumentController::class, 'download'])
    ->name('frontend.documents.download');
Route::get('/van-ban/{slug}', [FrontendDocumentController::class, 'show'])
    ->name('frontend.documents.show');
Route::get('/thu-tuc-hanh-chinh', [FrontendProcedureController::class, 'index'])
    ->name('frontend.procedures.index');
Route::get('/thu-tuc-hanh-chinh/bieu-mau/{requiredDocument}/tai', [FrontendProcedureController::class, 'downloadForm'])
    ->name('frontend.procedures.forms.download');
Route::get('/thu-tuc-hanh-chinh/{slug}', [FrontendProcedureController::class, 'show'])
    ->name('frontend.procedures.show');
Route::get('/tim-kiem', SearchController::class)->name('frontend.search');

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'permission:dashboard.view'])
    ->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');

        Route::resource('lookup-links', LookupLinkController::class)
            ->except('show')
            ->middleware('permission:lookup-links.manage');

        Route::resource('school-links', SchoolLinkController::class)
            ->except('show')
            ->middleware('permission:school-links.manage');

        Route::resource('categories', CategoryController::class)
            ->except(['show'])
            ->middleware('permission:categories.manage');
        Route::post('articles/upload-image', [ArticleController::class, 'uploadImage'])
            ->name('articles.upload-image')
            ->middleware('permission:articles.manage');

        Route::resource('articles', ArticleController::class)
            ->except(['show'])
            ->middleware('permission:articles.manage');

        Route::resource('banners', BannerController::class)
            ->except(['show'])
            ->middleware('permission:banners.manage');

        Route::resource('menus', MenuController::class)
            ->except(['show'])
            ->middleware('permission:menus.manage');

        Route::resource('document-categories', DocumentCategoryController::class)
            ->except(['show'])
            ->middleware('permission:documents.manage');

        Route::resource('documents', DocumentController::class)
            ->except(['show'])
            ->middleware('permission:documents.manage');

        Route::resource('procedure-groups', ProcedureGroupController::class)
            ->except(['show'])
            ->middleware('permission:procedures.manage');

        Route::resource('procedures', ProcedureController::class)
            ->except(['show'])
            ->middleware('permission:procedures.manage');

        Route::resource('pages', PageController::class)
            ->except(['show'])
            ->middleware('permission:pages.manage');

        Route::resource('work-schedules', WorkScheduleController::class)
            ->except(['show'])
            ->middleware('permission:work-schedules.manage');

        Route::resource('users', UserController::class)
            ->except(['show'])
            ->middleware('permission:users.manage');

        Route::prefix('menus/{menu}')
            ->name('menus.')
            ->middleware('permission:menus.manage')
            ->group(function () {
                Route::resource('items', MenuItemController::class)
                    ->except(['show']);
            });
        Route::resource( 'organization-members', OrganizationMemberController::class ) ->except('show') ->middleware('permission:organization-members.manage');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
