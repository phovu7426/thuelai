{{-- Form cho Users Modal --}}
@csrf

<div class="row g-3">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="name" class="form-label">
                <i class="bi bi-person"></i> Tên <span class="text-danger">*</span>
            </label>
            <input type="text" name="name" id="name" class="form-control" 
                   placeholder="Nhập tên người dùng..." 
                   value="{{ $data['name'] ?? old('name') }}" 
                   required>
            <div class="invalid-feedback" id="nameError"></div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="email" class="form-label">
                <i class="bi bi-envelope"></i> Email <span class="text-danger">*</span>
            </label>
            <input type="email" name="email" id="email" class="form-control" 
                   placeholder="Nhập email..." 
                   value="{{ $data['email'] ?? old('email') }}" 
                   required>
            <div class="invalid-feedback" id="emailError"></div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="password" class="form-label">
                <i class="bi bi-lock"></i> Mật khẩu
            </label>
            <input type="password" name="password" id="password" class="form-control" 
                   placeholder="Nhập mật khẩu...">
            <small class="form-text text-muted">
                @if($isEdit)
                    Để trống nếu không đổi mật khẩu
                @else
                    Mật khẩu phải có ít nhất 8 ký tự
                @endif
            </small>
            <div class="invalid-feedback" id="passwordError"></div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">
                <i class="bi bi-lock-fill"></i> Xác nhận mật khẩu
            </label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" 
                   placeholder="Nhập lại mật khẩu...">
            <div class="invalid-feedback" id="password_confirmationError"></div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="phone" class="form-label">
                <i class="bi bi-telephone"></i> Số điện thoại
            </label>
            <input type="tel" name="phone" id="phone" class="form-control" 
                   placeholder="Nhập số điện thoại..." 
                   value="{{ $data['phone'] ?? old('phone') }}">
            <div class="invalid-feedback" id="phoneError"></div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="status" class="form-label">
                <i class="bi bi-toggle-on"></i> Trạng thái
            </label>
            <select name="status" id="status" class="form-control">
                <option value="1" {{ ($data['status'] ?? 1) == 1 ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ ($data['status'] ?? 1) == 0 ? 'selected' : '' }}>Không hoạt động</option>
            </select>
            <div class="invalid-feedback" id="statusError"></div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="mb-3">
            <label for="address" class="form-label">
                <i class="bi bi-geo-alt"></i> Địa chỉ
            </label>
            <textarea name="address" id="address" class="form-control" 
                      placeholder="Nhập địa chỉ..." 
                      rows="3">{{ $data['address'] ?? old('address') }}</textarea>
            <div class="invalid-feedback" id="addressError"></div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="mb-3">
            <div class="form-check">
                <input type="checkbox" name="is_active" id="is_active" class="form-check-input" 
                       value="1" {{ ($data['is_active'] ?? 1) == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                    <i class="bi bi-check-circle"></i> Tài khoản hoạt động
                </label>
            </div>
            <div class="invalid-feedback" id="is_activeError"></div>
        </div>
    </div>
</div>

{{-- Script để xử lý form --}}
<script>
$(document).ready(function() {
    // Auto-generate password confirmation validation
    $('#password_confirmation').on('input', function() {
        const password = $('#password').val();
        const confirmPassword = $(this).val();
        
        if (password && confirmPassword && password !== confirmPassword) {
            $(this).addClass('is-invalid');
            $('#password_confirmationError').text('Mật khẩu xác nhận không khớp');
        } else {
            $(this).removeClass('is-invalid');
            $('#password_confirmationError').text('');
        }
    });

    // Auto-validate password confirmation when password changes
    $('#password').on('input', function() {
        const confirmPassword = $('#password_confirmation').val();
        if (confirmPassword) {
            $('#password_confirmation').trigger('input');
        }
    });

    // Phone number formatting
    $('#phone').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        if (value.length > 0) {
            if (value.startsWith('84')) {
                value = value.replace(/^84/, '0');
            }
            if (value.length > 10) {
                value = value.substring(0, 10);
            }
        }
        $(this).val(value);
    });
});
</script>
