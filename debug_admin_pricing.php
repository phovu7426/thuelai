<?php
/**
 * Debug script để kiểm tra admin pricing system
 * Chạy: php artisan tinker
 * Sau đó copy paste từng đoạn code dưới đây
 */

echo "=== DEBUG ADMIN PRICING SYSTEM ===\n\n";

// Test 1: Kiểm tra bảng có tồn tại không
echo "1. Kiểm tra bảng database:\n";
try {
    $tables = DB::select("SHOW TABLES");
    $tableNames = array_map(function($table) {
        return array_values((array)$table)[0];
    }, $tables);
    
    $requiredTables = [
        'driver_distance_tiers',
        'driver_pricing_rules', 
        'driver_pricing_tiers',
        'driver_pricing_rule_distances'
    ];
    
    foreach ($requiredTables as $table) {
        if (in_array($table, $tableNames)) {
            echo "  ✓ {$table} - EXISTS\n";
        } else {
            echo "  ✗ {$table} - MISSING\n";
        }
    }
} catch (Exception $e) {
    echo "  ✗ Error checking tables: " . $e->getMessage() . "\n";
}

echo "\n2. Kiểm tra dữ liệu:\n";
try {
    $distanceTiers = \App\Models\DriverDistanceTier::count();
    echo "  DriverDistanceTier: {$distanceTiers} records\n";
    
    $pricingRules = \App\Models\DriverPricingRule::count();
    echo "  DriverPricingRule: {$pricingRules} records\n";
    
    $pricingTiers = \App\Models\DriverPricingTier::count();
    echo "  DriverPricingTier: {$pricingTiers} records\n";
    
    $ruleDistances = \App\Models\DriverPricingRuleDistance::count();
    echo "  DriverPricingRuleDistance: {$ruleDistances} records\n";
} catch (Exception $e) {
    echo "  ✗ Error checking data: " . $e->getMessage() . "\n";
}

echo "\n3. Test routes:\n";
try {
    $routes = [
        'admin.driver.distance-tiers.index',
        'admin.driver.pricing-rules.index', 
        'admin.driver.pricing-tiers.index'
    ];
    
    foreach ($routes as $route) {
        try {
            $url = route($route);
            echo "  ✓ {$route} → {$url}\n";
        } catch (Exception $e) {
            echo "  ✗ {$route} → ERROR: " . $e->getMessage() . "\n";
        }
    }
} catch (Exception $e) {
    echo "  ✗ Error checking routes: " . $e->getMessage() . "\n";
}

echo "\n4. Test controllers:\n";
try {
    $controllers = [
        \App\Http\Controllers\Admin\Driver\DriverDistanceTierController::class,
        \App\Http\Controllers\Admin\Driver\DriverPricingRuleController::class,
        \App\Http\Controllers\Admin\Driver\DriverPricingTierController::class
    ];
    
    foreach ($controllers as $controller) {
        if (class_exists($controller)) {
            echo "  ✓ {$controller} - EXISTS\n";
        } else {
            echo "  ✗ {$controller} - MISSING\n";
        }
    }
} catch (Exception $e) {
    echo "  ✗ Error checking controllers: " . $e->getMessage() . "\n";
}

echo "\n5. Test models:\n";
try {
    $models = [
        \App\Models\DriverDistanceTier::class,
        \App\Models\DriverPricingRule::class,
        \App\Models\DriverPricingTier::class,
        \App\Models\DriverPricingRuleDistance::class
    ];
    
    foreach ($models as $model) {
        if (class_exists($model)) {
            echo "  ✓ {$model} - EXISTS\n";
        } else {
            echo "  ✗ {$model} - MISSING\n";
        }
    }
} catch (Exception $e) {
    echo "  ✗ Error checking models: " . $e->getMessage() . "\n";
}

echo "\n=== COMMANDS TO RUN ===\n";
echo "1. Chạy migration:\n";
echo "   php artisan migrate\n\n";

echo "2. Chạy seeder:\n";
echo "   php artisan db:seed --class=PricingSeeder\n\n";

echo "3. Clear cache:\n";
echo "   php artisan route:clear\n";
echo "   php artisan config:clear\n";
echo "   php artisan view:clear\n\n";

echo "4. Test truy cập:\n";
echo "   /admin/driver/distance-tiers\n";
echo "   /admin/driver/pricing-rules\n";
echo "   /admin/driver/pricing-tiers\n\n";

echo "=== TROUBLESHOOTING ===\n";
echo "Nếu vẫn lỗi, kiểm tra:\n";
echo "1. User có permission 'access_driver_services'\n";
echo "2. Đã login admin\n";
echo "3. Routes được load đúng\n";
echo "4. Database connection OK\n";
echo "5. Autoload classes\n\n";

echo "Debug completed!\n";
?>
