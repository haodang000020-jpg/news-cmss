<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Câu hỏi Trợ lý số</h2>
            <p class="mt-1 text-sm text-gray-500">
                Theo dõi nhu cầu tra cứu và những câu hỏi hệ thống chưa tìm được kết quả phù hợp.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-5 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-100">
                    <div class="text-sm font-medium text-gray-500">Tổng lượt hỏi</div>
                    <div class="mt-2 text-2xl font-bold text-gray-900">{{ number_format($stats['total']) }}</div>
                </div>
                <div class="rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-100">
                    <div class="text-sm font-medium text-gray-500">Có kết quả</div>
                    <div class="mt-2 text-2xl font-bold text-green-700">{{ number_format($stats['resolved']) }}</div>
                </div>
                <div class="rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-100">
                    <div class="text-sm font-medium text-gray-500">Chưa tìm thấy</div>
                    <div class="mt-2 text-2xl font-bold text-amber-700">{{ number_format($stats['unresolved']) }}</div>
                </div>
                <div class="rounded-lg bg-white p-4 shadow-sm ring-1 ring-gray-100">
                    <div class="text-sm font-medium text-gray-500">Phản hồi chưa phù hợp</div>
                    <div class="mt-2 text-2xl font-bold text-red-700">{{ number_format($stats['not_helpful']) }}</div>
                </div>
            </div>

            <form
                method="GET"
                action="{{ route('admin.assistant-queries.index') }}"
                class="mb-4 grid gap-3 rounded-lg bg-white p-4 shadow-sm md:grid-cols-4"
            >
                <input
                    name="search"
                    type="search"
                    value="{{ $filters['search'] }}"
                    placeholder="Tìm trong nội dung câu hỏi"
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >

                <select
                    name="status"
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >
                    <option value="">Tất cả kết quả</option>
                    <option value="resolved" @selected($filters['status'] === 'resolved')>Có kết quả</option>
                    <option value="unresolved" @selected($filters['status'] === 'unresolved')>Chưa tìm thấy</option>
                </select>

                <select
                    name="feedback"
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >
                    <option value="">Tất cả phản hồi</option>
                    <option value="helpful" @selected($filters['feedback'] === 'helpful')>Phù hợp</option>
                    <option value="not_helpful" @selected($filters['feedback'] === 'not_helpful')>Chưa phù hợp</option>
                    <option value="none" @selected($filters['feedback'] === 'none')>Chưa đánh giá</option>
                </select>

                <div class="flex gap-2">
                    <button
                        type="submit"
                        class="flex-1 rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800"
                    >
                        Lọc
                    </button>
                    <a
                        href="{{ route('admin.assistant-queries.index') }}"
                        class="rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                    >
                        Xóa lọc
                    </a>
                </div>
            </form>

            <div class="overflow-hidden rounded-lg bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-5 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Câu hỏi</th>
                                <th class="px-5 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Kết quả gần nhất</th>
                                <th class="px-5 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">Số kết quả</th>
                                <th class="px-5 py-3 text-center text-xs font-medium uppercase tracking-wider text-gray-500">Phản hồi</th>
                                <th class="px-5 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Thời gian</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($queries as $assistantQuery)
                                <tr>
                                    <td class="max-w-xl px-5 py-4 align-top">
                                        <p class="font-semibold text-gray-900">{{ $assistantQuery->question }}</p>
                                        <span class="mt-2 inline-flex rounded-full px-2 py-1 text-xs font-semibold {{ $assistantQuery->is_resolved ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                                            {{ $assistantQuery->is_resolved ? 'Có kết quả' : 'Chưa tìm thấy' }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 align-top text-sm text-gray-600">
                                        @if ($assistantQuery->matchedProcedure)
                                            <a
                                                href="{{ route('frontend.procedures.show', $assistantQuery->matchedProcedure->slug) }}"
                                                target="_blank"
                                                class="font-semibold text-blue-700 hover:underline"
                                            >
                                                {{ $assistantQuery->matchedProcedure->name }}
                                            </a>
                                        @else
                                            <span class="text-gray-400">Không có</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-center text-sm font-semibold text-gray-700">
                                        {{ $assistantQuery->result_count }}
                                    </td>
                                    <td class="px-5 py-4 text-center text-sm">
                                        @if ($assistantQuery->is_helpful === true)
                                            <span class="rounded-full bg-green-100 px-2 py-1 font-semibold text-green-700">Phù hợp</span>
                                        @elseif ($assistantQuery->is_helpful === false)
                                            <span class="rounded-full bg-red-100 px-2 py-1 font-semibold text-red-700">Chưa phù hợp</span>
                                        @else
                                            <span class="text-gray-400">Chưa đánh giá</span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-5 py-4 text-right text-sm text-gray-500">
                                        {{ $assistantQuery->created_at?->format('d/m/Y H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-sm text-gray-500">
                                        Chưa có câu hỏi nào được ghi nhận.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-5">{{ $queries->links() }}</div>
        </div>
    </div>
</x-app-layout>
