# Debug Frontend Data - Tìm nguồn dữ liệu

## 🔍 **Dữ liệu frontend đang load từ đâu?**

### **✅ Đã kiểm tra:**

1. **View `pricing.blade.php`**: ✅ Sử dụng `$pricingRules` và `$distanceTiers` từ controller
2. **Controller `HomeController::pricing()`**: ✅ Load từ database đúng cách
3. **Models**: ✅ Có relationships đầy đủ

### **❓ Vấn đề có thể là:**

1. **Chưa có dữ liệu trong database**
2. **Cache view cũ**
3. **Relationships không load đúng**
4. **Dữ liệu bị lỗi**

## 🛠️ **Các bước debug:**

### **Bước 1: Kiểm tra dữ liệu database**
```bash
php artisan tinker
```

Trong tinker:
```php
// Kiểm tra có dữ liệu không
\App\Models\DriverDistanceTier::count();
\App\Models\DriverPricingRule::count();
\App\Models\DriverPricingRuleDistance::count();

// Xem dữ liệu cụ thể
\App\Models\DriverDistanceTier::all();
\App\Models\DriverPricingRule::all();
```

### **Bước 2: Test route debug**
Truy cập: `/debug-pricing`

Sẽ hiển thị JSON với:
- `services_count`: Số lượng dịch vụ
- `pricing_rules_count`: Số lượng quy tắc giá
- `distance_tiers_count`: Số lượng khoảng cách
- Dữ liệu chi tiết của từng loại

### **Bước 3: Kiểm tra relationships**
```php
// Trong tinker
$rules = \App\Models\DriverPricingRule::with(['pricingDistances.distanceTier'])->get();
foreach($rules as $rule) {
    echo "Rule: {$rule->time_slot}\n";
    echo "Distances: {$rule->pricingDistances->count()}\n";
}
```

### **Bước 4: Test controller trực tiếp**
```php
// Trong tinker
$controller = app(\App\Http\Controllers\Driver\HomeController::class);
// Không thể gọi trực tiếp vì cần request, nhưng có thể test logic

$services = \App\Models\DriverService::where('status', true)->orderBy('sort_order')->get();
$pricingRules = \App\Models\DriverPricingRule::with(['pricingDistances.distanceTier'])->active()->ordered()->get();
$distanceTiers = \App\Models\DriverDistanceTier::active()->ordered()->get();

echo "Services: {$services->count()}\n";
echo "Rules: {$pricingRules->count()}\n";
echo "Tiers: {$distanceTiers->count()}\n";
```

## 🚨 **Các trường hợp thường gặp:**

### **Trường hợp 1: Không có dữ liệu**
**Triệu chứng**: Trang hiển thị "Chưa có bảng giá"
**Giải pháp**:
```bash
php artisan db:seed --class=QuickPricingSeeder
```

### **Trường hợp 2: Có dữ liệu nhưng không hiển thị**
**Triệu chứng**: `/debug-pricing` có dữ liệu nhưng `/bang-gia` không hiển thị
**Giải pháp**:
```bash
php artisan view:clear
php artisan route:clear
```

### **Trường hợp 3: Relationships lỗi**
**Triệu chứng**: Có rules và tiers nhưng không có prices
**Giải pháp**: Kiểm tra bảng `driver_pricing_rule_distances`

### **Trường hợp 4: Cache cũ**
**Triệu chứng**: Vẫn hiển thị dữ liệu cũ
**Giải pháp**:
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## 📊 **Cấu trúc dữ liệu mong đợi:**

### **Distance Tiers (4 records):**
```
1. 5km đầu (0-5km)
2. 6-10km (6-10km)  
3. >10km (11-30km)
4. >30km (31km+)
```

### **Pricing Rules (3 records):**
```
1. Trước 22h (fas fa-sun, #f59e0b)
2. 22h-24h (fas fa-moon, #6366f1)
3. Sau 24h (fas fa-star, #8b5cf6)
```

### **Pricing Rule Distances (12 records):**
```
3 rules × 4 tiers = 12 price entries
```

## 🔧 **Commands để fix:**

### **Reset hoàn toàn:**
```bash
# Clear all caches
php artisan route:clear
php artisan view:clear
php artisan config:clear
php artisan cache:clear

# Recreate data
php artisan db:seed --class=QuickPricingSeeder

# Test
curl -s http://your-domain/debug-pricing | jq .
```

### **Quick check:**
```bash
# Check data exists
php artisan tinker --execute="echo \App\Models\DriverPricingRule::count();"

# Check relationships
php artisan tinker --execute="echo \App\Models\DriverPricingRuleDistance::count();"
```

## 📋 **Checklist debug:**

- [ ] Chạy `/debug-pricing` - Kiểm tra có dữ liệu không
- [ ] Kiểm tra `pricing_rules_count > 0`
- [ ] Kiểm tra `distance_tiers_count > 0`
- [ ] Kiểm tra relationships có đầy đủ không
- [ ] Clear cache: `php artisan view:clear`
- [ ] Test `/bang-gia` sau khi clear cache
- [ ] Nếu vẫn lỗi, chạy seeder: `php artisan db:seed --class=QuickPricingSeeder`

## 🎯 **Kết quả mong đợi:**

Sau khi fix:
- `/debug-pricing` hiển thị đầy đủ dữ liệu JSON
- `/bang-gia` hiển thị bảng giá với 3 khung thời gian và 4 khoảng cách
- Giá hiển thị đúng: 245k, 260k, 299k cho 5km đầu
- Không còn dữ liệu hard-code

---

**Hãy chạy `/debug-pricing` trước để xem dữ liệu hiện tại như thế nào!** 🔍
