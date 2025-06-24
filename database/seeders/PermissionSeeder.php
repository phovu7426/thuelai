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
        ];
        // Tạo từng quyền
        foreach ($permissions as $module => $actions) {
            $manage = Permission::create([
                'title' => 'Quyền manage' . '_' . "{$module}",
                'name' => "manage_{$module}",
                'guard_name' => 'web',
                'is_default' => true
            ]);
            foreach ($actions as $action) {
                Permission::create([
                    'title' => 'Quyền ' . "{$action}" . '_' . "{$module}",
                    'name' => "{$action}" . '_' . "{$module}",
                    'guard_name' => 'web',
                    'parent_id' => $manage->id,
                    'is_default' => true
                ]);
            }
        }
        echo "Đã tạo các quyền thành công!\n";
    }
}
