<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Thêm bài viết
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-lg bg-white p-6 shadow-sm">
                <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
                    @include('admin.articles._form', ['submitLabel' => 'Lưu bài viết'])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
