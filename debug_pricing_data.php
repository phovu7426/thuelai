<?php
/**
 * Debug script để kiểm tra dữ liệu pricing
 * Chạy: php artisan tinker
 * Sau đó: include 'debug_pricing_data.php';
 */

echo "=== DEBUGGING PRICING DATA ===\n\n";

try {
    // 1. Kiểm tra Distance Tiers
    echo "1. Distance Tiers:\n";
    $distanceTiers = \App\Models\DriverDistanceTier::all();
    echo "  Total: {$distanceTiers->count()}\n";
    
    foreach ($distanceTiers as $tier) {
        echo "  - ID: {$tier->id}, Name: {$tier->name}, Display: {$tier->display_text}\n";
    }

    // 2. Kiểm tra Pricing Rules
    echo "\n2. Pricing Rules:\n";
    $pricingRules = \App\Models\DriverPricingRule::all();
    echo "  Total: {$pricingRules->count()}\n";
    
    foreach ($pricingRules as $rule) {
        echo "  - ID: {$rule->id}, Time: {$rule->time_slot}, Active: " . ($rule->is_active ? 'Yes' : 'No') . "\n";
    }

    // 3. Kiểm tra Pricing Rule Distances
    echo "\n3. Pricing Rule Distances:\n";
    $ruleDistances = \App\Models\DriverPricingRuleDistance::all();
    echo "  Total: {$ruleDistances->count()}\n";
    
    foreach ($ruleDistances as $rd) {
        $rule = \App\Models\DriverPricingRule::find($rd->pricing_rule_id);
        $tier = \App\Models\DriverDistanceTier::find($rd->distance_tier_id);
        
        $price = $rd->price_text ?: number_format($rd->price);
        echo "  - Rule: {$rule->time_slot} | Tier: {$tier->display_text} | Price: {$price}\n";
    }

    // 4. Test controller data
    echo "\n4. Controller Data (như frontend sẽ nhận):\n";
    
    $services = \App\Models\DriverService::where('status', true)
        ->orderBy('sort_order')
        ->get();

    $pricingRules = \App\Models\DriverPricingRule::with(['pricingDistances.distanceTier'])
        ->active()
        ->ordered()
        ->get();
        
    $distanceTiers = \App\Models\DriverDistanceTier::active()->ordered()->get();
    
    echo "  Services: {$services->count()}\n";
    echo "  Pricing Rules (active): {$pricingRules->count()}\n";
    echo "  Distance Tiers (active): {$distanceTiers->count()}\n";

    // 5. Test pricing matrix
    echo "\n5. Pricing Matrix:\n";
    foreach ($pricingRules as $rule) {
        echo "  {$rule->time_slot}:\n";
        foreach ($distanceTiers as $tier) {
            $pricingDistance = $rule->pricingDistances
                ->where('distance_tier_id', $tier->id)
                ->first();
                
            if ($pricingDistance) {
                $price = $pricingDistance->price_text ?: number_format($pricingDistance->price / 1000, 0) . 'k';
                echo "    {$tier->display_text}: {$price}\n";
            } else {
                echo "    {$tier->display_text}: -\n";
            }
        }
    }

    // 6. Test validation data
    echo "\n6. Test Validation Data:\n";
    $testData = [
        'time_slot' => 'Test Time',
        'time_icon' => 'fas fa-test',
        'time_color' => '#000000',
        'sort_order' => 1,
        'is_active' => true
    ];
    
    // Add price fields
    foreach ($distanceTiers as $tier) {
        $testData["price_{$tier->id}"] = '100000';
    }
    
    echo "  Test data keys: " . implode(', ', array_keys($testData)) . "\n";

    echo "\n✅ Debug completed successfully!\n";

} catch (Exception $e) {
    echo "\n❌ ERROR: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}

echo "\nScript completed!\n";
?>
