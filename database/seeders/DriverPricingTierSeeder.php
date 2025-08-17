<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DriverPricingTier;

class DriverPricingTierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pricingTiers = [
            // Trước 22h
            [
                'time_slot' => 'Trước 22h',
                'time_icon' => 'fas fa-sun',
                'time_color' => '#ffc107',
                'from_distance' => 0,
                'to_distance' => 5,
                'price' => 245000,
                'price_type' => 'fixed',
                'description' => 'Giá cơ bản cho 5km đầu tiên',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'time_slot' => 'Trước 22h',
                'time_icon' => 'fas fa-sun',
                'time_color' => '#ffc107',
                'from_distance' => 5,
                'to_distance' => 10,
                'price' => 20000,
                'price_type' => 'per_km',
                'description' => 'Phụ phí cho mỗi km từ 5-10km',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'time_slot' => 'Trước 22h',
                'time_icon' => 'fas fa-sun',
                'time_color' => '#ffc107',
                'from_distance' => 10,
                'to_distance' => 30,
                'price' => 15000,
                'price_type' => 'per_km',
                'description' => 'Phụ phí cho mỗi km từ 10-30km',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'time_slot' => 'Trước 22h',
                'time_icon' => 'fas fa-sun',
                'time_color' => '#ffc107',
                'from_distance' => 30,
                'to_distance' => null,
                'price' => 12000,
                'price_type' => 'per_km',
                'description' => 'Phụ phí cho mỗi km từ 30km trở lên',
                'is_active' => true,
                'sort_order' => 4,
            ],

            // 22h - 24h
            [
                'time_slot' => '22h - 24h',
                'time_icon' => 'fas fa-moon',
                'time_color' => '#17a2b8',
                'from_distance' => 0,
                'to_distance' => 5,
                'price' => 260000,
                'price_type' => 'fixed',
                'description' => 'Giá cơ bản cho 5km đầu tiên (giờ cao điểm)',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'time_slot' => '22h - 24h',
                'time_icon' => 'fas fa-moon',
                'time_color' => '#17a2b8',
                'from_distance' => 5,
                'to_distance' => 10,
                'price' => 25000,
                'price_type' => 'per_km',
                'description' => 'Phụ phí cho mỗi km từ 5-10km (giờ cao điểm)',
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'time_slot' => '22h - 24h',
                'time_icon' => 'fas fa-moon',
                'time_color' => '#17a2b8',
                'from_distance' => 10,
                'to_distance' => 30,
                'price' => 20000,
                'price_type' => 'per_km',
                'description' => 'Phụ phí cho mỗi km từ 10-30km (giờ cao điểm)',
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'time_slot' => '22h - 24h',
                'time_icon' => 'fas fa-moon',
                'time_color' => '#17a2b8',
                'from_distance' => 30,
                'to_distance' => null,
                'price' => 18000,
                'price_type' => 'per_km',
                'description' => 'Phụ phí cho mỗi km từ 30km trở lên (giờ cao điểm)',
                'is_active' => true,
                'sort_order' => 8,
            ],

            // Sau 24h
            [
                'time_slot' => 'Sau 24h',
                'time_icon' => 'fas fa-star',
                'time_color' => '#dc3545',
                'from_distance' => 0,
                'to_distance' => 5,
                'price' => 299000,
                'price_type' => 'fixed',
                'description' => 'Giá cơ bản cho 5km đầu tiên (giờ đặc biệt)',
                'is_active' => true,
                'sort_order' => 9,
            ],
            [
                'time_slot' => 'Sau 24h',
                'time_icon' => 'fas fa-star',
                'time_color' => '#dc3545',
                'from_distance' => 5,
                'to_distance' => 10,
                'price' => 20000,
                'price_type' => 'per_km',
                'description' => 'Phụ phí cho mỗi km từ 5-10km (giờ đặc biệt)',
                'is_active' => true,
                'sort_order' => 10,
            ],
            [
                'time_slot' => 'Sau 24h',
                'time_icon' => 'fas fa-star',
                'time_color' => '#dc3545',
                'from_distance' => 10,
                'to_distance' => 30,
                'price' => 20000,
                'price_type' => 'per_km',
                'description' => 'Phụ phí cho mỗi km từ 10-30km (giờ đặc biệt)',
                'is_active' => true,
                'sort_order' => 11,
            ],
            [
                'time_slot' => 'Sau 24h',
                'time_icon' => 'fas fa-star',
                'time_color' => '#dc3545',
                'from_distance' => 30,
                'to_distance' => null,
                'price' => 15000,
                'price_type' => 'per_km',
                'description' => 'Phụ phí cho mỗi km từ 30km trở lên (giờ đặc biệt)',
                'is_active' => true,
                'sort_order' => 12,
            ],
        ];

        foreach ($pricingTiers as $tier) {
            DriverPricingTier::create($tier);
        }
    }
}
