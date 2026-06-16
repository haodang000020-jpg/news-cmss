<x-app-layout>
    <x-slot name="header">
        <h2>Thêm liên kết trường học</h2>
    </x-slot>

    <div class="school-form-page">
        <div class="school-form-card">
            <div class="school-form-header">
                <h3>Thêm liên kết trường học</h3>
                <a href="{{ route('admin.school-links.index') }}" class="school-btn school-btn-secondary">
                    Quay lại
                </a>
            </div>

            <form action="{{ route('admin.school-links.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @include('admin.school-links._form', ['schoolLink' => $schoolLink])

                <div class="school-form-actions">
                    <button type="submit" class="school-btn school-btn-primary">
                        Lưu
                    </button>

                    <a href="{{ route('admin.school-links.index') }}" class="school-btn school-btn-secondary">
                        Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>