<x-app-layout>
    <x-slot name="header">
        <h2>Liên kết trường học</h2>
    </x-slot>

    <style>
        .school-admin-page {
            padding: 32px;
        }

        .school-admin-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.06);
            overflow: hidden;
        }

        .school-admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 20px 24px;
            border-bottom: 1px solid #e5e7eb;
        }

        .school-admin-title {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        .school-admin-subtitle {
            margin-top: 4px;
            color: #64748b;
            font-size: 14px;
        }

        .school-admin-btn {
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

        .school-admin-btn-primary {
            background: #0b63ad;
            color: #ffffff;
        }

        .school-admin-btn-primary:hover {
            background: #084f8c;
            color: #ffffff;
        }

        .school-admin-btn-edit {
            color: #1d4ed8;
            background: #eff6ff;
            border-color: #bfdbfe;
        }

        .school-admin-btn-delete {
            color: #dc2626;
            background: #fff1f2;
            border-color: #fecdd3;
        }

        .school-admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        .school-admin-table th {
            background: #f8fafc;
            color: #475569;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.04em;
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            white-space: nowrap;
        }

        .school-admin-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #e5e7eb;
            color: #0f172a;
            vertical-align: middle;
        }

        .school-admin-table tr:last-child td {
            border-bottom: 0;
        }

        .school-logo-preview {
            width: 64px;
            height: 48px;
            object-fit: contain;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 4px;
        }

        .school-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
        }

        .school-badge-active {
            background: #dcfce7;
            color: #166534;
        }

        .school-badge-inactive {
            background: #e5e7eb;
            color: #374151;
        }

        .school-admin-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .school-admin-alert {
            margin-bottom: 16px;
            padding: 12px 16px;
            border-radius: 8px;
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .school-empty {
            text-align: center;
            color: #64748b;
            padding: 28px 16px !important;
        }

        .school-admin-link {
            color: #0b63ad;
            text-decoration: none;
            word-break: break-all;
        }

        .school-admin-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .school-admin-page {
                padding: 16px;
            }

            .school-admin-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .school-admin-table {
                min-width: 760px;
            }

            .school-admin-table-wrap {
                overflow-x: auto;
            }
        }
    </style>

    <div class="school-admin-page">
        @if(session('success'))
            <div class="school-admin-alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="school-admin-card">
            <div class="school-admin-header">
                <div>
                    <h3 class="school-admin-title">Danh sách liên kết trường học</h3>
                    <div class="school-admin-subtitle">
                        Quản lý logo, tên trường và liên kết hiển thị ngoài trang chủ.
                    </div>
                </div>

                <a href="{{ route('admin.school-links.create') }}" class="school-admin-btn school-admin-btn-primary">
                    Thêm liên kết
                </a>
            </div>

            <div class="school-admin-table-wrap">
                <table class="school-admin-table">
                    <thead>
                        <tr>
                            <th>Logo</th>
                            <th>Tên trường</th>
                            <th>Liên kết</th>
                            <th>Thứ tự</th>
                            <th>Trạng thái</th>
                            <th style="text-align: right;">Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($schoolLinks as $schoolLink)
                            <tr>
                                <td>
                                    @if($schoolLink->logo_path)
                                        <img
                                            src="{{ asset('storage/' . $schoolLink->logo_path) }}"
                                            alt="{{ $schoolLink->name }}"
                                            class="school-logo-preview"
                                        >
                                    @else
                                        <span style="color: #94a3b8;">Không có</span>
                                    @endif
                                </td>

                                <td>
                                    <strong>{{ $schoolLink->name }}</strong>
                                </td>

                                <td>
                                    @if($schoolLink->url)
                                        <a href="{{ $schoolLink->url }}" target="_blank" rel="noopener" class="school-admin-link">
                                            {{ $schoolLink->url }}
                                        </a>
                                    @else
                                        <span style="color: #94a3b8;">-</span>
                                    @endif
                                </td>

                                <td>{{ $schoolLink->sort_order }}</td>

                                <td>
                                    @if($schoolLink->is_active)
                                        <span class="school-badge school-badge-active">Bật</span>
                                    @else
                                        <span class="school-badge school-badge-inactive">Tắt</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="school-admin-actions">
                                        <a href="{{ route('admin.school-links.edit', $schoolLink) }}" class="school-admin-btn school-admin-btn-edit">
                                            Sửa
                                        </a>

                                        <form action="{{ route('admin.school-links.destroy', $schoolLink) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa liên kết này?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="school-admin-btn school-admin-btn-delete">
                                                Xóa
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="school-empty">
                                    Chưa có liên kết trường học.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div style="margin-top: 16px;">
            {{ $schoolLinks->links() }}
        </div>
    </div>
</x-app-layout>