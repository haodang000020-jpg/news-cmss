@extends('frontend.layouts.app')

@section('content')
    @include('frontend.feedbacks._styles')

    <main class="feedback-page">
        <div class="container px-0">
            <section class="feedback-hero">
                <h1>Tra cứu phản ánh - kiến nghị</h1>
                <p>Nhập mã tra cứu cùng số điện thoại hoặc email đã dùng khi gửi phản ánh.</p>
            </section>

            <div class="feedback-grid">
                <section class="feedback-card">
                    <div class="feedback-card-header">
                        <h2>Thông tin tra cứu</h2>
                    </div>
                    <div class="feedback-card-body">
                        @if ($errors->any())
                            <div class="feedback-alert feedback-alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('frontend.feedbacks.lookup') }}">
                            @csrf
                            <div class="feedback-form-grid">
                                <div class="feedback-field-full">
                                    <label class="feedback-label" for="tracking_code">
                                        Mã tra cứu <span class="feedback-required">*</span>
                                    </label>
                                    <input
                                        id="tracking_code"
                                        name="tracking_code"
                                        type="text"
                                        value="{{ old('tracking_code') }}"
                                        class="feedback-input text-uppercase"
                                        placeholder="Ví dụ: PA-260625-ABC123"
                                        required
                                    >
                                </div>

                                <div class="feedback-field-full">
                                    <label class="feedback-label" for="contact">
                                        Số điện thoại hoặc email <span class="feedback-required">*</span>
                                    </label>
                                    <input
                                        id="contact"
                                        name="contact"
                                        type="text"
                                        value="{{ old('contact') }}"
                                        class="feedback-input"
                                        required
                                    >
                                </div>

                                <div class="feedback-field-full d-flex flex-wrap gap-2">
                                    <button type="submit" class="feedback-submit">Tra cứu trạng thái</button>
                                    <a href="{{ route('frontend.feedbacks.create') }}" class="feedback-secondary-link">
                                        Gửi phản ánh mới
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>

                <aside class="feedback-card align-self-start">
                    <div class="feedback-card-header">
                        <h2>Không tìm thấy mã?</h2>
                    </div>
                    <div class="feedback-card-body">
                        <p class="mb-2" style="font-size: 12px; color: #526b80; line-height: 1.6;">
                            Mã tra cứu được hiển thị ngay sau khi gửi thành công và có trong email xác nhận nếu bạn đã cung cấp email.
                        </p>
                        <div class="feedback-privacy-note">
                            Hệ thống yêu cầu thêm thông tin liên hệ để tránh người khác truy cập hồ sơ của bạn.
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>
@endsection
