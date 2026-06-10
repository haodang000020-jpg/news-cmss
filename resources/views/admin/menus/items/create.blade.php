<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Them menu item</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-lg bg-white p-6 shadow-sm">
                <form method="POST" action="{{ route('admin.menus.items.store', $menu) }}">
                    @csrf

                    <div class="grid gap-6">
                        <div>
                            <label for="parent_id" class="block text-sm font-medium text-gray-700">Menu cha</label>
                            <select id="parent_id" name="parent_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Khong co</option>
                                @foreach ($parentOptions as $row)
                                    <option value="{{ $row['item']->id }}" @selected((string) old('parent_id', $item->parent_id) === (string) $row['item']->id)>{{ $row['label'] }}</option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Tieu de</label>
                            <input id="title" name="title" type="text" value="{{ old('title', $item->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
                            <input id="url" name="url" type="text" value="{{ old('url', $item->url) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('url')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="route_name" class="block text-sm font-medium text-gray-700">Route name</label>
                            <input id="route_name" name="route_name" type="text" value="{{ old('route_name', $item->route_name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('route_name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="route_params" class="block text-sm font-medium text-gray-700">Route params JSON</label>
                            <textarea id="route_params" name="route_params" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('route_params', $item->route_params ? json_encode($item->route_params) : '') }}</textarea>
                            @error('route_params')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid gap-6 sm:grid-cols-2">
                            <div>
                                <label for="target" class="block text-sm font-medium text-gray-700">Target</label>
                                <select id="target" name="target" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    <option value="_self" @selected(old('target', $item->target) === '_self')>_self</option>
                                    <option value="_blank" @selected(old('target', $item->target) === '_blank')>_blank</option>
                                </select>
                                @error('target')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="sort_order" class="block text-sm font-medium text-gray-700">Thu tu</label>
                                <input id="sort_order" name="sort_order" type="number" value="{{ old('sort_order', $item->sort_order) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                @error('sort_order')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <input type="hidden" name="is_active" value="0">
                            <label class="inline-flex items-center gap-2 text-sm font-medium text-gray-700">
                                <input name="is_active" type="checkbox" value="1" @checked(old('is_active', $item->is_active)) class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                Dang hoat dong
                            </label>
                            @error('is_active')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex items-center gap-3">
                        <button type="submit" class="inline-flex items-center rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-800">
                            Luu item
                        </button>
                        <a href="{{ route('admin.menus.items.index', $menu) }}" class="rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            Huy
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
