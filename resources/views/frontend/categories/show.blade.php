@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="bg-white rounded shadow-sm p-4 mb-4">
            <h1 class="h3 section-title mb-2">{{ $category->name }}</h1>
        </div>

        <div class="row g-4">
            @forelse ($articles as $article)
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        @if ($article->thumbnail)
                            <img src="{{ asset('storage/'.$article->thumbnail) }}" class="card-img-top article-thumb" alt="{{ $article->title }}">
                        @endif
                        <div class="card-body">
                            <div class="small text-muted mb-2">{{ $article->published_at?->format('d/m/Y') ?: $article->created_at->format('d/m/Y') }}</div>
                            <h2 class="h5 card-title" style="   font-size: 25px;
                                                                line-height: 1.35;
                                                                display: -webkit-box;
                                                                -webkit-line-clamp: 2;
                                                                -webkit-box-orient: vertical;
                                                                overflow: hidden;
                                                                font-weight: 700;
                                                            }">
                                <a class="text-decoration-none text-dark" href="{{ route('frontend.articles.show', $article->slug) }}">{{ $article->title }}</a>
                            </h2>
                            @if ($article->summary)
                                <p class="card-text text-muted"  style="   font-size: 15px;
                                                                line-height: 1.35;
                                                                display: -webkit-box;
                                                                -webkit-line-clamp: 3;
                                                                -webkit-box-orient: vertical;
                                                                overflow: hidden;
                                                                font-weight: 600;
                                                            }">{{ $article->summary }}</p>
                            @endif
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('frontend.articles.show', $article->slug) }}">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-light border">Chưa có bài viết trong chuyên mục này.</div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    </div>
@endsection
