<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PostCategory;

class PostCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Mẹo lái xe',
                'slug' => 'tips',
                'description' => 'Những mẹo và kinh nghiệm lái xe an toàn, tiết kiệm nhiên liệu',
                'color' => '#28a745',
                'sort_order' => 1,
                'is_active' => true
            ],
            [
                'name' => 'Tin tức',
                'slug' => 'news',
                'description' => 'Tin tức mới nhất về giao thông, luật lệ và các sự kiện liên quan',
                'color' => '#007bff',
                'sort_order' => 2,
                'is_active' => true
            ],
            [
                'name' => 'An toàn giao thông',
                'slug' => 'safety',
                'description' => 'Kiến thức về an toàn giao thông, biển báo và quy tắc lái xe',
                'color' => '#dc3545',
                'sort_order' => 3,
                'is_active' => true
            ],
            [
                'name' => 'Dịch vụ',
                'slug' => 'service',
                'description' => 'Thông tin về dịch vụ tài xế thuê lái và các tiện ích khác',
                'color' => '#ffc107',
                'sort_order' => 4,
                'is_active' => true
            ],
            [
                'name' => 'Công nghệ xe',
                'slug' => 'technology',
                'description' => 'Những tiến bộ công nghệ trong ngành ô tô và giao thông',
                'color' => '#6f42c1',
                'sort_order' => 5,
                'is_active' => true
            ]
        ];

        foreach ($categories as $category) {
            PostCategory::create($category);
        }
    }
}




