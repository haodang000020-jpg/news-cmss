@extends('frontend.layouts.app')

@section('content')
    @include('frontend.feedbacks._styles')

    <main class="feedback-page">
        <div class="container px-0">
            <section class="feedback-hero">
                <h1>Phản ánh - kiến nghị trực tuyến</h1>
                <p>
                    Gửi thông tin đến cơ quan để được tiếp nhận, xử lý và theo dõi tiến độ bằng mã tra cứu riêng.
                    Vui lòng mô tả rõ nội dung và không cung cấp mật khẩu, mã OTP hoặc dữ liệu tài chính nhạy cảm.
                </p>
            </section>

            <div class="feedback-grid">
                <section class="feedback-card">
                    <div class="feedback-card-header">
                        <h2>Gửi phản ánh mới</h2>
                        <a href="{{ route('frontend.feedbacks.lookup.form') }}" class="feedback-secondary-link">
                            Tra cứu hồ sơ
                        </a>
                    </div>

                    <div class="feedback-card-body">
                        @if ($errors->any())
                            <div class="feedback-alert feedback-alert-danger">
                                <strong>Vui lòng kiểm tra lại thông tin:</strong>
                                <ul class="mb-0 mt-2 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form
                            method="POST"
                            action="{{ route('frontend.feedbacks.store') }}"
                            enctype="multipart/form-data"
                            novalidate
                        >
                            @csrf

                            <div class="feedback-form-grid">
                                <div>
                                    <label class="feedback-label" for="feedback_category_id">
                                        Lĩnh vực <span class="feedback-required">*</span>
                                    </label>
                                    <select
                                        id="feedback_category_id"
                                        name="feedback_category_id"
                                        class="feedback-select"
                                        required
                                    >
                                        <option value="">Chọn lĩnh vực phản ánh</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @selected(old('feedback_category_id') == $category->id)>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="feedback-label" for="full_name">
                                        Họ và tên <span class="feedback-required">*</span>
                                    </label>
                                    <input
                                        id="full_name"
                                        name="full_name"
                                        type="text"
                                        value="{{ old('full_name') }}"
                                        maxlength="150"
                                        class="feedback-input"
                                        required
                                    >
                                </div>

                                <div>
                                    <label class="feedback-label" for="phone">
                                        Số điện thoại <span class="feedback-required">*</span>
                                    </label>
                                    <input
                                        id="phone"
                                        name="phone"
                                        type="tel"
                                        value="{{ old('phone') }}"
                                        maxlength="20"
                                        class="feedback-input"
                                        placeholder="Ví dụ: 0912345678"
                                        required
                                    >
                                    <div class="feedback-help">Dùng để xác minh khi tra cứu trạng thái.</div>
                                </div>

                                <div>
                                    <label class="feedback-label" for="email">Email</label>
                                    <input
                                        id="email"
                                        name="email"
                                        type="email"
                                        value="{{ old('email') }}"
                                        maxlength="255"
                                        class="feedback-input"
                                        placeholder="Nhận thông báo khi hồ sơ cập nhật"
                                    >
                                </div>

                                <div>
                                    <label class="feedback-label" for="address">Địa chỉ liên hệ</label>
                                    <input
                                        id="address"
                                        name="address"
                                        type="text"
                                        value="{{ old('address') }}"
                                        maxlength="255"
                                        class="feedback-input"
                                    >
                                </div>

                                <div>
                                    <label class="feedback-label" for="location">Địa điểm xảy ra sự việc</label>
                                    <input
                                        id="location"
                                        name="location"
                                        type="text"
                                        value="{{ old('location') }}"
                                        maxlength="255"
                                        class="feedback-input"
                                        placeholder="Ấp, tuyến đường hoặc địa điểm cụ thể"
                                    >
                                </div>

                                <div class="feedback-field-full">
                                    <label class="feedback-label" for="subject">
                                        Tiêu đề phản ánh <span class="feedback-required">*</span>
                                    </label>
                                    <input
                                        id="subject"
                                        name="subject"
                                        type="text"
                                        value="{{ old('subject') }}"
                                        maxlength="255"
                                        class="feedback-input"
                                        placeholder="Tóm tắt ngắn gọn vấn đề cần phản ánh"
                                        required
                                    >
                                </div>

                                <div class="feedback-field-full">
                                    <label class="feedback-label" for="content">
                                        Nội dung chi tiết <span class="feedback-required">*</span>
                                    </label>
                                    <textarea
                                        id="content"
                                        name="content"
                                        maxlength="10000"
                                        class="feedback-textarea"
                                        placeholder="Mô tả thời gian, địa điểm, diễn biến và đề nghị xử lý..."
                                        required
                                    >{{ old('content') }}</textarea>
                                </div>

                                <div class="feedback-field-full">
                                    <label class="feedback-label" for="attachments">Ảnh hoặc tài liệu minh chứng</label>
                                    <div class="feedback-file-box">
                                        <input
                                            id="attachments"
                                            name="attachments[]"
                                            type="file"
                                            class="form-control form-control-sm"
                                            accept=".jpg,.jpeg,.png,.webp,.pdf,.doc,.docx"
                                            multiple
                                        >
                                        <div class="feedback-help">
                                            Tối đa 5 tệp, mỗi tệp không quá 5 MB. Tệp được lưu ở khu vực riêng tư.
                                        </div>
                                    </div>
                                </div>

                                <div class="feedback-honeypot" aria-hidden="true">
                                    <label for="website">Website</label>
                                    <input id="website" name="website" type="text" tabindex="-1" autocomplete="off">
                                </div>

                                <div class="feedback-field-full">
                                    <label class="feedback-check">
                                        <input
                                            type="checkbox"
                                            name="agree_privacy"
                                            value="1"
                                            @checked(old('agree_privacy'))
                                            required
                                        >
                                        <span>
                                            Tôi xác nhận thông tin đã cung cấp là đúng và đồng ý để cơ quan sử dụng dữ liệu liên hệ
                                            nhằm tiếp nhận, xác minh và phản hồi nội dung này.
                                        </span>
                                    </label>
                                </div>

                                <div class="feedback-field-full d-flex flex-wrap gap-2 align-items-center">
                                    <button type="submit" class="feedback-submit">Gửi phản ánh</button>
                                    <a href="{{ route('frontend.feedbacks.lookup.form') }}" class="feedback-secondary-link">
                                        Tôi đã có mã tra cứu
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>

                <aside class="d-grid gap-3 align-content-start">
                    <section class="feedback-card">
                        <div class="feedback-card-header">
                            <h2>Quy trình xử lý</h2>
                        </div>
                        <div class="feedback-card-body">
                            <ul class="feedback-side-list">
                                <li>Gửi thông tin và nhận mã tra cứu tự động.</li>
                                <li>Cơ quan kiểm tra, tiếp nhận và phân công xử lý.</li>
                                <li>Trạng thái được cập nhật trong quá trình giải quyết.</li>
                                <li>Người dân xem phản hồi và đánh giá mức độ hài lòng.</li>
                            </ul>
                        </div>
                    </section>

                    <section class="feedback-card">
                        <div class="feedback-card-header">
                            <h2>Lưu ý bảo mật</h2>
                        </div>
                        <div class="feedback-card-body">
                            <div class="feedback-privacy-note">
                                Không nhập số tài khoản, mật khẩu, mã OTP, thông tin sức khỏe nhạy cảm hoặc tài liệu không liên quan.
                                Thông tin cá nhân không được công khai trên website.
                            </div>
                        </div>
                    </section>
                </aside>
            </div>
        </div>
    </main>
@endsection
