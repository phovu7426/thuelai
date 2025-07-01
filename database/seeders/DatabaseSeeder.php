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
        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'password' => Hash::make('12345678'),
                'status' => 'active',
            ]
        );

        // Run permission seeders
        $this->call([
            PermissionSeeder::class,
            RolePermissionSeeder::class,
        ]);

        // Assign admin role to admin user
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $admin->assignRole($adminRole);
        }

        // Run content seeders
        $this->call([
            // Blog content
            StoneCategorySeeder::class,
            StoneMaterialSeeder::class,
            StoneSurfaceSeeder::class,
            StoneApplicationSeeder::class,
            StoneProductSeeder::class,
            StoneProjectSeeder::class,
            StoneShowroomSeeder::class,
            StoneVideoSeeder::class,
            SlideSeeder::class,

            // Other content if needed
            PostSeeder::class,
        ]);
    }
}
