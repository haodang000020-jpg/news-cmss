<div
    class="modal fade digital-assistant-modal"
    id="digitalAssistantModal"
    tabindex="-1"
    aria-labelledby="digitalAssistantModalTitle"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header digital-assistant-modal-header">
                <div class="digital-assistant-modal-brand">
                    <span class="digital-assistant-modal-robot" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <rect x="4" y="6" width="16" height="13" rx="5" />
                            <path d="M12 3v3" />
                            <circle cx="9" cy="12" r="1.2" />
                            <circle cx="15" cy="12" r="1.2" />
                            <path d="M9 16c.9.6 1.9.9 3 .9s2.1-.3 3-.9" />
                        </svg>
                    </span>

                    <div>
                        <h2 id="digitalAssistantModalTitle">Trợ lý số Vĩnh Bình</h2>
                        <p>Tra cứu thủ tục từ dữ liệu đã được cơ quan cập nhật</p>
                    </div>
                </div>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Đóng"
                ></button>
            </div>

            <div class="modal-body digital-assistant-modal-body">
                <form
                    id="digitalAssistantModalForm"
                    class="digital-assistant-form"
                    action="{{ route('frontend.digital-assistant.search') }}"
                    method="POST"
                    data-assistant-form
                    data-results-target="#digitalAssistantResults"
                >
                    @csrf

                    <label for="digitalAssistantModalQuestion">
                        Bạn cần tìm thủ tục gì?
                    </label>

                    <div class="digital-assistant-input-row">
                        <input
                            id="digitalAssistantModalQuestion"
                            type="text"
                            name="question"
                            maxlength="250"
                            required
                            data-assistant-sync-input
                            placeholder="Ví dụ: Tôi muốn làm giấy khai sinh cho con..."
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
                        data-assistant-form-target="#digitalAssistantModalForm"
                    >
                        Đăng ký khai sinh
                    </button>

                    <button
                        type="button"
                        data-assistant-suggestion="Tôi cần giấy xác nhận tình trạng hôn nhân"
                        data-assistant-form-target="#digitalAssistantModalForm"
                    >
                        Xác nhận độc thân
                    </button>

                    <button
                        type="button"
                        data-assistant-suggestion="Thủ tục bảo trợ xã hội cần giấy tờ gì"
                        data-assistant-form-target="#digitalAssistantModalForm"
                    >
                        Bảo trợ xã hội
                    </button>
                </div>

                <div
                    id="digitalAssistantResults"
                    class="digital-assistant-results"
                    data-feedback-url="{{ route('frontend.digital-assistant.feedback') }}"
                    aria-live="polite"
                >
                    <div class="digital-assistant-empty-state">
                        <span aria-hidden="true">⌕</span>
                        <strong>Nhập nhu cầu của bạn để bắt đầu tra cứu</strong>
                        <p>Không nhập số CCCD, số tài khoản, mã OTP hoặc mật khẩu.</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer digital-assistant-modal-footer">
                <p>
                    Kết quả chỉ hỗ trợ tra cứu. Vui lòng xem chi tiết thủ tục để xác nhận thông tin.
                </p>

                <a href="{{ route('frontend.digital-assistant.index') }}">
                    Mở trang trợ lý đầy đủ
                </a>
            </div>
        </div>
    </div>
</div>
