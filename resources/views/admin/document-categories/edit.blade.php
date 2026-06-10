<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Sua loai van ban
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-lg bg-white p-6 shadow-sm">
                <form method="POST" action="{{ route('admin.document-categories.update', $documentCategory) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Ten loai van ban</label>
                            <input id="name" name="name" type="text" value="{{ old('name', $documentCategory->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                            <input id="slug" name="slug" type="text" value="{{ old('slug', $documentCategory->slug) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('slug')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Mo ta</label>
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $documentCategory->description) }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="sort_order" class="block text-sm font-medium text-gray-700">Thu tu sap xep</label>
                            <input id="sort_order" name="sort_order" type="number" value="{{ old('sort_order', $documentCategory->sort_order) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('sort_order')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <input type="hidden" name="is_active" value="0">
                            <label class="inline-flex items-center gap-2 text-sm font-medium text-gray-700">
                                <input name="is_active" type="checkbox" value="1" @checked(old('is_active', $documentCategory->is_active)) class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                Dang hoat dong
                            </label>
                            @error('is_active')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex items-center gap-3">
                        <button type="submit" class="inline-flex items-center rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Cap nhat
                        </button>
                        <a href="{{ route('admin.document-categories.index') }}" class="rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            Huy
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
