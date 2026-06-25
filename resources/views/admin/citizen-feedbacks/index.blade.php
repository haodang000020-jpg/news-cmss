<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Phản ánh - kiến nghị</h2>
            <p class="mt-1 text-sm text-gray-500">Tiếp nhận, phân công, phản hồi và theo dõi mức độ hài lòng.</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-5 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-100">
                    <div class="text-sm font-medium text-gray-500">Tổng phản ánh</div>
                    <div class="mt-2 text-2xl font-bold text-gray-900">{{ number_format($stats['total']) }}</div>
                </div>
                <div class="rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-100">
                    <div class="text-sm font-medium text-gray-500">Mới gửi</div>
                    <div class="mt-2 text-2xl font-bold text-amber-700">{{ number_format($stats['new']) }}</div>
                </div>
                <div class="rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-100">
                    <div class="text-sm font-medium text-gray-500">Đang xử lý</div>
                    <div class="mt-2 text-2xl font-bold text-blue-700">{{ number_format($stats['processing']) }}</div>
                </div>
                <div class="rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-100">
                    <div class="text-sm font-medium text-gray-500">Đã giải quyết</div>
                    <div class="mt-2 text-2xl font-bold text-green-700">{{ number_format($stats['resolved']) }}</div>
                </div>
            </div>

            <form
                method="GET"
                action="{{ route('admin.citizen-feedbacks.index') }}"
                class="mb-4 grid gap-3 rounded-lg bg-white p-4 shadow-sm md:grid-cols-2 lg:grid-cols-6"
            >
                <input
                    name="search"
                    type="search"
                    value="{{ $filters['search'] }}"
                    placeholder="Mã, tiêu đề, người gửi..."
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 lg:col-span-2"
                >

                <select name="status" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Tất cả trạng thái</option>
                    @foreach ($statuses as $value => $label)
                        <option value="{{ $value }}" @selected($filters['status'] === $value)>{{ $label }}</option>
                    @endforeach
                </select>

                <select name="feedback_category_id" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Tất cả lĩnh vực</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected((string) $filters['feedback_category_id'] === (string) $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <input
                    name="from_date"
                    type="date"
                    value="{{ $filters['from_date'] }}"
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    title="Từ ngày"
                >

                <input
                    name="to_date"
                    type="date"
                    value="{{ $filters['to_date'] }}"
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    title="Đến ngày"
                >

                <div class="flex gap-2 lg:col-span-6">
                    <button type="submit" class="rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800">
                        Lọc dữ liệu
                    </button>
                    <a href="{{ route('admin.citizen-feedbacks.index') }}" class="rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        Xóa lọc
                    </a>
                    <a href="{{ route('admin.feedback-categories.index') }}" class="ml-auto rounded-md bg-white px-4 py-2 text-sm font-semibold text-blue-700 ring-1 ring-inset ring-blue-200 hover:bg-blue-50">
                        Lĩnh vực phản ánh
                    </a>
                </div>
            </form>

            <div class="overflow-hidden rounded-lg bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-5 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Mã / nội dung</th>
                                <th class="px-5 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Lĩnh vực</th>
                                <th class="px-5 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Người gửi</th>
                                <th class="px-5 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">Trạng thái</th>
                                <th class="px-5 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Phụ trách</th>
                                <th class="px-5 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Thời gian</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($feedbacks as $feedback)
                                @php
                                    $statusClasses = [
                                        'new' => 'bg-amber-100 text-amber-700',
                                        'received' => 'bg-sky-100 text-sky-700',
                                        'processing' => 'bg-violet-100 text-violet-700',
                                        'resolved' => 'bg-green-100 text-green-700',
                                        'rejected' => 'bg-red-100 text-red-700',
                                    ];
                                @endphp
                                <tr class="hover:bg-gray-50">
                                    <td class="max-w-xl px-5 py-4 align-top">
                                        <a href="{{ route('admin.citizen-feedbacks.show', $feedback) }}" class="font-semibold text-blue-700 hover:underline">
                                            {{ $feedback->tracking_code }}
                                        </a>
                                        <div class="mt-1 font-semibold text-gray-900">{{ $feedback->subject }}</div>
                                        <div class="mt-1 text-xs text-gray-500">{{ $feedback->attachments_count }} tệp đính kèm</div>
                                    </td>
                                    <td class="px-5 py-4 align-top text-sm text-gray-600">{{ $feedback->category?->name }}</td>
                                    <td class="px-5 py-4 align-top text-sm text-gray-600">
                                        <div class="font-medium text-gray-800">{{ $feedback->full_name }}</div>
                                        <div class="mt-1 text-xs text-gray-500">{{ $feedback->phone }}</div>
                                    </td>
                                    <td class="px-5 py-4 text-center align-top">
                                        <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $statusClasses[$feedback->status] ?? 'bg-gray-100 text-gray-600' }}">
                                            {{ $feedback->statusLabel() }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 align-top text-sm text-gray-600">
                                        {{ $feedback->assignedTo?->name ?? 'Chưa phân công' }}
                                    </td>
                                    <td class="whitespace-nowrap px-5 py-4 text-right align-top text-sm text-gray-500">
                                        {{ $feedback->created_at?->format('d/m/Y H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-500">Chưa có phản ánh nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-5">{{ $feedbacks->links() }}</div>
        </div>
    </div>
</x-app-layout>
