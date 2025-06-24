<?php

namespace Database\Seeders;

use App\Enums\BasicStatus;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('vi_VN'); // Sử dụng locale Việt Nam
        
        // Đảm bảo có ít nhất một user để gán vào post
        $users = User::all();
        if ($users->isEmpty()) {
            $user = User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
            ]);
            $users = collect([$user]);
        }
        
        // Tạo nội dung mẫu với các thẻ HTML
        $generateContent = function() use ($faker) {
            $content = '';
            
            // Tạo đoạn giới thiệu
            $content .= '<p class="lead">' . $faker->paragraph(3) . '</p>';
            
            // Tạo các đoạn văn bản
            for ($i = 0; $i < 5; $i++) {
                if ($i % 2 == 0) {
                    $content .= '<h2>' . $faker->sentence() . '</h2>';
                }
                
                $content .= '<p>' . $faker->paragraph(5) . '</p>';
                
                // Thêm danh sách
                if ($i == 2) {
                    $content .= '<h3>Các điểm chính</h3>';
                    $content .= '<ul>';
                    for ($j = 0; $j < 4; $j++) {
                        $content .= '<li>' . $faker->sentence() . '</li>';
                    }
                    $content .= '</ul>';
                }
                
                // Thêm quote
                if ($i == 3) {
                    $content .= '<blockquote class="blockquote">';
                    $content .= '<p>' . $faker->sentence(10) . '</p>';
                    $content .= '<footer class="blockquote-footer">' . $faker->name() . '</footer>';
                    $content .= '</blockquote>';
                }
            }
            
            // Kết luận
            $content .= '<h2>Kết luận</h2>';
            $content .= '<p>' . $faker->paragraph(3) . '</p>';
            
            return $content;
        };
        
        // Tạo 20 bài đăng với thông tin đầy đủ
        $categories = ['Công nghệ', 'Giáo dục', 'Kinh doanh', 'Sức khỏe', 'Du lịch', 'Thể thao', 'Giải trí', 'Khoa học'];
        
        for ($i = 0; $i < 20; $i++) {
            $category = $faker->randomElement($categories);
            $requireLogin = $faker->boolean(30); // 30% bài đăng yêu cầu đăng nhập
            
            Post::create([
                'user_id' => $users->random()->id,
                'name' => $category . ': ' . $faker->sentence(),
                'description' => $faker->realText(200),
                'content' => $generateContent(),
                'require_login' => $requireLogin,
                'status' => $faker->randomElement(BasicStatus::values()),
                'created_at' => $faker->dateTimeBetween('-3 months', 'now'),
                'updated_at' => $faker->dateTimeBetween('-3 months', 'now'),
            ]);
        }
    }
} 