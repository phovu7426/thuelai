{{-- Form cho Roles Modal --}}
@csrf

<div class="row g-3">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="title" class="form-label">
                <i class="bi bi-person-badge"></i> Ý nghĩa vai trò <span class="text-danger">*</span>
            </label>
            <input type="text" name="title" id="title" class="form-control"
                   placeholder="Nhập ý nghĩa vai trò..."
                   value="{{ $data['title'] ?? old('title') }}"
                   required>
            <div class="invalid-feedback" id="titleError"></div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <label for="name" class="form-label">
                <i class="bi bi-code-slash"></i> Tên vai trò <span class="text-danger">*</span>
            </label>
            <input type="text" name="name" id="name" class="form-control"
                   placeholder="Nhập tên vai trò (ví dụ: admin, user)..."
                   value="{{ $data['name'] ?? old('name') }}"
                   required>
            <div class="invalid-feedback" id="nameError"></div>
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
                      placeholder="Nhập mô tả vai trò...">{{ $data['description'] ?? old('description') }}</textarea>
            <div class="invalid-feedback" id="descriptionError"></div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label">
                <i class="bi bi-shield-check"></i> Quyền hạn
            </label>
            <div class="row">
                @foreach($permissions ?? [] as $permission)
                    <div class="col-md-4 mb-2">
                        <div class="form-check">
                            <input type="checkbox" name="permissions[]" 
                                   id="permission_{{ $permission->id }}" 
                                   class="form-check-input" 
                                   value="{{ $permission->id }}"
                                   {{ in_array($permission->id, $data['permissions'] ?? []) ? 'checked' : '' }}>
                            <label class="form-check-label" for="permission_{{ $permission->id }}">
                                {{ $permission->title ?? $permission->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="invalid-feedback" id="permissionsError"></div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="mb-3">
            <div class="form-check">
                <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1"
                       {{ ($data['is_active'] ?? old('is_active', true)) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                    <i class="bi bi-toggle-on"></i> Kích hoạt
                </label>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <div class="form-check">
                <input type="checkbox" name="is_system" id="is_system" class="form-check-input" value="1"
                       {{ ($data['is_system'] ?? old('is_system')) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_system">
                    <i class="bi bi-gear"></i> Vai trò hệ thống
                </label>
            </div>
        </div>
    </div>
</div>

{{-- Script để xử lý form --}}
<script>
$(document).ready(function() {
    // Auto-generate name from title
    $('#title').on('input', function() {
        const title = $(this).val();
        if (title && !$('#name').val()) {
            const name = title.toLowerCase()
                .replace(/[^a-z0-9\s]/g, '')
                .replace(/\s+/g, '_');
            $('#name').val(name);
        }
    });
    
    // Validate permissions
    $('input[name="permissions[]"]').on('change', function() {
        const checkedPermissions = $('input[name="permissions[]"]:checked').length;
        if (checkedPermissions === 0) {
            $('#permissionsError').text('Vui lòng chọn ít nhất một quyền');
            $(this).closest('.form-check').addClass('is-invalid');
        } else {
            $('#permissionsError').text('');
            $('.form-check').removeClass('is-invalid');
        }
    });
});
</script>
