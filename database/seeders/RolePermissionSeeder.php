<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = collect([
            ['name' => 'Xem dashboard', 'code' => 'dashboard.view', 'module' => 'dashboard'],
            ['name' => 'Quan ly chuyen muc', 'code' => 'categories.manage', 'module' => 'categories'],
            ['name' => 'Quan ly bai viet', 'code' => 'articles.manage', 'module' => 'articles'],
            ['name' => 'Quan ly banner', 'code' => 'banners.manage', 'module' => 'banners'],
            ['name' => 'Quan ly menu', 'code' => 'menus.manage', 'module' => 'menus'],
            ['name' => 'Quan ly van ban', 'code' => 'documents.manage', 'module' => 'documents'],
            ['name' => 'Quan ly trang tinh', 'code' => 'pages.manage', 'module' => 'pages'],
            ['name' => 'Quan ly lich lam viec', 'code' => 'work-schedules.manage', 'module' => 'work-schedules'],
            ['name' => 'Quan ly nguoi dung', 'code' => 'users.manage', 'module' => 'users'],
            ['name' => 'Quan ly vai tro', 'code' => 'roles.manage', 'module' => 'roles'],
            ['name' => 'Quan ly quyen', 'code' => 'permissions.manage', 'module' => 'permissions'],
            ['name' => 'Quan ly lien ket truong hoc', 'code' => 'school-links.manage', 'module' => 'school-links'],
        ])->map(fn (array $permission) => Permission::updateOrCreate(
            ['code' => $permission['code']],
            $permission
        ));

        $superAdmin = Role::query()
            ->where('code', 'super-admin')
            ->first();

        $admin = Role::updateOrCreate(
            ['code' => 'admin'],
            ['name' => 'Admin', 'description' => 'Quan tri noi dung va nguoi dung', 'is_active' => true]
        );

        $superAdmin?->permissions()->sync($permissions->pluck('id'));
        $admin->permissions()->sync($permissions->pluck('id'));
    }
}
