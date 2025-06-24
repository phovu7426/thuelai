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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call([
        //     //PermissionSeeder::class,
        //     // UserSeeder::class,
        //     RoleSeeder::class,
        //     // Category & Post seeders
        //     CategorySeeder::class,
        //     SeriesSeeder::class,
        //     PostSeeder::class,
            
        //     // Stone seeders
        //     StoneCategorySeeder::class,
        //     StoneMaterialSeeder::class,
        //     StoneSurfaceSeeder::class,
        //     StoneApplicationSeeder::class,
        //     StoneProductSeeder::class,
        //     StoneProjectSeeder::class,
        //     StoneShowroomSeeder::class,
        //     StoneVideoSeeder::class,
        // ]);
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'password' => Hash::make('12345678'),
            ]
        );

        // Gán role admin cho user admin
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $admin->assignRole($adminRole);
        }
    }
}
