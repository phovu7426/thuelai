<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DriverPricingRule;
use App\Models\DriverPricingRuleDistance;

class DriverPricingRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pricingRules = [
            [
                'time_slot' => 'Trước 22h',
                'time_icon' => 'fas fa-sun',
                'time_color' => '#ffc107',
                'is_active' => true,
                'sort_order' => 1,
                'prices' => [
                    1 => 245000, // 5km đầu
                    2 => 20000,   // 6-10km
                    3 => 15000,   // >10km
                    4 => 'Thỏa thuận', // >30km
                ]
            ],
            [
                'time_slot' => '22h - 24h',
                'time_icon' => 'fas fa-moon',
                'time_color' => '#17a2b8',
                'is_active' => true,
                'sort_order' => 2,
                'prices' => [
                    1 => 260000, // 5km đầu
                    2 => 25000,   // 6-10km
                    3 => 20000,   // >10km
                    4 => 'Thỏa thuận', // >30km
                ]
            ],
            [
                'time_slot' => 'Sau 24h',
                'time_icon' => 'fas fa-star',
                'time_color' => '#dc3545',
                'is_active' => true,
                'sort_order' => 3,
                'prices' => [
                    1 => 299000, // 5km đầu
                    2 => 20000,   // 6-10km
                    3 => 20000,   // >10km
                    4 => 'Thỏa thuận', // >30km
                ]
            ],
        ];

        foreach ($pricingRules as $ruleData) {
            $prices = $ruleData['prices'];
            unset($ruleData['prices']);
            
            $pricingRule = DriverPricingRule::create($ruleData);
            
            // Tạo giá cho từng khoảng cách
            foreach ($prices as $distanceTierId => $price) {
                if (is_numeric($price)) {
                    DriverPricingRuleDistance::create([
                        'pricing_rule_id' => $pricingRule->id,
                        'distance_tier_id' => $distanceTierId,
                        'price' => $price,
                        'price_text' => null,
                    ]);
                } else {
                    DriverPricingRuleDistance::create([
                        'pricing_rule_id' => $pricingRule->id,
                        'distance_tier_id' => $distanceTierId,
                        'price' => null,
                        'price_text' => $price,
                    ]);
                }
            }
        }
    }
}
