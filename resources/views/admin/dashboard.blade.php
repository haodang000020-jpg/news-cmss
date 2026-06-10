<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard quan tri
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-lg bg-white p-6 shadow-sm">
                    <p class="text-sm font-medium text-gray-500">Bai viet</p>
                    <p class="mt-3 text-3xl font-semibold text-gray-900">{{ number_format($stats['articles']) }}</p>
                </div>

                <div class="rounded-lg bg-white p-6 shadow-sm">
                    <p class="text-sm font-medium text-gray-500">Van ban</p>
                    <p class="mt-3 text-3xl font-semibold text-gray-900">{{ number_format($stats['documents']) }}</p>
                </div>

                <div class="rounded-lg bg-white p-6 shadow-sm">
                    <p class="text-sm font-medium text-gray-500">Luot xem</p>
                    <p class="mt-3 text-3xl font-semibold text-gray-900">{{ number_format($stats['views']) }}</p>
                </div>

                <div class="rounded-lg bg-white p-6 shadow-sm">
                    <p class="text-sm font-medium text-gray-500">Nguoi dung</p>
                    <p class="mt-3 text-3xl font-semibold text-gray-900">{{ number_format($stats['users']) }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

