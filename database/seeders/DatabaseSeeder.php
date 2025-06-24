<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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

        $this->call([
            PermissionSeeder::class,
            UserSeeder::class,
            RoleSeeder::class,
            // Category & Post seeders
            CategorySeeder::class,
            SeriesSeeder::class,
            PostSeeder::class,
            
            // Stone seeders
            StoneCategorySeeder::class,
            StoneMaterialSeeder::class,
            StoneSurfaceSeeder::class,
            StoneApplicationSeeder::class,
            StoneProductSeeder::class,
            StoneProjectSeeder::class,
            StoneShowroomSeeder::class,
            StoneVideoSeeder::class,
        ]);
    }
}
