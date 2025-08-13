<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DriverPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo permissions cho driver services
        $driverPermissions = [
            'access_driver_services',
            'access_driver_orders',
            'access_driver_testimonials',
            'access_driver_contacts',
            'create_driver_services',
            'edit_driver_services',
            'delete_driver_services',
            'create_driver_orders',
            'edit_driver_orders',
            'delete_driver_orders',
            'create_testimonials',
            'edit_testimonials',
            'delete_testimonials',
            'manage_contacts',
        ];

        foreach ($driverPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Gán permissions cho admin role
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $adminRole->givePermissionTo($driverPermissions);
        }

        // Gán permissions cho manager role (nếu có)
        $managerRole = Role::where('name', 'manager')->first();
        if ($managerRole) {
            $managerRole->givePermissionTo([
                'access_driver_services',
                'access_driver_orders',
                'access_driver_testimonials',
                'access_driver_contacts',
                'create_driver_services',
                'edit_driver_services',
                'create_driver_orders',
                'edit_driver_orders',
                'create_testimonials',
                'edit_testimonials',
                'manage_contacts',
            ]);
        }

        // Gán permissions cho staff role (nếu có)
        $staffRole = Role::where('name', 'staff')->first();
        if ($staffRole) {
            $staffRole->givePermissionTo([
                'access_driver_services',
                'access_driver_orders',
                'access_driver_testimonials',
                'access_driver_contacts',
                'create_driver_orders',
                'edit_driver_orders',
                'manage_contacts',
            ]);
        }

        $this->command->info('Driver service permissions have been created and assigned successfully!');
    }
}
