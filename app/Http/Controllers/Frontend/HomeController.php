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

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Throwable;

class HomeController extends Controller
{
    public function __invoke(Request $request): View
    {
        $schoolLinks = SchoolLink::active()->ordered()->get();
        /*
|--------------------------------------------------------------------------
| Chuyên mục Thông báo
|--------------------------------------------------------------------------
| Không kiểm tra is_active để chuyên mục dù đang ẩn khỏi menu
| vẫn được dùng cho box Thông báo.
*/
        $noticeCategory = Category::query()->where('slug', 'thong-bao')->first();

        $noticeArticles = $noticeCategory
            ? Article::query()
                ->with(['category', 'user'])
                ->published()
                ->where('category_id', $noticeCategory->id)
                ->limit(10)
                ->get()
            : collect();

        /*
|--------------------------------------------------------------------------
| Tin mới nhất
|--------------------------------------------------------------------------
| Loại bỏ bài viết thuộc chuyên mục Thông báo.
*/
        $latestArticles = Article::query()
            ->with(['category', 'user'])
            ->published()
            ->when($noticeCategory, fn($query) => $query->where('category_id', '!=', $noticeCategory->id))
            ->limit(8)
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

        $categories = Category::query()->where('is_active', true)->orderBy('sort_order')->orderBy('name')->limit(6)->get();

        $homeSliders = Banner::query()
            ->where('position', 'home_slider')
            ->where('is_active', true)
            ->where(function ($query): void {
                $query->whereNull('starts_at')->orWhere('starts_at', '<=', now());
            })
            ->where(function ($query): void {
                $query->whereNull('ends_at')->orWhere('ends_at', '>=', now());
            })
            ->orderBy('sort_order')
            ->latest()
            ->get();

        $workScheduleBanners = Banner::query()
            ->where('position', 'work_schedule_banner')
            ->where('is_active', true)
            ->where(function ($query): void {
                $query->whereNull('starts_at')->orWhere('starts_at', '<=', now());
            })
            ->where(function ($query): void {
                $query->whereNull('ends_at')->orWhere('ends_at', '>=', now());
            })
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        $propagandaBanners = Banner::query()
            ->where('position', 'propaganda_slider')
            ->where('is_active', true)
            ->where(function ($query): void {
                $query->whereNull('starts_at')->orWhere('starts_at', '<=', now());
            })
            ->where(function ($query): void {
                $query->whereNull('ends_at')->orWhere('ends_at', '>=', now());
            })
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        $documentCategories = DocumentCategory::query()->where('is_active', true)->orderBy('name')->get();

        $selectedDocumentCategoryId = $request->integer('document_category_id');

        if ($selectedDocumentCategoryId <= 0 || !$documentCategories->contains('id', $selectedDocumentCategoryId)) {
            $selectedDocumentCategoryId = null;
        }

        $selectedDocumentCategory = $selectedDocumentCategoryId ? $documentCategories->firstWhere('id', $selectedDocumentCategoryId) : null;

        $latestDocuments = Document::query()->where('is_active', true)->when($selectedDocumentCategoryId, fn($query) => $query->where('document_category_id', $selectedDocumentCategoryId))->orderByDesc('issued_at')->orderByDesc('created_at')->limit(7)->get();

        $workSchedules = WorkSchedule::active()->ordered()->get();

        $categories->each(function (Category $category): void {
            $category->setRelation('articles', $category->articles()->with('user')->published()->limit(4)->get());
        });

        $siteVisitCount = SiteVisit::count();

        $lookupLinks = LookupLink::active()->ordered()->get();

        $primaryCategories = $categories->reject(fn(Category $category): bool => $noticeCategory !== null && $category->id === $noticeCategory->id)->take(10)->values();
        $weather = $this->getCurrentWeather();
        return view('frontend.home', [
            'featuredArticles' => $featuredArticles,
            'latestArticles' => $latestArticles,
            'categories' => $categories,
            'homeSliders' => $homeSliders,
            'workScheduleBanners' => $workScheduleBanners,
            'propagandaBanners' => $propagandaBanners,
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
            'weather' => $weather,
            'metaTitle' => 'Trang chủ',
            'metaDescription' => 'Tin tức mới nhất',
        ]);
    }
    private function getCurrentWeather(): ?array
    {
        $latitude = config('services.weather.latitude');
        $longitude = config('services.weather.longitude');
        $location = config('services.weather.location', 'Vĩnh Bình, An Giang');

        if (!is_numeric($latitude) || !is_numeric($longitude)) {
            return null;
        }

        $cacheKey = 'homepage_weather_' . md5($latitude . '|' . $longitude);

        try {
            return Cache::store('file')->remember($cacheKey, now()->addMinutes(20), function () use ($latitude, $longitude, $location): ?array {
                $response = Http::acceptJson()
                    ->connectTimeout(3)
                    ->timeout(6)
                    ->retry(2, 200, throw: false)
                    ->get('https://api.open-meteo.com/v1/forecast', [
                        'latitude' => (float) $latitude,
                        'longitude' => (float) $longitude,

                        'current' => implode(',', ['temperature_2m', 'apparent_temperature', 'relative_humidity_2m', 'weather_code', 'wind_speed_10m', 'is_day']),

                        'temperature_unit' => 'celsius',
                        'wind_speed_unit' => 'kmh',
                        'timezone' => 'Asia/Ho_Chi_Minh',
                    ]);

                if (!$response->successful()) {
                    return null;
                }

                $current = $response->json('current');

                if (!is_array($current) || !isset($current['temperature_2m'])) {
                    return null;
                }

                $weatherCode = (int) ($current['weather_code'] ?? -1);

                $isDay = (int) ($current['is_day'] ?? 1) === 1;

                return [
                    'location' => (string) $location,

                    'temperature' => round((float) $current['temperature_2m']),

                    'apparent_temperature' => round((float) ($current['apparent_temperature'] ?? $current['temperature_2m'])),

                    'humidity' => (int) ($current['relative_humidity_2m'] ?? 0),

                    'wind_speed' => round((float) ($current['wind_speed_10m'] ?? 0), 1),

                    'weather_code' => $weatherCode,

                    'description' => $this->weatherDescription($weatherCode),

                    'icon' => $this->weatherIcon($weatherCode, $isDay),
                ];
            });
        } catch (Throwable $exception) {
            report($exception);

            // API lỗi không được làm hỏng trang chủ.
            return null;
        }
    }

