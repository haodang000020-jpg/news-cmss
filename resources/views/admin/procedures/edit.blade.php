<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Sửa thủ tục hành chính</h2>
            @if ($procedure->is_active)
                <a href="{{ route('frontend.procedures.show', $procedure->slug) }}" target="_blank"
                    class="rounded-md bg-white px-4 py-2 text-sm font-semibold text-blue-700 shadow-sm ring-1 ring-inset ring-blue-200 hover:bg-blue-50">
                    Xem ngoài website
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 rounded-md bg-green-50 p-4 text-sm text-green-700">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.procedures.update', $procedure) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.procedures._form', ['buttonLabel' => 'Cập nhật thủ tục'])
            </form>
        </div>
    </div>
</x-app-layout>
