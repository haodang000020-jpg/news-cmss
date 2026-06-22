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
    <option
        value="{{ $category->id }}"
        @selected(
            (string) old(
                'category_id',
                $article->category_id ?? ''
            ) === (string) $category->id
        )
    >
        {{ $category->name }}

        @if (! $category->is_active)
            — Ẩn khỏi menu
        @endif
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
      <textarea
    id="content-editor"
    name="content"
    class="form-control @error('content') is-invalid @enderror"
    rows="10"
>{{ old('content', $article->content ?? '') }}</textarea>

@error('content')
    <div class="invalid-feedback">{{ $message }}</div>
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

@once
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

    <style>
        .note-editor.note-frame {
            border: 1px solid #d1d5db;
            border-radius: 6px;
            overflow: hidden;
            background: #fff;
        }

        .note-editor .note-toolbar {
            display: flex !important;
            flex-wrap: wrap;
            align-items: center;
            gap: 4px;
            padding: 8px;
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
        }

        .note-editor .note-btn-group {
            display: inline-flex !important;
            margin: 0 4px 4px 0;
        }

        .note-editor .note-btn {
            border: 1px solid #d1d5db;
            background: #fff;
            color: #111827;
            padding: 5px 9px;
            font-size: 13px;
            border-radius: 4px;
        }

        .note-editor .note-btn:hover {
            background: #eef2f7;
        }

        .note-editor .note-dropdown-menu,
        .note-editor .dropdown-menu {
            display: none;
            position: absolute;
            z-index: 9999;
        }

        .note-editor .note-dropdown-menu.show,
        .note-editor .dropdown-menu.show {
            display: block;
        }

        .note-editor .note-editing-area {
            background: #fff;
        }

        .note-editor .note-editable {
            min-height: 420px;
            background: #fff;
            color: #111827;
            font-size: 15px;
            line-height: 1.7;
            padding: 16px;
        }

        .note-editor .note-statusbar {
            background: #f8fafc;
        }

        .note-modal {
            z-index: 10000;
        }

        .note-modal-backdrop {
            z-index: 9998;
        }

        .note-editor img {
            max-width: 100%;
            height: auto;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (!window.jQuery || !$.fn.summernote) {
                console.error('Summernote chưa được load.');
                return;
            }

            const editor = $('#content-editor');

            if (!editor.length) {
                return;
            }

            editor.summernote({
                height: 420,
                placeholder: 'Nhập nội dung bài viết...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                callbacks: {
                    onImageUpload: function (files) {
                        for (let i = 0; i < files.length; i++) {
                            uploadSummernoteImage(files[i]);
                        }
                    }
                }
            });

            function uploadSummernoteImage(file) {
                let formData = new FormData();
                formData.append('image', file);

                $.ajax({
                    url: "{{ route('admin.articles.upload-image') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    success: function (response) {
                        editor.summernote('insertImage', response.url);
                    },
                    error: function () {
                        alert('Upload ảnh thất bại. Vui lòng kiểm tra định dạng hoặc dung lượng ảnh.');
                    }
                });
            }
        });
    </script>
@endonce
