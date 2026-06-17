<x-app-layout>
    <x-slot name="header">
        <h2>Sửa mục tra cứu</h2>
    </x-slot>

    <div style="padding:32px;">
        <div style="max-width:760px;background:#fff;border-radius:12px;box-shadow:0 4px 16px rgba(15,23,42,.06);overflow:hidden;">
            <div style="display:flex;justify-content:space-between;align-items:center;padding:20px 24px;border-bottom:1px solid #e5e7eb;">
                <h3 style="margin:0;font-size:20px;font-weight:700;">Sửa mục tra cứu</h3>
                <a href="{{ route('admin.lookup-links.index') }}" style="color:#334155;text-decoration:none;">Quay lại</a>
            </div>

            <form action="{{ route('admin.lookup-links.update', $lookupLink) }}" method="POST" enctype="multipart/form-data" style="padding:24px;">
                @csrf
                @method('PUT')

                @include('admin.lookup-links._form', ['lookupLink' => $lookupLink])

                <div style="margin-top:24px;display:flex;gap:10px;">
                    <button type="submit" style="background:#0b63ad;color:#fff;border:0;padding:9px 16px;border-radius:8px;font-weight:600;">
                        Cập nhật
                    </button>

                    <a href="{{ route('admin.lookup-links.index') }}" style="background:#f8fafc;color:#334155;border:1px solid #cbd5e1;padding:9px 16px;border-radius:8px;text-decoration:none;">
                        Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>