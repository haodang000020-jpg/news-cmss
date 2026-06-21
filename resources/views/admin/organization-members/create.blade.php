<x-app-layout>
    <x-slot name="header">
        <h2>Thêm cán bộ</h2>
    </x-slot>

    <div class="organization-form-page">
        <div class="organization-form-card">
            <div class="organization-form-header">
                <h3>Thêm cán bộ vào cơ cấu tổ chức</h3>

                <a
                    href="{{ route('admin.organization-members.index') }}"
                    class="organization-form-btn organization-form-btn-secondary"
                >
                    Quay lại
                </a>
            </div>

            <form
                method="POST"
                action="{{ route('admin.organization-members.store') }}"
                enctype="multipart/form-data"
            >
                @csrf

                @include('admin.organization-members._form', [
                    'organizationMember' => $organizationMember,
                    'parentOptions' => $parentOptions,
                ])

                <div class="organization-form-actions">
                    <button
                        type="submit"
                        class="organization-form-btn organization-form-btn-primary"
                    >
                        Lưu cán bộ
                    </button>

                    <a
                        href="{{ route('admin.organization-members.index') }}"
                        class="organization-form-btn organization-form-btn-secondary"
                    >
                        Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>