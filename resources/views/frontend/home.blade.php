@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        @if ($homeSliders->isNotEmpty())
            <section class="mb-1">
                @if ($homeSliders->count() === 1)
                    @php($banner = $homeSliders->first())
                    @if ($banner->link)
                        <a href="{{ $banner->link }}">
                            <img src="{{ asset('storage/' . $banner->image) }}" class="img-fluid w-100 rounded shadow-sm"
                                alt="{{ $banner->title }}">
                        </a>
                    @else
                        <img src="{{ asset('storage/' . $banner->image) }}" class="img-fluid w-100 rounded shadow-sm"
                            alt="{{ $banner->title }}">
                    @endif
                @else
                    <div id="homeSlider" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner rounded shadow-sm">
                            @foreach ($homeSliders as $banner)
                                <div class="carousel-item @if ($loop->first) active @endif">
                                    @if ($banner->link)
                                        <a href="{{ $banner->link }}">
                                            <img src="{{ asset('storage/' . $banner->image) }}" class="d-block w-100"
                                                alt="{{ $banner->title }}">
                                        </a>
                                    @else
                                        <img src="{{ asset('storage/' . $banner->image) }}" class="d-block w-100"
                                            alt="{{ $banner->title }}">
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#homeSlider"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#homeSlider"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @endif
            </section>
        @endif




        <section class="mb-1">
            <div class="row g-1 home-main-grid align-items-stretch">
                <div class="col-lg-6 featured-news-column d-flex flex-column">
                    <div class="home-column-heading d-flex flex-column flex-md-row align-items-md-center gap-2 mb-3">
                        <h1 class="h4 section-title mb-0 flex-shrink-0">Tin nổi bật</h1>

                        @if ($latestArticles->isNotEmpty())
                            <div class="news-ticker">
                                <span class="news-ticker-label">Tin nhanh:</span>
                                <div class="news-ticker-track">
                                    <div class="news-ticker-content">
                                        @foreach ($latestArticles->take(2) as $article)
                                            <a href="{{ route('frontend.articles.show', $article->slug) }}"
                                                class="news-ticker-link">
                                                {{ $article->title }}
                                            </a>
                                            @unless ($loop->last)
                                                <span class="mx-2">•</span>
                                            @endunless
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    @if ($featuredArticles->isNotEmpty())
                        @if ($featuredArticles->count() > 1)
                            <div class="featured-news-card">
                                <div id="featuredArticlesCarousel" class="carousel slide featured-news-carousel h-100"
                                    data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="hover"
                                    data-bs-touch="true">

                                    <div class="carousel-indicators mb-0">
                                        @foreach ($featuredArticles as $article)
                                            <button type="button" data-bs-target="#featuredArticlesCarousel"
                                                data-bs-slide-to="{{ $loop->index }}"
                                                class="{{ $loop->first ? 'active' : '' }}"
                                                aria-current="{{ $loop->first ? 'true' : 'false' }}"
                                                aria-label="Tin nổi bật {{ $loop->iteration }}">
                                            </button>
                                        @endforeach
                                    </div>

                                    <div class="carousel-inner h-100">
                                        @foreach ($featuredArticles as $article)
                                            <div
                                                class="carousel-item h-100 @if ($loop->first) active @endif">
                                                <div class="card border-0 shadow-sm overflow-hidden h-100">
                                                    @if ($article->thumbnail)
                                                        <a href="{{ route('frontend.articles.show', $article->slug) }}">
                                                            <img src="{{ asset('storage/' . $article->thumbnail) }}"
                                                                class="card-img-top featured-news-image"
                                                                alt="{{ $article->title }}">
                                                        </a>
                                                    @endif

                                                    <div class="card-body p-4 featured-carousel-caption">

                                                        <div class="article-publish-meta mb-2"><strong> <span
                                                                    class="article-publish-date">
                                                                    {{ ($article->published_at ?? $article->created_at)->format('d/m/Y') }}
                                                                </span></strong> <strong><span
                                                                    class="article-meta-dot">•</span> <span
                                                                    class="article-age"
                                                                    data-published-at="{{ ($article->published_at ?? $article->created_at)->toIso8601String() }}"
                                                                    title="Đăng lúc {{ ($article->published_at ?? $article->created_at)->format('d/m/Y H:i:s') }}">
                                                                    {{ ($article->published_at ?? $article->created_at)->locale('vi')->diffForHumans() }}
                                                                </span></strong>
                                                        </div>

                                                        <h2 class="h3 featured-carousel-title">
                                                            <a class="text-decoration-none text-dark"
                                                                href="{{ route('frontend.articles.show', $article->slug) }}">
                                                                {{ $article->title }}
                                                            </a>
                                                        </h2>

                                                        @if ($article->summary)
                                                            <p class=" summary-tnb text-muted mb-0">{{ $article->summary }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#featuredArticlesCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>

                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#featuredArticlesCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        @else
                            @php($article = $featuredArticles->first())

                            <div class="featured-news-card">
                                <div class="card border-0 shadow-sm overflow-hidden h-100">
                                    @if ($article->thumbnail)
                                        <a href="{{ route('frontend.articles.show', $article->slug) }}">
                                            <img src="{{ asset('storage/' . $article->thumbnail) }}"
                                                class="card-img-top featured-news-image" alt="{{ $article->title }}">
                                        </a>
                                    @endif

                                    <div class="card-body p-4 featured-carousel-caption">
                                        <div class="small text-muted mb-2">
                                            {{ $article->published_at?->format('d/m/Y') ?: $article->created_at->format('d/m/Y') }}
                                        </div>

                                        <h2 class="h3 featured-carousel-title">
                                            <a class="text-decoration-none text-dark"
                                                href="{{ route('frontend.articles.show', $article->slug) }}">
                                                {{ $article->title }}
                                            </a>
                                        </h2>

                                        @if ($article->summary)
                                            <p class="summary-tnb text-muted mb-0">{{ $article->summary }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="alert alert-light border featured-news-card">
                            Chưa có tin nổi bật.
                        </div>
                    @endif
                </div>

                <div class="latest-news-column">
                    <div class="section-header-custom">
                        <h2 class="h4 section-title mb-0">
                            Tin mới nhất
                        </h2>

                        <div id="weather-box">
                            <span>Đang tải...</span>
                        </div>
                    </div>

                    <div class="latest-news-card shadow-sm">
                        <div class="latest-news-scroll list-group list-group-flush">
                            @forelse ($latestArticles as $article)
                                <a href="{{ route('frontend.articles.show', $article->slug) }}"
                                    class="list-group-item list-group-item-action latest-news-item-with-thumb">
                                    <div class="latest-news-thumb">
                                        @if ($article->thumbnail)
                                            <img src="{{ asset('storage/' . $article->thumbnail) }}"
                                                alt="{{ $article->title }}">
                                        @else
                                            <div class="latest-news-thumb-placeholder">
                                                Tin
                                            </div>
                                        @endif
                                    </div>

                                    <div class="latest-news-info">
                                        <div class="fw-semibold text-dark latest-news-title">
                                            {{ $article->title }}
                                        </div>

                                        <div class="latest-news-time mt-1">
                                            <span class="latest-news-date">
                                                {{ ($article->published_at ?? $article->created_at)->format('d/m/Y') }}
                                            </span>

                                            <span class="latest-news-time-dot">•</span>

                                            <span class="article-age latest-news-age"
                                                data-published-at="{{ ($article->published_at ?? $article->created_at)->toIso8601String() }}">
                                                {{ ($article->published_at ?? $article->created_at)->locale('vi')->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="list-group-item text-muted text-center py-4">
                                    Chưa có bài viết.
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>

                <div class="col-lg-3 hotline-column d-flex flex-column">
                    <div class="home-column-heading d-flex align-items-center" style="margin-bottom: 12px !important">
                        <h2 class="h4 section-title mb-0">Đường Dây Nóng</h2>
                    </div>

                    <div class="hotline-box flex-grow-1">
                        <div class="hotline-information">
                            <div class="hotline-item"> <span class="hotline-time-icon">🗓️
                                    <strong> {{ now()->format('d/m/Y H:i:s') }} </strong></span>
                            </div>

                            <div class="hotline-item"> <span class="hotline-item-icon hotline-icon-phone"> ☎ <strong>Đang
                                        cập nhật</strong></span>

                            </div>
                            <div class="hotline-item"> <span class="hotline-item-icon hotline-icon-email"> ✉ <strong>
                                        vhxh.vinhbinh@angiang.gov.vn </strong></span>

                            </div>
                            <div class="hotline-item"> <span class="hotline-item-icon hotline-icon-address"> ⌂ Địa chỉ:
                                    <strong>Xã Vĩnh Bình, tỉnh An Giang</strong></span>

                            </div>
                            <div class="hotline-item"> <span class="hotline-item-icon hotline-icon-time"> ⏰ <span
                                        class="hotline-item-label"> Thời gian tiếp nhận
                                    </span> <strong> Thứ Hai - Thứ Sáu, giờ hành chính </strong></span>
                                <div class="hotline-item-content"> </div>
                            </div>
                            <div class="hotline-item"> <span class="hotline-item-icon hotline-icon-field"> 📌 <span
                                        class="hotline-item-label"> Lĩnh vực tiếp nhận
                                    </span> <strong> Văn hóa, xã hội, giáo dục, y tế và đời sống nhân dân </strong></span>
                                <div class="hotline-item-content"> </div>
                            </div>
                            <div class="hotline-item"> <span class="hotline-item-icon hotline-icon-form"> 📝 <span
                                        class="hotline-item-label"> Hình thức tiếp nhận
                                    </span> <strong> Trực tiếp tại cơ quan hoặc qua điện thoại </strong></span>
                                <div class="hotline-item-content"> </div>
                            </div>
                        </div>
                        <div class="hotline-note">
                            <div class="hotline-note-icon">💬</div>
                            <div> <strong>Phản ánh và kiến nghị</strong>
                                <p> Tiếp nhận thông tin liên quan đến lĩnh vực văn hóa, xã hội...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-1">
            <div class="row g-1">
                <div class="col-lg-8">

                    <div class="latest-documents-panel">
                        {{-- Tiêu đề --}}
                        <div class="latest-documents-header">
                            <h2>VĂN BẢN MỚI BAN HÀNH</h2>
                        </div>

                        {{-- Các loại văn bản --}}
                        <div class="document-category-tabs">
                            <a href="{{ url('/') }}#latest-documents"
                                class="document-category-tab {{ empty($selectedDocumentCategoryId) ? 'active' : '' }}">
                                <span class="document-category-icon">■</span>
                                Tất cả
                            </a>

                            @foreach ($documentCategories as $documentCategory)
                                <a href="{{ url('/') }}?document_category_id={{ $documentCategory->id }}#latest-documents"
                                    class="document-category-tab {{ (int) $selectedDocumentCategoryId === (int) $documentCategory->id ? 'active' : '' }}">
                                    <span class="document-category-icon">◆</span>
                                    {{ $documentCategory->name }}
                                </a>
                            @endforeach
                        </div>

                        {{-- Danh sách văn bản có thanh cuộn --}}
                        <div id="latest-documents" class="latest-documents-scroll">
                            @forelse ($latestDocuments as $document)
                                <a href="{{ route('frontend.documents.show', $document->slug) }}"
                                    class="latest-document-item">
                                    <span class="latest-document-bullet">◆</span>

                                    <div class="latest-document-content">
                                        <h3 class="latest-document-title">
                                            {{ $document->title }}
                                        </h3>

                                        <div class="latest-document-meta">
                                            @if ($document->code)
                                                <span>
                                                    Số hiệu:
                                                    <strong>{{ $document->code }}</strong>
                                                </span>
                                            @endif

                                            @if ($document->issued_at)
                                                <span>
                                                    Ngày ban hành:
                                                    <strong>
                                                        {{ $document->issued_at->format('d/m/Y') }}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="latest-documents-empty">
                                    <div class="latest-documents-empty-icon">
                                        📄
                                    </div>

                                    <strong>Chưa có văn bản mới</strong>

                                    <span>
                                        Các văn bản mới ban hành sẽ được hiển thị tại đây.
                                    </span>
                                </div>
                            @endforelse
                        </div>
                    </div>


                    <div class="work-schedule-box mt-1">
                        <h2 class="portal-section-title">LỊCH LÀM VIỆC CỦA PHÒNG VĂN HÓA XÃ HỘI</h2>
                        <div class="p-3">
                            <div class="table-responsive">

                                <table class="table work-schedule-table">
                                    <colgroup>
                                        <col class="work-schedule-col-day">
                                        <col class="work-schedule-col-content">
                                        <col class="work-schedule-col-session">
                                        <col class="work-schedule-col-session">
                                        <col class="work-schedule-col-note">
                                    </colgroup>

                                    <thead>
                                        <tr>
                                            <th>Thứ/ngày</th>
                                            <th>Nội dung công việc</th>
                                            <th class="work-schedule-session-heading">
                                                Buổi sáng
                                            </th>
                                            <th class="work-schedule-session-heading">
                                                Buổi chiều
                                            </th>
                                            <th>Ghi chú</th>
                                        </tr>
                                    </thead>



                                    <tbody>
                                        @forelse (($workSchedules ?? collect()) as $workSchedule)
                                            <tr>


                                                <th scope="row" class="work-schedule-day-cell">
                                                    <strong class="work-schedule-day-name">
                                                        {{ $workSchedule->day_name }}
                                                    </strong>

                                                    <span class="work-schedule-date">
                                                        <span class="work-schedule-date-label">
                                                            Ngày
                                                        </span>

                                                        <span class="work-schedule-date-value">
                                                            {{ now('Asia/Ho_Chi_Minh')->startOfWeek(\Carbon\CarbonInterface::MONDAY)->addDays($loop->index)->format('d/m/Y') }}
                                                        </span>
                                                    </span>
                                                </th>




                                                <td>{{ $workSchedule->is_working_day ? ($workSchedule->title ?: '-') : 'Nghỉ' }}
                                                </td>
                                                @if ($workSchedule->is_working_day)
                                                    <td class="work-schedule-time-cell">
                                                        {{ $workSchedule->morning_time ?: '-' }}
                                                    </td>

                                                    <td class="work-schedule-time-cell">
                                                        {{ $workSchedule->afternoon_time ?: '-' }}
                                                    </td>
                                                @else
                                                    <td>-</td>
                                                    <td>-</td>
                                                @endif
                                                <td>{{ $workSchedule->note ?: '-' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <th scope="row">Thứ Hai - Thứ Sáu</th>
                                                <td>Làm việc bình thường</td>
                                                <td>07:00 - 11:00</td>
                                                <td>13:00 - 17:00</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Thứ Bảy, Chủ Nhật</th>
                                                <td>Nghỉ</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="small text-muted">Lịch làm việc có thể thay đổi theo thông báo của cơ quan.</div>
                        </div>
                    </div>

                    @if ($workScheduleBanners->isNotEmpty())
                        @if ($workScheduleBanners->count() > 1)
                            <div id="workScheduleBanner" class="carousel slide work-schedule-banner mt-0"
                                data-bs-ride="carousel" data-bs-interval="4500" data-bs-pause="hover"
                                data-bs-touch="true">
                                <div class="carousel-inner">
                                    @foreach ($workScheduleBanners as $banner)
                                        <div class="carousel-item h-100 {{ $loop->first ? 'active' : '' }}">
                                            @if ($banner->link)
                                                <a href="{{ $banner->link }}" target="_blank" rel="noopener">
                                                    <img src="{{ asset('storage/' . $banner->image) }}"
                                                        class="d-block w-100 work-schedule-banner-image"
                                                        alt="{{ $banner->title }}">
                                                </a>
                                            @else
                                                <img src="{{ asset('storage/' . $banner->image) }}"
                                                    class="d-block w-100 work-schedule-banner-image"
                                                    alt="{{ $banner->title }}">
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                <button class="carousel-control-prev" type="button" data-bs-target="#workScheduleBanner"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#workScheduleBanner"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @else
                            @php($banner = $workScheduleBanners->first())
                            <div class="work-schedule-banner mt-0">
                                @if ($banner->link)
                                    <a href="{{ $banner->link }}" target="_blank" rel="noopener">
                                        <img src="{{ asset('storage/' . $banner->image) }}"
                                            class="d-block w-100 work-schedule-banner-image" alt="{{ $banner->title }}">
                                    </a>
                                @else
                                    <img src="{{ asset('storage/' . $banner->image) }}"
                                        class="d-block w-100 work-schedule-banner-image" alt="{{ $banner->title }}">
                                @endif
                            </div>
                        @endif
                    @endif

                    {{-- Thông báo và banner tuyên truyền --}}
                    <div class="row g-2 mt-0 homepage-secondary-row">
                        {{-- Thông báo --}}
                        <div class="col-md-6 d-flex">
                            <div class="homepage-notice-card">
                                <div class="homepage-notice-header">
                                    <span class="homepage-notice-heading">
                                        <span class="homepage-notice-icon">🔔</span>
                                        {{ mb_strtoupper($noticeCategory?->name ?? 'Thông báo', 'UTF-8') }}
                                    </span>

                                    @if ($noticeCategory)
                                        <a href="{{ route('frontend.categories.show', $noticeCategory->slug) }}"
                                            class="homepage-notice-view-all">
                                            Xem tất cả
                                        </a>
                                    @endif
                                </div>

                                <div class="homepage-notice-scroll">

                                    @forelse (($noticeArticles ?? collect()) as $noticeArticle)
                                        <a href="{{ route('frontend.articles.show', $noticeArticle->slug) }}"
                                            class="notice-box-item" title="{{ $noticeArticle->title }}">
                                            <span class="notice-box-bullet"></span>

                                            <span class="notice-box-title">
                                                {{ $noticeArticle->title }}
                                            </span>

                                            <span class="notice-box-date">
                                                {{ ($noticeArticle->published_at ?? $noticeArticle->created_at)->format('d/m') }}
                                            </span>
                                        </a>
                                    @empty
                                        <div class="homepage-notice-empty">
                                            <span>📄</span>
                                            <span>Chưa có thông báo mới.</span>
                                        </div>
                                    @endforelse

                                </div>
                            </div>
                        </div>

                        {{-- Banner tuyên truyền --}}
                        <div class="col-md-6 d-flex">
                            <div class="homepage-propaganda-card">
                                @if (($propagandaBanners ?? collect())->isNotEmpty())

                                    <div id="propagandaBannerCarousel" class="carousel slide homepage-propaganda-carousel"
                                        data-bs-ride="carousel" data-bs-interval="3000" data-bs-pause="hover"
                                        data-bs-touch="true" data-bs-wrap="true">

                                        <div class="carousel-inner h-100">
                                            @foreach ($propagandaBanners ?? collect() as $banner)
                                                <div class="carousel-item h-100 {{ $loop->first ? 'active' : '' }}">
                                                    @if ($banner->link)
                                                        <a href="{{ $banner->link }}" target="_blank"
                                                            rel="noopener noreferrer" class="homepage-propaganda-link">
                                                            <img src="{{ asset('storage/' . $banner->image) }}"
                                                                class="homepage-propaganda-image"
                                                                alt="{{ $banner->title }}">
                                                        </a>
                                                    @else
                                                        <img src="{{ asset('storage/' . $banner->image) }}"
                                                            class="homepage-propaganda-image" alt="{{ $banner->title }}">
                                                    @endif

                                                    <span class="homepage-propaganda-badge">
                                                        TUYÊN TRUYỀN
                                                    </span>

                                                    @if ($banner->title)
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>

                                        @if (($propagandaBanners ?? collect())->count() > 1)
                                            <button class="carousel-control-prev homepage-propaganda-control"
                                                type="button" data-bs-target="#propagandaBannerCarousel"
                                                data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>

                                                <span class="visually-hidden">
                                                    Banner trước
                                                </span>
                                            </button>

                                            <button class="carousel-control-next homepage-propaganda-control"
                                                type="button" data-bs-target="#propagandaBannerCarousel"
                                                data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>

                                                <span class="visually-hidden">
                                                    Banner tiếp theo
                                                </span>
                                            </button>

                                            <div class="carousel-indicators homepage-propaganda-indicators">
                                                @foreach ($propagandaBanners ?? collect() as $banner)
                                                    <button type="button" data-bs-target="#propagandaBannerCarousel"
                                                        data-bs-slide-to="{{ $loop->index }}"
                                                        class="{{ $loop->first ? 'active' : '' }}"
                                                        aria-current="{{ $loop->first ? 'true' : 'false' }}"
                                                        aria-label="Banner {{ $loop->iteration }}"></button>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="homepage-propaganda-empty">
                                        <span class="homepage-propaganda-empty-icon">📢</span>

                                        <div>
                                            <strong>BANNER TUYÊN TRUYỀN</strong>
                                            <small>Chưa có banner đang hoạt động.</small>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="portal-section">
                        <div class="lookup-header-with-counter">
                            <span>TRA CỨU</span>

                            <span class="site-visit-counter">
                                👁 Lượt truy cập: {{ number_format($siteVisitCount ?? 0) }}
                            </span>
                        </div>
                        <div class="lookup-banner-list">
                            @forelse($lookupLinks as $lookupLink)
                                <a href="{{ $lookupLink->url ?: '#' }}" class="lookup-banner-item"
                                    @if ($lookupLink->open_new_tab && $lookupLink->url) target="_blank" rel="noopener" @endif>

                                    @if ($lookupLink->image_path)
                                        <img src="{{ asset('storage/' . $lookupLink->image_path) }}"
                                            alt="{{ $lookupLink->title }}" class="lookup-banner-image">
                                    @else
                                        <div class="lookup-banner-fallback">
                                            {{ $lookupLink->title }}
                                        </div>
                                    @endif

                                </a>
                            @empty
                                <div class="text-muted p-3">
                                    Chưa có mục tra cứu.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="school-links-box mt-1">
                        <h2 class="portal-section-title">LIÊN KẾT TRƯỜNG HỌC</h2>
                        <div class="p-3">
                            <div class="school-links-list">
                                @forelse($schoolLinks as $schoolLink)
                                    @if ($schoolLink->url)
                                        <a href="{{ $schoolLink->url }}" class="school-link-item" target="_blank"
                                            rel="noopener">
                                        @else
                                            <div class="school-link-item">
                                    @endif

                                    <div class="school-link-logo">
                                        @if ($schoolLink->logo_path)
                                            <img src="{{ asset('storage/' . $schoolLink->logo_path) }}"
                                                alt="{{ $schoolLink->name }}">
                                        @else
                                            <span>{{ mb_substr($schoolLink->name, 0, 1) }}</span>
                                        @endif
                                    </div>

                                    <div class="school-link-name">
                                        {{ $schoolLink->name }}
                                    </div>

                                    @if ($schoolLink->url)
                                        </a>
                                    @else
                            </div>
                            @endif
                        @empty
                            <div class="text-muted p-3">
                                Chưa có liên kết trường học.
                            </div>
                            @endforelse
                        </div>

                    </div>
                </div>
            </div>
    </div>
    </section>

    <section>
        <div class="row g-1">
            @foreach ($primaryCategories as $category)
                @php($leadArticle = $category->articles->first())
                <div class="col-lg-4">
                    <div class="portal-news-box">
                        <div class="d-flex justify-content-between align-items-center portal-section-title">
                            <span>{{ $category->name }}</span>
                            <a href="{{ route('frontend.categories.show', $category->slug) }}"
                                class="small text-white text-decoration-none">Xem thêm</a>
                        </div>
                        <div class="box-body">
                            @if ($leadArticle)
                                @if ($leadArticle->thumbnail)
                                    <img src="{{ asset('storage/' . $leadArticle->thumbnail) }}"
                                        class="featured-image mb-3" alt="{{ $leadArticle->title }}">
                                @endif
                                <h3 class="h6">
                                    <a class="text-dark text-decoration-none"
                                        href="{{ route('frontend.articles.show', $leadArticle->slug) }}">{{ $leadArticle->title }}</a>
                                </h3>
                                <div class="small text-muted mb-2">
                                    {{ $leadArticle->published_at?->format('d/m/Y') ?: $leadArticle->created_at->format('d/m/Y') }}
                                </div>
                                @foreach ($category->articles->skip(1)->take(4) as $article)
                                    <div class="news-list-item">
                                        <a class="text-dark text-decoration-none"
                                            href="{{ route('frontend.articles.show', $article->slug) }}">{{ $article->title }}</a>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted mb-0">Chưa có bài viết.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
        </div>
    </section>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hotlineClock = document.getElementById('hotline-clock');
            if (!hotlineClock) {
                return;
            }

            function updateHotlineClock() {
                const now = new Date();
                const date = new Intl.DateTimeFormat('vi-VN', {
                    timeZone: 'Asia/Ho_Chi_Minh',
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                }).format(now);
                const time = new Intl.DateTimeFormat('vi-VN', {
                    timeZone: 'Asia/Ho_Chi_Minh',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: false
                }).format(now);
                hotlineClock.textContent = date + ' · ' + time;
            }
            updateHotlineClock();
            setInterval(updateHotlineClock, 1000);

        });
        document.addEventListener('DOMContentLoaded', function() {
            const propagandaCarouselElement =
                document.getElementById('propagandaBannerCarousel');

            if (
                !propagandaCarouselElement ||
                typeof bootstrap === 'undefined'
            ) {
                return;
            }

            const propagandaCarousel =
                bootstrap.Carousel.getOrCreateInstance(
                    propagandaCarouselElement, {
                        interval: 3000,
                        ride: 'carousel',
                        pause: 'hover',
                        wrap: true,
                        touch: true,
                    }
                );

            propagandaCarousel.cycle();
        });
    </script>
@endsection
