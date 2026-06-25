<div class="grid gap-6">
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Tên lĩnh vực</label>
        <input id="name" name="name" type="text" value="{{ old('name', $procedureGroup->name) }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            required>
        @error('name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
        <input id="slug" name="slug" type="text" value="{{ old('slug', $procedureGroup->slug) }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            placeholder="Tự tạo từ tên nếu để trống">
        @error('slug')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
        <textarea id="description" name="description" rows="4"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $procedureGroup->description) }}</textarea>
        @error('description')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label for="sort_order" class="block text-sm font-medium text-gray-700">Thứ tự hiển thị</label>
            <input id="sort_order" name="sort_order" type="number" min="0"
                value="{{ old('sort_order', $procedureGroup->sort_order) }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                required>
            @error('sort_order')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-end pb-2">
            <input type="hidden" name="is_active" value="0">
            <label class="inline-flex items-center gap-2 text-sm font-medium text-gray-700">
                <input name="is_active" type="checkbox" value="1"
                    @checked(old('is_active', $procedureGroup->is_active))
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                Đang hoạt động
            </label>
        </div>
    </div>
</div>

<div class="mt-6 flex items-center gap-3">
    <button type="submit"
        class="inline-flex items-center rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-800">
        {{ $buttonLabel }}
    </button>
    <a href="{{ route('admin.procedure-groups.index') }}"
        class="rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
        Hủy
    </a>
</div>
