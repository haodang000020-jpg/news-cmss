@extends('frontend.layouts.app')

@section('content')
    @include('frontend.feedbacks._styles')

    @php
        $statusClass = match ($feedback->status) {
            \App\Models\CitizenFeedback::STATUS_RECEIVED => 'feedback-status-received',
            \App\Models\CitizenFeedback::STATUS_PROCESSING => 'feedback-status-processing',
            \App\Models\CitizenFeedback::STATUS_RESOLVED => 'feedback-status-resolved',
            \App\Models\CitizenFeedback::STATUS_REJECTED => 'feedback-status-rejected',
            default => 'feedback-status-new',
        };
    @endphp

    <main class="feedback-page">
        <div class="container px-0">
            <section class="feedback-hero">
                <h1>Theo dõi phản ánh</h1>
                <p>Thông tin dưới đây chỉ hiển thị qua đường dẫn riêng và không xuất hiện trong danh sách công khai.</p>
            </section>

            <div class="mt-3">
                @if (session('status'))
                    <div class="feedback-alert feedback-alert-success">{{ session('status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="feedback-alert feedback-alert-danger">{{ $errors->first() }}</div>
                @endif
            </div>

            <div class="feedback-grid">
                <div class="d-grid gap-3 align-content-start">
                    <section class="feedback-card">
                        <div class="feedback-card-header">
                            <h2>{{ $feedback->subject }}</h2>
                            <span class="feedback-status-badge {{ $statusClass }}">
                                {{ $feedback->statusLabel() }}
                            </span>
                        </div>

                        <div class="feedback-card-body">
                            @if (session('new_tracking_code'))
                                <div class="feedback-alert feedback-alert-success">
                                    <strong>Gửi thành công.</strong> Hãy lưu lại mã tra cứu bên dưới.
                                </div>
                            @endif

                            <div class="mb-3">
                                <div class="feedback-help mb-1">Mã tra cứu</div>
                                <span class="feedback-tracking-code">{{ $feedback->tracking_code }}</span>
                            </div>

                            <div class="feedback-summary-grid">
                                <div class="feedback-summary-item">
                                    <small>Lĩnh vực</small>
                                    <strong>{{ $feedback->category?->name }}</strong>
                                </div>
                                <div class="feedback-summary-item">
                                    <small>Ngày gửi</small>
                                    <strong>{{ $feedback->created_at?->format('d/m/Y H:i') }}</strong>
                                </div>
                                <div class="feedback-summary-item">
                                    <small>Liên hệ</small>
                                    <strong>{{ $feedback->maskedContact() }}</strong>
                                </div>
                                @if ($feedback->location)
                                    <div class="feedback-summary-item">
                                        <small>Địa điểm</small>
                                        <strong>{{ $feedback->location }}</strong>
                                    </div>
                                @endif
                                <div class="feedback-summary-item">
                                    <small>Tệp đính kèm</small>
                                    <strong>{{ $feedback->attachments->count() }} tệp</strong>
                                </div>
                                <div class="feedback-summary-item">
                                    <small>Cập nhật gần nhất</small>
                                    <strong>{{ $feedback->updated_at?->format('d/m/Y H:i') }}</strong>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="feedback-card">
                        <div class="feedback-card-header">
                            <h2>Nội dung đã gửi</h2>
                        </div>
                        <div class="feedback-card-body">
                            <div class="feedback-content-box">{{ $feedback->content }}</div>

                            @if ($feedback->attachments->isNotEmpty())
                                <div class="mt-3">
                                    <div class="feedback-label">Tệp đính kèm</div>
                                    <div class="feedback-attachment-list">
                                        @foreach ($feedback->attachments as $attachment)
                                            <a
                                                href="{{ route('frontend.feedbacks.attachments.download', [$feedback->public_id, $attachment]) }}"
                                                class="feedback-attachment-link"
                                            >
                                                <span>{{ $attachment->original_name }}</span>
                                                <small>{{ $attachment->humanSize() }}</small>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </section>

                    @if ($feedback->admin_response)
                        <section class="feedback-card">
                            <div class="feedback-card-header">
                                <h2>Phản hồi của cơ quan</h2>
                            </div>
                            <div class="feedback-card-body">
                                <div class="feedback-response-box">{{ $feedback->admin_response }}</div>
                                @if ($feedback->responded_at)
                                    <div class="feedback-help mt-2">
                                        Cập nhật lúc {{ $feedback->responded_at->format('d/m/Y H:i') }}
                                    </div>
                                @endif
                            </div>
                        </section>
                    @endif

                    @if ($feedback->status === \App\Models\CitizenFeedback::STATUS_RESOLVED)
                        <section class="feedback-card">
                            <div class="feedback-card-header">
                                <h2>Đánh giá mức độ hài lòng</h2>
                            </div>
                            <div class="feedback-card-body">
                                @if ($feedback->satisfaction_at)
                                    <div class="feedback-alert feedback-alert-success mb-0">
                                        Bạn đã đánh giá {{ $feedback->satisfaction_rating }}/5 điểm.
                                        @if ($feedback->satisfaction_comment)
                                            <div class="mt-2">{{ $feedback->satisfaction_comment }}</div>
                                        @endif
                                    </div>
                                @else
                                    <form method="POST" action="{{ route('frontend.feedbacks.rate', $feedback->public_id) }}">
                                        @csrf
                                        <div class="feedback-rating-grid mb-3">
                                            @for ($rating = 1; $rating <= 5; $rating++)
                                                <label class="feedback-rating-option">
                                                    <input type="radio" name="rating" value="{{ $rating }}" required>
                                                    <span>{{ $rating }}/5</span>
                                                </label>
                                            @endfor
                                        </div>
                                        <textarea
                                            name="comment"
                                            class="feedback-textarea"
                                            maxlength="1000"
                                            placeholder="Ý kiến thêm về kết quả xử lý (không bắt buộc)"
                                            style="min-height: 90px;"
                                        ></textarea>
                                        <button type="submit" class="feedback-submit mt-3">Gửi đánh giá</button>
                                    </form>
                                @endif
                            </div>
                        </section>
                    @endif
                </div>

                <aside class="d-grid gap-3 align-content-start">
                    <section class="feedback-card">
                        <div class="feedback-card-header">
                            <h2>Tiến độ xử lý</h2>
                        </div>
                        <div class="feedback-card-body">
                            <ol class="feedback-timeline">
                                @forelse ($feedback->histories as $history)
                                    <li class="feedback-timeline-item">
                                        <div class="feedback-timeline-title">{{ $history->toStatusLabel() }}</div>
                                        <div class="feedback-timeline-date">
                                            {{ $history->created_at?->format('d/m/Y H:i') }}
                                        </div>
                                        @if ($history->public_note)
                                            <div class="feedback-timeline-note">{{ $history->public_note }}</div>
                                        @endif
                                    </li>
                                @empty
                                    <li class="feedback-timeline-item">
                                        <div class="feedback-timeline-title">{{ $feedback->statusLabel() }}</div>
                                    </li>
                                @endforelse
                            </ol>
                        </div>
                    </section>

                    <section class="feedback-card">
                        <div class="feedback-card-header">
                            <h2>Thao tác nhanh</h2>
                        </div>
                        <div class="feedback-card-body d-grid gap-2">
                            <a href="{{ route('frontend.feedbacks.lookup.form') }}" class="feedback-secondary-link">
                                Tra cứu hồ sơ khác
                            </a>
                            <a href="{{ route('frontend.feedbacks.create') }}" class="feedback-secondary-link">
                                Gửi phản ánh mới
                            </a>
                        </div>
                    </section>
                </aside>
            </div>
        </div>
    </main>
@endsection
