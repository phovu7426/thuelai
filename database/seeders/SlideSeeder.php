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
                'title' => 'Dịch vụ lái xe chuyên nghiệp',
                'description' => 'Cung cấp dịch vụ lái xe thuê chuyên nghiệp, an toàn và đáng tin cậy cho mọi nhu cầu di chuyển.',
                'image' => 'slides/slide-1.jpg',
                'link' => '/driver/services',
                'status' => 1,
            ],
            [
                'title' => 'Lái xe có kinh nghiệm',
                'description' => 'Đội ngũ lái xe có kinh nghiệm, được đào tạo chuyên nghiệp và có giấy phép lái xe hợp lệ.',
                'image' => 'slides/slide-2.jpg',
                'link' => '/driver/services',
                'status' => 1,
            ],
            [
                'title' => 'Dịch vụ đa dạng',
                'description' => 'Cung cấp nhiều loại dịch vụ lái xe khác nhau: lái xe gia đình, lái xe công ty, lái xe du lịch...',
                'image' => 'slides/slide-3.jpg',
                'link' => '/driver/services',
                'status' => 1,
            ],
            [
                'title' => 'Đặt dịch vụ dễ dàng',
                'description' => 'Quy trình đặt dịch vụ đơn giản, nhanh chóng và thuận tiện cho khách hàng.',
                'image' => 'slides/slide-4.jpg',
                'link' => '/driver/services',
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
