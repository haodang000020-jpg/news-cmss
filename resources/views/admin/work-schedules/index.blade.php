<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Lịch làm việc
            </h2>
            <a href="{{ route('admin.work-schedules.create') }}" class="inline-flex items-center rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-800">
                Thêm lịch
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

            <form method="GET" action="{{ route('admin.work-schedules.index') }}" class="mb-4 grid gap-3 rounded-lg bg-white p-4 shadow-sm md:grid-cols-3">
                <input name="q" type="text" value="{{ $filters['q'] ?? '' }}" placeholder="Tìm theo tiêu đề, thời gian, ghi chú" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                <div class="flex gap-2 md:col-span-2">
                    <button type="submit" class="rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-800">
                        Tìm kiếm
                    </button>
                    <a href="{{ route('admin.work-schedules.index') }}" class="rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        Xóa lọc
                    </a>
                </div>
            </form>

            <div class="overflow-hidden rounded-lg bg-white shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Thứ/ngày</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Tiêu đề</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Buổi sáng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Buổi chiều</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Thứ tự</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Trạng thái</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse ($workSchedules as $workSchedule)
                            <tr>
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ $workSchedule->day_name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $workSchedule->title ?: '-' }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                    {{ $workSchedule->is_working_day ? ($workSchedule->morning_time ?: '-') : 'Nghỉ' }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                    {{ $workSchedule->is_working_day ? ($workSchedule->afternoon_time ?: '-') : 'Nghỉ' }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $workSchedule->sort_order }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm">
                                    <span class="rounded-full px-2 py-1 text-xs font-medium {{ $workSchedule->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                        {{ $workSchedule->is_active ? 'Đang bật' : 'Đang tắt' }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.work-schedules.edit', $workSchedule) }}" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-indigo-700 shadow-sm ring-1 ring-inset ring-indigo-200 hover:bg-indigo-50">
                                            Sửa
                                        </a>

                                        <form method="POST" action="{{ route('admin.work-schedules.destroy', $workSchedule) }}" onsubmit="return confirm('Xóa lịch làm việc này?')">
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
                                <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-500">
                                    Chưa có lịch làm việc.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $workSchedules->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
