<div class="grid gap-6">
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Tên</label>
        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
        @error('name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
        @error('email')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-3 md:grid-cols-2">
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Mật khẩu</label>
            <input id="password" name="password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" @required(! $user->exists)>
            @if ($user->exists)
                <p class="mt-2 text-sm text-gray-500">Để trống nếu không muốn đổi mật khẩu.</p>
            @endif
            @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Xác nhận mật khẩu</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" @required(! $user->exists)>
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Vai trò</label>
        @php
            $selectedRoleIds = collect(old('role_ids', $user->roles->pluck('id')->all()))->map(fn ($id) => (string) $id)->all();
        @endphp
        <div class="mt-2 grid gap-2 md:grid-cols-2">
            @foreach ($roles as $role)
                <label class="flex items-center gap-2 rounded-md border border-gray-200 p-3 text-sm text-gray-700">
                    <input name="role_ids[]" type="checkbox" value="{{ $role->id }}" @checked(in_array((string) $role->id, $selectedRoleIds, true)) class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span>{{ $role->name }}</span>
                </label>
            @endforeach
        </div>
        @error('role_ids')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
        @error('role_ids.*')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="inline-flex items-center rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-800">
        {{ $buttonLabel }}
    </button>
    <a href="{{ route('admin.users.index') }}" class="rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
        Hủy
    </a>
</div>
