@extends('frontend.layouts.app')

@section('content')
    <div class="container procedure-page procedure-detail-page">
        <nav class="procedure-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Trang chủ</a>
            <span>/</span>
            <a href="{{ route('frontend.procedures.index') }}">Thủ tục hành chính</a>
            @if ($procedure->group)
                <span>/</span>
                <a href="{{ route('frontend.procedures.index', ['procedure_group_id' => $procedure->group->id]) }}">
                    {{ $procedure->group->name }}
                </a>
            @endif
        </nav>

        <section class="procedure-detail-hero">
            <div class="procedure-detail-heading">
                <div class="procedure-list-meta">
                    @if ($procedure->group)
                        <span class="procedure-list-group">{{ $procedure->group->name }}</span>
                    @endif
                    @if ($procedure->code)
                        <span class="procedure-list-code">Mã thủ tục: {{ $procedure->code }}</span>
                    @endif
                </div>

                <h1>{{ $procedure->name }}</h1>

                @if ($procedure->summary)
                    <p>{{ $procedure->summary }}</p>
                @endif

                @if ($procedure->updated_on)
                    <div class="procedure-updated-date">
                        Cập nhật ngày {{ $procedure->updated_on->format('d/m/Y') }}
                    </div>
                @endif
            </div>

            <div class="procedure-detail-actions">
                @if ($procedure->service_url)
                    <a href="{{ $procedure->service_url }}" target="_blank" rel="noopener noreferrer" class="procedure-primary-action">
                        Nộp hồ sơ trực tuyến
                        <span aria-hidden="true">↗</span>
                    </a>
                @endif
                <button type="button" class="procedure-secondary-action" onclick="window.print()">
                    In hướng dẫn
                </button>
            </div>
        </section>

        <div class="procedure-detail-layout">
            <main class="procedure-detail-main">
                <section class="procedure-content-card">
                    <div class="procedure-content-title">
                        <span aria-hidden="true">i</span>
                        <h2>Thông tin thực hiện</h2>
                    </div>

                    <div class="procedure-info-grid">
                        @if ($procedure->applicants)
                            <div class="procedure-info-item">
                                <span>Đối tượng thực hiện</span>
                                <strong>{{ $procedure->applicants }}</strong>
                            </div>
                        @endif

                        @if ($procedure->implementing_agency)
                            <div class="procedure-info-item">
                                <span>Cơ quan thực hiện</span>
                                <strong>{{ $procedure->implementing_agency }}</strong>
                            </div>
                        @endif

                        @if ($procedure->processing_time)
                            <div class="procedure-info-item">
                                <span>Thời hạn giải quyết</span>
                                <strong>{{ $procedure->processing_time }}</strong>
                            </div>
                        @endif

                        @if ($procedure->fee)
                            <div class="procedure-info-item">
                                <span>Lệ phí</span>
                                <strong>{{ $procedure->fee }}</strong>
                            </div>
                        @endif

                        @if ($procedure->dossier_quantity)
                            <div class="procedure-info-item">
                                <span>Số lượng hồ sơ</span>
                                <strong>{{ $procedure->dossier_quantity }}</strong>
                            </div>
                        @endif

                        @if ($procedure->result)
                            <div class="procedure-info-item">
                                <span>Kết quả thực hiện</span>
                                <strong>{{ $procedure->result }}</strong>
                            </div>
                        @endif
                    </div>

                    @if ($procedure->receiving_place || $procedure->implementation_method)
                        <div class="procedure-info-long-grid">
                            @if ($procedure->receiving_place)
                                <div>
                                    <h3>Nơi tiếp nhận</h3>
                                    <p>{!! nl2br(e($procedure->receiving_place)) !!}</p>
                                </div>
                            @endif
                            @if ($procedure->implementation_method)
                                <div>
                                    <h3>Cách thức thực hiện</h3>
                                    <p>{!! nl2br(e($procedure->implementation_method)) !!}</p>
                                </div>
                            @endif
                        </div>
                    @endif
                </section>

                <section class="procedure-content-card">
                    <div class="procedure-content-title">
                        <span aria-hidden="true">✓</span>
                        <h2>Thành phần hồ sơ</h2>
                    </div>

                    @if ($procedure->requiredDocuments->isNotEmpty())
                        <div class="procedure-document-list">
                            @foreach ($procedure->requiredDocuments as $index => $requiredDocument)
                                <article class="procedure-document-item">
                                    <span class="procedure-document-number">{{ $index + 1 }}</span>
                                    <div class="procedure-document-content">
                                        <div class="procedure-document-heading">
                                            <h3>{{ $requiredDocument->name }}</h3>
                                            @if ($requiredDocument->is_required)
                                                <span>Bắt buộc</span>
                                            @else
                                                <span class="is-optional">Không bắt buộc</span>
                                            @endif
                                        </div>

                                        <div class="procedure-document-counts">
                                            <span>Bản chính: <b>{{ $requiredDocument->original_count }}</b></span>
                                            <span>Bản sao: <b>{{ $requiredDocument->copy_count }}</b></span>
                                        </div>

                                        @if ($requiredDocument->note)
                                            <p>{{ $requiredDocument->note }}</p>
                                        @endif

                                        @if ($requiredDocument->form_path)
                                            <a href="{{ route('frontend.procedures.forms.download', $requiredDocument) }}" class="procedure-form-download">
                                                Tải biểu mẫu: {{ $requiredDocument->form_name ?: 'Tệp đính kèm' }}
                                            </a>
                                        @endif
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <p class="procedure-muted-message">Thành phần hồ sơ đang được cập nhật.</p>
                    @endif
                </section>

                <section class="procedure-content-card">
                    <div class="procedure-content-title">
                        <span aria-hidden="true">→</span>
                        <h2>Trình tự thực hiện</h2>
                    </div>

                    @if ($procedure->steps->isNotEmpty())
                        <div class="procedure-timeline">
                            @foreach ($procedure->steps as $index => $step)
                                <article class="procedure-timeline-item">
                                    <span class="procedure-timeline-number">{{ $index + 1 }}</span>
                                    <div>
                                        <h3>{{ $step->title }}</h3>
                                        @if ($step->description)
                                            <p>{!! nl2br(e($step->description)) !!}</p>
                                        @endif
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <p class="procedure-muted-message">Trình tự thực hiện đang được cập nhật.</p>
                    @endif
                </section>

                @if ($procedure->legal_basis)
                    <section class="procedure-content-card">
                        <div class="procedure-content-title">
                            <span aria-hidden="true">§</span>
                            <h2>Căn cứ pháp lý</h2>
                        </div>
                        <div class="procedure-legal-basis">{!! nl2br(e($procedure->legal_basis)) !!}</div>
                    </section>
                @endif
            </main>

            <aside class="procedure-detail-sidebar">
                <div class="procedure-help-card">
                    <span class="procedure-help-icon" aria-hidden="true">?</span>
                    <h2>Cần hỗ trợ?</h2>
                    <p>Liên hệ cán bộ phụ trách để được xác nhận thông tin trước khi nộp hồ sơ.</p>
                    <a href="{{ route('frontend.introduction') }}">Xem danh bạ cán bộ</a>
                </div>

                @if ($relatedProcedures->isNotEmpty())
                    <div class="procedure-related-card">
                        <h2>Thủ tục cùng lĩnh vực</h2>
                        <div>
                            @foreach ($relatedProcedures as $relatedProcedure)
                                <a href="{{ route('frontend.procedures.show', $relatedProcedure->slug) }}">
                                    <span>{{ $relatedProcedure->name }}</span>
                                    <b aria-hidden="true">›</b>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="procedure-disclaimer">
                    <strong>Lưu ý</strong>
                    <p>
                        Nội dung được cơ quan quản trị cập nhật để hỗ trợ tra cứu.
                        Khi cần xác nhận, vui lòng liên hệ bộ phận tiếp nhận hồ sơ.
                    </p>
                </div>
            </aside>
        </div>
    </div>
@endsection
