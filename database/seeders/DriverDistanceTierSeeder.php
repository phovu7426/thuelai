<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DriverDistanceTier;

class DriverDistanceTierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $distanceTiers = [
            [
                'name' => '5km đầu',
                'description' => 'Khoảng cách từ 0-5km, giá cố định cho chuyến',
                'from_distance' => 0,
                'to_distance' => 5,
                'display_text' => '5KM ĐẦU',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => '6-10km',
                'description' => 'Khoảng cách từ 6-10km, phụ phí theo km',
                'from_distance' => 6,
                'to_distance' => 10,
                'display_text' => '6-10KM',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => '>10km',
                'description' => 'Khoảng cách từ 10km đến 30km, phụ phí theo km',
                'from_distance' => 11,
                'to_distance' => 30,
                'display_text' => '>10KM',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => '>30km',
                'description' => 'Khoảng cách từ 30km trở lên, thường thỏa thuận',
                'from_distance' => 31,
                'to_distance' => null,
                'display_text' => '>30KM',
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($distanceTiers as $tier) {
            DriverDistanceTier::updateOrCreate(
                ['name' => $tier['name']],
                $tier
            );
        }
    }
}
