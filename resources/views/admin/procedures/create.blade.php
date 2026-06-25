<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Thêm thủ tục hành chính</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.procedures.store') }}" enctype="multipart/form-data">
                @csrf
                @include('admin.procedures._form', ['buttonLabel' => 'Lưu thủ tục'])
            </form>
        </div>
    </div>
</x-app-layout>
