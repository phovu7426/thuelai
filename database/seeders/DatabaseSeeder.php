<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Check if we're running large data seeder
        // if (app()->environment('local') && $this->command->confirm('Would you like to seed 1000 records for each table?', false)) {
        //     $seeder = new LargeDataSeeder();
        //     if ($this->command) {
        //         $seeder->setCommand($this->command);
        //     }
        //     $seeder->run();
        //     return;
        // }
        
        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com', 'name' => 'Admin'],
            [
                'password' => Hash::make('12345678'),
                'status' => 'active',
            ]
        );

        // Run permission seeders
        $this->call([
            AdminSidebarSeeder::class, // Thêm dòng này để seed quyền, vai trò, tài khoản admin theo sidebar
            PermissionSeeder::class,
            RolePermissionSeeder::class,
        ]);

        // Assign admin role to admin user
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $admin->assignRole($adminRole);
        }

        // Run content seeders
        // $this->call([
        //     // Blog content
        //     StoneCategorySeeder::class,
        //     StoneMaterialSeeder::class,
        //     StoneSurfaceSeeder::class,
        //     StoneApplicationSeeder::class,
        //     StoneProductSeeder::class,
        //     StoneProjectSeeder::class,
        //     StoneShowroomSeeder::class,
        //     StoneVideoSeeder::class,
        //     SlideSeeder::class,

        //     // Other content if needed
        //     PostSeeder::class,
        // ]);
    }
}
