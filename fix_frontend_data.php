<?php
/**
 * Script để fix dữ liệu frontend
 * Chạy: php artisan tinker
 * Sau đó: include 'fix_frontend_data.php';
 */

echo "=== FIXING FRONTEND DATA ===\n\n";

// 1. Kiểm tra dữ liệu hiện tại
echo "1. Checking current data:\n";
$distanceTiers = \App\Models\DriverDistanceTier::count();
$pricingRules = \App\Models\DriverPricingRule::count();
$ruleDistances = \App\Models\DriverPricingRuleDistance::count();

echo "  Distance Tiers: {$distanceTiers}\n";
echo "  Pricing Rules: {$pricingRules}\n";
echo "  Rule Distances: {$ruleDistances}\n\n";

// 2. Nếu không có dữ liệu, tạo dữ liệu mẫu
if ($distanceTiers == 0 || $pricingRules == 0) {
    echo "2. Creating sample data...\n";
    
    // Tạo Distance Tiers
    $tiers = [
        ['name' => '5km đầu', 'display_text' => '5km đầu', 'from_distance' => 0, 'to_distance' => 5, 'sort_order' => 1],
        ['name' => '6-10km', 'display_text' => '6-10km', 'from_distance' => 6, 'to_distance' => 10, 'sort_order' => 2],
        ['name' => '>10km', 'display_text' => '>10km', 'from_distance' => 11, 'to_distance' => 30, 'sort_order' => 3],
        ['name' => '>30km', 'display_text' => '>30km', 'from_distance' => 31, 'to_distance' => null, 'sort_order' => 4],
    ];
    
    foreach ($tiers as $tier) {
        $tier['description'] = "Khoảng cách " . $tier['name'];
        $tier['is_active'] = true;
        \App\Models\DriverDistanceTier::updateOrCreate(['name' => $tier['name']], $tier);
        echo "    ✓ Created tier: {$tier['name']}\n";
    }
    
    // Tạo Pricing Rules
    $rules = [
        ['time_slot' => 'Trước 22h', 'time_icon' => 'fas fa-sun', 'time_color' => '#f59e0b', 'sort_order' => 1],
        ['time_slot' => '22h-24h', 'time_icon' => 'fas fa-moon', 'time_color' => '#6366f1', 'sort_order' => 2],
        ['time_slot' => 'Sau 24h', 'time_icon' => 'fas fa-star', 'time_color' => '#8b5cf6', 'sort_order' => 3],
    ];
    
    foreach ($rules as $rule) {
        $rule['is_active'] = true;
        $pricingRule = \App\Models\DriverPricingRule::updateOrCreate(['time_slot' => $rule['time_slot']], $rule);
        echo "    ✓ Created rule: {$rule['time_slot']}\n";
        
        // Tạo giá cho từng khoảng cách
        $prices = [];
        switch ($rule['time_slot']) {
            case 'Trước 22h':
                $prices = [
                    '5km đầu' => ['price' => 245000, 'price_text' => null],
                    '6-10km' => ['price' => 20000, 'price_text' => null],
                    '>10km' => ['price' => 15000, 'price_text' => null],
                    '>30km' => ['price' => null, 'price_text' => 'Thỏa thuận']
                ];
                break;
            case '22h-24h':
                $prices = [
                    '5km đầu' => ['price' => 260000, 'price_text' => null],
                    '6-10km' => ['price' => 25000, 'price_text' => null],
                    '>10km' => ['price' => 20000, 'price_text' => null],
                    '>30km' => ['price' => null, 'price_text' => 'Thỏa thuận']
                ];
                break;
            case 'Sau 24h':
                $prices = [
                    '5km đầu' => ['price' => 299000, 'price_text' => null],
                    '6-10km' => ['price' => 20000, 'price_text' => null],
                    '>10km' => ['price' => 20000, 'price_text' => null],
                    '>30km' => ['price' => null, 'price_text' => 'Thỏa thuận']
                ];
                break;
        }
        
        foreach ($prices as $tierName => $priceData) {
            $tier = \App\Models\DriverDistanceTier::where('name', $tierName)->first();
            if ($tier) {
                \App\Models\DriverPricingRuleDistance::updateOrCreate(
                    [
                        'pricing_rule_id' => $pricingRule->id,
                        'distance_tier_id' => $tier->id
                    ],
                    $priceData
                );
                echo "      ✓ Added price for {$tierName}\n";
            }
        }
    }
} else {
    echo "2. Data already exists, skipping creation.\n\n";
}

// 3. Test frontend data
echo "3. Testing frontend data:\n";
try {
    $pricingRules = \App\Models\DriverPricingRule::with(['pricingDistances.distanceTier'])->active()->ordered()->get();
    $distanceTiers = \App\Models\DriverDistanceTier::active()->ordered()->get();
    
    echo "  ✓ Found {$pricingRules->count()} active pricing rules\n";
    echo "  ✓ Found {$distanceTiers->count()} active distance tiers\n";
    
    foreach ($pricingRules as $rule) {
        echo "    - {$rule->time_slot}: {$rule->pricingDistances->count()} prices\n";
    }
    
} catch (Exception $e) {
    echo "  ✗ Error: " . $e->getMessage() . "\n";
}

// 4. Test route
echo "\n4. Testing route:\n";
try {
    $url = route('driver.pricing');
    echo "  ✓ Frontend URL: {$url}\n";
} catch (Exception $e) {
    echo "  ✗ Route error: " . $e->getMessage() . "\n";
}

echo "\n=== COMMANDS TO RUN ===\n";
echo "1. Clear cache:\n";
echo "   php artisan route:clear\n";
echo "   php artisan view:clear\n\n";

echo "2. Test frontend:\n";
echo "   Visit: /bang-gia\n\n";

echo "3. Test admin:\n";
echo "   Visit: /admin/driver/pricing-rules\n\n";

echo "Fix completed!\n";
?>
