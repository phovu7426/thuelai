<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DriverService;

class DriverServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Lái xe theo chuyến',
                'slug' => 'lai-xe-theo-chuyen',
                'description' => 'Dịch vụ lái xe theo chuyến từ điểm A đến điểm B. Phù hợp cho các chuyến đi một chiều, đưa đón sân bay, hoặc di chuyển trong thành phố.',
                'short_description' => 'Lái xe theo chuyến từ điểm A đến điểm B',
                'price_per_hour' => null,
                'price_per_trip' => 500000,
                'is_featured' => true,
                'status' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Lái xe theo giờ',
                'slug' => 'lai-xe-theo-gio',
                'description' => 'Dịch vụ lái xe theo giờ, lý tưởng cho các chuyến đi ngắn, tham quan thành phố, hoặc khi bạn cần tài xế trong một khoảng thời gian nhất định.',
                'short_description' => 'Lái xe theo giờ với tài xế chuyên nghiệp',
                'price_per_hour' => 150000,
                'price_per_trip' => null,
                'is_featured' => true,
                'status' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Lái xe theo yêu cầu',
                'slug' => 'lai-xe-theo-yeu-cau',
                'description' => 'Dịch vụ lái xe tùy chỉnh theo yêu cầu cụ thể của khách hàng. Bao gồm các dịch vụ đặc biệt như lái xe ban đêm, lái xe đường dài, hoặc các yêu cầu đặc biệt khác.',
                'short_description' => 'Dịch vụ lái xe tùy chỉnh theo yêu cầu',
                'price_per_hour' => 200000,
                'price_per_trip' => 800000,
                'is_featured' => false,
                'status' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Lái xe cho doanh nghiệp',
                'slug' => 'lai-xe-cho-doanh-nghiep',
                'description' => 'Dịch vụ lái xe chuyên nghiệp dành cho doanh nghiệp. Bao gồm đưa đón nhân viên, khách hàng, đối tác, và các chuyến công tác.',
                'short_description' => 'Dịch vụ lái xe chuyên nghiệp cho doanh nghiệp',
                'price_per_hour' => 180000,
                'price_per_trip' => 600000,
                'is_featured' => true,
                'status' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Lái xe cho sự kiện',
                'slug' => 'lai-xe-cho-su-kien',
                'description' => 'Dịch vụ lái xe chuyên biệt cho các sự kiện như đám cưới, hội nghị, triển lãm, hoặc các sự kiện đặc biệt khác. Đảm bảo sự thuận tiện và chuyên nghiệp.',
                'short_description' => 'Dịch vụ lái xe chuyên biệt cho sự kiện',
                'price_per_hour' => 250000,
                'price_per_trip' => 1000000,
                'is_featured' => false,
                'status' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($services as $service) {
            DriverService::create($service);
        }
    }
}
