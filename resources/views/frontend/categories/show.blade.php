@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="mb-4">
            <h1 class="h3">{{ $category->name }}</h1>
            @if ($category->description)
                <p class="text-muted">{{ $category->description }}</p>
            @endif
        </div>

        <div class="row g-4">
            @forelse ($articles as $article)
                <div class="col-md-6">
                    <div class="card h-100">
                        @if ($article->thumbnail)
                            <img src="{{ asset('storage/'.$article->thumbnail) }}" class="card-img-top" alt="{{ $article->title }}">
                        @endif
                        <div class="card-body">
                            <h2 class="h5 card-title">
                                <a class="text-decoration-none" href="{{ route('frontend.articles.show', $article->slug) }}">{{ $article->title }}</a>
                            </h2>
                            @if ($article->summary)
                                <p class="card-text">{{ $article->summary }}</p>
                            @endif
                            <p class="small text-muted mb-0">{{ $article->published_at?->format('d/m/Y') ?: $article->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">Chưa có bài viết trong chuyên mục này.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    </div>
@endsection
