@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <h1 class="h3 mb-4">Tìm kiếm</h1>

        @if ($keyword === '')
            <div class="alert alert-info">Vui lòng nhập từ khóa tìm kiếm.</div>
        @else
            <p class="text-muted">Kết quả cho: <strong>{{ $keyword }}</strong></p>
        @endif

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
                @if ($keyword !== '')
                    <div class="col-12">
                        <p class="text-muted">Không tìm thấy bài viết phù hợp.</p>
                    </div>
                @endif
            @endforelse
        </div>

        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    </div>
@endsection
