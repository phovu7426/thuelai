<?php

namespace Database\Seeders;

use App\Models\Slide;
use Illuminate\Database\Seeder;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slides = [
            [
                'title' => 'Đá tự nhiên cao cấp',
                'description' => 'Chuyên cung cấp và thi công đá tự nhiên cao cấp với chất lượng tốt nhất, mẫu mã đa dạng và giá cả cạnh tranh.',
                'image' => 'slides/slide-1.jpg',
                'link' => '/stone/products',
                'status' => 1,
            ],
            [
                'title' => 'Đá Marble cao cấp',
                'description' => 'Đá Marble nhập khẩu từ các mỏ đá nổi tiếng trên thế giới như Ý, Tây Ban Nha, Brazil...',
                'image' => 'slides/slide-2.jpg',
                'link' => '/stone/products',
                'status' => 1,
            ],
            [
                'title' => 'Thi công chuyên nghiệp',
                'description' => 'Đội ngũ thợ lành nghề với nhiều năm kinh nghiệm, đảm bảo thi công đúng kỹ thuật, chính xác và thẩm mỹ cao.',
                'image' => 'slides/slide-3.jpg',
                'link' => '/stone/projects',
                'status' => 1,
            ],
            [
                'title' => 'Showroom đa dạng',
                'description' => 'Ghé thăm showroom để trải nghiệm sản phẩm đá tự nhiên cao cấp với nhiều mẫu mã đa dạng.',
                'image' => 'slides/slide-4.jpg',
                'link' => '/stone/showrooms',
                'status' => 1,
            ],
        ];

        foreach ($slides as $slide) {
            Slide::updateOrCreate(
                ['title' => $slide['title']],
                $slide
            );
        }
    }
}
