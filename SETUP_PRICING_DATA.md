# Hướng dẫn Setup Dữ liệu Bảng Giá

## 1. Chạy Migration (nếu chưa có)

```bash
php artisan migrate
```

## 2. Chạy Seeder để tạo dữ liệu mẫu

### Chạy tất cả seeder:
```bash
php artisan db:seed
```

### Hoặc chỉ chạy PricingSeeder:
```bash
php artisan db:seed --class=PricingSeeder
```

## 3. Dữ liệu sẽ được tạo

### Distance Tiers (Khoảng cách):
- **5km đầu**: 0-5km
- **6-10km**: 6-10km  
- **>10km**: 11-30km
- **>30km**: 31km+

### Pricing Rules (Quy tắc giá):
- **Trước 22h** (icon: sun, màu vàng)
- **22h-24h** (icon: moon, màu xanh)
- **Sau 24h** (icon: star, màu tím)

### Giá cụ thể:

#### Trước 22h:
- 5km đầu: 245k/chuyến
- 6-10km: +20k/km
- >10km: +15k/km
- >30km: Thỏa thuận

#### 22h-24h:
- 5km đầu: 260k/chuyến
- 6-10km: +25k/km
- >10km: +20k/km
- >30km: Thỏa thuận

#### Sau 24h:
- 5km đầu: 299k/chuyến
- 6-10km: +20k/km
- >10km: +20k/km
- >30km: Thỏa thuận

## 4. Kiểm tra kết quả

### Frontend:
Truy cập: `http://your-domain/bang-gia`

### Admin:
Truy cập: `http://your-domain/admin/driver/pricing-rules`

## 5. Tùy chỉnh dữ liệu

Sau khi chạy seeder, bạn có thể:
- Vào admin để chỉnh sửa giá
- Thêm/xóa quy tắc giá mới
- Thay đổi icon và màu sắc
- Cập nhật khoảng cách

## 6. Reset dữ liệu (nếu cần)

```bash
php artisan migrate:fresh --seed
```

**Lưu ý**: Lệnh này sẽ xóa toàn bộ dữ liệu và tạo lại từ đầu.

## 7. Backup dữ liệu

Trước khi chạy seeder trên production, hãy backup database:

```bash
mysqldump -u username -p database_name > backup.sql
```

## 8. Troubleshooting

### Lỗi "Class not found":
```bash
composer dump-autoload
```

### Lỗi migration:
```bash
php artisan migrate:status
php artisan migrate
```

### Lỗi permission:
Đảm bảo user có quyền truy cập database và thư mục storage.
