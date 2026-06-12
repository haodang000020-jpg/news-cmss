<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::query()
            ->with('roles')
            ->when($request->filled('q'), function ($query) use ($request): void {
                $keyword = $request->string('q');

                $query->where(function ($query) use ($keyword): void {
                    $query->where('name', 'like', '%'.$keyword.'%')
                        ->orWhere('email', 'like', '%'.$keyword.'%');
                });
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', [
            'users' => $users,
            'filters' => $request->only(['q']),
        ]);
    }

    public function create(): View
    {
        return view('admin.users.create', [
            'user' => new User(),
            'roles' => $this->rolesForForm(),
        ]);
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->roles()->sync($validated['role_ids']);

        return redirect()
            ->route('admin.users.index')
            ->with('status', 'Đã thêm người dùng.');
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', [
            'user' => $user->load('roles'),
            'roles' => $this->rolesForForm(),
        ]);
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if (! empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);
        $user->roles()->sync($validated['role_ids']);

        return redirect()
            ->route('admin.users.index')
            ->with('status', 'Đã cập nhật người dùng.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Không thể xóa chính tài khoản đang đăng nhập.');
        }

        if ($this->isLastUserWithRole($user, 'admin')) {
            return back()->with('error', 'Không thể xóa tài khoản admin cuối cùng.');
        }

        if ($this->isLastUserWithRole($user, 'super-admin')) {
            return back()->with('error', 'Không thể xóa tài khoản super-admin cuối cùng.');
        }

        $user->roles()->detach();
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('status', 'Đã xóa người dùng.');
    }

    private function rolesForForm()
    {
        return Role::query()
            ->when(Schema::hasColumn('roles', 'is_active'), fn ($query) => $query->where('is_active', true))
            ->orderBy('name')
            ->get();
    }

    private function isLastUserWithRole(User $user, string $roleCode): bool
    {
        if (! $user->hasRole($roleCode)) {
            return false;
        }

        return User::query()
            ->whereHas('roles', fn ($query) => $query->where('code', $roleCode))
            ->count() <= 1;
    }
}
