@csrf

<div class="grid gap-6">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Tiêu đề</label>
        <input id="title" name="title" type="text" value="{{ old('title', $article->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
        @error('title')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
        <input id="slug" name="slug" type="text" value="{{ old('slug', $article->slug) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('slug')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="category_id" class="block text-sm font-medium text-gray-700">Chuyên mục</label>
        <select id="category_id" name="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            <option value="">Chọn chuyên mục</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected((string) old('category_id', $article->category_id) === (string) $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="summary" class="block text-sm font-medium text-gray-700">Tóm tắt</label>
        <textarea id="summary" name="summary" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('summary', $article->summary) }}</textarea>
        @error('summary')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="content" class="block text-sm font-medium text-gray-700">Nội dung</label>
        <textarea id="content" name="content" rows="10" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('content', $article->content) }}</textarea>
        @error('content')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="thumbnail" class="block text-sm font-medium text-gray-700">Ảnh đại diện</label>
        <input id="thumbnail" name="thumbnail" type="file" accept=".jpg,.jpeg,.png,.webp" class="mt-1 block w-full text-sm text-gray-700">
        @if ($article->thumbnail)
            <img src="{{ asset('storage/'.$article->thumbnail) }}" alt="{{ $article->title }}" class="mt-3 h-24 w-36 rounded-md object-cover">
        @endif
        @error('thumbnail')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-6 sm:grid-cols-2">
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Trạng thái</label>
            <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                <option value="draft" @selected(old('status', $article->status) === 'draft')>Nháp</option>
                <option value="published" @selected(old('status', $article->status) === 'published')>Xuất bản</option>
            </select>
            @error('status')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <input type="hidden" name="is_featured" value="0">
            <label class="mt-7 inline-flex items-center gap-2 text-sm font-medium text-gray-700">
                <input name="is_featured" type="checkbox" value="1" @checked(old('is_featured', $article->is_featured)) class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                Tin nổi bật
            </label>
            @error('is_featured')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label for="meta_title" class="block text-sm font-medium text-gray-700">Meta title</label>
        <input id="meta_title" name="meta_title" type="text" value="{{ old('meta_title', $article->meta_title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('meta_title')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="meta_description" class="block text-sm font-medium text-gray-700">Meta description</label>
        <textarea id="meta_description" name="meta_description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('meta_description', $article->meta_description) }}</textarea>
        @error('meta_description')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="inline-flex items-center rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
        {{ $submitLabel }}
    </button>
    <a href="{{ route('admin.articles.index') }}" class="rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
        Hủy
    </a>
</div>
