{{-- Form cho Permissions Modal --}}
@csrf

@php
    $statusValue = $status ?? old('status', 'active');
    $parentIdValue = $parent_id ?? old('parent_id');
@endphp

<div class="row g-3">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="title" class="form-label">
                <i class="bi bi-shield"></i> Ý nghĩa quyền <span class="text-danger">*</span>
            </label>
            <input type="text" name="title" id="title" class="form-control"
                   placeholder="Nhập ý nghĩa quyền..."
                   value="{{ $title ?? old('title') }}"
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
                   value="{{ $name ?? old('name') }}"
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
                      placeholder="Nhập mô tả quyền...">{{ $description ?? old('description') }}</textarea>
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
            <select name="parent_id" id="parent_id" class="form-control select2"
                    data-url="{{ route('admin.permissions.autocomplete') }}"
                    data-field="id"
                    data-display-field="title"
                    data-selected='@json($parentIdValue)'>
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
                <option value="web" {{ ($guard_name ?? old('guard_name', 'web')) == 'web' ? 'selected' : '' }}>Web</option>
                <option value="api" {{ ($guard_name ?? old('guard_name')) == 'api' ? 'selected' : '' }}>API</option>
            </select>
            <div class="invalid-feedback" id="guard_nameError"></div>
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
                <option value="active" {{ ($statusValue ?? '') === 'active' ? 'selected' : '' }}>Hoạt động</option>
                <option value="inactive" {{ ($statusValue ?? '') === 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
            </select>
            <div class="invalid-feedback" id="statusError"></div>
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
