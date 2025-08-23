<?php
/**
 * Debug script để kiểm tra dữ liệu frontend
 * Chạy: php artisan tinker
 * Sau đó: include 'debug_frontend_data.php';
 */

echo "=== DEBUG FRONTEND DATA ===\n\n";

// 1. Kiểm tra dữ liệu trong database
echo "1. Checking database data:\n";
try {
    $distanceTiers = \App\Models\DriverDistanceTier::active()->ordered()->get();
    $pricingRules = \App\Models\DriverPricingRule::active()->ordered()->get();
    
    echo "  Distance Tiers: {$distanceTiers->count()}\n";
    foreach ($distanceTiers as $tier) {
        echo "    - {$tier->name}: {$tier->display_text} ({$tier->from_distance}-{$tier->to_distance}km)\n";
    }
    
    echo "  Pricing Rules: {$pricingRules->count()}\n";
    foreach ($pricingRules as $rule) {
        echo "    - {$rule->time_slot}: {$rule->time_icon} {$rule->time_color}\n";
    }
    
} catch (Exception $e) {
    echo "  ✗ Database error: " . $e->getMessage() . "\n";
}

// 2. Kiểm tra relationships
echo "\n2. Checking relationships:\n";
try {
    $pricingRules = \App\Models\DriverPricingRule::with(['pricingDistances.distanceTier'])->active()->ordered()->get();
    
    foreach ($pricingRules as $rule) {
        echo "  Rule: {$rule->time_slot}\n";
        echo "    Pricing Distances: {$rule->pricingDistances->count()}\n";
        
        foreach ($rule->pricingDistances as $pd) {
            $tierName = $pd->distanceTier ? $pd->distanceTier->name : 'NULL';
            $price = $pd->price ? number_format($pd->price) : $pd->price_text;
            echo "      - {$tierName}: {$price}\n";
        }
    }
    
} catch (Exception $e) {
    echo "  ✗ Relationship error: " . $e->getMessage() . "\n";
}

// 3. Test controller method
echo "\n3. Testing controller method:\n";
try {
    $controller = app(\App\Http\Controllers\Driver\HomeController::class);
    
    // Simulate the pricing method
    $services = \App\Models\DriverService::where('status', true)
        ->orderBy('sort_order')
        ->get();

    $pricingRules = \App\Models\DriverPricingRule::with(['pricingDistances.distanceTier'])->active()->ordered()->get();
    $distanceTiers = \App\Models\DriverDistanceTier::active()->ordered()->get();
    
    echo "  Services: {$services->count()}\n";
    echo "  Pricing Rules: {$pricingRules->count()}\n";
    echo "  Distance Tiers: {$distanceTiers->count()}\n";
    
    // Check if data is being passed correctly
    if ($pricingRules->count() > 0 && $distanceTiers->count() > 0) {
        echo "  ✓ Controller data looks good!\n";
        
        // Test the actual view data structure
        echo "\n  Sample pricing data:\n";
        foreach ($pricingRules->take(1) as $rule) {
            echo "    Time Slot: {$rule->time_slot}\n";
            foreach ($distanceTiers->take(2) as $tier) {
                $pricingDistance = $rule->pricingDistances
                    ->where('distance_tier_id', $tier->id)
                    ->first();
                
                if ($pricingDistance) {
                    $display = $pricingDistance->price_text ?: number_format($pricingDistance->price / 1000, 0) . 'k';
                    echo "      {$tier->display_text}: {$display}\n";
                } else {
                    echo "      {$tier->display_text}: No data\n";
                }
            }
        }
    } else {
        echo "  ✗ No data found! Need to run seeder.\n";
    }
    
} catch (Exception $e) {
    echo "  ✗ Controller error: " . $e->getMessage() . "\n";
}

// 4. Check route
echo "\n4. Testing route:\n";
try {
    $url = route('driver.pricing');
    echo "  ✓ Route URL: {$url}\n";
} catch (Exception $e) {
    echo "  ✗ Route error: " . $e->getMessage() . "\n";
}

// 5. Check view cache
echo "\n5. Checking view cache:\n";
$viewPath = resource_path('views/driver/pricing.blade.php');
if (file_exists($viewPath)) {
    echo "  ✓ View file exists\n";
    $lastModified = date('Y-m-d H:i:s', filemtime($viewPath));
    echo "  Last modified: {$lastModified}\n";
} else {
    echo "  ✗ View file not found\n";
}

echo "\n=== RECOMMENDATIONS ===\n";

$distanceCount = \App\Models\DriverDistanceTier::count();
$ruleCount = \App\Models\DriverPricingRule::count();
$ruleDistanceCount = \App\Models\DriverPricingRuleDistance::count();

if ($distanceCount == 0 || $ruleCount == 0 || $ruleDistanceCount == 0) {
    echo "❌ MISSING DATA - Run seeder:\n";
    echo "   php artisan db:seed --class=QuickPricingSeeder\n\n";
}

echo "🔄 Clear caches:\n";
echo "   php artisan view:clear\n";
echo "   php artisan route:clear\n\n";

echo "🌐 Test URLs:\n";
echo "   Frontend: /bang-gia\n";
echo "   Admin: /admin/driver/pricing-rules\n\n";

echo "Debug completed!\n";
?>
