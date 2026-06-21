    <style>
        .organization-form-page {
            padding: 32px;
        }

        .organization-form-card {
            max-width: 960px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.07);
            overflow: hidden;
        }

        .organization-form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
        }

        .organization-form-header h3 {
            margin: 0;
            color: #0f172a;
            font-size: 20px;
            font-weight: 700;
        }

        .organization-form-body {
            padding: 24px;
        }

        .organization-form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .organization-form-group {
            min-width: 0;
        }

        .organization-form-group-full {
            grid-column: 1 / -1;
        }

        .organization-form-label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-weight: 600;
        }

        .organization-required {
            color: #dc2626;
        }

        .organization-form-control {
            width: 100%;
            min-height: 42px;
            padding: 9px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: #ffffff;
            color: #0f172a;
            outline: none;
        }

        textarea.organization-form-control {
            min-height: 105px;
            resize: vertical;
        }

        .organization-form-control:focus {
            border-color: #0b63ad;
            box-shadow: 0 0 0 3px rgba(11, 99, 173, 0.12);
        }

        .organization-form-error {
            margin-top: 6px;
            color: #dc2626;
            font-size: 13px;
        }

        .organization-form-help {
            margin-top: 6px;
            color: #64748b;
            font-size: 13px;
        }

        .organization-form-check {
            display: flex;
            align-items: center;
            gap: 9px;
            min-height: 42px;
        }

        .organization-form-photo-preview {
            margin-top: 12px;
        }

        .organization-form-photo-preview img {
            width: 130px;
            height: 150px;
            object-fit: cover;
            border: 1px solid #dbe4ee;
            border-radius: 10px;
            background: #f8fafc;
        }

        .organization-form-actions {
            display: flex;
            gap: 10px;
            padding: 20px 24px;
            border-top: 1px solid #e5e7eb;
            background: #f8fafc;
        }

        .organization-form-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 40px;
            padding: 9px 16px;
            border: 1px solid transparent;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .organization-form-btn-primary {
            background: #0b63ad;
            color: #ffffff;
        }

        .organization-form-btn-primary:hover {
            background: #084f8c;
            color: #ffffff;
        }

        .organization-form-btn-secondary {
            background: #ffffff;
            color: #334155;
            border-color: #cbd5e1;
        }

        .organization-error-summary {
            margin: 0 24px 20px;
            padding: 14px 16px;
            border: 1px solid #fecaca;
            border-radius: 8px;
            background: #fef2f2;
            color: #991b1b;
        }

        .organization-error-summary ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }

        @media (max-width: 768px) {
            .organization-form-page {
                padding: 16px;
            }

            .organization-form-grid {
                grid-template-columns: 1fr;
            }

            .organization-form-group-full {
                grid-column: auto;
            }

            .organization-form-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>

@if ($errors->any())
    <div class="organization-error-summary">
        <strong>Vui lòng kiểm tra lại thông tin:</strong>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="organization-form-body">
    <div class="organization-form-grid">
        <div class="organization-form-group">
            <label class="organization-form-label" for="name">
                Họ và tên <span class="organization-required">*</span>
            </label>

            <input
                type="text"
                id="name"
                name="name"
                class="organization-form-control"
                value="{{ old('name', $organizationMember->name) }}"
                placeholder="Ví dụ: Nguyễn Văn A"
                required
            >

            @error('name')
                <div class="organization-form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="organization-form-group">
            <label class="organization-form-label" for="position">
                Chức vụ <span class="organization-required">*</span>
            </label>

            <input
                type="text"
                id="position"
                name="position"
                class="organization-form-control"
                value="{{ old('position', $organizationMember->position) }}"
                placeholder="Ví dụ: Trưởng phòng"
                required
            >

            @error('position')
                <div class="organization-form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="organization-form-group">
            <label class="organization-form-label" for="position_level">
                Cấp chức vụ <span class="organization-required">*</span>
            </label>

            <select
                id="position_level"
                name="position_level"
                class="organization-form-control"
                required
            >
                <option value="1" @selected((int) old('position_level', $organizationMember->position_level) === 1)>
                    Cấp 1 — Trưởng phòng
                </option>

                <option value="2" @selected((int) old('position_level', $organizationMember->position_level) === 2)>
                    Cấp 2 — Phó phòng
                </option>

                <option value="3" @selected((int) old('position_level', $organizationMember->position_level) === 3)>
                    Cấp 3 — Công chức
                </option>
            </select>

            @error('position_level')
                <div class="organization-form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="organization-form-group">
            <label class="organization-form-label" for="parent_id">
                Cán bộ quản lý trực tiếp
            </label>

            <select
                id="parent_id"
                name="parent_id"
                class="organization-form-control"
            >
                <option value="">Không có cấp quản lý</option>

                @foreach ($parentOptions as $parentOption)
                    <option
                        value="{{ $parentOption->id }}"
                        @selected((string) old('parent_id', $organizationMember->parent_id) === (string) $parentOption->id)
                    >
                        {{ $parentOption->name }} — {{ $parentOption->position }}
                    </option>
                @endforeach
            </select>

            <div class="organization-form-help">
                Trưởng phòng thường không có cấp quản lý. Phó phòng chọn Trưởng phòng. Công chức chọn Phó phòng phụ trách.
            </div>

            @error('parent_id')
                <div class="organization-form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="organization-form-group">
            <label class="organization-form-label" for="department">
                Đơn vị / Bộ phận
            </label>

            <input
                type="text"
                id="department"
                name="department"
                class="organization-form-control"
                value="{{ old('department', $organizationMember->department) }}"
                placeholder="Phòng Văn hóa - Xã hội"
            >

            @error('department')
                <div class="organization-form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="organization-form-group">
            <label class="organization-form-label" for="phone">
                Số điện thoại
            </label>

            <input
                type="text"
                id="phone"
                name="phone"
                class="organization-form-control"
                value="{{ old('phone', $organizationMember->phone) }}"
                placeholder="Ví dụ: 0901 234 567"
            >

            @error('phone')
                <div class="organization-form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="organization-form-group">
            <label class="organization-form-label" for="email">
                Email
            </label>

            <input
                type="email"
                id="email"
                name="email"
                class="organization-form-control"
                value="{{ old('email', $organizationMember->email) }}"
                placeholder="example@angiang.gov.vn"
            >

            @error('email')
                <div class="organization-form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="organization-form-group">
            <label class="organization-form-label" for="sort_order">
                Thứ tự hiển thị
            </label>

            <input
                type="number"
                id="sort_order"
                name="sort_order"
                class="organization-form-control"
                value="{{ old('sort_order', $organizationMember->sort_order ?? 0) }}"
                min="0"
            >

            @error('sort_order')
                <div class="organization-form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="organization-form-group organization-form-group-full">
            <label class="organization-form-label" for="responsibility">
                Lĩnh vực phụ trách
            </label>

            <textarea
                id="responsibility"
                name="responsibility"
                class="organization-form-control"
                placeholder="Ví dụ: Phụ trách điều hành chung, văn hóa, xã hội, giáo dục..."
            >{{ old('responsibility', $organizationMember->responsibility) }}</textarea>

            @error('responsibility')
                <div class="organization-form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="organization-form-group organization-form-group-full">
            <label class="organization-form-label" for="biography">
                Thông tin giới thiệu
            </label>

            <textarea
                id="biography"
                name="biography"
                class="organization-form-control"
                placeholder="Thông tin ngắn về quá trình công tác hoặc nhiệm vụ..."
            >{{ old('biography', $organizationMember->biography) }}</textarea>

            @error('biography')
                <div class="organization-form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="organization-form-group">
            <label class="organization-form-label" for="photo">
                Ảnh chân dung
            </label>

            <input
                type="file"
                id="photo"
                name="photo"
                class="organization-form-control"
                accept=".jpg,.jpeg,.png,.webp"
            >

            <div class="organization-form-help">
                Định dạng JPG, PNG hoặc WEBP. Tối đa 4 MB.
            </div>

            @error('photo')
                <div class="organization-form-error">{{ $message }}</div>
            @enderror

            @if ($organizationMember->photo_path)
                <div class="organization-form-photo-preview">
                    <img
                        src="{{ asset('storage/' . $organizationMember->photo_path) }}"
                        alt="{{ $organizationMember->name }}"
                    >
                </div>
            @endif
        </div>

        <div class="organization-form-group">
            <label class="organization-form-label">
                Trạng thái hiển thị
            </label>

            <div class="organization-form-check">
                <input
                    type="checkbox"
                    id="is_active"
                    name="is_active"
                    value="1"
                    @checked(old('is_active', $organizationMember->is_active ?? true))
                >

                <label for="is_active">
                    Hiển thị trên trang Giới thiệu
                </label>
            </div>

            @error('is_active')
                <div class="organization-form-error">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
