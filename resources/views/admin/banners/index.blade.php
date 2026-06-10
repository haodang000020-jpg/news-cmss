<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Banner
            </h2>
            <a href="{{ route('admin.banners.create') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                Thêm banner
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

            <div class="overflow-hidden rounded-lg bg-white shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Ảnh</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Tiêu đề</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Vị trí</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Thứ tự</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Trạng thái</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse ($banners as $banner)
                            <tr>
                                <td class="px-6 py-4">
                                    <img src="{{ asset('storage/'.$banner->image) }}" alt="{{ $banner->title }}" class="h-16 w-28 rounded-md object-cover">
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $banner->title }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $positions[$banner->position] ?? $banner->position }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $banner->sort_order }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm">
                                    <span class="rounded-full px-2 py-1 text-xs font-medium {{ $banner->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                        {{ $banner->is_active ? 'Bật' : 'Tắt' }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                    <div class="flex justify-end gap-2">
                                        <form method="POST" action="{{ route('admin.banners.update', $banner) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="title" value="{{ $banner->title }}">
                                            <input type="hidden" name="link" value="{{ $banner->link }}">
                                            <input type="hidden" name="position" value="{{ $banner->position }}">
                                            <input type="hidden" name="sort_order" value="{{ $banner->sort_order }}">
                                            <input type="hidden" name="starts_at" value="{{ $banner->starts_at?->format('Y-m-d H:i:s') }}">
                                            <input type="hidden" name="ends_at" value="{{ $banner->ends_at?->format('Y-m-d H:i:s') }}">
                                            <input type="hidden" name="is_active" value="{{ $banner->is_active ? 0 : 1 }}">
                                            <button type="submit" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                                {{ $banner->is_active ? 'Tắt' : 'Bật' }}
                                            </button>
                                        </form>

                                        <a href="{{ route('admin.banners.edit', $banner) }}" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-indigo-700 shadow-sm ring-1 ring-inset ring-indigo-200 hover:bg-indigo-50">
                                            Sửa
                                        </a>

                                        <form method="POST" action="{{ route('admin.banners.destroy', $banner) }}" onsubmit="return confirm('Xóa banner này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-red-700 shadow-sm ring-1 ring-inset ring-red-200 hover:bg-red-50">
                                                Xóa
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">
                                    Chưa có banner.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $banners->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
