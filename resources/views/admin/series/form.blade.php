{{-- Form cho Series Modal --}}
@csrf

<div class="row g-3">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="name" class="form-label">
                <i class="bi bi-collection"></i> Tên Series <span class="text-danger">*</span>
            </label>
            <input type="text" name="name" id="name" class="form-control"
                   placeholder="Nhập tên series..."
                   value="{{ $data['name'] ?? old('name') }}"
                   required>
            <div class="invalid-feedback" id="nameError"></div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <label for="code" class="form-label">
                <i class="bi bi-code-slash"></i> Mã Series <span class="text-danger">*</span>
            </label>
            <input type="text" name="code" id="code" class="form-control"
                   placeholder="Nhập mã series..."
                   value="{{ $data['code'] ?? old('code') }}"
                   required>
            <div class="invalid-feedback" id="codeError"></div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="description" class="form-label">
                <i class="bi bi-text-paragraph"></i> Mô tả
            </label>
            <textarea name="description" id="description" class="form-control" rows="3"
                      placeholder="Nhập mô tả series...">{{ $data['description'] ?? old('description') }}</textarea>
            <div class="invalid-feedback" id="descriptionError"></div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="status" class="form-label">
                <i class="bi bi-toggle-on"></i> Trạng thái
            </label>
            <select name="status" id="status" class="form-control">
                <option value="inactive" {{ ($data['status'] ?? old('status')) == 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
                <option value="active" {{ ($data['status'] ?? old('status')) == 'active' ? 'selected' : '' }}>Hoạt động</option>
            </select>
            <div class="invalid-feedback" id="statusError"></div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <div class="form-check">
                <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input" value="1"
                       {{ ($data['is_featured'] ?? old('is_featured')) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_featured">
                    <i class="bi bi-star"></i> Nổi bật
                </label>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="sort_order" class="form-label">
                <i class="bi bi-sort-numeric-down"></i> Thứ tự sắp xếp
            </label>
            <input type="number" name="sort_order" id="sort_order" class="form-control"
                   placeholder="Nhập thứ tự sắp xếp..."
                   value="{{ $data['sort_order'] ?? old('sort_order', 0) }}"
                   min="0">
            <div class="invalid-feedback" id="sort_orderError"></div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <label for="color" class="form-label">
                <i class="bi bi-palette"></i> Màu sắc
            </label>
            <input type="color" name="color" id="color" class="form-control form-control-color"
                   value="{{ $data['color'] ?? old('color', '#007bff') }}"
                   title="Chọn màu sắc cho series">
            <div class="invalid-feedback" id="colorError"></div>
        </div>
    </div>
</div>

{{-- Script để xử lý form --}}
<script>
$(document).ready(function() {
    // Auto-generate code from name
    $('#name').on('input', function() {
        const name = $(this).val();
        if (name && !$('#code').val()) {
            const code = name.toUpperCase()
                .replace(/[^A-Z0-9\s]/g, '')
                .replace(/\s+/g, '_');
            $('#code').val(code);
        }
    });
    
    // Validate code format
    $('#code').on('input', function() {
        const code = $(this).val();
        if (code && !/^[A-Z0-9_]+$/.test(code)) {
            $('#codeError').text('Mã series chỉ được chứa chữ hoa, số và dấu gạch dưới');
            $(this).addClass('is-invalid');
        } else {
            $('#codeError').text('');
            $(this).removeClass('is-invalid');
        }
    });
});
</script>
