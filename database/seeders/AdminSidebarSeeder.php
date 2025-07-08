<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminSidebarSeeder extends Seeder
{
    public function run()
    {
        // 1. Tạo tài khoản admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
                'status' => 'active',
            ]
        );

        // 2. Tạo vai trò admin
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'title' => 'Quản trị viên',
            'guard_name' => 'web',
        ]);

        // 3. Danh sách quyền tương ứng menu sidebar
        $sidebarPermissions = [
            // key => [tên hiển thị, route]
            'dashboard' => 'Tổng quan',
            'users' => 'Quản lý tài khoản',
            'roles' => 'Quản lý vai trò',
            'permissions' => 'Quản lý quyền',
            'slides' => 'Quản lý slide',
            'stone.categories' => 'Danh mục đá',
            'stone.materials' => 'Chất liệu đá',
            'stone.surfaces' => 'Bề mặt đá',
            'stone.applications' => 'Ứng dụng đá',
            'stone.products' => 'Sản phẩm đá',
            'stone.projects' => 'Dự án đá',
            'stone.showrooms' => 'Showroom',
            'stone.videos' => 'Video',
            'stone.orders' => 'Đơn hàng',
            'stone.contacts' => 'Liên hệ',
            'contact-info' => 'Cấu hình hệ thống',
            'stone.inventory' => 'Quản lý kho hàng',
        ];

        $permissionIds = [];
        foreach ($sidebarPermissions as $key => $title) {
            $permission = Permission::firstOrCreate(
                [
                    'name' => 'access_' . $key,
                    'guard_name' => 'web',
                ],
                [
                    'title' => 'Truy cập ' . $title,
                    'is_default' => true,
                    'status' => 1,
                ]
            );
            $permissionIds[] = $permission->id;
        }

        // 4. Gán các quyền cho vai trò admin
        $adminRole->syncPermissions(Permission::whereIn('id', $permissionIds)->pluck('name')->toArray());

        // 5. Gán vai trò admin cho tài khoản admin
        $admin->assignRole($adminRole);
    }
} 