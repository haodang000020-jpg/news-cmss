@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Trang chủ</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
            </ol>
        </nav>

        <article class="bg-white rounded shadow-sm p-4 p-lg-5">
            <h1 class="display-6 fw-bold text-dark mb-3">{{ $page->title }}</h1>

            @if ($page->summary)
                <p class="lead border-start border-4 border-primary ps-3 text-secondary mb-4">
                    {{ $page->summary }}
                </p>
            @endif

            <div class="lh-lg fs-6">
                {!! nl2br(e($page->content)) !!}
            </div>
        </article>
    </div>
@endsection
