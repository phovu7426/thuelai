<?php

namespace Database\Seeders;

use App\Models\StoneMaterial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StoneMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            [
                'name' => 'Đá ghi sáng',
                'description' => 'Đá ghi sáng tự nhiên, màu sắc tươi sáng, bền đẹp.',
                'image' => 'stone_materials/da-ghi-sang.jpg',
                'order' => 1,
            ],
            [
                'name' => 'Đá xanh đen',
                'description' => 'Đá xanh đen tự nhiên, độ bền cao, màu sắc sang trọng.',
                'image' => 'stone_materials/da-xanh-den.jpg',
                'order' => 2,
            ],
            [
                'name' => 'Đá xanh rêu',
                'description' => 'Đá xanh rêu tự nhiên, màu sắc độc đáo.',
                'image' => 'stone_materials/da-xanh-reu.jpg',
                'order' => 3,
            ],
            [
                'name' => 'Đá bazan',
                'description' => 'Đá bazan tự nhiên, độ cứng cao.',
                'image' => 'stone_materials/da-bazan.jpg',
                'order' => 4,
            ],
            [
                'name' => 'Đá ánh kim',
                'description' => 'Đá ánh kim tự nhiên, lấp lánh, sang trọng.',
                'image' => 'stone_materials/da-anh-kim.jpg',
                'order' => 5,
            ],
            [
                'name' => 'Đá sọc dưa',
                'description' => 'Đá sọc dưa tự nhiên, vân đẹp.',
                'image' => 'stone_materials/da-soc-dua.jpg',
                'order' => 6,
            ],
            [
                'name' => 'Đá vàng',
                'description' => 'Đá vàng là loại đá có màu sắc vàng, đẹp, bề mặt nhẵn mịn và được ưa chuộng trong nhiều công trình.',
                'image' => 'stone_materials/da-vang.jpg',
                'order' => 7,
            ],
            [
                'name' => 'Đá trắng',
                'description' => 'Đá trắng là loại đá có màu sắc trắng, đẹp, bề mặt nhẵn mịn và được ưa chuộng trong nhiều công trình.',
                'image' => 'stone_materials/da-trang.jpg',
                'order' => 8,
            ],
            [
                'name' => 'Đá granite tự nhiên',
                'description' => 'Đá granite tự nhiên là loại đá có độ cứng cao, màu sắc đa dạng, đẹp, bề mặt nhẵn mịn và được ưa chuộng trong nhiều công trình.',
                'image' => 'stone_materials/da-granite-tu-nhien.jpg',
                'order' => 9,
            ],
            [
                'name' => 'Đá trắng xám',
                'description' => 'Đá trắng xám là loại đá có màu sắc trắng xám, đẹp, bề mặt nhẵn mịn và được ưa chuộng trong nhiều công trình.',
                'image' => 'stone_materials/da-trang-xam.jpg',
                'order' => 10,
            ],
            [
                'name' => 'Đá bông mai',
                'description' => 'Đá bông mai là loại đá có vân hoa mai, đẹp, bề mặt nhẵn mịn và được ưa chuộng trong nhiều công trình.',
                'image' => 'stone_materials/da-bong-mai.jpg',
                'order' => 11,
            ],
            [
                'name' => 'Đá Marble',
                'description' => 'Đá Marble là loại đá có màu sắc đa dạng, vân đẹp, bề mặt nhẵn mịn và được ưa chuộng trong nhiều công trình.',
                'image' => 'stone_materials/da-marble.jpg',
                'order' => 12,
            ],
            [
                'name' => 'Bluestone',
                'description' => 'Bluestone là loại đá có màu xanh đặc trưng, đẹp, bề mặt nhẵn mịn và được ưa chuộng trong nhiều công trình.',
                'image' => 'stone_materials/bluestone.jpg',
                'order' => 13,
            ],
        ];

        foreach ($materials as $material) {
            StoneMaterial::create([
                'name' => $material['name'],
                'slug' => Str::slug($material['name']),
                'description' => $material['description'],
                'image' => $material['image'],
                'status' => 1,
                'order' => $material['order'],
            ]);
        }
    }
}
