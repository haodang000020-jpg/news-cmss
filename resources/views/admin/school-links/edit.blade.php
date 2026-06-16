<x-app-layout>
    <x-slot name="header">
        <h2>Sửa liên kết trường học</h2>
    </x-slot>

    <div class="school-form-page">
        <div class="school-form-card">
            <div class="school-form-header">
                <h3>Sửa liên kết trường học</h3>
                <a href="{{ route('admin.school-links.index') }}" class="school-btn school-btn-secondary">
                    Quay lại
                </a>
            </div>

            <form action="{{ route('admin.school-links.update', $schoolLink) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.school-links._form', ['schoolLink' => $schoolLink])

                <div class="school-form-actions">
                    <button type="submit" class="school-btn school-btn-primary">
                        Cập nhật
                    </button>

                    <a href="{{ route('admin.school-links.index') }}" class="school-btn school-btn-secondary">
                        Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>