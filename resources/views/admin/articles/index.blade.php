<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Bài viết
            </h2>
            <a href="{{ route('admin.articles.create') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                Thêm bài viết
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 rounded-md bg-green-50 p-4 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            <form method="GET" action="{{ route('admin.articles.index') }}" class="mb-4 grid gap-3 rounded-lg bg-white p-4 shadow-sm md:grid-cols-4">
                <input name="search" type="text" value="{{ $filters['search'] ?? '' }}" placeholder="Tìm theo tiêu đề" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                <select name="category_id" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Tất cả chuyên mục</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected((string) ($filters['category_id'] ?? '') === (string) $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <select name="status" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Tất cả trạng thái</option>
                    <option value="draft" @selected(($filters['status'] ?? '') === 'draft')>Nháp</option>
                    <option value="published" @selected(($filters['status'] ?? '') === 'published')>Xuất bản</option>
                </select>

                <div class="flex gap-2">
                    <button type="submit" class="rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-800">
                        Lọc
                    </button>
                    <a href="{{ route('admin.articles.index') }}" class="rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        Xóa lọc
                    </a>
                </div>
            </form>

            <div class="overflow-hidden rounded-lg bg-white shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Tiêu đề</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Chuyên mục</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Trạng thái</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Nổi bật</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Người viết</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse ($articles as $article)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ $article->title }}
                                    <div class="mt-1 text-xs text-gray-500">{{ $article->slug }}</div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $article->category?->name }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm">
                                    <span class="rounded-full px-2 py-1 text-xs font-medium {{ $article->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                        {{ $article->status === 'published' ? 'Xuất bản' : 'Nháp' }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                    {{ $article->is_featured ? 'Có' : 'Không' }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">{{ $article->user?->name }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.articles.edit', $article) }}" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-indigo-700 shadow-sm ring-1 ring-inset ring-indigo-200 hover:bg-indigo-50">
                                            Sửa
                                        </a>

                                        <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" onsubmit="return confirm('Xóa bài viết này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-red-700 shadow-sm ring-1 ring-inset ring-red-200 hover:bg-red-50">
                                                Xóa
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">
                                    Chưa có bài viết.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
