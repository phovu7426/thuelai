<?php
/**
 * Test script để kiểm tra controller access
 * Chạy: php artisan tinker
 * Sau đó: include 'test_controller_access.php';
 */

echo "=== TESTING CONTROLLER ACCESS ===\n\n";

// Test 1: Kiểm tra model có hoạt động không
echo "1. Testing Models:\n";
try {
    // Test DriverDistanceTier
    $distanceTier = new \App\Models\DriverDistanceTier();
    echo "  ✓ DriverDistanceTier model - OK\n";
    
    // Test DriverPricingRule
    $pricingRule = new \App\Models\DriverPricingRule();
    echo "  ✓ DriverPricingRule model - OK\n";
    
    // Test DriverPricingTier
    $pricingTier = new \App\Models\DriverPricingTier();
    echo "  ✓ DriverPricingTier model - OK\n";
    
} catch (Exception $e) {
    echo "  ✗ Model error: " . $e->getMessage() . "\n";
}

echo "\n2. Testing Database Connection:\n";
try {
    $connection = \DB::connection()->getPdo();
    echo "  ✓ Database connection - OK\n";
    
    // Test table exists
    $tables = \DB::select("SHOW TABLES LIKE 'driver_distance_tiers'");
    if (count($tables) > 0) {
        echo "  ✓ driver_distance_tiers table - EXISTS\n";
    } else {
        echo "  ✗ driver_distance_tiers table - MISSING\n";
    }
    
} catch (Exception $e) {
    echo "  ✗ Database error: " . $e->getMessage() . "\n";
}

echo "\n3. Testing Repository:\n";
try {
    $repo = new \App\Repositories\Admin\Driver\DriverDistanceTierRepository(new \App\Models\DriverDistanceTier());
    echo "  ✓ DriverDistanceTierRepository - OK\n";
    
    // Test getList method
    $list = $repo->getList();
    echo "  ✓ Repository getList() - OK (found " . $list->count() . " items)\n";
    
} catch (Exception $e) {
    echo "  ✗ Repository error: " . $e->getMessage() . "\n";
}

echo "\n4. Testing Service:\n";
try {
    $service = new \App\Services\Admin\Driver\DriverDistanceTierService(
        new \App\Repositories\Admin\Driver\DriverDistanceTierRepository(new \App\Models\DriverDistanceTier())
    );
    echo "  ✓ DriverDistanceTierService - OK\n";
    
    // Test getList method
    $list = $service->getList();
    echo "  ✓ Service getList() - OK (found " . $list->count() . " items)\n";
    
} catch (Exception $e) {
    echo "  ✗ Service error: " . $e->getMessage() . "\n";
}

echo "\n5. Testing Controller:\n";
try {
    $controller = new \App\Http\Controllers\Admin\Driver\DriverDistanceTierController(
        new \App\Services\Admin\Driver\DriverDistanceTierService(
            new \App\Repositories\Admin\Driver\DriverDistanceTierRepository(new \App\Models\DriverDistanceTier())
        )
    );
    echo "  ✓ DriverDistanceTierController - OK\n";
    
} catch (Exception $e) {
    echo "  ✗ Controller error: " . $e->getMessage() . "\n";
}

echo "\n6. Testing Routes:\n";
try {
    $routes = [
        'admin.driver.distance-tiers.index',
        'admin.driver.pricing-rules.index',
        'admin.driver.pricing-tiers.index'
    ];
    
    foreach ($routes as $routeName) {
        try {
            $url = route($routeName);
            echo "  ✓ {$routeName} → {$url}\n";
        } catch (Exception $e) {
            echo "  ✗ {$routeName} → ERROR: " . $e->getMessage() . "\n";
        }
    }
} catch (Exception $e) {
    echo "  ✗ Routes error: " . $e->getMessage() . "\n";
}

echo "\n=== QUICK FIXES ===\n";
echo "If you see errors above, try these commands:\n\n";

echo "1. Run migrations:\n";
echo "   php artisan migrate\n\n";

echo "2. Run seeder:\n";
echo "   php artisan db:seed --class=PricingSeeder\n\n";

echo "3. Clear caches:\n";
echo "   php artisan route:clear\n";
echo "   php artisan config:clear\n";
echo "   php artisan view:clear\n\n";

echo "4. Dump autoload:\n";
echo "   composer dump-autoload\n\n";

echo "5. Check permissions:\n";
echo "   Make sure your user has 'access_driver_services' permission\n\n";

echo "Test completed!\n";
?>
