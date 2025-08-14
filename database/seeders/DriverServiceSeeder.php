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
                'name' => 'Lái xe theo giờ',
                'slug' => 'lai-xe-theo-gio',
                'description' => 'Dịch vụ lái xe theo giờ, phù hợp cho các chuyến đi ngắn, công việc, mua sắm hoặc tham quan trong thành phố.',
                'short_description' => 'Lái xe theo giờ linh hoạt, phù hợp mọi nhu cầu',
                'image' => 'images/driver-services/hourly-service.jpg',
                'icon' => 'fas fa-clock',
                'price_per_hour' => 150000,
                'price_per_trip' => null,
                'is_featured' => true,
                'status' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Lái xe theo chuyến',
                'slug' => 'lai-xe-theo-chuyen',
                'description' => 'Dịch vụ lái xe theo chuyến, đưa đón từ điểm A đến điểm B với giá cố định, phù hợp cho các chuyến đi có lộ trình rõ ràng.',
                'short_description' => 'Đưa đón theo chuyến với giá cố định',
                'image' => 'images/driver-services/trip-service.jpg',
                'icon' => 'fas fa-route',
                'price_per_hour' => null,
                'price_per_trip' => 300000,
                'is_featured' => true,
                'status' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Lái xe doanh nghiệp',
                'slug' => 'lai-xe-doanh-nghiep',
                'description' => 'Dịch vụ lái xe chuyên nghiệp dành cho doanh nghiệp, đưa đón khách hàng, đối tác, nhân viên với xe đời mới và lái xe kinh nghiệm.',
                'short_description' => 'Dịch vụ cao cấp cho doanh nghiệp',
                'image' => 'images/driver-services/business-service.jpg',
                'icon' => 'fas fa-building',
                'price_per_hour' => 200000,
                'price_per_trip' => 500000,
                'is_featured' => false,
                'status' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Lái xe sự kiện',
                'slug' => 'lai-xe-su-kien',
                'description' => 'Dịch vụ lái xe cho các sự kiện đặc biệt như đám cưới, hội nghị, tiệc tùng với xe sang trọng và lái xe chuyên nghiệp.',
                'short_description' => 'Phục vụ sự kiện đặc biệt',
                'image' => 'images/driver-services/event-service.jpg',
                'icon' => 'fas fa-calendar-alt',
                'price_per_hour' => 250000,
                'price_per_trip' => 800000,
                'is_featured' => false,
                'status' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Lái xe du lịch',
                'slug' => 'lai-xe-du-lich',
                'description' => 'Dịch vụ lái xe du lịch, khám phá các điểm đến với xe thoải mái, lái xe am hiểu địa lý và văn hóa địa phương.',
                'short_description' => 'Khám phá điểm đến với lái xe chuyên nghiệp',
                'image' => 'images/driver-services/travel-service.jpg',
                'icon' => 'fas fa-plane',
                'price_per_hour' => 180000,
                'price_per_trip' => 600000,
                'is_featured' => false,
                'status' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Lái xe khẩn cấp',
                'slug' => 'lai-xe-khan-cap',
                'description' => 'Dịch vụ lái xe khẩn cấp 24/7, phục vụ các trường hợp cần thiết như đưa đón bệnh viện, sân bay, hoặc các tình huống khẩn cấp khác.',
                'short_description' => 'Dịch vụ 24/7 cho tình huống khẩn cấp',
                'image' => 'images/driver-services/emergency-service.jpg',
                'icon' => 'fas fa-ambulance',
                'price_per_hour' => 300000,
                'price_per_trip' => 1000000,
                'is_featured' => false,
                'status' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $service) {
            DriverService::create($service);
        }

        $this->command->info('Driver services seeded successfully!');
    }
}
