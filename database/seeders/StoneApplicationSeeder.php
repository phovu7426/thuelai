<?php

namespace Database\Seeders;

use App\Models\StoneApplication;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StoneApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exteriorApplications = [
            [
                'name' => 'Vỉa hè',
                'description' => 'Đá lát vỉa hè là sản phẩm được sử dụng rộng rãi trong việc xây dựng các tuyến phố, đường đi bộ, khu đô thị mới.',
                'image' => 'stone_applications/via-he.jpg',
                'order' => 1,
            ],
            [
                'name' => 'Sân vườn',
                'description' => 'Đá lát sân vườn mang đến vẻ đẹp tự nhiên, sang trọng cho không gian ngoại thất.',
                'image' => 'stone_applications/san-vuon.jpg',
                'order' => 2,
            ],
            [
                'name' => 'Quảng trường',
                'description' => 'Đá lát quảng trường với độ bền cao, khả năng chịu lực tốt, phù hợp cho các không gian công cộng.',
                'image' => 'stone_applications/quang-truong.jpg',
                'order' => 3,
            ],
            [
                'name' => 'Bể bơi',
                'description' => 'Đá ốp lát bể bơi với khả năng chống thấm, chống trơn trượt, tạo vẻ đẹp sang trọng cho khu vực bể bơi.',
                'image' => 'stone_applications/be-boi.jpg',
                'order' => 4,
            ],
            [
                'name' => 'Dải lối đi',
                'description' => 'Đá lát dải lối đi tạo điểm nhấn cho khu vực sân vườn, công viên.',
                'image' => 'stone_applications/dai-loi-di.jpg',
                'order' => 5,
            ],
            [
                'name' => 'Bó vỉa',
                'description' => 'Đá bó vỉa được sử dụng để ngăn cách giữa các khu vực trong thiết kế cảnh quan.',
                'image' => 'stone_applications/bo-via.jpg',
                'order' => 6,
            ],
            [
                'name' => 'Bậc tam cấp',
                'description' => 'Đá bậc tam cấp với độ bền cao, chống trơn trượt, tạo vẻ đẹp sang trọng cho lối vào công trình.',
                'image' => 'stone_applications/bac-tam-cap.jpg',
                'order' => 7,
            ],
            [
                'name' => 'Đá cubic',
                'description' => 'Đá cubic với hình dạng vuông vắn, phù hợp cho việc lát các khu vực có hoa văn đặc biệt.',
                'image' => 'stone_applications/da-cubic.jpg',
                'order' => 8,
            ],
            [
                'name' => 'Tường trang trí',
                'description' => 'Đá ốp tường trang trí tạo điểm nhấn thẩm mỹ cho công trình.',
                'image' => 'stone_applications/tuong-trang-tri.jpg',
                'order' => 9,
            ],
            [
                'name' => 'Biển hiệu',
                'description' => 'Đá làm biển hiệu với độ bền cao, khả năng chống chịu thời tiết tốt, tạo vẻ đẹp sang trọng cho biển hiệu.',
                'image' => 'stone_applications/bien-hieu.jpg',
                'order' => 10,
            ],
        ];

        $interiorApplications = [
            [
                'name' => 'Sàn nhà',
                'description' => 'Đá lát sàn nhà với vẻ đẹp sang trọng, độ bền cao, dễ dàng vệ sinh.',
                'image' => 'stone_applications/san-nha.jpg',
                'order' => 11,
            ],
            [
                'name' => 'Mặt tiền',
                'description' => 'Đá ốp mặt tiền tạo vẻ đẹp sang trọng, hiện đại cho công trình.',
                'image' => 'stone_applications/mat-tien.jpg',
                'order' => 12,
            ],
            [
                'name' => 'Cầu thang bộ',
                'description' => 'Đá lát cầu thang bộ với độ bền cao, chống trơn trượt, tạo vẻ đẹp sang trọng cho công trình.',
                'image' => 'stone_applications/cau-thang-bo.jpg',
                'order' => 13,
            ],
            [
                'name' => 'Cầu thang máy',
                'description' => 'Đá ốp cầu thang máy tạo vẻ đẹp sang trọng, hiện đại cho công trình.',
                'image' => 'stone_applications/cau-thang-may.jpg',
                'order' => 14,
            ],
            [
                'name' => 'Nhà vệ sinh',
                'description' => 'Đá ốp lát nhà vệ sinh với khả năng chống thấm, dễ dàng vệ sinh, tạo vẻ đẹp sang trọng.',
                'image' => 'stone_applications/nha-ve-sinh.jpg',
                'order' => 15,
            ],
            [
                'name' => 'Bàn bếp',
                'description' => 'Đá làm bàn bếp với độ bền cao, khả năng chống chịu nhiệt tốt, dễ dàng vệ sinh.',
                'image' => 'stone_applications/ban-bep.jpg',
                'order' => 16,
            ],
        ];

        $artstoneApplications = [
            [
                'name' => 'Lăng thờ đá',
                'description' => 'Lăng thờ đá với vẻ đẹp trang nghiêm, độ bền cao, phù hợp cho các công trình tâm linh.',
                'image' => 'stone_applications/lang-tho-da.jpg',
                'order' => 17,
                'type' => StoneApplication::TYPE_ARTSTONE,
            ],
            [
                'name' => 'Mộ đá',
                'description' => 'Mộ đá với vẻ đẹp trang nghiêm, độ bền cao, phù hợp cho các công trình tâm linh.',
                'image' => 'stone_applications/mo-da.jpg',
                'order' => 18,
                'type' => StoneApplication::TYPE_ARTSTONE,
            ],
            [
                'name' => 'Chân tảng đá',
                'description' => 'Chân tảng đá với vẻ đẹp trang nghiêm, độ bền cao, phù hợp cho các công trình tâm linh.',
                'image' => 'stone_applications/chan-tang-da.jpg',
                'order' => 19,
                'type' => StoneApplication::TYPE_ARTSTONE,
            ],
            [
                'name' => 'Lư hương',
                'description' => 'Lư hương đá với vẻ đẹp trang nghiêm, độ bền cao, phù hợp cho các công trình tâm linh.',
                'image' => 'stone_applications/lu-huong.jpg',
                'order' => 20,
                'type' => StoneApplication::TYPE_ARTSTONE,
            ],
            [
                'name' => 'Cuốn thư đá',
                'description' => 'Cuốn thư đá với vẻ đẹp trang nghiêm, độ bền cao, phù hợp cho các công trình tâm linh.',
                'image' => 'stone_applications/cuon-thu-da.jpg',
                'order' => 21,
                'type' => StoneApplication::TYPE_ARTSTONE,
            ],
            [
                'name' => 'Đèn đá',
                'description' => 'Đèn đá với vẻ đẹp trang nghiêm, độ bền cao, phù hợp cho các công trình tâm linh.',
                'image' => 'stone_applications/den-da.jpg',
                'order' => 22,
                'type' => StoneApplication::TYPE_ARTSTONE,
            ],
            [
                'name' => 'Bàn thờ đá',
                'description' => 'Bàn thờ đá với vẻ đẹp trang nghiêm, độ bền cao, phù hợp cho các công trình tâm linh.',
                'image' => 'stone_applications/ban-tho-da.jpg',
                'order' => 23,
                'type' => StoneApplication::TYPE_ARTSTONE,
            ],
            [
                'name' => 'Lan can đá',
                'description' => 'Lan can đá với vẻ đẹp trang nghiêm, độ bền cao, phù hợp cho các công trình tâm linh.',
                'image' => 'stone_applications/lan-can-da.jpg',
                'order' => 24,
                'type' => StoneApplication::TYPE_ARTSTONE,
            ],
            [
                'name' => 'Đài phun nước',
                'description' => 'Đài phun nước đá với vẻ đẹp trang nghiêm, độ bền cao, phù hợp cho các công trình cảnh quan.',
                'image' => 'stone_applications/dai-phun-nuoc.jpg',
                'order' => 25,
                'type' => StoneApplication::TYPE_ARTSTONE,
            ],
            [
                'name' => 'Con Giống Đá',
                'description' => 'Con giống đá với vẻ đẹp trang nghiêm, độ bền cao, phù hợp cho các công trình tâm linh.',
                'image' => 'stone_applications/con-giong-da.jpg',
                'order' => 26,
                'type' => StoneApplication::TYPE_ARTSTONE,
            ],
            [
                'name' => 'Trụ đá',
                'description' => 'Trụ đá với vẻ đẹp trang nghiêm, độ bền cao, phù hợp cho các công trình tâm linh.',
                'image' => 'stone_applications/tru-da.jpg',
                'order' => 27,
                'type' => StoneApplication::TYPE_ARTSTONE,
            ],
            [
                'name' => 'Cổng tam quan',
                'description' => 'Cổng tam quan đá với vẻ đẹp trang nghiêm, độ bền cao, phù hợp cho các công trình tâm linh.',
                'image' => 'stone_applications/cong-tam-quan.jpg',
                'order' => 28,
                'type' => StoneApplication::TYPE_ARTSTONE,
            ],
            [
                'name' => 'Tượng đá',
                'description' => 'Tượng đá với vẻ đẹp trang nghiêm, độ bền cao, phù hợp cho các công trình tâm linh.',
                'image' => 'stone_applications/tuong-da.jpg',
                'order' => 29,
                'type' => StoneApplication::TYPE_ARTSTONE,
            ],
            [
                'name' => 'Chiếu rồng',
                'description' => 'Chiếu rồng đá với vẻ đẹp trang nghiêm, độ bền cao, phù hợp cho các công trình tâm linh.',
                'image' => 'stone_applications/chieu-rong.jpg',
                'order' => 30,
                'type' => StoneApplication::TYPE_ARTSTONE,
            ],
        ];

        // Thêm các ứng dụng ngoại thất
        foreach ($exteriorApplications as $application) {
            StoneApplication::create([
                'name' => $application['name'],
                'slug' => Str::slug($application['name']),
                'description' => $application['description'],
                'image' => $application['image'],
                'type' => StoneApplication::TYPE_EXTERIOR,
                'status' => 1,
                'order' => $application['order'],
            ]);
        }

        // Thêm các ứng dụng nội thất
        foreach ($interiorApplications as $application) {
            StoneApplication::create([
                'name' => $application['name'],
                'slug' => Str::slug($application['name']),
                'description' => $application['description'],
                'image' => $application['image'],
                'type' => StoneApplication::TYPE_INTERIOR,
                'status' => 1,
                'order' => $application['order'],
            ]);
        }

        // Thêm các ứng dụng đá mỹ nghệ
        foreach ($artstoneApplications as $application) {
            StoneApplication::create([
                'name' => $application['name'],
                'slug' => Str::slug($application['name']),
                'description' => $application['description'],
                'image' => $application['image'],
                'type' => StoneApplication::TYPE_ARTSTONE,
                'status' => 1,
                'order' => $application['order'],
            ]);
        }
    }
} 