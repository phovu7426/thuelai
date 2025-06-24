<?php

namespace Database\Seeders;

use App\Models\StoneVideo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StoneVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $videos = [
            [
                'title' => 'Video giới thiệu công ty Thanh Thanh Tùng',
                'description' => 'Video giới thiệu về công ty TNHH Thanh Thanh Tùng, nhà sản xuất và cung cấp đá ốp lát, đá mỹ nghệ hàng đầu Việt Nam.',
                'video_url' => 'https://www.youtube.com/watch?v=example1',
                'thumbnail' => 'stone_videos/video-gioi-thieu-cong-ty.jpg',
                'is_featured' => 1,
                'order' => 1,
            ],
            [
                'title' => 'Đá xanh đen băm toàn phần 30x60',
                'description' => 'Video giới thiệu sản phẩm đá xanh đen băm toàn phần kích thước 30x60cm, chất lượng cao, bền đẹp.',
                'video_url' => 'https://www.youtube.com/watch?v=example2',
                'thumbnail' => 'stone_videos/da-xanh-den-bam-toan-phan-30x60.jpg',
                'is_featured' => 1,
                'order' => 2,
            ],
            [
                'title' => 'Đá xanh đen băm toàn phần 40x40',
                'description' => 'Video giới thiệu sản phẩm đá xanh đen băm toàn phần kích thước 40x40cm, chất lượng cao, bền đẹp.',
                'video_url' => 'https://www.youtube.com/watch?v=example3',
                'thumbnail' => 'stone_videos/da-xanh-den-bam-toan-phan-40x40.jpg',
                'is_featured' => 1,
                'order' => 3,
            ],
            [
                'title' => 'Đá xanh đen băm trừ viền hone',
                'description' => 'Video giới thiệu sản phẩm đá xanh đen băm trừ viền hone, chất lượng cao, bền đẹp.',
                'video_url' => 'https://www.youtube.com/watch?v=example4',
                'thumbnail' => 'stone_videos/da-xanh-den-bam-tru-vien-hone.jpg',
                'is_featured' => 1,
                'order' => 4,
            ],
            [
                'title' => 'Đá xanh rêu thô tinh',
                'description' => 'Video giới thiệu sản phẩm đá xanh rêu thô tinh, chất lượng cao, bền đẹp.',
                'video_url' => 'https://www.youtube.com/watch?v=example5',
                'thumbnail' => 'stone_videos/da-xanh-reu-tho-tinh.jpg',
                'is_featured' => 1,
                'order' => 5,
            ],
        ];

        foreach ($videos as $video) {
            StoneVideo::create([
                'title' => $video['title'],
                'slug' => Str::slug($video['title']),
                'description' => $video['description'],
                'video_url' => $video['video_url'],
                'thumbnail' => $video['thumbnail'],
                'status' => 1,
                'is_featured' => $video['is_featured'],
                'order' => $video['order'],
            ]);
        }
    }
} 