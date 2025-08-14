# Chức năng Đặt hàng Dịch vụ Lái xe - ThuêLai.vn

## Tổng quan
Hệ thống đặt hàng dịch vụ lái xe được thiết kế để cung cấp trải nghiệm đặt hàng trực tuyến thuận tiện cho khách hàng và quản lý hiệu quả cho admin.

## Tính năng chính

### 1. Trang đặt hàng (Frontend)
- **URL**: `/dat-dich-vu`
- **Chức năng**:
  - Hiển thị danh sách dịch vụ lái xe
  - Chọn dịch vụ và loại dịch vụ (theo giờ/chuyến/tùy chỉnh)
  - Form đặt hàng với thông tin khách hàng
  - Tính toán giá tự động
  - Xác nhận đặt hàng

### 2. Quản lý đơn hàng (Admin)
- **URL**: `/admin/driver-orders`
- **Chức năng**:
  - Xem danh sách đơn hàng
  - Lọc theo trạng thái, dịch vụ, ngày
  - Tìm kiếm đơn hàng
  - Cập nhật trạng thái đơn hàng
  - Thêm ghi chú admin
  - Xem chi tiết đơn hàng

### 3. Dashboard thống kê (Admin)
- **URL**: `/admin/driver-dashboard`
- **Chức năng**:
  - Thống kê tổng quan
  - Biểu đồ doanh thu
  - Đơn hàng theo dịch vụ
  - Thống kê theo thời gian

## Cấu trúc Database

### Bảng `driver_services`
- `id`: ID dịch vụ
- `name`: Tên dịch vụ
- `slug`: URL slug
- `description`: Mô tả chi tiết
- `short_description`: Mô tả ngắn
- `image`: Hình ảnh dịch vụ
- `icon`: Icon FontAwesome
- `price_per_hour`: Giá theo giờ
- `price_per_trip`: Giá theo chuyến
- `is_featured`: Dịch vụ nổi bật
- `status`: Trạng thái hoạt động
- `sort_order`: Thứ tự sắp xếp

### Bảng `driver_orders`
- `id`: ID đơn hàng
- `order_number`: Mã đơn hàng
- `user_id`: ID người dùng (nếu đã đăng nhập)
- `customer_name`: Tên khách hàng
- `customer_phone`: Số điện thoại
- `customer_email`: Email
- `driver_service_id`: ID dịch vụ
- `service_type`: Loại dịch vụ (hourly/trip/custom)
- `pickup_datetime`: Thời gian đón
- `pickup_location`: Địa điểm đón
- `destination`: Điểm đến
- `hours`: Số giờ (nếu theo giờ)
- `total_amount`: Tổng tiền
- `special_requirements`: Yêu cầu đặc biệt
- `status`: Trạng thái đơn hàng
- `admin_notes`: Ghi chú từ admin

## Trạng thái đơn hàng

1. **pending**: Chờ xác nhận
2. **confirmed**: Đã xác nhận
3. **in_progress**: Đang thực hiện
4. **completed**: Hoàn thành
5. **cancelled**: Đã hủy

## Cách sử dụng

### 1. Khách hàng đặt hàng
1. Truy cập trang `/dat-dich-vu`
2. Chọn dịch vụ phù hợp
3. Điền thông tin cá nhân
4. Chọn loại dịch vụ và thời gian
5. Xác nhận đặt hàng

### 2. Admin quản lý
1. Truy cập `/admin/driver-orders`
2. Xem danh sách đơn hàng
3. Cập nhật trạng thái theo tiến trình
4. Thêm ghi chú khi cần thiết

### 3. Chạy seeder
```bash
php artisan db:seed --class=DriverServiceSeeder
```

## API Endpoints

### Frontend
- `POST /dat-dich-vu`: Đặt dịch vụ
- `GET /don-hang/{id}`: Xem chi tiết đơn hàng (yêu cầu đăng nhập)

### Admin
- `GET /admin/driver-orders`: Danh sách đơn hàng
- `GET /admin/driver-orders/{id}`: Chi tiết đơn hàng
- `PUT /admin/driver-orders/{id}`: Cập nhật đơn hàng
- `PATCH /admin/driver-orders/{id}/status`: Cập nhật trạng thái
- `PATCH /admin/driver-orders/{id}/note`: Thêm ghi chú

## Tùy chỉnh

### 1. Thêm dịch vụ mới
1. Thêm vào bảng `driver_services`
2. Cập nhật seeder nếu cần
3. Thêm hình ảnh vào `public/images/driver-services/`

### 2. Thay đổi giá
- Cập nhật trực tiếp trong database
- Hoặc tạo giao diện admin để quản lý giá

### 3. Thêm trạng thái mới
1. Cập nhật migration
2. Cập nhật controller
3. Cập nhật view

## Bảo mật

- CSRF protection cho tất cả form
- Validation dữ liệu đầu vào
- Kiểm tra quyền truy cập admin
- Sanitize dữ liệu trước khi lưu

## Troubleshooting

### 1. Lỗi "Class not found"
- Chạy `composer dump-autoload`
- Kiểm tra namespace trong controller

### 2. Lỗi database
- Chạy `php artisan migrate:fresh --seed`
- Kiểm tra kết nối database

### 3. Lỗi route
- Chạy `php artisan route:clear`
- Kiểm tra file routes

## Hỗ trợ

Nếu gặp vấn đề, vui lòng:
1. Kiểm tra log trong `storage/logs/laravel.log`
2. Kiểm tra quyền truy cập file
3. Kiểm tra cấu hình database
4. Liên hệ team phát triển

## Phiên bản

- **Version**: 1.0.0
- **Laravel**: 10.x
- **PHP**: 8.1+
- **Database**: MySQL 8.0+

