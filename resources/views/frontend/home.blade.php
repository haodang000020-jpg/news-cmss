@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        @if ($homeSliders->isNotEmpty())
            <section class="mb-4">
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

        <section class="mb-4">
            <div class="row g-4 home-main-grid">
                <div class="col-lg-6 featured-news-column">
                    <div class="d-flex flex-column flex-md-row align-items-md-center gap-2 mb-3">
                        <h1 class="h4 section-title mb-0 flex-shrink-0">Tin nổi bật</h1>
                        @if ($latestArticles->isNotEmpty())
                            <div class="news-ticker">
                                <span class="news-ticker-label">Tin nhanh:</span>
                                <div class="news-ticker-track">
                                    <div class="news-ticker-content">
                                        @foreach ($latestArticles->take(2) as $article)
                                            <a href="{{ route('frontend.articles.show', $article->slug) }}" class="news-ticker-link">{{ $article->title }}</a>
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
                            <div id="featuredArticlesCarousel" class="carousel slide featured-news-carousel" data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="hover" data-bs-touch="true">
                                <div class="carousel-indicators">
                                    @foreach ($featuredArticles as $article)
                                        <button type="button" data-bs-target="#featuredArticlesCarousel" data-bs-slide-to="{{ $loop->index }}" class="@if ($loop->first) active @endif" aria-current="@if ($loop->first) true @endif" aria-label="Tin nổi bật {{ $loop->iteration }}"></button>
                                    @endforeach
                                </div>

                                <div class="carousel-inner">
                                    @foreach ($featuredArticles as $article)
                                        <div class="carousel-item @if ($loop->first) active @endif">
                                            <div class="card border-0 shadow-sm overflow-hidden">
                                                @if ($article->thumbnail)
                                                    <a href="{{ route('frontend.articles.show', $article->slug) }}">
                                                        <img src="{{ asset('storage/'.$article->thumbnail) }}" class="card-img-top featured-news-image" alt="{{ $article->title }}">
                                                    </a>
                                                @endif
                                                <div class="card-body p-4 featured-carousel-caption">
                                                    <div class="small text-muted mb-2">{{ $article->published_at?->format('d/m/Y') ?: $article->created_at->format('d/m/Y') }}</div>
                                                    <h2 class="h3 featured-carousel-title">
                                                        <a class="text-decoration-none text-dark" href="{{ route('frontend.articles.show', $article->slug) }}">{{ $article->title }}</a>
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
                        @else
                            @php($article = $featuredArticles->first())
                            <div class="featured-news-carousel">
                                <div class="card border-0 shadow-sm overflow-hidden">
                                    @if ($article->thumbnail)
                                        <a href="{{ route('frontend.articles.show', $article->slug) }}">
                                            <img src="{{ asset('storage/'.$article->thumbnail) }}" class="card-img-top featured-news-image" alt="{{ $article->title }}">
                                        </a>
                                    @endif
                                    <div class="card-body p-4 featured-carousel-caption">
                                        <div class="small text-muted mb-2">{{ $article->published_at?->format('d/m/Y') ?: $article->created_at->format('d/m/Y') }}</div>
                                        <h2 class="h3 featured-carousel-title">
                                            <a class="text-decoration-none text-dark" href="{{ route('frontend.articles.show', $article->slug) }}">{{ $article->title }}</a>
                                        </h2>
                                        @if ($article->summary)
                                            <p class="text-muted mb-0">{{ $article->summary }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="alert alert-light border">Chưa có tin nổi bật.</div>
                    @endif
                </div>

                <div class="col-lg-3 latest-news-column">
                    <h2 class="h4 section-title mb-3">Tin mới nhất</h2>
                    <div class="list-group shadow-sm">
                        @forelse ($latestArticles->take(6) as $article)
                            <a href="{{ route('frontend.articles.show', $article->slug) }}" class="list-group-item list-group-item-action p-3">
                                <div class="fw-semibold text-dark">{{ $article->title }}</div>
                                <div class="small text-muted mt-1">{{ $article->published_at?->format('d/m/Y') ?: $article->created_at->format('d/m/Y') }}</div>
                            </a>
                        @empty
                            <div class="list-group-item text-muted">Chưa có bài viết.</div>
                        @endforelse
                    </div>
                </div>

                <div class="col-lg-3 hotline-column">
                    <div class="hotline-box">
                        <h2 class="hotline-title">THÔNG TIN ĐƯỜNG DÂY NÓNG PHÒNG VH-XH</h2>
                        <div class="hotline-item fw-semibold">Phòng Văn hóa - Xã hội xã Vĩnh Bình</div>
                        <div class="hotline-item">☎ Điện thoại: Đang cập nhật</div>
                        <div class="hotline-item">✉ Email: Đang cập nhật</div>
                        <div class="hotline-item">⌂ Địa chỉ: Xã Vĩnh Bình, tỉnh An Giang</div>
                        <div class="hotline-item">⏰ Thời gian tiếp nhận: Thứ Hai - Thứ Sáu, giờ hành chính</div>
                        <p class="hotline-note">Tiếp nhận phản ánh, kiến nghị liên quan đến lĩnh vực văn hóa, xã hội, giáo dục, y tế và đời sống nhân dân.</p>
                        <div class="hotline-actions">
                            <a href="#" class="btn btn-sm btn-primary">Gọi ngay</a>
                            <a href="#" class="btn btn-sm btn-outline-primary">Gửi email</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-4">
            <div class="row g-4">
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

                    <div class="work-schedule-box mt-4">
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
                        <h2 class="portal-section-title">Tra cứu</h2>
                        <div class="utility-grid">
                            <a href="#" class="lookup-card lookup-blue">Dịch vụ công trực tuyến</a>
                            <a href="#" class="lookup-card lookup-red">Nộp hồ sơ trực tuyến</a>
                            <a href="#" class="lookup-card lookup-orange">Tra cứu hồ sơ</a>
                            <a href="#" class="lookup-card lookup-blue">Bộ thủ tục của tất cả cơ quan</a>
                            <a href="#" class="lookup-card lookup-red">Phản ánh kiến nghị</a>
                            <a href="#" class="lookup-card lookup-orange">Hiến kế cho UBND</a>
                            <a href="#" class="lookup-card lookup-blue">Lịch làm việc của UBND</a>
                            <a href="{{ route('frontend.documents.index') }}" class="lookup-card lookup-red">Công báo</a>
                        </div>
                    </div>

                    <div class="school-links-box mt-4">
                        <h2 class="portal-section-title">LIÊN KẾT TRƯỜNG HỌC</h2>
                        <div class="p-3">
                            <a href="#" class="school-link-card">
                                <img src="{{ asset('images/school-links/school-default.svg') }}" class="school-link-image" alt="Trường Mầm non Vĩnh Bình">
                                <span>Trường Mầm non Vĩnh Bình</span>
                            </a>
                            <a href="#" class="school-link-card">
                                <img src="{{ asset('images/school-links/school-default.svg') }}" class="school-link-image" alt="Trường Tiểu học Vĩnh Bình">
                                <span>Trường Tiểu học Vĩnh Bình</span>
                            </a>
                            <a href="#" class="school-link-card">
                                <img src="{{ asset('images/school-links/school-default.svg') }}" class="school-link-image" alt="Trường THCS Vĩnh Bình">
                                <span>Trường THCS Vĩnh Bình</span>
                            </a>
                            <a href="#" class="school-link-card">
                                <img src="{{ asset('images/school-links/school-default.svg') }}" class="school-link-image" alt="Trung tâm học tập cộng đồng">
                                <span>Trung tâm học tập cộng đồng</span>
                            </a>
                             <a href="#" class="school-link-card">
                                <img src="{{ asset('images/school-links/school-default.svg') }}" class="school-link-image" alt="Trường Mầm non Vĩnh Bình">
                                <span>Trường Mầm non Vĩnh Bình</span>
                            </a>
                            <a href="#" class="school-link-card">
                                <img src="{{ asset('images/school-links/school-default.svg') }}" class="school-link-image" alt="Trường Tiểu học Vĩnh Bình">
                                <span>Trường Tiểu học Vĩnh Bình</span>
                            </a>
                            <a href="#" class="school-link-card">
                                <img src="{{ asset('images/school-links/school-default.svg') }}" class="school-link-image" alt="Trường THCS Vĩnh Bình">
                                <span>Trường THCS Vĩnh Bình</span>
                            </a>
                            <a href="#" class="school-link-card">
                                <img src="{{ asset('images/school-links/school-default.svg') }}" class="school-link-image" alt="Trung tâm học tập cộng đồng">
                                <span>Trung tâm học tập cộng đồng</span>
                            </a>
                             <a href="#" class="school-link-card">
                                <img src="{{ asset('images/school-links/school-default.svg') }}" class="school-link-image" alt="Trường Mầm non Vĩnh Bình">
                                <span>Trường Mầm non Vĩnh Bình</span>
                            </a>
                            <a href="#" class="school-link-card">
                                <img src="{{ asset('images/school-links/school-default.svg') }}" class="school-link-image" alt="Trường Tiểu học Vĩnh Bình">
                                <span>Trường Tiểu học Vĩnh Bình</span>
                            </a>
                            <a href="#" class="school-link-card">
                                <img src="{{ asset('images/school-links/school-default.svg') }}" class="school-link-image" alt="Trường THCS Vĩnh Bình">
                                <span>Trường THCS Vĩnh Bình</span>
                            </a>
                         
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="row g-4">
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
