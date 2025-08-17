<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\User;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // Get first user as author
        $author = User::first();
        if (!$author) {
            $author = User::factory()->create();
        }

        // Get categories
        $categories = PostCategory::all();
        $tags = PostTag::all();

        $posts = [
            [
                'title' => '10 Mẹo Lái Xe An Toàn Cho Người Mới',
                'excerpt' => 'Những mẹo cơ bản giúp bạn lái xe an toàn hơn khi mới bắt đầu học lái xe.',
                'content' => '<h2>1. Luôn thắt dây an toàn</h2><p>Dây an toàn là thiết bị quan trọng nhất giúp bảo vệ tính mạng khi xảy ra tai nạn. Hãy luôn thắt dây an toàn trước khi khởi động xe.</p><h2>2. Kiểm tra gương chiếu hậu</h2><p>Điều chỉnh gương chiếu hậu để có tầm nhìn tốt nhất về phía sau và hai bên xe.</p><h2>3. Giữ khoảng cách an toàn</h2><p>Luôn giữ khoảng cách ít nhất 2 giây với xe phía trước để có đủ thời gian phản ứng khi cần thiết.</p>',
                'category_id' => $categories->where('slug', 'tips')->first()->id,
                'author_id' => $author->id,
                'status' => 'published',
                'published_at' => now()->subDays(5),
                'featured' => true,
                'views' => 1250,
                'reading_time' => 3
            ],
            [
                'title' => 'Cập Nhật Luật Giao Thông Mới Năm 2024',
                'excerpt' => 'Những thay đổi quan trọng trong luật giao thông đường bộ có hiệu lực từ năm 2024.',
                'content' => '<h2>Thay đổi về tốc độ</h2><p>Năm 2024, tốc độ tối đa trên đường cao tốc được tăng lên 120km/h cho xe ô tô con.</p><h2>Quy định về điện thoại</h2><p>Nghiêm cấm sử dụng điện thoại khi lái xe, kể cả khi dừng đèn đỏ.</p><h2>Xử phạt vi phạm</h2><p>Mức phạt tiền cho các vi phạm giao thông được tăng lên đáng kể.</p>',
                'category_id' => $categories->where('slug', 'news')->first()->id,
                'author_id' => $author->id,
                'status' => 'published',
                'published_at' => now()->subDays(3),
                'featured' => false,
                'views' => 890,
                'reading_time' => 4
            ],
            [
                'title' => 'Hướng Dẫn Bảo Dưỡng Xe Định Kỳ',
                'excerpt' => 'Lịch trình bảo dưỡng xe ô tô định kỳ để đảm bảo xe luôn hoạt động tốt và an toàn.',
                'content' => '<h2>Bảo dưỡng sau 5.000km</h2><p>Thay dầu nhớt động cơ, kiểm tra hệ thống phanh và lốp xe.</p><h2>Bảo dưỡng sau 10.000km</h2><p>Thay bộ lọc gió, kiểm tra hệ thống làm mát và ắc quy.</p><h2>Bảo dưỡng sau 20.000km</h2><p>Thay bộ lọc nhiên liệu, kiểm tra hệ thống treo và lái.</p>',
                'category_id' => $categories->where('slug', 'service')->first()->id,
                'author_id' => $author->id,
                'status' => 'published',
                'published_at' => now()->subDays(1),
                'featured' => false,
                'views' => 567,
                'reading_time' => 5
            ],
            [
                'title' => 'Xu Hướng Xe Điện Trong Tương Lai',
                'excerpt' => 'Khám phá tương lai của ngành công nghiệp ô tô với sự phát triển mạnh mẽ của xe điện.',
                'content' => '<h2>Lợi ích của xe điện</h2><p>Xe điện giúp giảm thiểu ô nhiễm môi trường và tiết kiệm chi phí nhiên liệu.</p><h2>Công nghệ pin mới</h2><p>Những tiến bộ trong công nghệ pin giúp xe điện có quãng đường di chuyển xa hơn.</p><h2>Hạ tầng sạc điện</h2><p>Hệ thống trạm sạc điện đang được phát triển mạnh mẽ trên toàn thế giới.</p>',
                'category_id' => $categories->where('slug', 'technology')->first()->id,
                'author_id' => $author->id,
                'status' => 'published',
                'published_at' => now()->subHours(12),
                'featured' => true,
                'views' => 234,
                'reading_time' => 4
            ]
        ];

        foreach ($posts as $postData) {
            $post = Post::create($postData);
            
            // Attach random tags
            $randomTags = $tags->random(rand(2, 4));
            $post->tags()->attach($randomTags->pluck('id'));
        }
    }
} 