<x-app-layout>
    <x-slot name="header">
        <h2>Cơ cấu tổ chức</h2>
    </x-slot>

    <style>
        .organization-page {
            padding: 32px;
        }

        .organization-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.07);
            overflow: hidden;
        }

        .organization-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
        }

        .organization-card-title {
            margin: 0;
            color: #0f172a;
            font-size: 20px;
            font-weight: 700;
        }

        .organization-card-description {
            margin-top: 5px;
            color: #64748b;
            font-size: 14px;
        }

        .organization-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 38px;
            padding: 8px 14px;
            border: 1px solid transparent;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .organization-btn-primary {
            background: #0b63ad;
            color: #ffffff;
        }

        .organization-btn-primary:hover {
            background: #084f8c;
            color: #ffffff;
        }

        .organization-btn-edit {
            color: #1d4ed8;
            background: #eff6ff;
            border-color: #bfdbfe;
        }

        .organization-btn-delete {
            color: #dc2626;
            background: #fff1f2;
            border-color: #fecdd3;
        }

        .organization-filter {
            display: grid;
            grid-template-columns: minmax(220px, 1fr) 180px 180px auto;
            gap: 12px;
            padding: 18px 24px;
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
        }

        .organization-input,
        .organization-select {
            width: 100%;
            min-height: 42px;
            padding: 9px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: #ffffff;
            color: #0f172a;
            outline: none;
        }

        .organization-input:focus,
        .organization-select:focus {
            border-color: #0b63ad;
            box-shadow: 0 0 0 3px rgba(11, 99, 173, 0.12);
        }

        .organization-alert {
            margin-bottom: 16px;
            padding: 12px 16px;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            background: #dcfce7;
            color: #166534;
        }

        .organization-table-wrap {
            overflow-x: auto;
        }

        .organization-table {
            width: 100%;
            min-width: 1100px;
            border-collapse: collapse;
        }

        .organization-table th {
            padding: 13px 14px;
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
            color: #475569;
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .organization-table td {
            padding: 14px;
            border-bottom: 1px solid #e5e7eb;
            color: #0f172a;
            vertical-align: middle;
        }

        .organization-table tbody tr:hover {
            background: #f8fbff;
        }

        .organization-photo {
            width: 58px;
            height: 58px;
            border: 1px solid #dbe4ee;
            border-radius: 50%;
            object-fit: cover;
            background: #f1f5f9;
        }

        .organization-photo-placeholder {
            width: 58px;
            height: 58px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #eaf4ff;
            color: #0b63ad;
            font-size: 21px;
            font-weight: 800;
        }

        .organization-member-name {
            color: #0f172a;
            font-weight: 700;
        }

        .organization-member-position {
            margin-top: 4px;
            color: #64748b;
            font-size: 13px;
        }

        .organization-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .organization-level-1 {
            background: #fef3c7;
            color: #92400e;
        }

        .organization-level-2 {
            background: #dbeafe;
            color: #1e40af;
        }

        .organization-level-3 {
            background: #e0f2fe;
            color: #075985;
        }

        .organization-status-active {
            background: #dcfce7;
            color: #166534;
        }

        .organization-status-inactive {
            background: #e5e7eb;
            color: #475569;
        }

        .organization-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .organization-empty {
            padding: 30px !important;
            color: #64748b !important;
            text-align: center;
        }

        .organization-pagination {
            margin-top: 16px;
        }

        @media (max-width: 900px) {
            .organization-page {
                padding: 16px;
            }

            .organization-card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .organization-filter {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="organization-page">
        @if (session('success'))
            <div class="organization-alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="organization-card">
            <div class="organization-card-header">
                <div>
                    <h3 class="organization-card-title">
                        Danh sách cơ cấu tổ chức
                    </h3>

                    <div class="organization-card-description">
                        Quản lý Trưởng phòng, Phó phòng và công chức chuyên môn.
                    </div>
                </div>

                <a
                    href="{{ route('admin.organization-members.create') }}"
                    class="organization-btn organization-btn-primary"
                >
                    Thêm cán bộ
                </a>
            </div>

            <form
                method="GET"
                action="{{ route('admin.organization-members.index') }}"
                class="organization-filter"
            >
                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    class="organization-input"
                    placeholder="Tìm theo tên, chức vụ, lĩnh vực..."
                >

                <select
                    name="position_level"
                    class="organization-select"
                >
                    <option value="">Tất cả cấp chức vụ</option>
                    <option value="1" @selected(request('position_level') === '1')>
                        Trưởng phòng
                    </option>
                    <option value="2" @selected(request('position_level') === '2')>
                        Phó phòng
                    </option>
                    <option value="3" @selected(request('position_level') === '3')>
                        Công chức
                    </option>
                </select>

                <select
                    name="status"
                    class="organization-select"
                >
                    <option value="">Tất cả trạng thái</option>
                    <option value="active" @selected(request('status') === 'active')>
                        Đang hoạt động
                    </option>
                    <option value="inactive" @selected(request('status') === 'inactive')>
                        Đã tắt
                    </option>
                </select>

                <button
                    type="submit"
                    class="organization-btn organization-btn-primary"
                >
                    Tìm kiếm
                </button>
            </form>

            <div class="organization-table-wrap">
                <table class="organization-table">
                    <thead>
                        <tr>
                            <th>Ảnh</th>
                            <th>Họ tên / Chức vụ</th>
                            <th>Cấp chức vụ</th>
                            <th>Quản lý trực tiếp</th>
                            <th>Lĩnh vực phụ trách</th>
                            <th>Thứ tự</th>
                            <th>Trạng thái</th>
                            <th style="text-align: right;">Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($members as $member)
                            <tr>
                                <td>
                                    @if ($member->photo_path)
                                        <img
                                            src="{{ asset('storage/' . $member->photo_path) }}"
                                            alt="{{ $member->name }}"
                                            class="organization-photo"
                                        >
                                    @else
                                        <div class="organization-photo-placeholder">
                                            {{ mb_strtoupper(mb_substr($member->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <div class="organization-member-name">
                                        {{ $member->name }}
                                    </div>

                                    <div class="organization-member-position">
                                        {{ $member->position }}
                                    </div>

                                    @if ($member->department)
                                        <div class="organization-member-position">
                                            {{ $member->department }}
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <span class="organization-badge organization-level-{{ $member->position_level }}">
                                        {{ $member->level_label }}
                                    </span>
                                </td>

                                <td>
                                    @if ($member->parent)
                                        <strong>{{ $member->parent->name }}</strong>
                                        <div class="organization-member-position">
                                            {{ $member->parent->position }}
                                        </div>
                                    @else
                                        <span style="color: #94a3b8;">Không có</span>
                                    @endif
                                </td>

                                <td>
                                    {{ \Illuminate\Support\Str::limit($member->responsibility ?: '-', 90) }}
                                </td>

                                <td>
                                    {{ $member->sort_order }}
                                </td>

                                <td>
                                    @if ($member->is_active)
                                        <span class="organization-badge organization-status-active">
                                            Đang hoạt động
                                        </span>
                                    @else
                                        <span class="organization-badge organization-status-inactive">
                                            Đã tắt
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="organization-actions">
                                        <a
                                            href="{{ route('admin.organization-members.edit', $member) }}"
                                            class="organization-btn organization-btn-edit"
                                        >
                                            Sửa
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('admin.organization-members.destroy', $member) }}"
                                            onsubmit="return confirm('Bạn có chắc muốn xóa cán bộ này khỏi cơ cấu tổ chức?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="organization-btn organization-btn-delete"
                                            >
                                                Xóa
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="organization-empty">
                                    Chưa có cán bộ trong cơ cấu tổ chức.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="organization-pagination">
            {{ $members->links() }}
        </div>
    </div>
</x-app-layout>
