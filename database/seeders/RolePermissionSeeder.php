<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Xóa cache trước khi tạo dữ liệu mới
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Nhóm quyền theo module
        $permissions = [
            'users' => ['manage', 'view', 'create', 'edit', 'delete', 'assign'],
            'roles' => ['manage', 'view', 'create', 'edit', 'delete'],
            'permissions' => ['manage', 'view', 'create', 'edit', 'delete'],
        ];

        // Tạo từng quyền
        $this->call(PermissionSeeder::class);
//        foreach ($permissions as $module => $actions) {
//            foreach ($actions as $action) {
//                Permission::firstOrCreate([
//                    'title' => 'Quyền ' . "{$action}" . '_' . "{$module}",
//                    'name' => "{$action}" . '_' . "{$module}",
//                    'guard_name' => 'web'
//                ]);
//            }
//        }

        // Tạo role "admin" và gán tất cả quyền
        $adminRole = Role::firstOrCreate([
            'title' => 'Vai trò admin',
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
        $adminRole->syncPermissions(Permission::pluck('name')->toArray());

        // Tạo role "manager" và chỉ gán quyền quản lý tài khoản, sách
        $managerRole = Role::firstOrCreate([
            'title' => 'Vai trò quản lý',
            'name' => 'manager',
            'guard_name' => 'web'
        ]);
        $managerRole->givePermissionTo([
            'view_users', 'create_users', 'edit_users'
        ]);

        // Tạo role "user" và chỉ có quyền xem
        $userRole = Role::firstOrCreate([
            'title' => 'Vai trò người dùng',
            'name' => 'user',
            'guard_name' => 'web'
        ]);
        foreach ($permissions as $module => $actions) {
            $userRole->givePermissionTo("view_{$module}");
        }
    }
}
