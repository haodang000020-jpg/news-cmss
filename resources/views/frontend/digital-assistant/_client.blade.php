<script>
    document.addEventListener('DOMContentLoaded', function () {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

        const escapeHtml = function (value) {
            return String(value ?? '')
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');
        };

        const setLoading = function (form, loading) {
            const button = form.querySelector('button[type="submit"]');
            const spinner = form.querySelector('[data-assistant-spinner]');
            const text = form.querySelector('[data-assistant-submit-text]');

            if (button) {
                button.disabled = loading;
            }

            if (spinner) {
                spinner.classList.toggle('d-none', !loading);
            }

            if (text) {
                if (! text.dataset.defaultText) {
                    text.dataset.defaultText = text.textContent.trim();
                }

                text.textContent = loading
                    ? 'Đang tìm...'
                    : text.dataset.defaultText;
            }
        };

        const renderError = function (target, message) {
            target.innerHTML = `
                <div class="digital-assistant-alert is-error" role="alert">
                    <strong>Chưa thể tra cứu</strong>
                    <p>${escapeHtml(message)}</p>
                </div>
            `;
        };

        const renderResults = function (target, payload) {
            const results = Array.isArray(payload.results) ? payload.results : [];
            const message = escapeHtml(payload.message || 'Đã hoàn tất tra cứu.');
            const disclaimer = escapeHtml(payload.disclaimer || '');

            if (results.length === 0) {
                target.innerHTML = `
                    <div class="digital-assistant-alert is-empty">
                        <strong>Chưa tìm thấy kết quả phù hợp</strong>
                        <p>${message}</p>
                    </div>
                    <div class="digital-assistant-result-actions">
                        <a href="{{ route('frontend.procedures.index') }}">Tự tra cứu danh sách thủ tục</a>
                    </div>
                `;
                return;
            }

            const cards = results.map(function (item, index) {
                const code = item.code
                    ? `<span class="digital-assistant-result-code">${escapeHtml(item.code)}</span>`
                    : '';
                const group = item.group
                    ? `<span>${escapeHtml(item.group)}</span>`
                    : '';
                const summary = item.summary
                    ? `<p>${escapeHtml(item.summary)}</p>`
                    : '';

                return `
                    <article class="digital-assistant-result-card">
                        <div class="digital-assistant-result-heading">
                            <span class="digital-assistant-result-number">${index + 1}</span>
                            <div>
                                <div class="digital-assistant-result-meta">
                                    ${group}
                                    ${code}
                                </div>
                                <h3>${escapeHtml(item.name)}</h3>
                            </div>
                        </div>

                        ${summary}

                        <div class="digital-assistant-result-facts">
                            <span>
                                <small>Hồ sơ</small>
                                <strong>${Number(item.required_documents_count || 0)} loại giấy tờ</strong>
                            </span>
                            <span>
                                <small>Thời hạn</small>
                                <strong>${escapeHtml(item.processing_time)}</strong>
                            </span>
                            <span>
                                <small>Lệ phí</small>
                                <strong>${escapeHtml(item.fee)}</strong>
                            </span>
                        </div>

                        <a
                            class="digital-assistant-result-link"
                            href="${escapeHtml(item.url)}"
                        >
                            Xem chi tiết thủ tục
                            <span aria-hidden="true">→</span>
                        </a>
                    </article>
                `;
            }).join('');

            const feedback = payload.query_id
                ? `
                    <div class="digital-assistant-feedback" data-query-id="${escapeHtml(payload.query_id)}">
                        <span>Kết quả này có phù hợp không?</span>
                        <button type="button" data-assistant-feedback="1">Phù hợp</button>
                        <button type="button" data-assistant-feedback="0">Chưa phù hợp</button>
                    </div>
                `
                : '';

            target.innerHTML = `
                <div class="digital-assistant-alert is-success">
                    <strong>${message}</strong>
                </div>
                <div class="digital-assistant-result-list">${cards}</div>
                ${feedback}
                <p class="digital-assistant-disclaimer">${disclaimer}</p>
            `;
        };

        const search = async function (form) {
            const input = form.querySelector('input[name="question"]');
            const question = input?.value.trim() || '';
            const target = document.querySelector(form.dataset.resultsTarget || '');

            if (! input || ! target || question.length < 2) {
                if (target) {
                    renderError(target, 'Vui lòng nhập ít nhất 2 ký tự.');
                }
                return;
            }

            document.querySelectorAll('[data-assistant-sync-input]').forEach(function (syncInput) {
                syncInput.value = question;
            });

            const modalSelector = form.dataset.openModal;
            if (modalSelector && window.bootstrap) {
                const modalElement = document.querySelector(modalSelector);
                if (modalElement) {
                    bootstrap.Modal.getOrCreateInstance(modalElement).show();
                }
            }

            target.innerHTML = `
                <div class="digital-assistant-loading" role="status">
                    <span class="spinner-border" aria-hidden="true"></span>
                    <strong>Đang tìm thủ tục phù hợp...</strong>
                </div>
            `;

            setLoading(form, true);

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ question: question }),
                });

                const payload = await response.json();

                if (! response.ok) {
                    const validationMessage = payload.errors?.question?.[0];
                    throw new Error(validationMessage || payload.message || 'Không thể thực hiện tra cứu.');
                }

                renderResults(target, payload);
            } catch (error) {
                renderError(target, error.message || 'Hệ thống đang bận. Vui lòng thử lại sau.');
            } finally {
                setLoading(form, false);
            }
        };

        document.querySelectorAll('[data-assistant-form]').forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                search(form);
            });

            if (form.dataset.autoSubmit === 'true') {
                const input = form.querySelector('input[name="question"]');
                if (input && input.value.trim().length >= 2) {
                    search(form);
                }
            }
        });

        document.querySelectorAll('[data-assistant-suggestion]').forEach(function (button) {
            button.addEventListener('click', function () {
                const form = document.querySelector(button.dataset.assistantFormTarget || '');
                const input = form?.querySelector('input[name="question"]');

                if (! form || ! input) {
                    return;
                }

                input.value = button.dataset.assistantSuggestion || '';
                form.requestSubmit();
            });
        });

        document.addEventListener('click', async function (event) {
            const button = event.target.closest('[data-assistant-feedback]');
            if (! button) {
                return;
            }

            const feedbackBox = button.closest('.digital-assistant-feedback');
            const resultsBox = button.closest('.digital-assistant-results');
            const queryId = feedbackBox?.dataset.queryId;
            const feedbackUrl = resultsBox?.dataset.feedbackUrl;

            if (! queryId || ! feedbackUrl) {
                return;
            }

            feedbackBox.querySelectorAll('button').forEach(function (item) {
                item.disabled = true;
            });

            try {
                const response = await fetch(feedbackUrl, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        query_id: queryId,
                        helpful: button.dataset.assistantFeedback === '1',
                    }),
                });

                const payload = await response.json();
                feedbackBox.innerHTML = `<span>${escapeHtml(payload.message || 'Cảm ơn bạn đã phản hồi.')}</span>`;
            } catch (error) {
                feedbackBox.innerHTML = '<span>Chưa thể ghi nhận phản hồi. Vui lòng thử lại sau.</span>';
            }
        });
    });
</script>
