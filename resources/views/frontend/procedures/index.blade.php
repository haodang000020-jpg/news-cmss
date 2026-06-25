@extends('frontend.layouts.app')

@section('content')
    <div class="container procedure-page">
        <section class="procedure-hero">
            <div class="procedure-hero-content">
                <span class="procedure-kicker">DỊCH VỤ SỐ CHO NGƯỜI DÂN</span>
                <h1>Tra cứu thủ tục hành chính</h1>
                <p>
                    Tìm nhanh thành phần hồ sơ, trình tự thực hiện, thời hạn giải quyết,
                    lệ phí và biểu mẫu cần thiết.
                </p>
            </div>

            <form method="GET" action="{{ route('frontend.procedures.index') }}" class="procedure-search-card">
                <div class="procedure-search-field">
                    <span aria-hidden="true">⌕</span>
                    <input
                        type="search"
                        name="q"
                        value="{{ $keyword }}"
                        placeholder="Nhập tên hoặc mã thủ tục..."
                        aria-label="Tìm thủ tục hành chính"
                    >
                </div>

                <select name="procedure_group_id" aria-label="Lọc theo lĩnh vực">
                    <option value="">Tất cả lĩnh vực</option>
                    @foreach ($procedureGroups as $procedureGroup)
                        <option
                            value="{{ $procedureGroup->id }}"
                            @selected((string) $selectedProcedureGroupId === (string) $procedureGroup->id)
                        >
                            {{ $procedureGroup->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit">Tìm kiếm</button>
            </form>
        </section>

        @if ($procedureGroups->isNotEmpty())
            <section class="procedure-groups-section">
                <div class="procedure-section-heading">
                    <div>
                        <span class="procedure-section-eyebrow">TRA CỨU THEO LĨNH VỰC</span>
                        <h2>Chọn lĩnh vực cần thực hiện</h2>
                    </div>
                    @if ($keyword !== '' || $selectedProcedureGroupId)
                        <a href="{{ route('frontend.procedures.index') }}" class="procedure-reset-link">Xóa bộ lọc</a>
                    @endif
                </div>

                <div class="procedure-group-grid">
                    @foreach ($procedureGroups as $procedureGroup)
                        <a
                            href="{{ route('frontend.procedures.index', ['procedure_group_id' => $procedureGroup->id]) }}"
                            class="procedure-group-card {{ (string) $selectedProcedureGroupId === (string) $procedureGroup->id ? 'is-active' : '' }}"
                        >
                            <span class="procedure-group-icon" aria-hidden="true">▤</span>
                            <span class="procedure-group-content">
                                <strong>{{ $procedureGroup->name }}</strong>
                                <small>{{ $procedureGroup->procedures_count }} thủ tục</small>
                            </span>
                            <span class="procedure-group-arrow" aria-hidden="true">›</span>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        @if ($keyword === '' && ! $selectedProcedureGroupId && $featuredProcedures->isNotEmpty())
            <section class="procedure-featured-section">
                <div class="procedure-section-heading">
                    <div>
                        <span class="procedure-section-eyebrow">ĐƯỢC QUAN TÂM</span>
                        <h2>Thủ tục nổi bật</h2>
                    </div>
                </div>

                <div class="procedure-featured-grid">
                    @foreach ($featuredProcedures as $featuredProcedure)
                        <a href="{{ route('frontend.procedures.show', $featuredProcedure->slug) }}" class="procedure-featured-card">
                            <span class="procedure-featured-badge">Nổi bật</span>
                            <span class="procedure-featured-group">{{ $featuredProcedure->group?->name }}</span>
                            <strong>{{ $featuredProcedure->name }}</strong>
                            @if ($featuredProcedure->processing_time)
                                <small>Thời hạn: {{ $featuredProcedure->processing_time }}</small>
                            @endif
                            <span class="procedure-featured-link">Xem hướng dẫn <span aria-hidden="true">→</span></span>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        <section class="procedure-results-section">
            <div class="procedure-section-heading procedure-result-heading">
                <div>
                    <span class="procedure-section-eyebrow">KẾT QUẢ TRA CỨU</span>
                    <h2>
                        @if ($keyword !== '')
                            Kết quả cho “{{ $keyword }}”
                        @else
                            Danh sách thủ tục
                        @endif
                    </h2>
                </div>
                <span class="procedure-result-count">{{ $procedures->total() }} kết quả</span>
            </div>

            <div class="procedure-list">
                @forelse ($procedures as $procedure)
                    <article class="procedure-list-card">
                        <div class="procedure-list-main">
                            <div class="procedure-list-meta">
                                @if ($procedure->group)
                                    <span class="procedure-list-group">{{ $procedure->group->name }}</span>
                                @endif
                                @if ($procedure->code)
                                    <span class="procedure-list-code">Mã: {{ $procedure->code }}</span>
                                @endif
                            </div>

                            <h3>
                                <a href="{{ route('frontend.procedures.show', $procedure->slug) }}">
                                    {{ $procedure->name }}
                                </a>
                            </h3>

                            @if ($procedure->summary)
                                <p>{{ $procedure->summary }}</p>
                            @endif

                            <div class="procedure-list-facts">
                                @if ($procedure->processing_time)
                                    <span><b>Thời hạn:</b> {{ $procedure->processing_time }}</span>
                                @endif
                                @if ($procedure->fee)
                                    <span><b>Lệ phí:</b> {{ $procedure->fee }}</span>
                                @endif
                                <span><b>Thành phần hồ sơ:</b> {{ $procedure->required_documents_count }}</span>
                            </div>
                        </div>

                        <a href="{{ route('frontend.procedures.show', $procedure->slug) }}" class="procedure-detail-button">
                            Xem chi tiết
                            <span aria-hidden="true">→</span>
                        </a>
                    </article>
                @empty
                    <div class="procedure-empty-state">
                        <span aria-hidden="true">⌕</span>
                        <h3>Chưa tìm thấy thủ tục phù hợp</h3>
                        <p>Hãy thử từ khóa ngắn hơn hoặc chọn lĩnh vực khác.</p>
                        <a href="{{ route('frontend.procedures.index') }}">Xem toàn bộ thủ tục</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $procedures->links('pagination::bootstrap-5') }}
            </div>
        </section>
    </div>
@endsection
