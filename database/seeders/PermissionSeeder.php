<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Sinh quyền dựa trên route admin.*
        $router = app('router');
        $routes = collect($router->getRoutes())->map(fn($r) => $r->getName())->filter();
        $adminRoutes = $routes->filter(fn($name) => Str::startsWith($name, 'admin.'));

        $moduleToActions = [];
        foreach ($adminRoutes as $routeName) {
            $parts = explode('.', $routeName);
            if (count($parts) < 2) {
                continue;
            }
            $module = $parts[1];
            $action = $parts[count($parts) - 1];
            $moduleToActions[$module][$action] = true;
        }

        // Tạo quyền cho từng module
        foreach ($moduleToActions as $module => $actionsMap) {
            // access_* và manage_* cho module
            Permission::firstOrCreate(
                ['name' => "access_{$module}", 'guard_name' => 'web'],
                ['title' => "Truy cập {$module}", 'is_default' => true, 'status' => 'active']
            );

            $manage = Permission::firstOrCreate(
                ['name' => "manage_{$module}", 'guard_name' => 'web'],
                ['title' => "Quản trị {$module}", 'is_default' => true, 'status' => 'active']
            );

            $actionMap = [
                'index' => 'view', 'show' => 'view',
                'create' => 'create', 'store' => 'create',
                'edit' => 'edit', 'update' => 'edit',
                'delete' => 'delete', 'destroy' => 'delete',
                'toggle-status' => 'toggle-status', 'toggle-featured' => 'toggle-featured',
                'publish' => 'publish', 'assign' => 'assign'
            ];

            foreach ($actionMap as $routeAction => $permAction) {
                if (!empty($actionsMap[$routeAction])) {
                    Permission::firstOrCreate(
                        ['name' => "{$permAction}_{$module}", 'guard_name' => 'web'],
                        [
                            'title' => ucfirst($permAction) . " {$module}",
                            'parent_id' => $manage->id,
                            'is_default' => true,
                            'status' => 'active'
                        ]
                    );
                }
            }
        }
    }
}
