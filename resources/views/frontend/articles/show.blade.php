@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="row g-4">
            <article class="col-lg-8">
                <div class="bg-white rounded shadow-sm p-4 p-lg-5">
                    @if ($article->category)
                        <a href="{{ route('frontend.categories.show', $article->category->slug) }}" class="badge text-bg-primary text-decoration-none mb-3">
                            {{ $article->category->name }}
                        </a>
                    @endif

                    <h1 class="display-6 fw-bold text-dark">{{ $article->title }}</h1>

                    <div class="d-flex flex-wrap gap-3 text-muted small border-bottom pb-3 mb-4">
                        <span>Ngày đăng: {{ $article->published_at?->format('d/m/Y H:i') ?: $article->created_at->format('d/m/Y H:i') }}</span>
                        @if ($article->user)
                            <span>Tác giả: {{ $article->user->name }}</span>
                        @endif
                        @if ($article->category)
                            <span>Chuyên mục: {{ $article->category->name }}</span>
                        @endif
                        <span>{{ number_format($article->view_count) }} lượt xem</span>
                    </div>

                    @if ($article->thumbnail)
                        <img src="{{ asset('storage/'.$article->thumbnail) }}" class="img-fluid rounded mb-4 w-100" alt="{{ $article->title }}">
                    @endif

                    @if ($article->summary)
                        <p class="lead border-start border-4 border-primary ps-3 text-secondary">{{ $article->summary }}</p>
                    @endif

                    <div class="lh-lg fs-6 pre-line">{{ $article->content }}</div>
                </div>
            </article>

            <aside class="col-lg-4">
                <div class="bg-white rounded shadow-sm p-4">
                    <h2 class="h5 section-title mb-3">Bài viết liên quan</h2>
                    <div class="list-group list-group-flush">
                        @forelse ($relatedArticles as $relatedArticle)
                            <a href="{{ route('frontend.articles.show', $relatedArticle->slug) }}" class="list-group-item list-group-item-action px-0">
                                <div class="fw-semibold">{{ $relatedArticle->title }}</div>
                                <div class="small text-muted mt-1">{{ $relatedArticle->published_at?->format('d/m/Y') ?: $relatedArticle->created_at->format('d/m/Y') }}</div>
                            </a>
                        @empty
                            <p class="text-muted mb-0">Chưa có bài viết liên quan.</p>
                        @endforelse
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection
