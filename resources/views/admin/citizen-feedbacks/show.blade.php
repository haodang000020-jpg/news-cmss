<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ $feedback->tracking_code }}</h2>
                <p class="mt-1 text-sm text-gray-500">{{ $feedback->subject }}</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a
                    href="{{ route('frontend.feedbacks.show', $feedback->public_id) }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="rounded-md bg-white px-4 py-2 text-sm font-semibold text-blue-700 ring-1 ring-inset ring-blue-200 hover:bg-blue-50"
                >
                    Xem trang người dân
                </a>
                <a href="{{ route('admin.citizen-feedbacks.index') }}" class="rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    Quay lại danh sách
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 rounded-md bg-green-50 p-4 text-sm font-medium text-green-700">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="mb-4 rounded-md bg-red-50 p-4 text-sm font-medium text-red-700">
                    <ul class="list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid gap-5 lg:grid-cols-3">
                <div class="space-y-5 lg:col-span-2">
                    <section class="rounded-lg bg-white p-6 shadow-sm">
                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <div class="text-xs font-semibold uppercase tracking-wide text-gray-500">Người gửi</div>
                                <div class="mt-1 font-semibold text-gray-900">{{ $feedback->full_name }}</div>
                            </div>
                            <div>
                                <div class="text-xs font-semibold uppercase tracking-wide text-gray-500">Liên hệ</div>
                                <div class="mt-1 text-sm text-gray-800">{{ $feedback->phone }}</div>
                                @if ($feedback->email)
                                    <div class="mt-1 text-sm text-gray-600">{{ $feedback->email }}</div>
                                @endif
                            </div>
                            <div>
                                <div class="text-xs font-semibold uppercase tracking-wide text-gray-500">Lĩnh vực</div>
                                <div class="mt-1 text-sm text-gray-800">{{ $feedback->category?->name }}</div>
                            </div>
                            <div>
                                <div class="text-xs font-semibold uppercase tracking-wide text-gray-500">Ngày gửi</div>
                                <div class="mt-1 text-sm text-gray-800">{{ $feedback->created_at?->format('d/m/Y H:i') }}</div>
                            </div>
                            @if ($feedback->address)
                                <div>
                                    <div class="text-xs font-semibold uppercase tracking-wide text-gray-500">Địa chỉ liên hệ</div>
                                    <div class="mt-1 text-sm text-gray-800">{{ $feedback->address }}</div>
                                </div>
                            @endif
                            @if ($feedback->location)
                                <div>
                                    <div class="text-xs font-semibold uppercase tracking-wide text-gray-500">Địa điểm sự việc</div>
                                    <div class="mt-1 text-sm text-gray-800">{{ $feedback->location }}</div>
                                </div>
                            @endif
                        </div>

                        <div class="mt-5 border-t border-gray-100 pt-5">
                            <div class="text-xs font-semibold uppercase tracking-wide text-gray-500">Nội dung phản ánh</div>
                            <div class="mt-2 whitespace-pre-line rounded-md bg-gray-50 p-4 text-sm leading-7 text-gray-800">{{ $feedback->content }}</div>
                        </div>

                        @if ($feedback->attachments->isNotEmpty())
                            <div class="mt-5 border-t border-gray-100 pt-5">
                                <div class="text-xs font-semibold uppercase tracking-wide text-gray-500">Tệp đính kèm</div>
                                <div class="mt-3 grid gap-2 sm:grid-cols-2">
                                    @foreach ($feedback->attachments as $attachment)
                                        <a
                                            href="{{ route('admin.citizen-feedbacks.attachments.download', [$feedback, $attachment]) }}"
                                            class="flex items-center justify-between gap-3 rounded-md border border-gray-200 p-3 text-sm font-semibold text-blue-700 hover:bg-blue-50"
                                        >
                                            <span class="truncate">{{ $attachment->original_name }}</span>
                                            <small class="whitespace-nowrap text-gray-500">{{ $attachment->humanSize() }}</small>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </section>

                    <section class="rounded-lg bg-white p-6 shadow-sm">
                        <h3 class="text-base font-semibold text-gray-900">Lịch sử xử lý</h3>
                        <div class="mt-4 space-y-4">
                            @forelse ($feedback->histories as $history)
                                <div class="rounded-md border border-gray-200 p-4">
                                    <div class="flex flex-wrap items-center justify-between gap-2">
                                        <div class="font-semibold text-gray-900">
                                            {{ $history->fromStatusLabel() ? $history->fromStatusLabel().' → ' : '' }}{{ $history->toStatusLabel() }}
                                        </div>
                                        <div class="text-xs text-gray-500">{{ $history->created_at?->format('d/m/Y H:i') }}</div>
                                    </div>
                                    <div class="mt-1 text-xs text-gray-500">Cập nhật bởi: {{ $history->changedBy?->name ?? 'Hệ thống' }}</div>
                                    @if ($history->public_note)
                                        <div class="mt-3 rounded-md bg-blue-50 p-3 text-sm text-blue-800">
                                            <strong>Ghi chú công khai:</strong> {{ $history->public_note }}
                                        </div>
                                    @endif
                                    @if ($history->internal_note)
                                        <div class="mt-2 rounded-md bg-amber-50 p-3 text-sm text-amber-800">
                                            <strong>Ghi chú nội bộ:</strong> {{ $history->internal_note }}
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="text-sm text-gray-500">Chưa có lịch sử xử lý.</div>
                            @endforelse
                        </div>
                    </section>
                </div>

                <aside class="space-y-5">
                    <section class="rounded-lg bg-white p-6 shadow-sm">
                        <h3 class="text-base font-semibold text-gray-900">Cập nhật xử lý</h3>
                        <form method="POST" action="{{ route('admin.citizen-feedbacks.update', $feedback) }}" class="mt-4 space-y-4">
                            @csrf
                            @method('PATCH')

                            <div>
                                <label for="status" class="mb-1 block text-sm font-semibold text-gray-700">Trạng thái</label>
                                <select id="status" name="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    @foreach ($statuses as $value => $label)
                                        <option value="{{ $value }}" @selected(old('status', $feedback->status) === $value)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="assigned_to" class="mb-1 block text-sm font-semibold text-gray-700">Cán bộ phụ trách</label>
                                <select id="assigned_to" name="assigned_to" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Chưa phân công</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" @selected((string) old('assigned_to', $feedback->assigned_to) === (string) $user->id)>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="admin_response" class="mb-1 block text-sm font-semibold text-gray-700">Phản hồi cho người dân</label>
                                <textarea id="admin_response" name="admin_response" rows="6" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('admin_response', $feedback->admin_response) }}</textarea>
                            </div>

                            <div>
                                <label for="status_public_note" class="mb-1 block text-sm font-semibold text-gray-700">Ghi chú công khai của lần cập nhật</label>
                                <textarea id="status_public_note" name="status_public_note" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('status_public_note') }}</textarea>
                            </div>

                            <div>
                                <label for="internal_note" class="mb-1 block text-sm font-semibold text-gray-700">Ghi chú nội bộ hiện tại</label>
                                <textarea id="internal_note" name="internal_note" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('internal_note', $feedback->internal_note) }}</textarea>
                            </div>

                            <div>
                                <label for="status_internal_note" class="mb-1 block text-sm font-semibold text-gray-700">Ghi chú nội bộ của lần cập nhật</label>
                                <textarea id="status_internal_note" name="status_internal_note" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('status_internal_note') }}</textarea>
                            </div>

                            <button type="submit" class="w-full rounded-md bg-blue-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-blue-800">
                                Lưu cập nhật
                            </button>
                        </form>
                    </section>

                    <section class="rounded-lg bg-white p-6 shadow-sm">
                        <h3 class="text-base font-semibold text-gray-900">Thông tin xử lý</h3>
                        <dl class="mt-4 space-y-3 text-sm">
                            <div>
                                <dt class="text-gray-500">Tiếp nhận lúc</dt>
                                <dd class="font-medium text-gray-800">{{ $feedback->received_at?->format('d/m/Y H:i') ?? 'Chưa tiếp nhận' }}</dd>
                            </div>
                            <div>
                                <dt class="text-gray-500">Phản hồi lúc</dt>
                                <dd class="font-medium text-gray-800">{{ $feedback->responded_at?->format('d/m/Y H:i') ?? 'Chưa phản hồi' }}</dd>
                            </div>
                            <div>
                                <dt class="text-gray-500">Đóng hồ sơ lúc</dt>
                                <dd class="font-medium text-gray-800">{{ $feedback->closed_at?->format('d/m/Y H:i') ?? 'Chưa đóng' }}</dd>
                            </div>
                            <div>
                                <dt class="text-gray-500">Người cập nhật gần nhất</dt>
                                <dd class="font-medium text-gray-800">{{ $feedback->processedBy?->name ?? 'Chưa có' }}</dd>
                            </div>
                            <div>
                                <dt class="text-gray-500">Đánh giá</dt>
                                <dd class="font-medium text-gray-800">
                                    {{ $feedback->satisfaction_rating ? $feedback->satisfaction_rating.'/5' : 'Chưa đánh giá' }}
                                </dd>
                            </div>
                        </dl>
                    </section>
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>
