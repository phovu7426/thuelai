# Hướng dẫn sử dụng Admin Pricing System

## 3 Menu chính đã được làm động

### 1. 📏 **Khoảng cách** (`/admin/driver/distance-tiers`)
**Chức năng**: Quản lý các khoảng cách cho bảng giá

**Các thao tác có thể thực hiện**:
- ✅ **Xem danh sách**: Hiển thị tất cả khoảng cách đã tạo
- ✅ **Thêm mới**: Tạo khoảng cách mới (VD: 5km đầu, 6-10km, >10km)
- ✅ **Chỉnh sửa**: Cập nhật thông tin khoảng cách
- ✅ **Xóa**: Xóa khoảng cách không cần thiết
- ✅ **Bật/tắt trạng thái**: Active/Inactive
- ✅ **Đánh dấu nổi bật**: Featured/Normal

**Dữ liệu quản lý**:
- Tên khoảng cách (VD: "5km đầu")
- Khoảng cách từ-đến (VD: 0-5km)
- Text hiển thị (VD: "5km đầu")
- Mô tả chi tiết
- Thứ tự sắp xếp

### 2. 📊 **Quy tắc giá** (`/admin/driver/pricing-rules`)
**Chức năng**: Quản lý quy tắc giá theo thời gian

**Các thao tác có thể thực hiện**:
- ✅ **Xem danh sách**: Hiển thị bảng giá theo thời gian
- ✅ **Thêm mới**: Tạo quy tắc giá mới (VD: Trước 22h, 22h-24h)
- ✅ **Chỉnh sửa**: Cập nhật giá cho từng khoảng cách
- ✅ **Xóa**: Xóa quy tắc không cần thiết
- ✅ **Bật/tắt trạng thái**: Active/Inactive
- ✅ **Đánh dấu nổi bật**: Featured/Normal

**Dữ liệu quản lý**:
- Khung thời gian (VD: "Trước 22h")
- Icon hiển thị (FontAwesome)
- Màu sắc icon
- Giá cho từng khoảng cách
- Thứ tự sắp xếp

### 3. 💰 **Giá theo khoảng cách** (`/admin/driver/pricing-tiers`)
**Chức năng**: Quản lý giá linh hoạt theo khoảng cách và thời gian

**Các thao tác có thể thực hiện**:
- ✅ **Xem danh sách**: Hiển thị giá theo nhóm thời gian
- ✅ **Thêm mới**: Tạo mức giá mới
- ✅ **Chỉnh sửa**: Cập nhật giá cụ thể
- ✅ **Xóa**: Xóa mức giá
- ✅ **Bật/tắt trạng thái**: Active/Inactive
- ✅ **Đánh dấu nổi bật**: Featured/Normal

**Dữ liệu quản lý**:
- Khung thời gian
- Khoảng cách áp dụng
- Loại giá (cố định/theo km)
- Giá cụ thể
- Mô tả

## Workflow sử dụng

### Bước 1: Tạo khoảng cách
1. Vào **Khoảng cách** → Click "Thêm khoảng cách mới"
2. Điền thông tin:
   - Tên: "5km đầu"
   - Từ: 0km, Đến: 5km
   - Text hiển thị: "5km đầu"
   - Mô tả: "Khoảng cách từ 0 đến 5km"

### Bước 2: Tạo quy tắc giá
1. Vào **Quy tắc giá** → Click "Thêm quy tắc mới"
2. Điền thông tin:
   - Thời gian: "Trước 22h"
   - Icon: "fas fa-sun"
   - Màu: "#f59e0b"
   - Giá cho từng khoảng cách

### Bước 3: Tạo giá linh hoạt (tùy chọn)
1. Vào **Giá theo khoảng cách** → Click "Thêm mức giá mới"
2. Tạo giá chi tiết cho từng trường hợp cụ thể

## Giao diện đã được cải thiện

### ✨ **Thiết kế mới**:
- Header gradient xanh hiện đại
- Table styling chuyên nghiệp
- Action buttons với hover effects
- Empty state đẹp mắt
- Responsive design

### 🎨 **Màu sắc**:
- Header: Dark gradient
- Table headers: Primary gradient
- Action buttons: Gradient colors
- Status badges: Color-coded

## Dữ liệu mẫu có sẵn

Sau khi chạy seeder, bạn sẽ có:

### Khoảng cách:
- 5km đầu (0-5km)
- 6-10km (6-10km)
- >10km (11-30km)
- >30km (31km+)

### Quy tắc giá:
- Trước 22h: 245k, +20k/km, +15k/km, Thỏa thuận
- 22h-24h: 260k, +25k/km, +20k/km, Thỏa thuận
- Sau 24h: 299k, +20k/km, +20k/km, Thỏa thuận

## Tính năng nâng cao

### 🔄 **AJAX Operations**:
- Toggle status không reload trang
- Toggle featured không reload trang
- Delete với confirmation
- Real-time updates

### 📱 **Responsive**:
- Mobile-friendly tables
- Touch-friendly buttons
- Optimized for tablets

### 🔍 **Search & Filter**:
- Tìm kiếm theo tên
- Lọc theo trạng thái
- Sắp xếp theo thứ tự

## Troubleshooting

### Nếu không thấy dữ liệu:
```bash
php artisan db:seed --class=PricingSeeder
```

### Nếu lỗi permission:
Đảm bảo user có quyền `access_driver_services`

### Nếu lỗi 404:
Kiểm tra routes trong `routes/admin.php`
