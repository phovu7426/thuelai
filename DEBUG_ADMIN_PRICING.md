# Debug Admin Pricing System

## 🔍 **Các bước kiểm tra lỗi**

### **Bước 1: Kiểm tra cơ bản**
```bash
# Clear cache
php artisan route:clear
php artisan config:clear
php artisan view:clear
php artisan cache:clear

# Dump autoload
composer dump-autoload

# Check routes
php artisan route:list | grep "distance-tiers\|pricing-rules\|pricing-tiers"
```

### **Bước 2: Kiểm tra database**
```bash
# Run migrations
php artisan migrate

# Check tables exist
php artisan tinker
```

Trong tinker:
```php
// Check tables
DB::select("SHOW TABLES LIKE 'driver_%'");

// Check data
\App\Models\DriverDistanceTier::count();
\App\Models\DriverPricingRule::count();
\App\Models\DriverPricingTier::count();
```

### **Bước 3: Chạy seeder**
```bash
php artisan db:seed --class=PricingSeeder
```

### **Bước 4: Test routes trực tiếp**
Truy cập các URL test tôi đã tạo:

1. **Test tổng quát**: `/admin/driver/test/pricing`
   - Kiểm tra database, models, routes, views

2. **Test Distance Tiers**: `/admin/driver/test/distance-tiers`
   - Test trực tiếp trang distance tiers

3. **Test Pricing Rules**: `/admin/driver/test/pricing-rules`
   - Test trực tiếp trang pricing rules

4. **Test Pricing Tiers**: `/admin/driver/test/pricing-tiers`
   - Test trực tiếp trang pricing tiers

### **Bước 5: Kiểm tra permissions**
Trong tinker:
```php
// Check user permissions
$user = auth()->user();
$user->can('access_driver_services');

// Or check roles
$user->roles;
```

### **Bước 6: Kiểm tra logs**
```bash
tail -f storage/logs/laravel.log
```

## 🚨 **Các lỗi thường gặp**

### **1. Lỗi 404 - Route not found**
**Nguyên nhân**: Routes chưa được load
**Giải pháp**:
```bash
php artisan route:clear
php artisan route:cache
```

### **2. Lỗi 403 - Forbidden**
**Nguyên nhân**: Không có permission
**Giải pháp**: Gán permission `access_driver_services` cho user

### **3. Lỗi 500 - Internal Server Error**
**Nguyên nhân**: Lỗi code hoặc database
**Giải pháp**: Kiểm tra logs và debug

### **4. Class not found**
**Nguyên nhân**: Autoload chưa cập nhật
**Giải pháp**:
```bash
composer dump-autoload
```

### **5. Table doesn't exist**
**Nguyên nhân**: Chưa chạy migration
**Giải pháp**:
```bash
php artisan migrate
```

## 🔧 **Debug step by step**

### **Test 1: Basic connectivity**
```php
// In tinker
try {
    $connection = \DB::connection()->getPdo();
    echo "Database: OK\n";
} catch (Exception $e) {
    echo "Database Error: " . $e->getMessage() . "\n";
}
```

### **Test 2: Models**
```php
// In tinker
try {
    $model = new \App\Models\DriverDistanceTier();
    echo "DriverDistanceTier Model: OK\n";
} catch (Exception $e) {
    echo "Model Error: " . $e->getMessage() . "\n";
}
```

### **Test 3: Controllers**
```php
// In tinker
try {
    $controller = app(\App\Http\Controllers\Admin\Driver\DriverDistanceTierController::class);
    echo "Controller: OK\n";
} catch (Exception $e) {
    echo "Controller Error: " . $e->getMessage() . "\n";
}
```

### **Test 4: Routes**
```php
// In tinker
try {
    $url = route('admin.driver.distance-tiers.index');
    echo "Route: {$url}\n";
} catch (Exception $e) {
    echo "Route Error: " . $e->getMessage() . "\n";
}
```

## 📋 **Checklist**

- [ ] Database connection OK
- [ ] Tables exist (driver_distance_tiers, driver_pricing_rules, etc.)
- [ ] Models can be instantiated
- [ ] Controllers exist and can be loaded
- [ ] Routes are registered
- [ ] Views exist
- [ ] User has correct permissions
- [ ] Seeder has run successfully
- [ ] Cache cleared

## 🎯 **Quick Fix Commands**

```bash
# Complete reset
php artisan route:clear
php artisan config:clear
php artisan view:clear
php artisan cache:clear
composer dump-autoload
php artisan migrate
php artisan db:seed --class=PricingSeeder

# Test access
curl -I http://your-domain/admin/driver/test/pricing
```

## 📞 **Nếu vẫn lỗi**

1. **Kiểm tra file logs**: `storage/logs/laravel.log`
2. **Test routes trực tiếp**: `/admin/driver/test/pricing`
3. **Kiểm tra browser console** cho JS errors
4. **Kiểm tra network tab** cho HTTP errors
5. **Test với user admin khác**

## 🔄 **Rollback nếu cần**

Nếu muốn quay lại trạng thái trước:
```bash
git checkout -- resources/views/admin/driver/
git checkout -- routes/admin.php
```

Sau đó chạy lại:
```bash
php artisan route:clear
php artisan view:clear
```
