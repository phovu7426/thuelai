# Universal Modal Component

## Tổng quan
Universal Modal là một component tổng quát có thể tái sử dụng cho tất cả các menu trong admin panel. Component này cho phép tạo modal thêm mới và chỉnh sửa một cách linh hoạt thông qua cấu hình.

## Tính năng chính

### ✅ Đã hỗ trợ
- **Modal động**: Tạo modal dựa trên cấu hình
- **Load từ View**: Tải giao diện từ file Blade template
- **Validation**: Tự động hiển thị lỗi validation từ server
- **Loading states**: Spinner khi submit
- **Responsive**: Tương thích mobile
- **Custom callbacks**: Xử lý logic sau khi thành công
- **Auto-reload**: Tự động reload trang hoặc custom logic

### 🚀 Tính năng nâng cao
- **Dynamic options**: Load options cho select từ server
- **Field groups**: Nhóm các field liên quan
- **Custom styling**: CSS linh hoạt
- **Accessibility**: Hỗ trợ keyboard navigation
- **Error handling**: Xử lý lỗi toàn diện

## Cách sử dụng

### 1. Include files
```html
<!-- CSS -->
<link rel="stylesheet" href="{{ asset('css/admin/universal-modal.css') }}">

<!-- JavaScript -->
<script src="{{ asset('js/admin/universal-modal.js') }}"></script>
```

### 2. Khởi tạo modal

```javascript
const myModal = new UniversalModal({
    modalId: 'myModal',
    modalTitle: 'Tên Modal',
    formId: 'myForm',
    submitBtnId: 'mySubmitBtn',
    createRoute: '/admin/my-route/store',
    updateRoute: '/admin/my-route/update/:id',
    getDataRoute: '/admin/my-route/get-data/:id',
    viewPath: 'admin.my-route.form',
    viewData: {
        // Dữ liệu truyền vào view
        options: [],
        settings: {}
    },
    onSuccess: function(response, isEdit, id) {
        // Custom logic sau khi thành công
    }
});
```

### 3. Gọi modal từ HTML
```html
<!-- Thêm mới -->
<button onclick="myModal.openCreateModal()">Thêm mới</button>

<!-- Chỉnh sửa -->
<button onclick="myModal.openEditModal(id)">Chỉnh sửa</button>
```

## Cấu hình View

### Cấu trúc view cơ bản
Universal Modal sử dụng file Blade template để hiển thị form. Bạn cần tạo file view với cấu trúc sau:

```blade
{{-- resources/views/admin/my-route/form.blade.php --}}
@csrf

<div class="row g-3">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" name="name" id="name" class="form-control" 
                   value="{{ $data['name'] ?? '' }}" required>
            <div class="invalid-feedback" id="nameError"></div>
        </div>
    </div>
    <!-- Thêm các field khác... -->
</div>
```

### Dữ liệu có sẵn trong view
- `$data`: Dữ liệu từ server (khi edit)
- `$isEdit`: Boolean cho biết đang ở chế độ edit hay create
- `$mode`: 'create' hoặc 'edit'
- `$id`: ID của record (khi edit)
- Các dữ liệu khác từ `viewData` config

## Ví dụ thực tế

### 1. Modal cho Users
```javascript
const usersModal = new UniversalModal({
    modalId: 'usersModal',
    modalTitle: 'Tài khoản',
    createRoute: '/admin/users/store',
    updateRoute: '/admin/users/update/:id',
    getDataRoute: '/admin/users/get-user-info/:id',
    viewPath: 'admin.users.form',
    viewData: {
        roles: rolesData,
        permissions: permissionsData
    }
});
```

**File view:** `resources/views/admin/users/form.blade.php`
```blade
@csrf
<div class="row g-3">
    <div class="col-md-6">
        <label for="name">Tên</label>
        <input type="text" name="name" class="form-control" value="{{ $data['name'] ?? '' }}">
    </div>
    <div class="col-md-6">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" value="{{ $data['email'] ?? '' }}">
    </div>
    <!-- Thêm các field khác... -->
</div>
```

### 2. Modal cho Categories
```javascript
const categoriesModal = new UniversalModal({
    modalId: 'categoriesModal',
    modalTitle: 'Danh mục',
    createRoute: '/admin/categories/store',
    updateRoute: '/admin/categories/update/:id',
    getDataRoute: '/admin/categories/get-category-info/:id',
    viewPath: 'admin.categories.form',
    viewData: {
        categories: categoriesData,
        parentCategories: parentCategoriesData
    }
});
```

