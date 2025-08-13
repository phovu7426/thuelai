# Website Dịch Vụ Tài Xế Thuê Lái

## Tổng Quan
Website này đã được chuyển đổi từ website về đá tự nhiên (thanh tung stone) thành website dịch vụ tài xế thuê lái, tương tự như thuelai.vn.

## Các Trang Đã Hoàn Thành

### 1. Trang Chủ (`/`)
- **File**: `resources/views/driver/home.blade.php`
- **Tính năng**:
  - Banner chính với hình ảnh lái xe an toàn
  - Giới thiệu nhanh dịch vụ
  - Các gói dịch vụ (card/icon)
  - Lợi ích nổi bật
  - Phản hồi khách hàng (testimonials)
  - Quy trình đặt tài xế (4 bước)
  - Bảng giá nổi bật
  - Thông tin liên hệ nhanh
  - Form đặt dịch vụ nhanh

### 2. Trang Dịch Vụ (`/dich-vu`)
- **File**: `resources/views/driver/services.blade.php`
- **Tính năng**:
  - Danh sách dịch vụ chi tiết
  - Hình ảnh và mô tả
  - Giá cả và nút "Đặt ngay"
  - Phân trang

### 3. Trang Bảng Giá (`/bang-gia`)
- **File**: `resources/views/driver/pricing.blade.php`
- **Tính năng**:
  - Bảng giá chi tiết theo loại dịch vụ
  - Giá theo giờ và theo chuyến
  - Thông tin phụ phí
  - Gói dịch vụ nổi bật
  - Thông tin bổ sung (giờ làm việc, khu vực phục vụ)

### 4. Trang Tin Tức (`/tin-tuc`)
- **File**: `resources/views/driver/news.blade.php`
- **Tính năng**:
  - Danh sách bài viết với hình ảnh
  - Bộ lọc theo danh mục
  - Sidebar với bài viết phổ biến
  - Danh mục và số lượng bài viết
  - Phân trang

### 5. Trang Chi Tiết Tin Tức (`/tin-tuc/{slug}`)
- **File**: `resources/views/driver/news-detail.blade.php`
- **Tính năng**:
  - Hiển thị bài viết chi tiết
  - Meta tags và SEO
  - Nút chia sẻ mạng xã hội
  - Bài viết liên quan
  - Tính thời gian đọc

### 6. Trang Giới Thiệu (`/gioi-thieu`)
- **File**: `resources/views/driver/about.blade.php`
- **Tính năng**:
  - Câu chuyện công ty
  - Sứ mệnh và tầm nhìn
  - Giá trị cốt lõi
  - Đội ngũ nhân viên
  - Văn phòng và cơ sở
  - Thống kê thành tựu
  - Cam kết chất lượng

### 7. Trang Liên Hệ (`/lien-he`)
- **File**: `resources/views/driver/contact.blade.php`
- **Tính năng**:
  - Form liên hệ với validation
  - Thông tin công ty
  - Giờ làm việc
  - Mã QR liên hệ
  - Bản đồ Google Maps (placeholder)
  - Liên hệ khẩn cấp

## Cấu Trúc Backend

### Models
- **`DriverService`**: Quản lý các dịch vụ tài xế
- **`DriverOrder`**: Quản lý đơn hàng đặt dịch vụ
- **`Testimonial`**: Quản lý phản hồi khách hàng

### Controllers
- **`HomeController`**: Xử lý các trang chính
- **`OrderController`**: Xử lý đặt dịch vụ
- **`ContactController`**: Xử lý form liên hệ

### Routes
- **File**: `routes/driver.php`
- **Prefix**: `driver.`
- **Middleware**: Auth cho một số route bảo vệ

### Database Migrations
- **`driver_services`**: Bảng dịch vụ
- **`driver_orders`**: Bảng đơn hàng
- **`testimonials`**: Bảng phản hồi

## Giao Diện và Styling

