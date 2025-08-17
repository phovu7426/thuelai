# Modal Quản lý Tài khoản

## Tổng quan
Modal này được tạo để thay thế các trang riêng biệt cho việc thêm mới và chỉnh sửa tài khoản, giúp cải thiện trải nghiệm người dùng bằng cách không cần chuyển trang.

## Tính năng

### 1. Thêm mới tài khoản
- Mở modal bằng cách click nút "Thêm Tài khoản"
- Form bao gồm các trường: Tên, Email, Mật khẩu, Xác nhận mật khẩu
- Validation real-time với hiển thị lỗi
- Loading state khi submit

### 2. Chỉnh sửa tài khoản
- Mở modal bằng cách click nút "Chỉnh sửa" trong bảng
- Tự động load thông tin người dùng hiện tại
- Mật khẩu không bắt buộc (có thể để trống nếu không đổi)
- Validation và loading state

### 3. Giao diện
- Modal responsive với gradient header đẹp mắt
- Animation mượt mà khi mở/đóng
- Thông báo thành công/lỗi với auto-dismiss
- Loading spinner khi submit

## Cấu trúc file

```
resources/views/admin/users/
├── index.blade.php          # Trang danh sách với modal
├── create.blade.php         # (Cũ - không dùng nữa)
└── edit.blade.php           # (Cũ - không dùng nữa)

public/
├── css/admin/
│   └── users-modal.css      # Styling cho modal
└── js/admin/
    └── users-modal.js       # Logic xử lý modal
```

## Cách sử dụng

### 1. Thêm mới tài khoản
```html
<button type="button" class="btn btn-primary" onclick="openCreateModal()">
    <i class="bi bi-plus-circle"></i> Thêm Tài khoản
</button>
```

### 2. Chỉnh sửa tài khoản
```html
<button type="button" class="btn-action btn-edit" onclick="openEditModal(userId)">
    <i class="fas fa-edit"></i>
</button>
```

### 3. Include files
```php
@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/users-modal.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('js/admin/users-modal.js') }}"></script>
@endsection
```

## API Endpoints

### 1. Lấy thông tin user
```
GET /admin/users/get-user-info/{id}
Response: { success: true, data: { id, name, email } }
```

### 2. Tạo user mới
```
POST /admin/users/store
Body: { name, email, password, password_confirmation }
Response: { success: true, message: "Thêm mới tài khoản thành công" }
```

### 3. Cập nhật user
```
POST /admin/users/update/{id}
Body: { name, email, password?, password_confirmation? }
Response: { success: true, message: "Cập nhật tài khoản thành công" }
```

## Validation Rules

### Thêm mới
- `name`: required, string, max:255
- `email`: required, email, unique:users
- `password`: required, min:8, confirmed

### Chỉnh sửa
- `name`: required, string, max:255
- `email`: required, email, unique:users,email,{id}
- `password`: nullable, min:8, confirmed

## Styling

Modal sử dụng CSS custom với:
- Gradient header màu tím-xanh
- Animation mượt mà
- Responsive design
- Loading states
- Validation styling

## JavaScript Class

```javascript
class UsersModal {
    constructor() {
        this.isEditMode = false;
        this.init();
    }
    
    openCreateModal() { /* ... */ }
    openEditModal(userId) { /* ... */ }
    handleSubmit(e) { /* ... */ }
    showAlert(type, message) { /* ... */ }
}
```

## Lưu ý

1. **Route cần thiết**: Đảm bảo route `getUserInfo` đã được thêm vào `routes/admin.php`
2. **Controller method**: Method `getUserInfo` trong `UserController` phải trả về JSON response
3. **CSRF Token**: Form tự động include CSRF token
4. **Validation**: Sử dụng Laravel validation với AJAX response
5. **Error Handling**: Xử lý lỗi 422 (validation) và 500 (server error)

## Troubleshooting

### Modal không mở
- Kiểm tra console errors
- Đảm bảo Bootstrap JS đã load
- Kiểm tra file `users-modal.js` đã include

### Validation không hoạt động
- Kiểm tra response format từ server
- Đảm bảo field IDs khớp với validation errors
- Kiểm tra CSRF token

### Styling không đúng
- Đảm bảo file CSS đã load
- Kiểm tra CSS specificity
- Clear browser cache

## Tương lai

Có thể mở rộng modal này để:
- Thêm field upload avatar
- Tích hợp với role assignment
- Thêm field profile information
- Export/import users
- Bulk actions
