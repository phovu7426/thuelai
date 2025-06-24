<?php

namespace Database\Seeders;

use App\Models\StoneSurface;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StoneSurfaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $surfaces = [
            [
                'name' => 'Băm nhám',
                'description' => 'Bề mặt băm nhám chống trơn trượt.',
                'image' => 'stone_surfaces/bam-nham.jpg',
                'order' => 1,
            ],
            [
                'name' => 'Băm trang trí',
                'description' => 'Bề mặt băm trang trí tạo điểm nhấn.',
                'image' => 'stone_surfaces/bam-trang-tri.jpg',
                'order' => 2,
            ],
            [
                'name' => 'Xẻ thô',
                'description' => 'Bề mặt xẻ thô tự nhiên.',
                'image' => 'stone_surfaces/xe-tho.jpg',
                'order' => 3,
            ],
            [
                'name' => 'Mài thô',
                'description' => 'Bề mặt mài thô.',
                'image' => 'stone_surfaces/mai-tho.jpg',
                'order' => 4,
            ],
            [
                'name' => 'Mài hone',
                'description' => 'Bề mặt mài hone mịn.',
                'image' => 'stone_surfaces/mai-hone.jpg',
                'order' => 5,
            ],
            [
                'name' => 'Mài bóng',
                'description' => 'Bề mặt mài bóng sáng đẹp.',
                'image' => 'stone_surfaces/mai-bong.jpg',
                'order' => 6,
            ],
            [
                'name' => 'Mài cát',
                'description' => 'Bề mặt mài cát là bề mặt đá được mài với hạt cát, tạo độ nhám mịn, thích hợp cho khu vực ngoài trời.',
                'image' => 'stone_surfaces/mai-cat.jpg',
                'order' => 7,
            ],
            [
                'name' => 'Khò lửa',
                'description' => 'Bề mặt khò lửa là bề mặt đá được xử lý bằng nhiệt, tạo độ nhám và màu sắc đặc biệt, thích hợp cho khu vực ngoài trời.',
                'image' => 'stone_surfaces/kho-lua.jpg',
                'order' => 8,
            ],
            [
                'name' => 'Giả cổ',
                'description' => 'Bề mặt giả cổ là bề mặt đá được xử lý để tạo vẻ cổ kính, thích hợp cho các công trình kiến trúc cổ.',
                'image' => 'stone_surfaces/gia-co.jpg',
                'order' => 9,
            ],
            [
                'name' => 'Quay mẻ',
                'description' => 'Bề mặt quay mẻ là bề mặt đá được xử lý để tạo các vết mẻ nhỏ, tạo vẻ đẹp tự nhiên.',
                'image' => 'stone_surfaces/quay-me.jpg',
                'order' => 10,
            ],
            [
                'name' => 'Xẻ rãnh',
                'description' => 'Bề mặt xẻ rãnh là bề mặt đá được tạo các rãnh nhỏ, tăng khả năng chống trơn trượt.',
                'image' => 'stone_surfaces/xe-ranh.jpg',
                'order' => 11,
            ],
            [
                'name' => 'Nút tròn',
                'description' => 'Bề mặt nút tròn là bề mặt đá được tạo các nút tròn nhỏ, tăng khả năng chống trơn trượt và tạo điểm nhấn thẩm mỹ.',
                'image' => 'stone_surfaces/nut-tron.jpg',
                'order' => 12,
            ],
            [
                'name' => 'Họa tiết CNC',
                'description' => 'Bề mặt họa tiết CNC là bề mặt đá được tạo các họa tiết bằng máy CNC, tạo các mẫu trang trí đẹp mắt.',
                'image' => 'stone_surfaces/hoa-tiet-cnc.jpg',
                'order' => 13,
            ],
            [
                'name' => 'Chẻ tay',
                'description' => 'Bề mặt chẻ tay là bề mặt đá được tạo bằng cách chẻ đá thủ công, tạo vẻ đẹp tự nhiên và độc đáo.',
                'image' => 'stone_surfaces/che-tay.jpg',
                'order' => 14,
            ],
            [
                'name' => 'Băm soi',
                'description' => 'Bề mặt băm soi là bề mặt đá được tạo bằng cách băm và soi rãnh, tạo vẻ đẹp độc đáo.',
                'image' => 'stone_surfaces/bam-soi.jpg',
                'order' => 15,
            ],
            [
                'name' => 'Bóc lồi',
                'description' => 'Bề mặt bóc lồi là bề mặt đá được xử lý để tạo các phần lồi, tạo vẻ đẹp tự nhiên và độc đáo.',
                'image' => 'stone_surfaces/boc-loi.jpg',
                'order' => 16,
            ],
            [
                'name' => 'Ghép',
                'description' => 'Bề mặt ghép là bề mặt đá được tạo bằng cách ghép nhiều mảnh đá nhỏ lại với nhau, tạo họa tiết đẹp mắt.',
                'image' => 'stone_surfaces/ghep.jpg',
                'order' => 17,
            ],
            [
                'name' => 'Lồi lõm',
                'description' => 'Bề mặt lồi lõm là bề mặt đá được tạo các phần lồi lõm, tạo vẻ đẹp tự nhiên và độc đáo.',
                'image' => 'stone_surfaces/loi-lom.jpg',
                'order' => 18,
            ],
            [
                'name' => 'Răng lược',
                'description' => 'Bề mặt răng lược là bề mặt đá được tạo các rãnh giống như răng lược, tăng khả năng chống trơn trượt.',
                'image' => 'stone_surfaces/rang-luoc.jpg',
                'order' => 19,
            ],
        ];

        foreach ($surfaces as $surface) {
            StoneSurface::create([
                'name' => $surface['name'],
                'slug' => Str::slug($surface['name']),
                'description' => $surface['description'],
                'image' => $surface['image'],
                'status' => 1,
                'order' => $surface['order'],
            ]);
        }
    }
}