### Layout
- **File**: `resources/views/driver/layouts/main.blade.php`
- Responsive design với Bootstrap 5
- Header với navigation động
- Footer với thông tin liên hệ

### CSS
- **File**: `public/css/driver.css`
- Thiết kế hiện đại và chuyên nghiệp
- Gradient backgrounds
- Hover effects và animations
- Responsive breakpoints

### JavaScript
- **File**: `public/js/driver.js`
- Form validation
- AJAX submissions
- Smooth scrolling
- Lazy loading images
- Interactive elements

## Tính Năng Đặc Biệt

### 1. Form Validation
- Validation real-time
- Error messages tiếng Việt
- Loading states
- Success/error notifications

### 2. Responsive Design
- Mobile-first approach
- Grid layouts
- Flexible images
- Touch-friendly interactions

### 3. SEO Optimization
- Meta tags động
- Open Graph tags
- Structured data
- Clean URLs

### 4. Performance
- Lazy loading images
- Optimized CSS/JS
- Efficient database queries
- Caching strategies

## Cài Đặt và Chạy

### 1. Cài đặt dependencies
```bash
composer install
npm install
```

### 2. Cấu hình database
```bash
cp .env.example .env
# Cập nhật thông tin database trong .env
```

### 3. Chạy migrations
```bash
php artisan migrate
```

### 4. Tạo storage link
```bash
php artisan storage:link
```

### 5. Chạy website
```bash
php artisan serve
```

## Cấu Hình Cần Thiết

### 1. Database
- Tạo database mới
- Chạy migrations
- Seeder dữ liệu mẫu (nếu cần)

### 2. Storage
- Cấu hình file uploads
- Tạo symbolic link cho storage

### 3. Mail Configuration
- Cấu hình SMTP cho form liên hệ
- Tạo Mailable classes nếu cần

### 4. Google Maps
- Thêm API key cho Google Maps
- Cập nhật địa chỉ trong trang liên hệ

## Công Việc Còn Lại

### 1. Admin Panel
- Quản lý dịch vụ
- Quản lý đơn hàng
- Quản lý tin tức
- Quản lý testimonials
- Cài đặt SEO

### 2. Database Seeding
- Dữ liệu mẫu cho dịch vụ
- Dữ liệu mẫu cho tin tức
- Dữ liệu mẫu cho testimonials

### 3. Testing
- Unit tests
- Feature tests
- Browser tests

### 4. Deployment
- Production server setup
- SSL certificate
- Performance optimization
- Monitoring

## Cấu Trúc Thư Mục

```
resources/views/driver/
├── home.blade.php              # Trang chủ
├── services.blade.php          # Trang dịch vụ
├── pricing.blade.php           # Trang bảng giá
├── news.blade.php              # Trang tin tức
├── news-detail.blade.php       # Trang chi tiết tin tức
├── about.blade.php             # Trang giới thiệu
├── contact.blade.php           # Trang liên hệ
└── layouts/
    └── main.blade.php          # Layout chính

app/Http/Controllers/Driver/
├── HomeController.php          # Controller trang chính
├── OrderController.php         # Controller đặt dịch vụ
└── ContactController.php       # Controller liên hệ

app/Models/
├── DriverService.php           # Model dịch vụ
├── DriverOrder.php             # Model đơn hàng
└── Testimonial.php             # Model phản hồi

database/migrations/
├── create_driver_services_table.php
├── create_driver_orders_table.php
└── create_testimonials_table.php

public/
├── css/driver.css              # CSS chính
└── js/driver.js                # JavaScript chính
```

## Ghi Chú

- Website đã được thiết kế theo yêu cầu chi tiết của người dùng
- Sử dụng Laravel framework với kiến trúc MVC
- Giao diện responsive và thân thiện người dùng
- Code được viết theo chuẩn Laravel best practices
- Sẵn sàng cho việc phát triển thêm tính năng

## Liên Hệ

Để có thêm thông tin hoặc hỗ trợ, vui lòng liên hệ qua:
- Email: [your-email@domain.com]
- Website: [your-website.com]
