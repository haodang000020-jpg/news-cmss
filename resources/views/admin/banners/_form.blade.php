@csrf

@php
    $bannerPositions = array_replace($positions, [
        'home_slider' => 'Slider trang chủ',
        'work_schedule_banner' => 'Dưới lịch làm việc',
        'site_header_banner' => 'Banner đầu trang',
    ]);
@endphp

<div class="grid gap-6">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Tiêu đề</label>
        <input id="title" name="title" type="text" value="{{ old('title', $banner->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
        @error('title')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="image" class="block text-sm font-medium text-gray-700">Ảnh banner</label>
        <input id="image" name="image" type="file" accept=".jpg,.jpeg,.png,.webp" class="mt-1 block w-full text-sm text-gray-700" @required(! $banner->exists)>
        @if ($banner->image)
            <img src="{{ asset('storage/'.$banner->image) }}" alt="{{ $banner->title }}" class="mt-3 h-24 w-48 rounded-md object-cover">
        @endif
        @error('image')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="link" class="block text-sm font-medium text-gray-700">Liên kết</label>
        <input id="link" name="link" type="url" value="{{ old('link', $banner->link) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('link')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="position" class="block text-sm font-medium text-gray-700">Vị trí</label>
        <select id="position" name="position" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            @foreach ($bannerPositions as $value => $label)
                <option value="{{ $value }}" @selected(old('position', $banner->position) === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('position')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="sort_order" class="block text-sm font-medium text-gray-700">Thứ tự sắp xếp</label>
        <input id="sort_order" name="sort_order" type="number" value="{{ old('sort_order', $banner->sort_order) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
        @error('sort_order')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-6 sm:grid-cols-2">
        <div>
            <label for="starts_at" class="block text-sm font-medium text-gray-700">Ngày bắt đầu</label>
            <input id="starts_at" name="starts_at" type="datetime-local" value="{{ old('starts_at', $banner->starts_at?->format('Y-m-d\TH:i')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('starts_at')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="ends_at" class="block text-sm font-medium text-gray-700">Ngày kết thúc</label>
            <input id="ends_at" name="ends_at" type="datetime-local" value="{{ old('ends_at', $banner->ends_at?->format('Y-m-d\TH:i')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('ends_at')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <input type="hidden" name="is_active" value="0">
        <label class="inline-flex items-center gap-2 text-sm font-medium text-gray-700">
            <input name="is_active" type="checkbox" value="1" @checked(old('is_active', $banner->is_active)) class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
            Đang hoạt động
        </label>
        @error('is_active')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="inline-flex items-center rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-800">
        {{ $submitLabel }}
    </button>
    <a href="{{ route('admin.banners.index') }}" class="rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
        Hủy
    </a>
</div>
