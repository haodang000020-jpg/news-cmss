<x-app-layout>
    <x-slot name="header">
        <h2>Tra cứu</h2>
    </x-slot>

    <div style="padding:32px;">
        @if(session('success'))
            <div style="margin-bottom:16px;padding:12px 16px;background:#dcfce7;color:#166534;border-radius:8px;">
                {{ session('success') }}
            </div>
        @endif

        <div style="background:#fff;border-radius:12px;box-shadow:0 4px 16px rgba(15,23,42,.06);overflow:hidden;">
            <div style="display:flex;justify-content:space-between;align-items:center;padding:20px 24px;border-bottom:1px solid #e5e7eb;">
                <div>
                    <h3 style="margin:0;font-size:20px;font-weight:700;">Danh sách mục tra cứu</h3>
                    <div style="margin-top:4px;color:#64748b;font-size:14px;">
                        Quản lý banner, tiêu đề và liên kết hiển thị tại khối Tra cứu ngoài trang chủ.
                    </div>
                </div>

                <a href="{{ route('admin.lookup-links.create') }}"
                   style="background:#0b63ad;color:#fff;padding:9px 14px;border-radius:8px;text-decoration:none;font-weight:600;">
                    Thêm mục tra cứu
                </a>
            </div>

            <table style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr style="background:#f8fafc;">
                        <th style="padding:14px;text-align:left;">Ảnh</th>
                        <th style="padding:14px;text-align:left;">Tiêu đề</th>
                        <th style="padding:14px;text-align:left;">Liên kết</th>
                        <th style="padding:14px;text-align:left;">Thứ tự</th>
                        <th style="padding:14px;text-align:left;">Trạng thái</th>
                        <th style="padding:14px;text-align:right;">Thao tác</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($lookupLinks as $lookupLink)
                        <tr>
                            <td style="padding:14px;border-top:1px solid #e5e7eb;">
                                @if($lookupLink->image_path)
                                    <img src="{{ asset('storage/' . $lookupLink->image_path) }}"
                                         alt="{{ $lookupLink->title }}"
                                         style="width:80px;height:54px;object-fit:cover;border-radius:6px;">
                                @else
                                    <span style="color:#94a3b8;">Không có</span>
                                @endif
                            </td>

                            <td style="padding:14px;border-top:1px solid #e5e7eb;">
                                <strong>{{ $lookupLink->title }}</strong>
                            </td>

                            <td style="padding:14px;border-top:1px solid #e5e7eb;">
                                @if($lookupLink->url)
                                    <a href="{{ $lookupLink->url }}" target="_blank" rel="noopener" style="color:#0b63ad;">
                                        {{ $lookupLink->url }}
                                    </a>
                                @else
                                    <span style="color:#94a3b8;">-</span>
                                @endif
                            </td>

                            <td style="padding:14px;border-top:1px solid #e5e7eb;">
                                {{ $lookupLink->sort_order }}
                            </td>

                            <td style="padding:14px;border-top:1px solid #e5e7eb;">
                                @if($lookupLink->is_active)
                                    <span style="background:#dcfce7;color:#166534;padding:4px 10px;border-radius:999px;font-weight:600;">Bật</span>
                                @else
                                    <span style="background:#e5e7eb;color:#374151;padding:4px 10px;border-radius:999px;font-weight:600;">Tắt</span>
                                @endif
                            </td>

                            <td style="padding:14px;border-top:1px solid #e5e7eb;text-align:right;">
                                <a href="{{ route('admin.lookup-links.edit', $lookupLink) }}"
                                   style="color:#1d4ed8;background:#eff6ff;border:1px solid #bfdbfe;padding:7px 12px;border-radius:6px;text-decoration:none;">
                                    Sửa
                                </a>

                                <form action="{{ route('admin.lookup-links.destroy', $lookupLink) }}"
                                      method="POST"
                                      style="display:inline;"
                                      onsubmit="return confirm('Bạn có chắc muốn xóa mục này?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            style="color:#dc2626;background:#fff1f2;border:1px solid #fecdd3;padding:7px 12px;border-radius:6px;">
                                        Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding:28px;text-align:center;color:#64748b;border-top:1px solid #e5e7eb;">
                                Chưa có mục tra cứu.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:16px;">
            {{ $lookupLinks->links() }}
        </div>
    </div>
</x-app-layout>