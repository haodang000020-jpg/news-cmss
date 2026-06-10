<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Loai van ban
            </h2>
            <a href="{{ route('admin.document-categories.create') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                Them loai van ban
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 rounded-md bg-green-50 p-4 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 rounded-md bg-red-50 p-4 text-sm text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <div class="overflow-hidden rounded-lg bg-white shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Ten</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Slug</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Thu tu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Trang thai</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Thao tac</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse ($documentCategories as $documentCategory)
                            <tr>
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">{{ $documentCategory->name }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $documentCategory->slug }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $documentCategory->sort_order }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm">
                                    <span class="rounded-full px-2 py-1 text-xs font-medium {{ $documentCategory->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                        {{ $documentCategory->is_active ? 'Bat' : 'Tat' }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                    <div class="flex justify-end gap-2">
                                        <form method="POST" action="{{ route('admin.document-categories.update', $documentCategory) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="name" value="{{ $documentCategory->name }}">
                                            <input type="hidden" name="slug" value="{{ $documentCategory->slug }}">
                                            <input type="hidden" name="description" value="{{ $documentCategory->description }}">
                                            <input type="hidden" name="sort_order" value="{{ $documentCategory->sort_order }}">
                                            <input type="hidden" name="is_active" value="{{ $documentCategory->is_active ? 0 : 1 }}">
                                            <button type="submit" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                                {{ $documentCategory->is_active ? 'Tat' : 'Bat' }}
                                            </button>
                                        </form>

                                        <a href="{{ route('admin.document-categories.edit', $documentCategory) }}" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-indigo-700 shadow-sm ring-1 ring-inset ring-indigo-200 hover:bg-indigo-50">
                                            Sua
                                        </a>

                                        <form method="POST" action="{{ route('admin.document-categories.destroy', $documentCategory) }}" onsubmit="return confirm('Xoa loai van ban nay?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-red-700 shadow-sm ring-1 ring-inset ring-red-200 hover:bg-red-50">
                                                Xoa
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">
                                    Chua co loai van ban.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
