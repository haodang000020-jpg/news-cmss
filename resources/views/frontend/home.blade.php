@extends('frontend.layouts.app')

@section('content')
    <div class="container">
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
            <section class="mb-5">
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

        <section>
            <h2 class="h4 section-title mb-3">Tin theo chuyên mục</h2>
            <div class="row g-4">
                @foreach ($categories as $category)
                    <div class="col-lg-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h3 class="h5 mb-0">{{ $category->name }}</h3>
                                <a href="{{ route('frontend.categories.show', $category->slug) }}" class="small text-decoration-none">Xem thêm</a>
                            </div>
                            <div class="card-body">
                                @forelse ($category->articles as $article)
                                    <div class="border-bottom pb-3 mb-3">
                                        <a class="fw-semibold text-decoration-none text-dark" href="{{ route('frontend.articles.show', $article->slug) }}">{{ $article->title }}</a>
                                        <div class="small text-muted mt-1">{{ $article->published_at?->format('d/m/Y') ?: $article->created_at->format('d/m/Y') }}</div>
                                    </div>
                                @empty
                                    <p class="text-muted mb-0">Chưa có bài viết.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
