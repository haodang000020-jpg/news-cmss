@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="bg-white rounded shadow-sm p-4 p-lg-5">
            @if ($document->category)
                <span class="badge text-bg-primary mb-3">{{ $document->category->name }}</span>
            @endif

            <h1 class="display-6 fw-bold text-dark mb-3">{{ $document->title }}</h1>

            <div class="row g-3 text-muted border-bottom pb-4 mb-4">
                @if ($document->code)
                    <div class="col-md-6">
                        <span class="fw-semibold text-dark">Số ký hiệu:</span> {{ $document->code }}
                    </div>
                @endif

                @if ($document->issuer)
                    <div class="col-md-6">
                        <span class="fw-semibold text-dark">Cơ quan ban hành:</span> {{ $document->issuer }}
                    </div>
                @endif

                @if ($document->issued_at)
                    <div class="col-md-6">
                        <span class="fw-semibold text-dark">Ngày ban hành:</span> {{ $document->issued_at->format('d/m/Y') }}
                    </div>
                @endif

                @if ($document->effective_at)
                    <div class="col-md-6">
                        <span class="fw-semibold text-dark">Ngày hiệu lực:</span> {{ $document->effective_at->format('d/m/Y') }}
                    </div>
                @endif

                @if ($document->category)
                    <div class="col-md-6">
                        <span class="fw-semibold text-dark">Loại văn bản:</span> {{ $document->category->name }}
                    </div>
                @endif

                <div class="col-md-6">
                    <span class="fw-semibold text-dark">Lượt tải:</span> {{ number_format($document->download_count) }}
                </div>
            </div>

            @if ($document->summary)
                <div class="mb-4">
                    <h2 class="h5 section-title mb-3">Tóm tắt</h2>
                    <p class="text-secondary mb-0">{{ $document->summary }}</p>
                </div>
            @endif

            <div class="border rounded p-4">
                <h2 class="h5 section-title mb-3">Tệp đính kèm</h2>

                @if ($document->file_name)
                    <div class="mb-2">
                        <span class="fw-semibold">Tên tệp:</span> {{ $document->file_name }}
                    </div>
                @endif

                @if ($document->file_size)
                    <div class="mb-3">
                        <span class="fw-semibold">Dung lượng:</span> {{ number_format($document->file_size) }} bytes
                    </div>
                @endif

                @if ($document->file_path)
                    <a href="{{ route('frontend.documents.download', $document) }}" class="btn btn-primary">
                        Tải văn bản
                    </a>
                @else
                    <p class="text-muted mb-0">Chưa có tệp đính kèm.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
