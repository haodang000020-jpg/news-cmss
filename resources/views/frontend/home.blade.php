@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <section class="mb-5">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h1 class="h3 mb-0">Tin nổi bật</h1>
            </div>
            <div class="row g-4">
                @forelse ($featuredArticles as $article)
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100">
                            @if ($article->thumbnail)
                                <img src="{{ asset('storage/'.$article->thumbnail) }}" class="card-img-top" alt="{{ $article->title }}">
                            @endif
                            <div class="card-body">
                                <h2 class="h6 card-title">
                                    <a class="text-decoration-none" href="{{ route('frontend.articles.show', $article->slug) }}">{{ $article->title }}</a>
                                </h2>
                                <p class="card-text small text-muted">{{ $article->published_at?->format('d/m/Y') ?: $article->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">Chưa có tin nổi bật.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <section class="mb-5">
            <h2 class="h4 mb-3">Tin mới nhất</h2>
            <div class="list-group">
                @forelse ($latestArticles as $article)
                    <a href="{{ route('frontend.articles.show', $article->slug) }}" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <strong>{{ $article->title }}</strong>
                            <small>{{ $article->published_at?->format('d/m/Y') ?: $article->created_at->format('d/m/Y') }}</small>
                        </div>
                        @if ($article->summary)
                            <p class="mb-0 mt-1 text-muted">{{ $article->summary }}</p>
                        @endif
                    </a>
                @empty
                    <p class="text-muted">Chưa có bài viết.</p>
                @endforelse
            </div>
        </section>

        <section>
            <h2 class="h4 mb-3">Tin theo chuyên mục</h2>
            <div class="row g-4">
                @foreach ($categories as $category)
                    <div class="col-lg-6">
                        <div class="border rounded p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3 class="h5 mb-0">{{ $category->name }}</h3>
                                <a href="{{ route('frontend.categories.show', $category->slug) }}" class="small">Xem thêm</a>
                            </div>
                            @forelse ($category->articles as $article)
                                <div class="border-top py-2">
                                    <a class="fw-semibold text-decoration-none" href="{{ route('frontend.articles.show', $article->slug) }}">{{ $article->title }}</a>
                                    <div class="small text-muted">{{ $article->published_at?->format('d/m/Y') ?: $article->created_at->format('d/m/Y') }}</div>
                                </div>
                            @empty
                                <p class="text-muted mb-0">Chưa có bài viết.</p>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
