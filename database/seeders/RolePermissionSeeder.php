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
            ['name' => 'Quan ly van ban', 'code' => 'documents.manage', 'module' => 'documents'],
            ['name' => 'Quan ly nguoi dung', 'code' => 'users.manage', 'module' => 'users'],
            ['name' => 'Quan ly vai tro', 'code' => 'roles.manage', 'module' => 'roles'],
        ])->map(fn (array $permission) => Permission::updateOrCreate(
            ['code' => $permission['code']],
            $permission
        ));

        $superAdmin = Role::updateOrCreate(
            ['code' => 'super-admin'],
            ['name' => 'Super Admin', 'description' => 'Toan quyen he thong', 'is_active' => true]
        );

        $admin = Role::updateOrCreate(
            ['code' => 'admin'],
            ['name' => 'Admin', 'description' => 'Quan tri noi dung va nguoi dung', 'is_active' => true]
        );

        $superAdmin->permissions()->sync($permissions->pluck('id'));
        $admin->permissions()->sync($permissions->pluck('id'));
    }
}
