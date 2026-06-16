@once
    <style>
        .school-form-page {
            padding: 32px;
        }

        .school-form-card {
            max-width: 760px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.06);
            overflow: hidden;
        }

        .school-form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
        }

        .school-form-header h3 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
        }

        .school-form-group {
            padding: 0 24px;
            margin-top: 18px;
        }

        .school-form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #334155;
        }

        .school-form-control {
            width: 100%;
            min-height: 42px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 9px 12px;
            outline: none;
            background: #ffffff;
            color: #0f172a;
        }

        .school-form-control:focus {
            border-color: #0b63ad;
            box-shadow: 0 0 0 3px rgba(11, 99, 173, 0.12);
        }

        .school-form-error {
            margin-top: 6px;
            color: #dc2626;
            font-size: 13px;
        }

        .school-form-check {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0 24px;
            margin-top: 18px;
        }

        .school-form-preview {
            margin-top: 10px;
        }

        .school-form-preview img {
            width: 120px;
            height: 80px;
            object-fit: contain;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: #f8fafc;
            padding: 6px;
        }

        .school-form-actions {
            display: flex;
            gap: 10px;
            padding: 24px;
            margin-top: 8px;
            border-top: 1px solid #e5e7eb;
        }

        .school-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 38px;
            padding: 8px 14px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            border: 1px solid transparent;
            cursor: pointer;
            font-size: 14px;
        }

        .school-btn-primary {
            background: #0b63ad;
            color: #ffffff;
        }

        .school-btn-primary:hover {
            background: #084f8c;
            color: #ffffff;
        }

        .school-btn-secondary {
            background: #f8fafc;
            color: #334155;
            border-color: #cbd5e1;
        }

        .school-btn-secondary:hover {
            background: #e2e8f0;
        }

        @media (max-width: 768px) {
            .school-form-page {
                padding: 16px;
            }

            .school-form-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
@endonce

<div class="school-form-group">
    <label class="school-form-label">Tên trường</label>
    <input
        type="text"
        name="name"
        class="school-form-control"
        value="{{ old('name', $schoolLink->name ?? '') }}"
        placeholder="Ví dụ: Trường Tiểu học Vĩnh Bình"
    >

    @error('name')
        <div class="school-form-error">{{ $message }}</div>
    @enderror
</div>

<div class="school-form-group">
    <label class="school-form-label">Logo / Ảnh đại diện</label>
    <input
        type="file"
        name="logo"
        class="school-form-control"
        accept="image/*"
    >

    @error('logo')
        <div class="school-form-error">{{ $message }}</div>
    @enderror

    @if(!empty($schoolLink->logo_path))
        <div class="school-form-preview">
            <img src="{{ asset('storage/' . $schoolLink->logo_path) }}" alt="{{ $schoolLink->name }}">
        </div>
    @endif
</div>

<div class="school-form-group">
    <label class="school-form-label">Liên kết website</label>
    <input
        type="url"
        name="url"
        class="school-form-control"
        value="{{ old('url', $schoolLink->url ?? '') }}"
        placeholder="https://..."
    >

    @error('url')
        <div class="school-form-error">{{ $message }}</div>
    @enderror
</div>

<div class="school-form-group">
    <label class="school-form-label">Thứ tự hiển thị</label>
    <input
        type="number"
        name="sort_order"
        class="school-form-control"
        value="{{ old('sort_order', $schoolLink->sort_order ?? 0) }}"
        min="0"
    >

    @error('sort_order')
        <div class="school-form-error">{{ $message }}</div>
    @enderror
</div>

<div class="school-form-check">
    <input
        type="checkbox"
        name="is_active"
        id="is_active"
        value="1"
        @checked(old('is_active', $schoolLink->is_active ?? true))
    >

    <label for="is_active">
        Hiển thị ngoài trang chủ
    </label>
</div>