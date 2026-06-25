<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Thêm lĩnh vực thủ tục</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-lg bg-white p-6 shadow-sm">
                <form method="POST" action="{{ route('admin.procedure-groups.store') }}">
                    @csrf
                    @include('admin.procedure-groups._form', ['buttonLabel' => 'Lưu lĩnh vực'])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
