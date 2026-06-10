<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Sửa banner
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-lg bg-white p-6 shadow-sm">
                <form method="POST" action="{{ route('admin.banners.update', $banner) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @include('admin.banners._form', ['submitLabel' => 'Cập nhật banner'])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
