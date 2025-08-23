<?php
/**
 * Script tạo dữ liệu mẫu
 * Chạy: php artisan tinker
 * Sau đó: include 'create_sample_data.php';
 */

echo "=== CREATING SAMPLE DATA ===\n\n";

try {
    // 1. Tạo Distance Tiers
    echo "1. Creating Distance Tiers...\n";
    
    $tiers = [
        [
            'name' => '5km đầu',
            'display_text' => '5km đầu',
            'description' => 'Khoảng cách từ 0 đến 5km',
            'from_distance' => 0,
            'to_distance' => 5,
            'is_active' => true,
            'sort_order' => 1
        ],
        [
            'name' => '6-10km',
            'display_text' => '6-10km',
            'description' => 'Khoảng cách từ 6 đến 10km',
            'from_distance' => 6,
            'to_distance' => 10,
            'is_active' => true,
            'sort_order' => 2
        ],
        [
            'name' => '>10km',
            'display_text' => '>10km',
            'description' => 'Khoảng cách từ 11 đến 30km',
            'from_distance' => 11,
            'to_distance' => 30,
            'is_active' => true,
            'sort_order' => 3
        ],
        [
            'name' => '>30km',
            'display_text' => '>30km',
            'description' => 'Khoảng cách trên 30km',
            'from_distance' => 31,
            'to_distance' => null,
            'is_active' => true,
            'sort_order' => 4
        ]
    ];

    foreach ($tiers as $tierData) {
        $tier = \App\Models\DriverDistanceTier::updateOrCreate(
            ['name' => $tierData['name']],
            $tierData
        );
        echo "  ✓ Created: {$tier->name}\n";
    }

    // 2. Tạo Pricing Rules
    echo "\n2. Creating Pricing Rules...\n";
    
    $rules = [
        [
            'time_slot' => 'Trước 22h',
            'time_icon' => 'fas fa-sun',
            'time_color' => '#f59e0b',
            'is_active' => true,
            'sort_order' => 1
        ],
        [
            'time_slot' => '22h-24h',
            'time_icon' => 'fas fa-moon',
            'time_color' => '#6366f1',
            'is_active' => true,
            'sort_order' => 2
        ],
        [
            'time_slot' => 'Sau 24h',
            'time_icon' => 'fas fa-star',
            'time_color' => '#8b5cf6',
            'is_active' => true,
            'sort_order' => 3
        ]
    ];

    foreach ($rules as $ruleData) {
        $rule = \App\Models\DriverPricingRule::updateOrCreate(
            ['time_slot' => $ruleData['time_slot']],
            $ruleData
        );
        echo "  ✓ Created: {$rule->time_slot}\n";
    }

    // 3. Tạo Pricing Rule Distances
    echo "\n3. Creating Pricing Rule Distances...\n";
    
    $priceMatrix = [
        'Trước 22h' => [
            '5km đầu' => ['price' => 245000.00, 'price_text' => null],
            '6-10km' => ['price' => 20000.00, 'price_text' => null],
            '>10km' => ['price' => 15000.00, 'price_text' => null],
            '>30km' => ['price' => null, 'price_text' => 'Thỏa thuận']
        ],
        '22h-24h' => [
            '5km đầu' => ['price' => 260000.00, 'price_text' => null],
            '6-10km' => ['price' => 25000.00, 'price_text' => null],
            '>10km' => ['price' => 20000.00, 'price_text' => null],
            '>30km' => ['price' => null, 'price_text' => 'Thỏa thuận']
        ],
        'Sau 24h' => [
            '5km đầu' => ['price' => 299000.00, 'price_text' => null],
            '6-10km' => ['price' => 20000.00, 'price_text' => null],
            '>10km' => ['price' => 20000.00, 'price_text' => null],
            '>30km' => ['price' => null, 'price_text' => 'Thỏa thuận']
        ]
    ];

    foreach ($priceMatrix as $timeSlot => $prices) {
        $rule = \App\Models\DriverPricingRule::where('time_slot', $timeSlot)->first();
        if ($rule) {
            echo "  Processing {$timeSlot}:\n";
            
            foreach ($prices as $tierName => $priceData) {
                $tier = \App\Models\DriverDistanceTier::where('name', $tierName)->first();
                if ($tier) {
                    \App\Models\DriverPricingRuleDistance::updateOrCreate(
                        [
                            'pricing_rule_id' => $rule->id,
                            'distance_tier_id' => $tier->id
                        ],
                        $priceData
                    );
                    
                    $display = $priceData['price_text'] ?: number_format($priceData['price']);
                    echo "    ✓ {$tierName}: {$display}\n";
                }
            }
        }
    }

    // 4. Kiểm tra kết quả
    echo "\n4. Checking results...\n";
    $distanceCount = \App\Models\DriverDistanceTier::count();
    $ruleCount = \App\Models\DriverPricingRule::count();
    $ruleDistanceCount = \App\Models\DriverPricingRuleDistance::count();
    
    echo "  Distance Tiers: {$distanceCount}\n";
    echo "  Pricing Rules: {$ruleCount}\n";
    echo "  Rule Distances: {$ruleDistanceCount}\n";

    if ($distanceCount >= 4 && $ruleCount >= 3 && $ruleDistanceCount >= 12) {
        echo "\n✅ SUCCESS! Sample data created successfully!\n";
        echo "\nNow test:\n";
        echo "  - Admin: /admin/driver/pricing-rules\n";
        echo "  - Frontend: /bang-gia\n";
        echo "  - Debug: /debug-pricing\n";
    } else {
        echo "\n❌ WARNING! Some data might be missing.\n";
    }

} catch (Exception $e) {
    echo "\n❌ ERROR: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}

echo "\nScript completed!\n";
?>
