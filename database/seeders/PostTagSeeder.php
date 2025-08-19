<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PostTag;

class PostTagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            [
                'name' => 'Lái xe an toàn',
                'slug' => 'safe-driving',
                'description' => 'Các bài viết về lái xe an toàn',
                'color' => '#28a745',
                'is_active' => true
            ],
            [
                'name' => 'Tiết kiệm nhiên liệu',
                'slug' => 'fuel-efficiency',
                'description' => 'Mẹo tiết kiệm nhiên liệu khi lái xe',
                'color' => '#17a2b8',
                'is_active' => true
            ],
            [
                'name' => 'Bảo dưỡng xe',
                'slug' => 'car-maintenance',
                'description' => 'Hướng dẫn bảo dưỡng xe định kỳ',
                'color' => '#ffc107',
                'is_active' => true
            ],
            [
                'name' => 'Luật giao thông',
                'slug' => 'traffic-laws',
                'description' => 'Cập nhật luật giao thông mới',
                'color' => '#dc3545',
                'is_active' => true
            ],
            [
                'name' => 'Xe điện',
                'slug' => 'electric-cars',
                'description' => 'Thông tin về xe điện và xu hướng tương lai',
                'color' => '#6f42c1',
                'is_active' => true
            ],
            [
                'name' => 'Du lịch',
                'slug' => 'travel',
                'description' => 'Kinh nghiệm du lịch bằng ô tô',
                'color' => '#fd7e14',
                'is_active' => true
            ]
        ];

        foreach ($tags as $tag) {
            PostTag::create($tag);
        }
    }
}







