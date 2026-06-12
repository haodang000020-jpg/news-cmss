<div class="grid gap-6">
    <div class="grid gap-3 md:grid-cols-2">
        <div>
            <label for="day_of_week" class="block text-sm font-medium text-gray-700">Thứ/ngày</label>
            <select id="day_of_week" name="day_of_week" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Khác</option>
                @foreach ([1 => 'Thứ Hai', 2 => 'Thứ Ba', 3 => 'Thứ Tư', 4 => 'Thứ Năm', 5 => 'Thứ Sáu', 6 => 'Thứ Bảy', 7 => 'Chủ Nhật'] as $value => $label)
                    <option value="{{ $value }}" @selected((string) old('day_of_week', $workSchedule->day_of_week) === (string) $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('day_of_week')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Tiêu đề</label>
            <input id="title" name="title" type="text" value="{{ old('title', $workSchedule->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('title')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid gap-3 md:grid-cols-2">
        <div>
            <label for="morning_time" class="block text-sm font-medium text-gray-700">Buổi sáng</label>
            <input id="morning_time" name="morning_time" type="text" value="{{ old('morning_time', $workSchedule->morning_time) }}" placeholder="07:00 - 11:00" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('morning_time')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="afternoon_time" class="block text-sm font-medium text-gray-700">Buổi chiều</label>
            <input id="afternoon_time" name="afternoon_time" type="text" value="{{ old('afternoon_time', $workSchedule->afternoon_time) }}" placeholder="13:00 - 17:00" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('afternoon_time')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label for="note" class="block text-sm font-medium text-gray-700">Ghi chú</label>
        <textarea id="note" name="note" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('note', $workSchedule->note) }}</textarea>
        @error('note')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-3 md:grid-cols-3">
        <div>
            <label for="sort_order" class="block text-sm font-medium text-gray-700">Thứ tự</label>
            <input id="sort_order" name="sort_order" type="number" value="{{ old('sort_order', $workSchedule->sort_order) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('sort_order')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <input type="hidden" name="is_working_day" value="0">
            <label class="mt-7 inline-flex items-center gap-2 text-sm font-medium text-gray-700">
                <input name="is_working_day" type="checkbox" value="1" @checked(old('is_working_day', $workSchedule->is_working_day)) class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                Ngày làm việc
            </label>
            @error('is_working_day')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <input type="hidden" name="is_active" value="0">
            <label class="mt-7 inline-flex items-center gap-2 text-sm font-medium text-gray-700">
                <input name="is_active" type="checkbox" value="1" @checked(old('is_active', $workSchedule->is_active)) class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                Đang hoạt động
            </label>
            @error('is_active')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="inline-flex items-center rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
        {{ $buttonLabel }}
    </button>
    <a href="{{ route('admin.work-schedules.index') }}" class="rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
        Hủy
    </a>
</div>
