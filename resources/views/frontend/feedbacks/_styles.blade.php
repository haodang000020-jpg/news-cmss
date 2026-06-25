<style>
    .feedback-page {
        --fb-primary: #0868bd;
        --fb-primary-dark: #075397;
        --fb-soft: #eef7ff;
        --fb-border: #d8e7f3;
        --fb-text: #17324d;
        --fb-muted: #667d91;
        padding: 18px 0 32px;
    }

    .feedback-hero {
        position: relative;
        overflow: hidden;
        padding: 24px;
        border-radius: 16px;
        color: #fff;
        background: linear-gradient(135deg, #07579e 0%, #0877cc 60%, #1593df 100%);
        box-shadow: 0 14px 32px rgba(7, 83, 151, .18);
    }

    .feedback-hero::after {
        content: "";
        position: absolute;
        width: 190px;
        height: 190px;
        right: -55px;
        top: -85px;
        border: 30px solid rgba(255, 255, 255, .08);
        border-radius: 50%;
    }

    .feedback-hero h1 {
        position: relative;
        z-index: 1;
        margin: 0;
        color: #fff;
        font-size: 28px;
        font-weight: 800;
    }

    .feedback-hero p {
        position: relative;
        z-index: 1;
        max-width: 760px;
        margin: 8px 0 0;
        color: rgba(255, 255, 255, .88);
        font-size: 14px;
        line-height: 1.6;
    }

    .feedback-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.7fr) minmax(280px, .8fr);
        gap: 18px;
        margin-top: 18px;
    }

    .feedback-card {
        overflow: hidden;
        border: 1px solid var(--fb-border);
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 9px 24px rgba(15, 76, 123, .08);
    }

    .feedback-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 15px 18px;
        border-bottom: 1px solid var(--fb-border);
        background: linear-gradient(180deg, #fbfdff, #f2f8fd);
    }

    .feedback-card-header h2 {
        margin: 0;
        color: var(--fb-primary-dark);
        font-size: 17px;
        font-weight: 800;
    }

    .feedback-card-body {
        padding: 18px;
    }

    .feedback-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .feedback-field-full {
        grid-column: 1 / -1;
    }

    .feedback-label {
        display: block;
        margin-bottom: 6px;
        color: #244760;
        font-size: 13px;
        font-weight: 700;
    }

    .feedback-required {
        color: #d44343;
    }

    .feedback-input,
    .feedback-select,
    .feedback-textarea {
        width: 100%;
        border: 1px solid #cddfeb;
        border-radius: 9px;
        background: #fbfdff;
        color: var(--fb-text);
        font-size: 13px;
        transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
    }

    .feedback-input,
    .feedback-select {
        height: 43px;
        padding: 0 12px;
    }

    .feedback-textarea {
        min-height: 145px;
        padding: 11px 12px;
        resize: vertical;
    }

    .feedback-input:focus,
    .feedback-select:focus,
    .feedback-textarea:focus {
        outline: none;
        border-color: #2b89d2;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(8, 104, 189, .1);
    }

    .feedback-help {
        margin-top: 5px;
        color: var(--fb-muted);
        font-size: 11px;
        line-height: 1.45;
    }

    .feedback-file-box {
        padding: 13px;
        border: 1px dashed #9fc8e7;
        border-radius: 10px;
        background: #f6fbff;
    }

    .feedback-check {
        display: flex;
        align-items: flex-start;
        gap: 9px;
        padding: 12px;
        border-radius: 10px;
        background: #f8fafc;
        color: #40586c;
        font-size: 12px;
        line-height: 1.5;
    }

    .feedback-check input {
        margin-top: 3px;
    }

    .feedback-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 44px;
        padding: 0 20px;
        border: 0;
        border-radius: 9px;
        background: linear-gradient(135deg, #075da8, #1686dd);
        color: #fff;
        font-size: 13px;
        font-weight: 800;
        box-shadow: 0 7px 16px rgba(8, 104, 189, .22);
    }

    .feedback-submit:hover {
        color: #fff;
        filter: brightness(1.05);
        transform: translateY(-1px);
    }

    .feedback-secondary-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 42px;
        padding: 0 16px;
        border: 1px solid #b8d3e8;
        border-radius: 9px;
        background: #fff;
        color: var(--fb-primary-dark);
        font-size: 12px;
        font-weight: 750;
        text-decoration: none;
    }

    .feedback-side-list {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .feedback-side-list li {
        position: relative;
        padding: 0 0 13px 24px;
        color: #466078;
        font-size: 12px;
        line-height: 1.55;
    }

    .feedback-side-list li::before {
        content: "✓";
        position: absolute;
        top: 0;
        left: 0;
        width: 17px;
        height: 17px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #e4f4ff;
        color: #0871c8;
        font-size: 10px;
        font-weight: 900;
    }

    .feedback-privacy-note {
        padding: 12px;
        border: 1px solid #f0d38b;
        border-radius: 10px;
        background: #fff8e7;
        color: #755717;
        font-size: 11px;
        line-height: 1.55;
    }

    .feedback-alert {
        margin-bottom: 14px;
        padding: 12px 14px;
        border-radius: 9px;
        font-size: 12px;
        line-height: 1.5;
    }

    .feedback-alert-success {
        border: 1px solid #9bd7b5;
        background: #ecfbf2;
        color: #206b3e;
    }

    .feedback-alert-danger {
        border: 1px solid #efb3b3;
        background: #fff2f2;
        color: #9c2929;
    }

    .feedback-tracking-code {
        display: inline-flex;
        padding: 8px 12px;
        border: 1px dashed #78b8e7;
        border-radius: 8px;
        background: #edf8ff;
        color: #075b9f;
        font-size: 18px;
        font-weight: 900;
        letter-spacing: .5px;
    }

    .feedback-summary-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 10px;
    }

    .feedback-summary-item {
        padding: 11px;
        border: 1px solid #dfebf4;
        border-radius: 9px;
        background: #f9fcff;
    }

    .feedback-summary-item small {
        display: block;
        color: #75899b;
        font-size: 10px;
        font-weight: 650;
        text-transform: uppercase;
    }

    .feedback-summary-item strong {
        display: block;
        margin-top: 5px;
        color: #23445f;
        font-size: 12px;
        line-height: 1.4;
    }

    .feedback-status-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 9px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
    }

    .feedback-status-new { background: #fff4d8; color: #936700; }
    .feedback-status-received { background: #e9f4ff; color: #1769a8; }
    .feedback-status-processing { background: #eee9ff; color: #6347a7; }
    .feedback-status-resolved { background: #e8f8ee; color: #2d7d48; }
    .feedback-status-rejected { background: #f5eded; color: #8f4444; }

    .feedback-timeline {
        position: relative;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .feedback-timeline-item {
        position: relative;
        padding: 0 0 18px 28px;
    }

    .feedback-timeline-item::before {
        content: "";
        position: absolute;
        top: 6px;
        left: 6px;
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background: #0b78c9;
        box-shadow: 0 0 0 4px #e5f3fe;
    }

    .feedback-timeline-item::after {
        content: "";
        position: absolute;
        top: 18px;
        bottom: 0;
        left: 10px;
        width: 1px;
        background: #cfe2f1;
    }

    .feedback-timeline-item:last-child::after { display: none; }

    .feedback-timeline-title {
        color: #24445f;
        font-size: 12px;
        font-weight: 800;
    }

    .feedback-timeline-date {
        margin-top: 2px;
        color: #7b8ea0;
        font-size: 10px;
    }

    .feedback-timeline-note {
        margin-top: 5px;
        color: #536b80;
        font-size: 11px;
        line-height: 1.5;
    }

    .feedback-content-box,
    .feedback-response-box {
        padding: 14px;
        border-radius: 10px;
        color: #3c566c;
        font-size: 13px;
        line-height: 1.7;
        white-space: pre-line;
    }

    .feedback-content-box {
        border: 1px solid #dce9f2;
        background: #fbfdff;
    }

    .feedback-response-box {
        border: 1px solid #a9d8bc;
        background: #effaf3;
        color: #2f6644;
    }

    .feedback-attachment-list {
        display: grid;
        gap: 8px;
    }

    .feedback-attachment-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 10px 12px;
        border: 1px solid #d8e7f3;
        border-radius: 9px;
        background: #f9fcff;
        color: #1d5f91;
        font-size: 11px;
        font-weight: 700;
        text-decoration: none;
    }

    .feedback-rating-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .feedback-rating-option input { display: none; }

    .feedback-rating-option span {
        display: inline-flex;
        min-width: 42px;
        height: 36px;
        align-items: center;
        justify-content: center;
        border: 1px solid #cbddeb;
        border-radius: 8px;
        background: #fff;
        color: #536d82;
        font-size: 12px;
        font-weight: 800;
        cursor: pointer;
    }

    .feedback-rating-option input:checked + span {
        border-color: #1680d0;
        background: #eaf6ff;
        color: #075da8;
        box-shadow: 0 0 0 3px rgba(8, 104, 189, .1);
    }

    .feedback-honeypot {
        position: absolute !important;
        left: -9999px !important;
        width: 1px !important;
        height: 1px !important;
        opacity: 0 !important;
        pointer-events: none !important;
    }

    @media (max-width: 991.98px) {
        .feedback-grid { grid-template-columns: 1fr; }
        .feedback-summary-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }

    @media (max-width: 575.98px) {
        .feedback-page { padding-top: 10px; }
        .feedback-hero { padding: 18px; border-radius: 12px; }
        .feedback-hero h1 { font-size: 22px; }
        .feedback-form-grid { grid-template-columns: 1fr; }
        .feedback-field-full { grid-column: auto; }
        .feedback-summary-grid { grid-template-columns: 1fr; }
        .feedback-card-body { padding: 14px; }
    }
</style>
