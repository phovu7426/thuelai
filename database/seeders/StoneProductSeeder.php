<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StoneProduct;

class StoneProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Đá Marble Trắng Ý',
                'description' => 'Đá Marble Trắng Ý nổi bật với vân mây tự nhiên, màu trắng tinh khiết, thích hợp cho các công trình cao cấp như sảnh khách sạn, biệt thự.',
                'price' => 3200000,
                'sale_price' => 2950000,
                'quantity' => 50,
                'main_image' => 'marble_trang_y.jpg',
                'category_id' => 1,
                'material_id' => 1,
            ],
            [
                'name' => 'Đá Granite Đen Kim Sa Trung',
                'description' => 'Đá Granite Đen Kim Sa Trung có độ bền cao, bề mặt bóng, các hạt ánh kim lấp lánh, phù hợp làm mặt bếp, cầu thang, mặt tiền.',
                'price' => 1800000,
                'sale_price' => 1700000,
                'quantity' => 100,
                'main_image' => 'granite_den_kim_sa.jpg',
                'category_id' => 2,
                'material_id' => 2,
            ],
            [
                'name' => 'Đá Marble Vàng Ai Cập',
                'description' => 'Đá Marble Vàng Ai Cập mang sắc vàng ấm áp, vân đá tự nhiên sang trọng, thường dùng cho lát nền, ốp tường phòng khách.',
                'price' => 2700000,
                'sale_price' => 2500000,
                'quantity' => 30,
                'main_image' => 'marble_vang_ai_cap.jpg',
                'category_id' => 1,
                'material_id' => 1,
            ],
            [
                'name' => 'Đá Granite Trắng Suối Lau',
                'description' => 'Đá Granite Trắng Suối Lau có màu trắng xám nhẹ, vân đá tự nhiên, độ cứng cao, thích hợp cho lát nền, cầu thang, mặt bếp.',
                'price' => 1500000,
                'sale_price' => 1400000,
                'quantity' => 80,
                'main_image' => 'granite_trang_suoi_lau.jpg',
                'category_id' => 2,
                'material_id' => 2,
            ],
            [
                'name' => 'Đá Onyx Xanh Ngọc',
                'description' => 'Đá Onyx Xanh Ngọc có khả năng xuyên sáng, màu sắc độc đáo, thường dùng làm vách trang trí, quầy bar, bàn trà cao cấp.',
                'price' => 4500000,
                'sale_price' => 4200000,
                'quantity' => 15,
                'main_image' => 'onyx_xanh_ngoc.jpg',
                'category_id' => 3,
                'material_id' => 3,
            ],
            [
                'name' => 'Đá Marble Xám Ý',
                'description' => 'Đá Marble Xám Ý với vân mây xám nhẹ, bề mặt bóng, tạo cảm giác hiện đại, sang trọng cho không gian nội thất.',
                'price' => 3100000,
                'sale_price' => 2950000,
                'quantity' => 40,
                'main_image' => 'marble_xam_y.jpg',
                'category_id' => 1,
                'material_id' => 1,
            ],
            [
                'name' => 'Đá Granite Đỏ Bình Định',
                'description' => 'Đá Granite Đỏ Bình Định có màu đỏ đặc trưng, độ cứng cao, chịu lực tốt, thường dùng cho lát sân, bậc tam cấp, mặt tiền.',
                'price' => 1600000,
                'sale_price' => 1500000,
                'quantity' => 60,
                'main_image' => 'granite_do_binh_dinh.jpg',
                'category_id' => 2,
                'material_id' => 2,
            ],
            [
                'name' => 'Đá Marble Nâu Tây Ban Nha',
                'description' => 'Đá Marble Nâu Tây Ban Nha mang sắc nâu trầm, vân đá tự nhiên, phù hợp cho các công trình mang phong cách cổ điển.',
                'price' => 3300000,
                'sale_price' => 3100000,
                'quantity' => 25,
                'main_image' => 'marble_nau_tay_ban_nha.jpg',
                'category_id' => 1,
                'material_id' => 1,
            ],
            [
                'name' => 'Đá Granite Xanh Brazil',
                'description' => 'Đá Granite Xanh Brazil có màu xanh lạ mắt, vân đá độc đáo, độ bền cao, thích hợp cho các công trình nghệ thuật, trang trí.',
                'price' => 3700000,
                'sale_price' => 3500000,
                'quantity' => 10,
                'main_image' => 'granite_xanh_brazil.jpg',
                'category_id' => 2,
                'material_id' => 2,
            ],
            [
                'name' => 'Đá Onyx Trắng Sữa',
                'description' => 'Đá Onyx Trắng Sữa có khả năng xuyên sáng, màu trắng tinh tế, thường dùng làm vách trang trí, bàn tiếp khách cao cấp.',
                'price' => 4800000,
                'sale_price' => 4500000,
                'quantity' => 12,
                'main_image' => 'onyx_trang_sua.jpg',
                'category_id' => 3,
                'material_id' => 3,
            ],
        ];

        foreach ($products as $product) {
            StoneProduct::create($product);
        }
    }
}
