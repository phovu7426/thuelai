<?php

namespace Database\Seeders;

use App\Models\StoneShowroom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StoneShowroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete existing showrooms
        StoneShowroom::truncate();
        
        // Create sample showrooms
        $showrooms = [
            [
                'name' => 'Showroom Hà Nội',
                'slug' => Str::slug('Showroom Hà Nội'),
                'address' => '123 Đường Láng, Đống Đa, Hà Nội',
                'phone' => '024.1234.5678',
                'email' => 'hanoi@example.com',
                'description' => 'Showroom đá tại Hà Nội',
                'status' => 1,
                'order' => 1,
            ],
            [
                'name' => 'Showroom Đà Nẵng',
                'slug' => Str::slug('Showroom Đà Nẵng'),
                'address' => '456 Nguyễn Văn Linh, Hải Châu, Đà Nẵng',
                'phone' => '0236.1234.567',
                'email' => 'danang@example.com',
                'description' => 'Showroom đá tại Đà Nẵng',
                'status' => 1,
                'order' => 2,
            ],
            [
                'name' => 'Showroom Hồ Chí Minh',
                'slug' => Str::slug('Showroom Hồ Chí Minh'),
                'address' => '789 Nguyễn Huệ, Quận 1, TP. Hồ Chí Minh',
                'phone' => '028.1234.5678',
                'email' => 'hcm@example.com',
                'description' => 'Showroom đá tại TP. Hồ Chí Minh',
                'status' => 1,
                'order' => 3,
            ],
        ];
        
        foreach ($showrooms as $showroom) {
            StoneShowroom::create($showroom);
        }
    }
} 