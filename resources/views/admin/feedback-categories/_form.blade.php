@csrf

<div class="grid gap-5 md:grid-cols-2">
    <div>
        <label for="name" class="mb-1 block text-sm font-semibold text-gray-700">Tên lĩnh vực</label>
        <input
            id="name"
            name="name"
            type="text"
            value="{{ old('name', $feedbackCategory->name) }}"
            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            required
        >
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="slug" class="mb-1 block text-sm font-semibold text-gray-700">Slug</label>
        <input
            id="slug"
            name="slug"
            type="text"
            value="{{ old('slug', $feedbackCategory->slug) }}"
            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            placeholder="Tự tạo nếu để trống"
        >
        @error('slug')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="description" class="mb-1 block text-sm font-semibold text-gray-700">Mô tả</label>
        <textarea
            id="description"
            name="description"
            rows="4"
            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >{{ old('description', $feedbackCategory->description) }}</textarea>
        @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="sort_order" class="mb-1 block text-sm font-semibold text-gray-700">Thứ tự</label>
        <input
            id="sort_order"
            name="sort_order"
            type="number"
            min="0"
            value="{{ old('sort_order', $feedbackCategory->sort_order ?? 0) }}"
            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >
        @error('sort_order')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center pt-7">
        <label class="inline-flex items-center gap-2 text-sm font-semibold text-gray-700">
            <input
                type="checkbox"
                name="is_active"
                value="1"
                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                @checked(old('is_active', $feedbackCategory->is_active ?? true))
            >
            Đang hoạt động
        </label>
    </div>
</div>

<div class="mt-6 flex flex-wrap gap-3">
    <button
        type="submit"
        class="rounded-md bg-blue-700 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-800"
    >
        {{ $buttonLabel }}
    </button>
    <a
        href="{{ route('admin.feedback-categories.index') }}"
        class="rounded-md bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
    >
        Quay lại
    </a>
</div>
