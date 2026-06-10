@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="row g-5">
            <article class="col-lg-8">
                <div class="mb-3">
                    @if ($article->category)
                        <a href="{{ route('frontend.categories.show', $article->category->slug) }}" class="badge text-bg-primary text-decoration-none">{{ $article->category->name }}</a>
                    @endif
                </div>

                <h1 class="h2">{{ $article->title }}</h1>

                <div class="text-muted small mb-3">
                    {{ $article->published_at?->format('d/m/Y H:i') ?: $article->created_at->format('d/m/Y H:i') }}
                    @if ($article->user)
                        · {{ $article->user->name }}
                    @endif
                    · {{ number_format($article->view_count) }} lượt xem
                </div>

                @if ($article->thumbnail)
                    <img src="{{ asset('storage/'.$article->thumbnail) }}" class="img-fluid rounded mb-4" alt="{{ $article->title }}">
                @endif

                @if ($article->summary)
                    <p class="lead">{{ $article->summary }}</p>
                @endif

                <div class="lh-lg">
                    {!! nl2br(e($article->content)) !!}
                </div>
            </article>

            <aside class="col-lg-4">
                <h2 class="h5 mb-3">Bài viết liên quan</h2>
                <div class="list-group">
                    @forelse ($relatedArticles as $relatedArticle)
                        <a href="{{ route('frontend.articles.show', $relatedArticle->slug) }}" class="list-group-item list-group-item-action">
                            {{ $relatedArticle->title }}
                        </a>
                    @empty
                        <p class="text-muted">Chưa có bài viết liên quan.</p>
                    @endforelse
                </div>
            </aside>
        </div>
    </div>
@endsection
