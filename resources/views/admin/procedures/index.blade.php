<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">Thủ tục hành chính</h2>
                <p class="mt-1 text-sm text-gray-500">Quản lý hồ sơ, trình tự, thời hạn, lệ phí và biểu mẫu.</p>
            </div>
            <a href="{{ route('admin.procedures.create') }}"
                class="inline-flex items-center rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-800">
                Thêm thủ tục
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 rounded-md bg-green-50 p-4 text-sm text-green-700">{{ session('status') }}</div>
            @endif

            <form method="GET" action="{{ route('admin.procedures.index') }}"
                class="mb-4 grid gap-3 rounded-lg bg-white p-4 shadow-sm md:grid-cols-4">
                <input name="search" type="search" value="{{ $filters['search'] ?? '' }}"
                    placeholder="Tên, mã thủ tục, cơ quan thực hiện"
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                <select name="procedure_group_id"
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Tất cả lĩnh vực</option>
                    @foreach ($procedureGroups as $procedureGroup)
                        <option value="{{ $procedureGroup->id }}"
                            @selected((string) ($filters['procedure_group_id'] ?? '') === (string) $procedureGroup->id)>
                            {{ $procedureGroup->name }}
                        </option>
                    @endforeach
                </select>

                <select name="is_active"
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Tất cả trạng thái</option>
                    <option value="1" @selected(($filters['is_active'] ?? '') === '1')>Đang hoạt động</option>
                    <option value="0" @selected(($filters['is_active'] ?? '') === '0')>Đang ẩn</option>
                </select>

                <div class="flex gap-2">
                    <button type="submit"
                        class="flex-1 rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800">
                        Lọc
                    </button>
                    <a href="{{ route('admin.procedures.index') }}"
                        class="rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        Xóa lọc
                    </a>
                </div>
            </form>

            <div class="overflow-hidden rounded-lg bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Thủ tục</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Lĩnh vực</th>
                                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">Hồ sơ</th>
                                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">Bước</th>
                                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">Trạng thái</th>
                                <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($procedures as $procedure)
                                <tr>
                                    <td class="px-6 py-4 align-top">
                                        <div class="flex items-start gap-2">
                                            <div>
                                                <div class="font-semibold text-gray-900">{{ $procedure->name }}</div>
                                                <div class="mt-1 flex flex-wrap gap-2 text-xs text-gray-500">
                                                    @if ($procedure->code)
                                                        <span>Mã: {{ $procedure->code }}</span>
                                                    @endif
                                                    @if ($procedure->is_featured)
                                                        <span class="rounded-full bg-amber-100 px-2 py-0.5 font-semibold text-amber-700">Nổi bật</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 align-top text-sm text-gray-600">{{ $procedure->group?->name }}</td>
                                    <td class="px-6 py-4 text-center text-sm font-semibold text-gray-700">{{ $procedure->required_documents_count }}</td>
                                    <td class="px-6 py-4 text-center text-sm font-semibold text-gray-700">{{ $procedure->steps_count }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $procedure->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                            {{ $procedure->is_active ? 'Đang bật' : 'Đang ẩn' }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                                        <div class="flex justify-end gap-2">
                                            @if ($procedure->is_active)
                                                <a href="{{ route('frontend.procedures.show', $procedure->slug) }}" target="_blank"
                                                    class="rounded-md bg-white px-3 py-2 font-semibold text-blue-700 shadow-sm ring-1 ring-inset ring-blue-200 hover:bg-blue-50">
                                                    Xem
                                                </a>
                                            @endif
                                            <a href="{{ route('admin.procedures.edit', $procedure) }}"
                                                class="rounded-md bg-white px-3 py-2 font-semibold text-indigo-700 shadow-sm ring-1 ring-inset ring-indigo-200 hover:bg-indigo-50">
                                                Sửa
                                            </a>
                                            <form method="POST" action="{{ route('admin.procedures.destroy', $procedure) }}"
                                                onsubmit="return confirm('Xóa thủ tục này cùng toàn bộ thành phần hồ sơ và các bước thực hiện?')">
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
                                    <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-500">Chưa có thủ tục hành chính.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-5">{{ $procedures->links() }}</div>
        </div>
    </div>
</x-app-layout>
