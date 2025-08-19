<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $roles = [
            'admin',
            'editor',
            'user',
        ];

        foreach ($roles as $roleName) {
            $role = Role::firstOrCreate(
                ['name' => $roleName, 'guard_name' => 'web'],
                ['title' => ucfirst($roleName), 'status' => 'active']
            );

            // Assign permissions based on role
            if ($roleName === 'admin') {
                $allPermissionNames = Permission::where('name', 'like', 'access_%')->pluck('name')->all();
                $role->syncPermissions($allPermissionNames);
            } elseif ($roleName === 'editor') {
                $postPermissionNames = Permission::whereIn('name', [
                    'access_posts',
                    'access_post-categories',
                    'access_post-tags',
                ])->pluck('name')->all();
                $role->syncPermissions($postPermissionNames);
            } else { // user
                $basicPermissionNames = Permission::whereIn('name', [
                    'access_posts',
                ])->pluck('name')->all();
                $role->syncPermissions($basicPermissionNames);
            }
        }
    }
}


