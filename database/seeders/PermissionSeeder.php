<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'users' => ['view', 'create', 'edit', 'delete', 'assign'],
            'roles' => ['view', 'create', 'edit', 'delete'],
            'permissions' => ['view', 'create', 'edit', 'delete'],
            'declarations' => ['view', 'create', 'edit', 'delete'],
            'posts' => ['view', 'create', 'edit', 'delete', 'publish'],
        ];
        // Tạo từng quyền
        foreach ($permissions as $module => $actions) {
            $manage = Permission::firstOrCreate(
                ['name' => "manage_{$module}", 'guard_name' => 'web'],
                [
                    'title' => 'Quyền manage' . '_' . "{$module}",
                    'is_default' => true
                ]
            );
            
            // Tạo quyền access cho module
            Permission::firstOrCreate(
                ['name' => "access_{$module}", 'guard_name' => 'web'],
                [
                    'title' => 'Quyền truy cập ' . "{$module}",
                    'is_default' => true
                ]
            );
            
            foreach ($actions as $action) {
                Permission::firstOrCreate(
                    ['name' => "{$action}_{$module}", 'guard_name' => 'web'],
                    [
                        'title' => 'Quyền ' . "{$action}" . '_' . "{$module}",
                        'parent_id' => $manage->id,
                        'is_default' => true
                    ]
                );
            }
        }
        echo "Đã tạo các quyền thành công!\n";
    }
}
