<div class="grid gap-6">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Tiêu đề</label>
        <input id="title" name="title" type="text" value="{{ old('title', $document->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
        @error('title')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label for="document_category_id" class="block text-sm font-medium text-gray-700">Loại văn bản</label>
            <select id="document_category_id" name="document_category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                <option value="">Chọn loại văn bản</option>
                @foreach ($documentCategories as $documentCategory)
                    <option value="{{ $documentCategory->id }}" @selected((string) old('document_category_id', $document->document_category_id) === (string) $documentCategory->id)>
                        {{ $documentCategory->name }}
                    </option>
                @endforeach
            </select>
            @error('document_category_id')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
            <input id="slug" name="slug" type="text" value="{{ old('slug', $document->slug) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('slug')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label for="code" class="block text-sm font-medium text-gray-700">Số ký hiệu</label>
            <input id="code" name="code" type="text" value="{{ old('code', $document->code) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('code')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="issuer" class="block text-sm font-medium text-gray-700">Cơ quan ban hành</label>
            <input id="issuer" name="issuer" type="text" value="{{ old('issuer', $document->issuer) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('issuer')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label for="issued_at" class="block text-sm font-medium text-gray-700">Ngày ban hành</label>
            <input id="issued_at" name="issued_at" type="date" value="{{ old('issued_at', optional($document->issued_at)->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('issued_at')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="effective_at" class="block text-sm font-medium text-gray-700">Ngày hiệu lực</label>
            <input id="effective_at" name="effective_at" type="date" value="{{ old('effective_at', optional($document->effective_at)->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('effective_at')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label for="summary" class="block text-sm font-medium text-gray-700">Tóm tắt</label>
        <textarea id="summary" name="summary" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('summary', $document->summary) }}</textarea>
        @error('summary')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="file" class="block text-sm font-medium text-gray-700">Tệp đính kèm</label>
        <input id="file" name="file" type="file" accept=".pdf,.doc,.docx,.xls,.xlsx" class="mt-1 block w-full text-sm text-gray-700 file:mr-4 file:rounded-md file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100">
        @if ($document->file_name)
            <p class="mt-2 text-sm text-gray-500">Tệp hiện tại: {{ $document->file_name }}</p>
        @endif
        @error('file')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-3 md:grid-cols-2">
        <div>
            <input type="hidden" name="is_featured" value="0">
            <label class="inline-flex items-center gap-2 text-sm font-medium text-gray-700">
                <input name="is_featured" type="checkbox" value="1" @checked(old('is_featured', $document->is_featured)) class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                Văn bản nổi bật
            </label>
            @error('is_featured')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <input type="hidden" name="is_active" value="0">
            <label class="inline-flex items-center gap-2 text-sm font-medium text-gray-700">
                <input name="is_active" type="checkbox" value="1" @checked(old('is_active', $document->is_active)) class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
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
    <a href="{{ route('admin.documents.index') }}" class="rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
        Hủy
    </a>
</div>
