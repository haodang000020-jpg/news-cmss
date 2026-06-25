<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Sửa lĩnh vực thủ tục</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-lg bg-white p-6 shadow-sm">
                <form method="POST" action="{{ route('admin.procedure-groups.update', $procedureGroup) }}">
                    @csrf
                    @method('PUT')
                    @include('admin.procedure-groups._form', ['buttonLabel' => 'Cập nhật lĩnh vực'])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
