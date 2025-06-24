<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Chạy Seeder phân quyền trước
        $this->call(RolePermissionSeeder::class);

        // Tạo tài khoản admin
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
        
        // Seed dữ liệu bài đăng
        $this->call(PostSeeder::class);
    }
}
