@extends('frontend.layouts.app')

@section('content')
    <div class="container digital-assistant-page">
        <section class="digital-assistant-page-hero">
            <div>
                <span class="digital-assistant-page-kicker">TIỆN ÍCH SỐ CHO NGƯỜI DÂN</span>
                <h1>Trợ lý số Vĩnh Bình</h1>
                <p>
                    Nhập nhu cầu bằng ngôn ngữ tự nhiên để tìm thủ tục, thành phần hồ sơ,
                    thời hạn xử lý và lệ phí từ dữ liệu đã được cơ quan quản trị cập nhật.
                </p>
            </div>

            <span class="digital-assistant-page-badge">BETA</span>
        </section>

        <div class="digital-assistant-page-layout">
            <main class="digital-assistant-page-main">
                <section class="digital-assistant-page-search-card">
                    <form
                        id="digitalAssistantPageForm"
                        class="digital-assistant-form"
                        action="{{ route('frontend.digital-assistant.search') }}"
                        method="POST"
                        data-assistant-form
                        data-results-target="#digitalAssistantPageResults"
                        data-auto-submit="{{ $initialQuestion !== '' ? 'true' : 'false' }}"
                    >
                        @csrf

                        <label for="digitalAssistantPageQuestion">
                            Bạn cần hỗ trợ thủ tục gì?
                        </label>

                        <div class="digital-assistant-input-row">
                            <input
                                id="digitalAssistantPageQuestion"
                                type="text"
                                name="question"
                                value="{{ $initialQuestion }}"
                                maxlength="250"
                                required
                                data-assistant-sync-input
                                placeholder="Ví dụ: Tôi có con mới sinh, cần làm giấy tờ gì?"
                            >

                            <button type="submit">
                                <span data-assistant-submit-text>Tìm kiếm</span>
                                <span
                                    class="spinner-border spinner-border-sm d-none"
                                    data-assistant-spinner
                                    aria-hidden="true"
                                ></span>
                            </button>
                        </div>
                    </form>

                    <div class="digital-assistant-suggestion-list" aria-label="Câu hỏi gợi ý">
                        <button
                            type="button"
                            data-assistant-suggestion="Tôi muốn đăng ký khai sinh cho con"
                            data-assistant-form-target="#digitalAssistantPageForm"
                        >
                            Đăng ký khai sinh
                        </button>

                        <button
                            type="button"
                            data-assistant-suggestion="Tôi cần giấy xác nhận tình trạng hôn nhân"
                            data-assistant-form-target="#digitalAssistantPageForm"
                        >
                            Xác nhận tình trạng hôn nhân
                        </button>

                        <button
                            type="button"
                            data-assistant-suggestion="Thủ tục văn hóa thể thao cộng đồng"
                            data-assistant-form-target="#digitalAssistantPageForm"
                        >
                            Văn hóa - thể thao
                        </button>
                    </div>
                </section>

                <section
                    id="digitalAssistantPageResults"
                    class="digital-assistant-results digital-assistant-page-results"
                    data-feedback-url="{{ route('frontend.digital-assistant.feedback') }}"
                    aria-live="polite"
                >
                    <div class="digital-assistant-empty-state">
                        <span aria-hidden="true">⌕</span>
                        <strong>Chưa có nội dung tra cứu</strong>
                        <p>Hãy nhập tên giấy tờ, thủ tục hoặc tình huống bạn đang cần giải quyết.</p>
                    </div>
                </section>
            </main>

            <aside class="digital-assistant-page-sidebar">
                <section>
                    <h2>Trợ lý có thể hỗ trợ</h2>
                    <ul>
                        <li>Tìm thủ tục gần đúng theo nhu cầu.</li>
                        <li>Hiển thị số loại giấy tờ cần chuẩn bị.</li>
                        <li>Cho biết thời hạn và lệ phí đã được cập nhật.</li>
                        <li>Dẫn đến trang chi tiết thủ tục chính thức của website.</li>
                    </ul>
                </section>

                <section class="is-warning">
                    <h2>Bảo vệ thông tin cá nhân</h2>
                    <p>
                        Không nhập số CCCD, số tài khoản, mã OTP, mật khẩu,
                        hồ sơ sức khỏe hoặc dữ liệu cá nhân nhạy cảm.
                    </p>
                </section>

                <a
                    class="digital-assistant-page-procedure-link"
                    href="{{ route('frontend.procedures.index') }}"
                >
                    Xem toàn bộ thủ tục hành chính
                    <span aria-hidden="true">→</span>
                </a>
            </aside>
        </div>
    </div>

    @include('frontend.digital-assistant._client')
@endsection
