# Hệ thống Bảng Giá Thuê Lái Xe

## Tổng quan

Hệ thống bảng giá đã được cải thiện với thiết kế hiện đại, lấy cảm hứng từ thuelai.vn, bao gồm:

### Frontend (Người dùng)

-   **URL**: `/bang-gia`
-   **Thiết kế**: Gradient background xanh dương, bảng giá trong suốt với hiệu ứng glass
-   **Tính năng**:
    -   Bảng giá responsive cho mobile, tablet, desktop
    -   Animation mượt mà khi load trang
    -   Hover effects trên các ô giá
    -   Nút CTA "Liên hệ ngay" nổi bật màu vàng
    -   Ghi chú rõ ràng về chính sách giá

### Admin (Quản lý)

-   **URL**: `/admin/driver/pricing-rules`
-   **Tính năng**:
    -   Giao diện hiện đại với gradient header
    -   Table styling chuyên nghiệp
    -   Action buttons với hover effects
    -   Status và featured badges
    -   Empty state đẹp mắt

## Cấu trúc Database

### Bảng `driver_pricing_rules`

-   `time_slot`: Khung giờ (Trước 22h, 22h-24h, Sau 24h)
-   `time_icon`: Icon FontAwesome
-   `time_color`: Màu sắc icon
-   `is_active`: Trạng thái hoạt động
-   `sort_order`: Thứ tự sắp xếp

### Bảng `driver_distance_tiers`

-   `name`: Tên khoảng cách
-   `display_text`: Text hiển thị (5km đầu, 6-10km, >10km, >30km)
-   `from_distance`, `to_distance`: Khoảng cách từ-đến
-   `is_active`: Trạng thái hoạt động

### Bảng `driver_pricing_rule_distances`

-   `pricing_rule_id`: ID quy tắc giá
-   `distance_tier_id`: ID khoảng cách
-   `price`: Giá số (VND)
-   `price_text`: Giá text ("Thỏa thuận")

## CSS Classes Mới

### Frontend

-   `.pricing-section`: Section chính với gradient background
-   `.pricing-title`: Tiêu đề lớn màu trắng
-   `.pricing-table-modern`: Container bảng với glass effect
-   `.pricing-notes`: Ghi chú màu trắng
-   `.btn-contact-now`: Nút CTA màu vàng với animation

### Admin

-   `.pricing-admin-header`: Header gradient xanh
-   `.pricing-table-admin`: Table container hiện đại
-   `.time-slot-admin`: Hiển thị thời gian với icon
-   `.price-display`: Hiển thị giá căn giữa
-   `.status-badge`, `.featured-badge`: Badges trạng thái
-   `.action-buttons-modern`: Buttons hành động
-   `.empty-state-modern`: Trạng thái rỗng đẹp

## Responsive Design

-   **Desktop**: Full layout với animations
-   **Tablet**: Điều chỉnh padding và font size
-   **Mobile**: Stack layout, touch-friendly buttons

## Animation Effects

-   `fadeInUp`: Hiệu ứng fade từ dưới lên
-   `slideInLeft`: Slide từ trái sang
-   `bounceIn`: Bounce effect cho elements quan trọng
-   `pulse`: Animation cho CTA button
-   Staggered animations cho table rows

## Hướng dẫn sử dụng

### Setup dữ liệu ban đầu

```bash
# Chạy seeder để tạo dữ liệu mẫu
php artisan db:seed --class=PricingSeeder

# Hoặc chạy tất cả seeder
php artisan db:seed
```

### Thêm quy tắc giá mới

1. Vào Admin → Driver → Pricing Rules
2. Click "Thêm quy tắc mới"
3. Điền thông tin khung giờ và giá cho từng khoảng cách
4. Save

### Cập nhật giá

1. Vào danh sách pricing rules
2. Click icon edit (màu xanh)
3. Cập nhật giá
4. Save

### Xem bảng giá frontend

-   Truy cập `/bang-gia` để xem bảng giá với thiết kế mới

## Màu sắc đã được cập nhật

-   **Primary Color**: #6366f1 (tím xanh) - phù hợp với theme chung
-   **Secondary Color**: #f59e0b (cam vàng) - cho CTA buttons
-   **Success Color**: #10b981 (xanh lá)
-   **Danger Color**: #ef4444 (đỏ)
-   **Background**: Gradient dark với overlay primary colors

## Tính năng nổi bật

-   ✅ Thiết kế responsive hoàn toàn
-   ✅ Animation mượt mà
-   ✅ Glass morphism effect
-   ✅ Gradient backgrounds
-   ✅ Hover effects
-   ✅ Touch-friendly cho mobile
-   ✅ Loading states
-   ✅ Empty states đẹp
-   ✅ Accessibility support

## Browser Support

-   Chrome 60+
-   Firefox 55+
-   Safari 12+
-   Edge 79+

## Performance

-   CSS được tối ưu với vendor prefixes
-   Animations sử dụng transform và opacity
-   Lazy loading cho heavy effects
-   Responsive images và fonts