    private function weatherDescription(int $code): string
    {
        return match (true) {
            $code === 0 => 'Trời quang',

            in_array($code, [1, 2], true) => 'Có mây nhẹ',

            $code === 3 => 'Nhiều mây',

            in_array($code, [45, 48], true) => 'Sương mù',

            in_array($code, [51, 53, 55, 56, 57], true) => 'Mưa phùn',

            in_array($code, [61, 63, 65, 66, 67], true) => 'Có mưa',

            in_array($code, [80, 81, 82], true) => 'Mưa rào',

            in_array($code, [71, 73, 75, 77, 85, 86], true) => 'Có tuyết',

            in_array($code, [95, 96, 99], true) => 'Mưa dông',

            default => 'Thời tiết hiện tại',
        };
    }

    private function weatherIcon(int $code, bool $isDay): string
    {
        return match (true) {
            $code === 0 => $isDay ? '☀️' : '🌙',

            in_array($code, [1, 2], true) => $isDay ? '🌤️' : '☁️',

            $code === 3 => '☁️',

            in_array($code, [45, 48], true) => '🌫️',

            in_array($code, [51, 53, 55, 56, 57, 61, 63, 65, 66, 67, 80, 81, 82], true) => '🌧️',

            in_array($code, [71, 73, 75, 77, 85, 86], true) => '🌨️',

            in_array($code, [95, 96, 99], true) => '⛈️',

            default => '🌡️',
        };
    }
}
