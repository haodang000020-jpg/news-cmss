<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">Lĩnh vực phản ánh</h2>
                <p class="mt-1 text-sm text-gray-500">Quản lý nhóm nội dung để người dân lựa chọn khi gửi phản ánh.</p>
            </div>
            <a
                href="{{ route('admin.feedback-categories.create') }}"
                class="rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800"
            >
                Thêm lĩnh vực
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 rounded-md bg-green-50 p-4 text-sm font-medium text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 rounded-md bg-red-50 p-4 text-sm font-medium text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="overflow-hidden rounded-lg bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Lĩnh vực</th>
                                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">Phản ánh</th>
                                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">Trạng thái</th>
                                <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($categories as $category)
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-900">{{ $category->name }}</div>
                                        <div class="mt-1 text-xs text-gray-500">{{ $category->slug }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm font-semibold text-gray-700">
                                        {{ number_format($category->feedbacks_count) }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $category->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                            {{ $category->is_active ? 'Hoạt động' : 'Đã tắt' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-2">
                                            <a
                                                href="{{ route('admin.feedback-categories.edit', $category) }}"
                                                class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-blue-700 ring-1 ring-inset ring-blue-200 hover:bg-blue-50"
                                            >
                                                Sửa
                                            </a>
                                            <form
                                                method="POST"
                                                action="{{ route('admin.feedback-categories.destroy', $category) }}"
                                                onsubmit="return confirm('Xóa lĩnh vực phản ánh này?')"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-red-700 ring-1 ring-inset ring-red-200 hover:bg-red-50"
                                                >
                                                    Xóa
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-sm text-gray-500">
                                        Chưa có lĩnh vực phản ánh.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-5">{{ $categories->links() }}</div>
        </div>
    </div>
</x-app-layout>
