<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Post::truncate();
        PostCategory::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $user = User::first() ?? User::factory()->create(['name' => 'Admin', 'email' => 'admin@example.com']);

        // Create Post Categories based on the Model's fillable fields
        $categories = [
            ['name' => 'Mẹo lái xe', 'slug' => 'meo-lai-xe', 'description' => 'Các mẹo và kỹ năng lái xe an toàn', 'status' => 'active'],
            ['name' => 'Quy định giao thông', 'slug' => 'quy-dinh-giao-thong', 'description' => 'Cập nhật các quy định giao thông mới nhất', 'status' => 'active'],
            ['name' => 'Dịch vụ thuê tài xế', 'slug' => 'dich-vu-thue-tai-xe', 'description' => 'Thông tin về dịch vụ thuê tài xế', 'status' => 'active'],
            ['name' => 'Bảo dưỡng xe', 'slug' => 'bao-duong-xe', 'description' => 'Hướng dẫn bảo dưỡng và chăm sóc xe', 'status' => 'active'],
            ['name' => 'Tin tức ngành', 'slug' => 'tin-tuc-nganh', 'description' => 'Tin tức và xu hướng trong ngành vận tải', 'status' => 'active'],
        ];

        $createdCategories = [];
        foreach ($categories as $cat) {
            $createdCategories[$cat['slug']] = PostCategory::create($cat);
        }
        $this->command->info('Đã tạo ' . count($categories) . ' danh mục bài viết.');

        // Create Posts
        $posts = [
            ['title' => '10 Mẹo Lái Xe An Toàn Trong Thành Phố', 'excerpt' => 'Hướng dẫn chi tiết 10 mẹo lái xe an toàn...', 'content' => 'Nội dung chi tiết về 10 mẹo lái xe an toàn...', 'category_slug' => 'meo-lai-xe', 'image' => 'images/posts/safe-driving-tips.jpg', 'featured' => true],
            ['title' => 'Lợi Ích Của Việc Thuê Tài Xế Riêng', 'excerpt' => 'Khám phá những lợi ích tuyệt vời khi sử dụng dịch vụ...', 'content' => 'Nội dung chi tiết về lợi ích thuê tài xế...', 'category_slug' => 'dich-vu-thue-tai-xe', 'image' => 'images/posts/private-driver-benefits.jpg', 'featured' => true],
            ['title' => 'Quy Định Giao Thông Mới Nhất 2024', 'excerpt' => 'Tổng hợp các quy định giao thông mới nhất năm 2024...', 'content' => 'Nội dung chi tiết về quy định giao thông 2024...', 'category_slug' => 'quy-dinh-giao-thong', 'image' => 'images/posts/traffic-regulations-2024.jpg', 'featured' => false],
            ['title' => 'Cách Chọn Tài Xế Thuê Lái Uy Tín', 'excerpt' => 'Hướng dẫn chi tiết cách chọn tài xế thuê lái uy tín...', 'content' => 'Nội dung chi tiết về cách chọn tài xế...', 'category_slug' => 'dich-vu-thue-tai-xe', 'image' => 'images/posts/choose-reliable-driver.jpg', 'featured' => false],
            ['title' => 'Bảo Dưỡng Xe Định Kỳ - Điều Cần Biết', 'excerpt' => 'Hướng dẫn toàn diện về bảo dưỡng xe định kỳ...', 'content' => 'Nội dung chi tiết về bảo dưỡng xe...', 'category_slug' => 'bao-duong-xe', 'image' => 'images/posts/car-maintenance.jpg', 'featured' => false],
            ['title' => 'Kỹ Năng Lái Xe Trong Điều Kiện Thời Tiết Xấu', 'excerpt' => 'Hướng dẫn kỹ năng lái xe an toàn trong các điều kiện...', 'content' => 'Nội dung chi tiết về lái xe thời tiết xấu...', 'category_slug' => 'meo-lai-xe', 'image' => 'images/posts/bad-weather-driving.jpg', 'featured' => true],
        ];

        foreach ($posts as $postData) {
            Post::create([
                'title' => $postData['title'],
                'slug' => Str::slug($postData['title']),
                'excerpt' => $postData['excerpt'],
                'content' => $postData['content'],
                'image' => $postData['image'],
                'category_id' => $createdCategories[$postData['category_slug']]->id,
                'author_id' => $user->id,
                'status' => 'published',
                'featured' => $postData['featured'],
                'views' => rand(100, 1000),
                'published_at' => now()->subDays(rand(1, 30)),
            ]);
        }

        $this->command->info('Đã tạo ' . count($posts) . ' bài viết mẫu.');
    }
}
