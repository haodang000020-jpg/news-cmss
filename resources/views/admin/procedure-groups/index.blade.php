<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">Lĩnh vực thủ tục</h2>
                <p class="mt-1 text-sm text-gray-500">Phân nhóm thủ tục hành chính để người dân dễ tra cứu.</p>
            </div>
            <a href="{{ route('admin.procedure-groups.create') }}"
                class="inline-flex items-center rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-800">
                Thêm lĩnh vực
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 rounded-md bg-green-50 p-4 text-sm text-green-700">{{ session('status') }}</div>
            @endif

            @if (session('error'))
                <div class="mb-4 rounded-md bg-red-50 p-4 text-sm text-red-700">{{ session('error') }}</div>
            @endif

            <div class="overflow-hidden rounded-lg bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Lĩnh vực</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Slug</th>
                                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">Số thủ tục</th>
                                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">Thứ tự</th>
                                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">Trạng thái</th>
                                <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($procedureGroups as $procedureGroup)
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-900">{{ $procedureGroup->name }}</div>
                                        @if ($procedureGroup->description)
                                            <div class="mt-1 max-w-xl text-sm text-gray-500">{{ $procedureGroup->description }}</div>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $procedureGroup->slug }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-center text-sm font-semibold text-gray-700">{{ $procedureGroup->procedures_count }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-500">{{ $procedureGroup->sort_order }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-center text-sm">
                                        <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $procedureGroup->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                            {{ $procedureGroup->is_active ? 'Đang bật' : 'Đang tắt' }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('admin.procedure-groups.edit', $procedureGroup) }}"
                                                class="rounded-md bg-white px-3 py-2 font-semibold text-indigo-700 shadow-sm ring-1 ring-inset ring-indigo-200 hover:bg-indigo-50">
                                                Sửa
                                            </a>
                                            <form method="POST" action="{{ route('admin.procedure-groups.destroy', $procedureGroup) }}"
                                                onsubmit="return confirm('Xóa lĩnh vực thủ tục này?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="rounded-md bg-white px-3 py-2 font-semibold text-red-700 shadow-sm ring-1 ring-inset ring-red-200 hover:bg-red-50">
                                                    Xóa
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-500">Chưa có lĩnh vực thủ tục.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
