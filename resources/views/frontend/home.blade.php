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
            <div class="row g-4">
                <div class="col-lg-7">
                    <h1 class="h4 section-title mb-3">Tin nổi bật</h1>
                    @forelse ($featuredArticles->take(1) as $article)
                        <div class="card border-0 shadow-sm overflow-hidden">
                            @if ($article->thumbnail)
                                <img src="{{ asset('storage/'.$article->thumbnail) }}" class="card-img-top featured-thumb" alt="{{ $article->title }}">
                            @endif
                            <div class="card-body p-4">
                                <div class="small text-muted mb-2">{{ $article->published_at?->format('d/m/Y') ?: $article->created_at->format('d/m/Y') }}</div>
                                <h2 class="h3">
                                    <a class="text-decoration-none text-dark" href="{{ route('frontend.articles.show', $article->slug) }}">{{ $article->title }}</a>
                                </h2>
                                @if ($article->summary)
                                    <p class="text-muted mb-0">{{ $article->summary }}</p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-light border">Chưa có tin nổi bật.</div>
                    @endforelse
                </div>

                <div class="col-lg-5">
                    <h2 class="h4 section-title mb-3">Tin mới nhất</h2>
                    <div class="list-group shadow-sm">
                        @forelse ($latestArticles as $article)
                            <a href="{{ route('frontend.articles.show', $article->slug) }}" class="list-group-item list-group-item-action p-3">
                                <div class="fw-semibold text-dark">{{ $article->title }}</div>
                                <div class="small text-muted mt-1">{{ $article->published_at?->format('d/m/Y') ?: $article->created_at->format('d/m/Y') }}</div>
                            </a>
                        @empty
                            <div class="list-group-item text-muted">Chưa có bài viết.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        @if ($featuredArticles->count() > 1)
            <section class="mb-4">
                <div class="row g-4">
                    @foreach ($featuredArticles->skip(1) as $article)
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                @if ($article->thumbnail)
                                    <img src="{{ asset('storage/'.$article->thumbnail) }}" class="card-img-top article-thumb" alt="{{ $article->title }}">
                                @endif
                                <div class="card-body">
                                    <h3 class="h6 card-title">
                                        <a class="text-decoration-none text-dark" href="{{ route('frontend.articles.show', $article->slug) }}">{{ $article->title }}</a>
                                    </h3>
                                    <div class="small text-muted">{{ $article->published_at?->format('d/m/Y') ?: $article->created_at->format('d/m/Y') }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <section class="mb-4">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="portal-section h-100">
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
                </div>

                <div class="col-lg-4">
                    <div class="portal-section h-100">
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
