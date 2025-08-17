{{-- Form cho Permissions Modal --}}
@csrf

<div class="row g-3">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="title" class="form-label">
                <i class="bi bi-shield"></i> Ý nghĩa quyền <span class="text-danger">*</span>
            </label>
            <input type="text" name="title" id="title" class="form-control"
                   placeholder="Nhập ý nghĩa quyền..."
                   value="{{ isset($data['title']) ? $data['title'] : old('title') }}"
                   required>
            <div class="invalid-feedback" id="titleError"></div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <label for="name" class="form-label">
                <i class="bi bi-code-slash"></i> Tên quyền <span class="text-danger">*</span>
            </label>
            <input type="text" name="name" id="name" class="form-control"
                   placeholder="Nhập tên quyền (ví dụ: access_users)..."
                   value="{{ isset($data['name']) ? $data['name'] : old('name') }}"
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
                      placeholder="Nhập mô tả quyền...">{{ isset($data['description']) ? $data['description'] : old('description') }}</textarea>
            <div class="invalid-feedback" id="descriptionError"></div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="parent_id" class="form-label">
                <i class="bi bi-diagram-3"></i> Quyền cha
            </label>
            <select name="parent_id" id="parent_id" class="form-control">
                <option value="">Không có quyền cha</option>
                @foreach($permissions ?? [] as $permission)
                    @if(isset($permission['id']) && $permission['id'] != ($data['id'] ?? 0))
                        <option value="{{ $permission['id'] }}" 
                                {{ (isset($data['parent_id']) ? $data['parent_id'] : old('parent_id')) == $permission['id'] ? 'selected' : '' }}>
                            {{ $permission['title'] ?? '' }}
                        </option>
                    @endif
                @endforeach
            </select>
            <div class="invalid-feedback" id="parent_idError"></div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <label for="guard_name" class="form-label">
                <i class="bi bi-shield-lock"></i> Guard
            </label>
            <select name="guard_name" id="guard_name" class="form-control">
                <option value="web" {{ (isset($data['guard_name']) ? $data['guard_name'] : old('guard_name', 'web')) == 'web' ? 'selected' : '' }}>Web</option>
                <option value="api" {{ (isset($data['guard_name']) ? $data['guard_name'] : old('guard_name')) == 'api' ? 'selected' : '' }}>API</option>
            </select>
            <div class="invalid-feedback" id="guard_nameError"></div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="mb-3">
            <div class="form-check">
                <input type="checkbox" name="is_default" id="is_default" class="form-check-input" value="1"
                       {{ (isset($data['is_default']) ? $data['is_default'] : old('is_default')) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_default">
                    <i class="bi bi-star"></i> Quyền mặc định
                </label>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <div class="form-check">
                <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1"
                       {{ (isset($data['is_active']) ? $data['is_active'] : old('is_active', true)) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                    <i class="bi bi-toggle-on"></i> Kích hoạt
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
    
    // Validate name format
    $('#name').on('input', function() {
        const name = $(this).val();
        if (name && !/^[a-z_][a-z0-9_]*$/.test(name)) {
            $('#nameError').text('Tên quyền chỉ được chứa chữ thường, số và dấu gạch dưới, bắt đầu bằng chữ cái');
            $(this).addClass('is-invalid');
        } else {
            $('#nameError').text('');
            $(this).removeClass('is-invalid');
        }
    });
});
</script>