**File view:** `resources/views/admin/categories/form.blade.php`
```blade
@csrf
<div class="row g-3">
    <div class="col-md-8">
        <label for="name">Tên danh mục</label>
        <input type="text" name="name" class="form-control" value="{{ $data['name'] ?? '' }}">
    </div>
    <div class="col-md-4">
        <label for="slug">Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ $data['slug'] ?? '' }}">
    </div>
    <!-- Thêm các field khác... -->
</div>
```

## API Endpoints cần thiết

### 1. Create endpoint
```
POST /admin/your-route/store
Body: { field1, field2, ... }
Response: { success: true, message: "Thêm mới thành công" }
```

### 2. Update endpoint
```
POST /admin/your-route/update/{id}
Body: { field1, field2, ... }
Response: { success: true, message: "Cập nhật thành công" }
```

### 3. Get data endpoint
```
GET /admin/your-route/get-data/{id}
Response: { success: true, data: { id, field1, field2, ... } }
```

## Callbacks và Events

### onSuccess callback
```javascript
onSuccess: function(response, isEdit, id) {
    // response: Response từ server
    // isEdit: true nếu là edit, false nếu là create
    // id: ID của record (nếu edit)
    
    if (isEdit) {
        // Logic cho edit
        updateTableRow(id, response.data);
    } else {
        // Logic cho create
        addTableRow(response.data);
    }
}
```

### Custom validation
```javascript
// Có thể thêm validation client-side
beforeSubmit: function(formData) {
    // Kiểm tra và return false nếu có lỗi
    if (!formData.get('required_field')) {
        this.showAlert('error', 'Field này là bắt buộc');
        return false;
    }
    return true;
}
```

## Styling và Customization

### CSS Variables
```css
:root {
    --modal-primary-color: #667eea;
    --modal-secondary-color: #764ba2;
    --modal-success-color: #28a745;
    --modal-danger-color: #dc3545;
}
```

### Custom themes
```javascript
// Có thể thay đổi theme
modal.updateConfig({
    theme: 'dark', // hoặc 'light'
    primaryColor: '#your-color'
});
```

## Troubleshooting

### Modal không mở
- Kiểm tra console errors
- Đảm bảo Bootstrap JS đã load
- Kiểm tra modalId không trùng lặp

### Form không submit
- Kiểm tra route có đúng không
- Đảm bảo CSRF token
- Kiểm tra validation rules

### Styling không đúng
- Clear browser cache
- Kiểm tra CSS specificity
- Đảm bảo file CSS đã load

## Best Practices

### 1. Naming convention
```javascript
// Sử dụng prefix cho modal ID
modalId: 'usersModal',        // Thay vì 'modal'
formId: 'usersForm',          // Thay vì 'form'
```

### 2. Route naming
```javascript
// Sử dụng RESTful routes
createRoute: '/admin/users/store',
updateRoute: '/admin/users/update/:id',
getDataRoute: '/admin/users/get-user-info/:id'
```

### 3. View organization
```blade
{{-- Sắp xếp form logic trong view --}}
<div class="row g-3">
    {{-- Thông tin cơ bản --}}
    <div class="col-md-6">
        <label for="name">Tên</label>
        <input type="text" name="name" class="form-control">
    </div>
    
    {{-- Thông tin bổ sung --}}
    <div class="col-md-12">
        <label for="description">Mô tả</label>
        <textarea name="description" class="form-control"></textarea>
    </div>
    
    {{-- Cài đặt --}}
    <div class="col-md-6">
        <div class="form-check">
            <input type="checkbox" name="is_active" class="form-check-input">
            <label class="form-check-label">Hoạt động</label>
        </div>
    </div>
</div>
```

## Tương lai

### Tính năng sắp tới
- [ ] Drag & drop file upload
- [ ] Rich text editor
- [ ] Date picker với calendar
- [ ] Multi-select với search
- [ ] Form wizard (nhiều bước)
- [ ] Auto-save draft
- [ ] Form templates
- [ ] Bulk operations
- [ ] Export/import data
- [ ] Real-time validation
