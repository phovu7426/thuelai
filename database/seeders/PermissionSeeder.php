<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo quyền chính theo menu (module) dựa trên route admin.*
        $router = app('router');
        $routes = collect($router->getRoutes())->map(fn($r) => $r->getName())->filter();
        $adminRoutes = $routes->filter(fn($name) => Str::startsWith($name, 'admin.'));

        $modules = [];
        foreach ($adminRoutes as $routeName) {
            $parts = explode('.', $routeName);
            if (count($parts) < 2) {
                continue;
            }
            $module = $parts[1];
            if ($module === 'index') {
                $module = 'dashboard';
            }
            $modules[$module] = true;
        }

        foreach (array_keys($modules) as $module) {
            Permission::firstOrCreate(
                ['name' => "access_{$module}", 'guard_name' => 'web'],
                [
                    'title' => "Truy cập {$module}",
                    'is_default' => true,
                    'status' => 'active'
                ]
            );
        }
    }
}
