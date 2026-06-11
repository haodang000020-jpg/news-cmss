@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="bg-white rounded shadow-sm p-4 mb-4">
            <h1 class="h3 section-title mb-3">Văn bản chỉ đạo điều hành</h1>

            <form method="GET" action="{{ route('frontend.documents.index') }}" class="row g-3">
                <div class="col-lg-6">
                    <label for="q" class="form-label">Từ khóa</label>
                    <input
                        type="search"
                        class="form-control"
                        id="q"
                        name="q"
                        value="{{ $keyword }}"
                        placeholder="Nhập tiêu đề, số ký hiệu, cơ quan ban hành"
                    >
                </div>

                <div class="col-lg-4">
                    <label for="document_category_id" class="form-label">Loại văn bản</label>
                    <select class="form-select" id="document_category_id" name="document_category_id">
                        <option value="">Tất cả</option>
                        @foreach ($documentCategories as $documentCategory)
                            <option
                                value="{{ $documentCategory->id }}"
                                @selected((string) $selectedDocumentCategoryId === (string) $documentCategory->id)
                            >
                                {{ $documentCategory->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
                </div>
            </form>
        </div>

        <div class="list-group shadow-sm">
            @forelse ($documents as $document)
                <a href="{{ route('frontend.documents.show', $document->slug) }}" class="list-group-item list-group-item-action p-4">
                    <div class="d-flex flex-column flex-lg-row justify-content-between gap-2">
                        <div>
                            <h2 class="h5 mb-2 text-dark">{{ $document->title }}</h2>

                            <div class="d-flex flex-wrap gap-3 small text-muted">
                                @if ($document->code)
                                    <span>Số ký hiệu: {{ $document->code }}</span>
                                @endif

                                @if ($document->issuer)
                                    <span>Cơ quan ban hành: {{ $document->issuer }}</span>
                                @endif

                                @if ($document->issued_at)
                                    <span>Ngày ban hành: {{ $document->issued_at->format('d/m/Y') }}</span>
                                @endif

                                @if ($document->category)
                                    <span>Loại văn bản: {{ $document->category->name }}</span>
                                @endif
                            </div>
                        </div>

                        <span class="text-primary small fw-semibold">Xem chi tiết</span>
                    </div>
                </a>
            @empty
                <div class="list-group-item p-4 text-muted">Chưa có văn bản.</div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $documents->links() }}
        </div>
    </div>
@endsection
