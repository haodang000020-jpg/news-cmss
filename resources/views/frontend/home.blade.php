@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        @if ($homeSliders->isNotEmpty())
            <section class="mb-1">
                @if ($homeSliders->count() === 1)
                    @php($banner = $homeSliders->first())
                    @if ($banner->link)
                        <a href="{{ $banner->link }}">
                            <img src="{{ asset('storage/' . $banner->image) }}" class="img-fluid w-100 rounded shadow-sm" alt="{{ $banner->title }}">
                        </a>
                    @else
                        <img src="{{ asset('storage/' . $banner->image) }}" class="img-fluid w-100 rounded shadow-sm" alt="{{ $banner->title }}">
                    @endif
                @else
                    <div id="homeSlider" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner rounded shadow-sm">
                            @foreach ($homeSliders as $banner)
                                <div class="carousel-item @if ($loop->first) active @endif">
                                    @if ($banner->link)
                                        <a href="{{ $banner->link }}">
                                            <img src="{{ asset('storage/' . $banner->image) }}" class="d-block w-100" alt="{{ $banner->title }}">
                                        </a>
                                    @else
                                        <img src="{{ asset('storage/' . $banner->image) }}" class="d-block w-100" alt="{{ $banner->title }}">
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#homeSlider" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#homeSlider" data-bs-slide="next">
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
                                    <a href="{{ route('frontend.articles.show', $article->slug) }}" class="news-ticker-link">
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
                        <div id="featuredArticlesCarousel"
                             class="carousel slide featured-news-carousel h-100"
                             data-bs-ride="carousel"
                             data-bs-interval="5000"
                             data-bs-pause="hover"
                             data-bs-touch="true">

                            <div class="carousel-indicators">
                                @foreach ($featuredArticles as $article)
                                    <button
                                        type="button"
                                        data-bs-target="#featuredArticlesCarousel"
                                        data-bs-slide-to="{{ $loop->index }}"
                                        class="@if ($loop->first) active @endif"
                                        aria-current="@if ($loop->first) true @endif"
                                        aria-label="Tin nổi bật {{ $loop->iteration }}">
                                    </button>
                                @endforeach
                            </div>

                            <div class="carousel-inner h-100">
                                @foreach ($featuredArticles as $article)
                                    <div class="carousel-item h-100 @if ($loop->first) active @endif">
                                        <div class="card border-0 shadow-sm overflow-hidden h-100">
                                            @if ($article->thumbnail)
                                                <a href="{{ route('frontend.articles.show', $article->slug) }}">
                                                    <img src="{{ asset('storage/'.$article->thumbnail) }}"
                                                         class="card-img-top featured-news-image"
                                                         alt="{{ $article->title }}">
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
                                                    <p class="text-muted mb-0">{{ $article->summary }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#featuredArticlesCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>

                            <button class="carousel-control-next" type="button" data-bs-target="#featuredArticlesCarousel" data-bs-slide="next">
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
                                    <img src="{{ asset('storage/'.$article->thumbnail) }}"
                                         class="card-img-top featured-news-image"
                                         alt="{{ $article->title }}">
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
                                    <p class="text-muted mb-0">{{ $article->summary }}</p>
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
    <h2 class="h4 section-title">Tin mới nhất</h2>

    <div class="list-group shadow-sm latest-news-card latest-news-card-with-thumb">
    @forelse ($latestArticles->take(6) as $article)
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

                <div class="small text-muted mt-1">
                    {{ $article->published_at?->format('d/m/Y') ?: $article->created_at->format('d/m/Y') }}
                </div>
            </div>
        </a>
    @empty
        <div class="list-group-item text-muted">Chưa có bài viết.</div>
    @endforelse
</div>
</div>

        <div class="col-lg-3 hotline-column d-flex flex-column">
            <div class="home-column-heading d-flex align-items-center mb-3">
                <h2 class="h4 section-title mb-0">Đường Dây Nóng</h2>
            </div>

            <div class="hotline-box">
                <div class="hotline-item fw-semibold">Phòng Văn hóa - Xã hội xã Vĩnh Bình</div>
                <div class="hotline-item">☎ Điện thoại: Đang cập nhật</div>
                <div class="hotline-item">✉ Email: Đang cập nhật</div>
                <div class="hotline-item">⌂ Địa chỉ: Xã Vĩnh Bình, tỉnh An Giang</div>
                <div class="hotline-item">⏰ Thời gian tiếp nhận: Thứ Hai - Thứ Sáu, giờ hành chính</div>
                <div class="hotline-item">📌 Lĩnh vực tiếp nhận: Văn hóa, xã hội, giáo dục, y tế, đời sống nhân dân</div>
                <div class="hotline-item">📝 Hình thức tiếp nhận: Trực tiếp tại cơ quan hoặc qua điện thoại</div>
                <p class="hotline-note">
                    Tiếp nhận phản ánh, kiến nghị liên quan đến lĩnh vực văn hóa, xã hội, giáo dục, y tế và đời sống nhân dân.
                </p>
            </div>
        </div>
    </div>
</section>

        <section class="mb-1">
            <div class="row g-1">
                <div class="col-lg-8">
                    <div class="portal-section">
                        <div class="d-flex justify-content-between align-items-center portal-section-title">
                            <span>Văn bản mới ban hành</span>
                            <a href="{{ route('frontend.documents.index') }}" class="small text-white text-decoration-none">Xem thêm</a>
                        </div>
                        <div class="document-list">
                            @forelse (($latestDocuments ?? collect()) as $document)
                                <div class="document-item d-flex gap-2">
                                    <span class="document-icon">◆</span>
                                    <div>
                                        <a class="fw-semibold text-dark text-decoration-none" href="{{ route('frontend.documents.show', $document->slug) }}">
                                            {{ $document->title }}
                                        </a>
                                        <div class="small text-muted mt-1">
                                            @if ($document->code)
                                                <span>Số hiệu: {{ $document->code }}</span>
                                            @endif
                                            @if ($document->issued_at)
                                                <span class="ms-2">Ngày ban hành: {{ $document->issued_at->format('d/m/Y') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-3 text-muted">Chưa có văn bản mới.</div>
                            @endforelse
                        </div>
                    </div>

                    <div class="work-schedule-box mt-1">
                        <h2 class="portal-section-title">LỊCH LÀM VIỆC CỦA PHÒNG VĂN HÓA XÃ HỘI</h2>
                        <div class="p-3">
                            <div class="table-responsive">
                                <table class="table work-schedule-table mb-3">
                                    <thead>
                                        <tr>
                                            <th>Thứ/ngày</th>
                                            <th>Nội dung công việc</th>
                                            <th>Buổi sáng</th>
                                            <th>Buổi chiều</th>
                                            <th>Ghi chú</th>
                                        </tr>
                                    </thead>
                                    <tbody>                          
                                        @forelse (($workSchedules ?? collect()) as $workSchedule)
                                            <tr>
                                                <th scope="row">{{ $workSchedule->day_name }}</th> 
                                                <td>{{ $workSchedule->is_working_day ? ($workSchedule->title ?: '-') : 'Nghỉ' }}</td>
                                                @if ($workSchedule->is_working_day)
                                                    <td>{{ $workSchedule->morning_time ?: '-' }}</td>
                                                    <td>{{ $workSchedule->afternoon_time ?: '-' }}</td>
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
                            <div id="workScheduleBanner" class="carousel slide work-schedule-banner mt-4" data-bs-ride="carousel" data-bs-interval="4500" data-bs-pause="hover" data-bs-touch="true">
                                <div class="carousel-inner">
                                    @foreach ($workScheduleBanners as $banner)
                                        <div class="carousel-item @if ($loop->first) active @endif">
                                            @if ($banner->link)
                                                <a href="{{ $banner->link }}" target="_blank" rel="noopener">
                                                    <img src="{{ asset('storage/' . $banner->image) }}" class="d-block w-100 work-schedule-banner-image" alt="{{ $banner->title }}">
                                                </a>
                                            @else
                                                <img src="{{ asset('storage/' . $banner->image) }}" class="d-block w-100 work-schedule-banner-image" alt="{{ $banner->title }}">
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                <button class="carousel-control-prev" type="button" data-bs-target="#workScheduleBanner" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#workScheduleBanner" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @else
                            @php($banner = $workScheduleBanners->first())
                            <div class="work-schedule-banner mt-4">
                                @if ($banner->link)
                                    <a href="{{ $banner->link }}" target="_blank" rel="noopener">
                                        <img src="{{ asset('storage/' . $banner->image) }}" class="d-block w-100 work-schedule-banner-image" alt="{{ $banner->title }}">
                                    </a>
                                @else
                                    <img src="{{ asset('storage/' . $banner->image) }}" class="d-block w-100 work-schedule-banner-image" alt="{{ $banner->title }}">
                                @endif
                            </div>
                        @endif
                    @endif
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
                                <a href="{{ $lookupLink->url ?: '#' }}"
                                class="lookup-banner-item"
                                @if($lookupLink->open_new_tab && $lookupLink->url) target="_blank" rel="noopener" @endif>

                                    @if($lookupLink->image_path)
                                        <img src="{{ asset('storage/' . $lookupLink->image_path) }}"
                                            alt="{{ $lookupLink->title }}"
                                            class="lookup-banner-image">
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
                                    @if($schoolLink->url)
                                        <a href="{{ $schoolLink->url }}" class="school-link-item" target="_blank" rel="noopener">
                                    @else
                                        <div class="school-link-item">
                                    @endif

                                        <div class="school-link-logo">
                                            @if($schoolLink->logo_path)
                                                <img src="{{ asset('storage/' . $schoolLink->logo_path) }}" alt="{{ $schoolLink->name }}">
                                            @else
                                                <span>{{ mb_substr($schoolLink->name, 0, 1) }}</span>
                                            @endif
                                        </div>

                                        <div class="school-link-name">
                                            {{ $schoolLink->name }}
                                        </div>

                                    @if($schoolLink->url)
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
                                <a href="{{ route('frontend.categories.show', $category->slug) }}" class="small text-white text-decoration-none">Xem thêm</a>
                            </div>
                            <div class="box-body">
                                @if ($leadArticle)
                                    @if ($leadArticle->thumbnail)
                                        <img src="{{ asset('storage/'.$leadArticle->thumbnail) }}" class="featured-image mb-3" alt="{{ $leadArticle->title }}">
                                    @endif
                                    <h3 class="h6">
                                        <a class="text-dark text-decoration-none" href="{{ route('frontend.articles.show', $leadArticle->slug) }}">{{ $leadArticle->title }}</a>
                                    </h3>
                                    <div class="small text-muted mb-2">{{ $leadArticle->published_at?->format('d/m/Y') ?: $leadArticle->created_at->format('d/m/Y') }}</div>
                                    @foreach ($category->articles->skip(1)->take(4) as $article)
                                        <div class="news-list-item">
                                            <a class="text-dark text-decoration-none" href="{{ route('frontend.articles.show', $article->slug) }}">{{ $article->title }}</a>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-muted mb-0">Chưa có bài viết.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-lg-4">
                    <div class="portal-sidebar-box">
                        <div class="d-flex justify-content-between align-items-center portal-section-title">
                            <span>Thông báo</span>
                            @if ($noticeCategory)
                                <a href="{{ route('frontend.categories.show', $noticeCategory->slug) }}" class="small text-white text-decoration-none">Xem thêm</a>
                            @endif
                        </div>
                        <div class="box-body">
                            @php($noticeLead = $noticeArticles->first())
                            @if ($noticeLead)
                                @if ($noticeLead->thumbnail)
                                    <img src="{{ asset('storage/'.$noticeLead->thumbnail) }}" class="featured-image mb-3" alt="{{ $noticeLead->title }}">
                                @endif
                                <h3 class="h6">
                                    <a class="text-dark text-decoration-none" href="{{ route('frontend.articles.show', $noticeLead->slug) }}">{{ $noticeLead->title }}</a>
                                </h3>
                                <div class="small text-muted mb-2">{{ $noticeLead->published_at?->format('d/m/Y') ?: $noticeLead->created_at->format('d/m/Y') }}</div>
                                @foreach ($noticeArticles->skip(1)->take(4) as $article)
                                    <div class="news-list-item">
                                        <a class="text-dark text-decoration-none" href="{{ route('frontend.articles.show', $article->slug) }}">{{ $article->title }}</a>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted mb-0">Chưa có thông báo.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
