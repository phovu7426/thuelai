# Hướng dẫn sử dụng Modal cho Admin Panel

## Tổng quan
Đã tạo modal cho 3 menu chính trong Admin Panel:
1. **Quản lý dịch vụ** (Driver Services)
2. **Quy tắc giá** (Driver Pricing Rules) 
3. **Đánh giá khách hàng** (Testimonials)

## 1. Quản lý dịch vụ (Driver Services)

### File đã tạo:
- `resources/views/admin/driver/services/form.blade.php` - Form cho modal
- Đã cập nhật `resources/views/admin/driver/services/index.blade.php` để sử dụng modal

### Tính năng:
- ✅ Thêm mới dịch vụ
- ✅ Chỉnh sửa dịch vụ
- ✅ Upload ảnh và icon
- ✅ Quản lý trạng thái và nổi bật
- ✅ Sắp xếp thứ tự

### Cách sử dụng:
1. Click nút "Thêm dịch vụ" để mở modal thêm mới
2. Click nút "Sửa" (biểu tượng edit) để mở modal chỉnh sửa
3. Modal sẽ tự động load dữ liệu khi chỉnh sửa

## 2. Quy tắc giá (Driver Pricing Rules)

### File đã tạo:
- `resources/views/admin/driver/pricing-rules/form.blade.php` - Form cho modal

### Tính năng:
- ✅ Thêm mới quy tắc giá
- ✅ Chỉnh sửa quy tắc giá
- ✅ Hỗ trợ 3 loại: Theo khoảng cách, Theo thời gian, Đặc biệt
- ✅ Quản lý giá cơ bản và giá theo đơn vị
- ✅ Quản lý trạng thái và mặc định

### Cách sử dụng:
1. Cần cập nhật file index tương ứng để sử dụng modal
2. Modal sẽ tự động ẩn/hiện các trường phù hợp với loại quy tắc

## 3. Đánh giá khách hàng (Testimonials)

### File đã tạo:
- `resources/views/admin/driver/testimonials/form.blade.php` - Form cho modal

### Tính năng:
- ✅ Thêm mới đánh giá
- ✅ Chỉnh sửa đánh giá
- ✅ Hỗ trợ đánh giá từ 1-5 sao
- ✅ Upload ảnh đại diện khách hàng
- ✅ Quản lý trạng thái và nổi bật
- ✅ Xác minh mua hàng

### Cách sử dụng:
1. Cần cập nhật file index tương ứng để sử dụng modal
2. Modal sẽ tự động tạo tiêu đề từ nội dung đánh giá

## Cài đặt cần thiết

### 1. CSS và JS:
```html
<!-- Trong layout admin -->
<link rel="stylesheet" href="{{ asset('css/admin/universal-modal.css') }}">
<script src="{{ asset('js/admin/universal-modal.js') }}"></script>
```

### 2. Khởi tạo Modal:
```javascript
// Khởi tạo Universal Modal
waitForJQuery(function() {
    if (!window.yourModalName) {
        window.yourModalName = new UniversalModal({
            modalId: 'yourModalId',
            modalTitle: 'Tiêu đề Modal',
            formId: 'yourFormId',
            submitBtnId: 'yourSubmitBtnId',
            createRoute: '{{ route("your.create.route") }}',
            updateRoute: '{{ route("your.update.route", ":id") }}',
            getDataRoute: '{{ route("your.show.route", ":id") }}',
            viewPath: 'your.view.path',
            viewData: {},
            onSuccess: function(response, isEdit, id) {
                setTimeout(() => {
                    location.reload();
                }, 1500);
            }
        });
    }
});
```

### 3. Functions để gọi Modal:
```javascript
// Mở modal thêm mới
function openCreateModal() {
    if (window.yourModalName) {
        window.yourModalName.openCreateModal();
    }
}

// Mở modal chỉnh sửa
function openEditModal(id) {
    if (window.yourModalName) {
        window.yourModalName.openEditModal(id);
    }
}
```

## Lưu ý quan trọng

1. **Controller cần có method `show()`**: Tất cả controller sử dụng modal phải có method `show()` trả về JSON
2. **Routes phải đúng**: Đảm bảo các route create, update, show đã được định nghĩa
3. **View path phải chính xác**: Sử dụng dot notation (ví dụ: `admin.driver.services.form`)
4. **CSRF Token**: Form phải có `@csrf` directive
5. **File upload**: Nếu có upload file, cần xử lý trong controller

## Troubleshooting

### Lỗi thường gặp:
1. **Modal không hiển thị**: Kiểm tra console, đảm bảo jQuery và UniversalModal đã load
2. **Form không submit**: Kiểm tra CSRF token và route
3. **Dữ liệu không load**: Kiểm tra method `show()` trong controller
4. **File không upload**: Kiểm tra enctype="multipart/form-data" và xử lý trong controller

### Debug:
- Sử dụng `console.log()` để kiểm tra dữ liệu
- Kiểm tra Network tab trong DevTools
- Kiểm tra Laravel logs (`storage/logs/laravel.log`)

## Kết luận

Với việc sử dụng Universal Modal, bạn có thể:
- ✅ Tạo giao diện thống nhất cho tất cả form
- ✅ Giảm thời gian phát triển
- ✅ Dễ dàng bảo trì và cập nhật
- ✅ Trải nghiệm người dùng tốt hơn

Hãy áp dụng tương tự cho các menu khác trong Admin Panel!
