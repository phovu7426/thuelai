@extends('admin.layouts.main')

@section('title', 'Cấu hình thông tin liên hệ')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Cấu hình thông tin liên hệ</li>
@endsection

@section('content')
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white border-bottom-0">
                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-telephone me-2"></i> Cấu hình thông tin liên hệ
                            </h5>
                        </div>
                        <div class="card-body bg-white p-4">
                            <!-- Alert messages -->
                            <div id="alert-container"></div>

                            <form id="edit-contact-info-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="bi bi-geo-alt me-1"></i> Địa chỉ
                                        </label>
                                        <input type="text" name="address" id="address" class="form-control"
                                               placeholder="🏢 Nhập địa chỉ công ty..."
                                               value="{{ old('address', $contact->address ?? '') }}">
                                        <div class="invalid-feedback" id="address-error"></div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="bi bi-telephone me-1"></i> Số điện thoại
                                        </label>
                                        <input type="tel" name="phone" id="phone" class="form-control"
                                               placeholder="📞 Nhập số điện thoại..."
                                               value="{{ old('phone', $contact->phone ?? '') }}">
                                        <div class="invalid-feedback" id="phone-error"></div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="bi bi-envelope me-1"></i> Email
                                        </label>
                                        <input type="email" name="email" id="email" class="form-control"
                                               placeholder="📧 Nhập email..."
                                               value="{{ old('email', $contact->email ?? '') }}">
                                        <div class="invalid-feedback" id="email-error"></div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="bi bi-clock me-1"></i> Giờ làm việc
                                        </label>
                                        <input type="text" name="working_time" id="working_time" class="form-control"
                                               placeholder="⏰ Ví dụ: 8:00 - 17:00 (Thứ 2 - Thứ 6)"
                                               value="{{ old('working_time', $contact->working_time ?? '') }}">
                                        <div class="invalid-feedback" id="working_time-error"></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="bi bi-facebook me-1"></i> Facebook
                                        </label>
                                        <input type="url" name="facebook" id="facebook" class="form-control"
                                               placeholder="https://facebook.com/..."
                                               value="{{ old('facebook', $contact->facebook ?? '') }}">
                                        <div class="invalid-feedback" id="facebook-error"></div>
                                        <small class="form-text text-muted">Link Facebook chính thức</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="bi bi-instagram me-1"></i> Instagram
                                        </label>
                                        <input type="url" name="instagram" id="instagram" class="form-control"
                                               placeholder="https://instagram.com/..."
                                               value="{{ old('instagram', $contact->instagram ?? '') }}">
                                        <div class="invalid-feedback" id="instagram-error"></div>
                                        <small class="form-text text-muted">Link Instagram chính thức</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="bi bi-youtube me-1"></i> Youtube
                                        </label>
                                        <input type="url" name="youtube" id="youtube" class="form-control"
                                               placeholder="https://youtube.com/..."
                                               value="{{ old('youtube', $contact->youtube ?? '') }}">
                                        <div class="invalid-feedback" id="youtube-error"></div>
                                        <small class="form-text text-muted">Link Youtube chính thức</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">
                                            <i class="bi bi-linkedin me-1"></i> LinkedIn
                                        </label>
                                        <input type="url" name="linkedin" id="linkedin" class="form-control"
                                               placeholder="https://linkedin.com/..."
                                               value="{{ old('linkedin', $contact->linkedin ?? '') }}">
                                        <div class="invalid-feedback" id="linkedin-error"></div>
                                        <small class="form-text text-muted">Link LinkedIn chính thức</small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label">
                                            <i class="bi bi-map me-1"></i> Mã nhúng bản đồ (iframe)
                                        </label>
                                        <textarea name="map_embed" id="map_embed" class="form-control" rows="4"
                                                  placeholder="<iframe src='https://www.google.com/maps/embed?...'></iframe>">{{ old('map_embed', $contact->map_embed ?? '') }}</textarea>
                                        <div class="invalid-feedback" id="map_embed-error"></div>
                                        <small class="form-text text-muted">
                                            <i class="bi bi-info-circle me-1"></i>
                                            Dán mã iframe nhúng bản đồ Google Maps tại đây. 
                                            <a href="https://support.google.com/maps/answer/144361?hl=vi" target="_blank">
                                                Hướng dẫn lấy mã nhúng
                                            </a>
                                        </small>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg" id="submit-btn">
                                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        <i class="bi bi-save me-1"></i> Lưu thông tin
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
@endsection

@push('scripts')
<script>
$(document).ready(function() {
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

    // Form submission
    $('#edit-contact-info-form').on('submit', function(e) {
        e.preventDefault();
        
        // Clear previous errors
        clearErrors();
        
        // Show loading state
        const submitBtn = $('#submit-btn');
        const spinner = submitBtn.find('.spinner-border');
        const icon = submitBtn.find('.bi');
        
        submitBtn.prop('disabled', true);
        spinner.removeClass('d-none');
        icon.addClass('d-none');
        
        $.ajax({
            url: '{{ route("admin.contact-info.update") }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.message);
                    // Reload page after 2 seconds to show updated data
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                } else {
                    showAlert('danger', response.message);
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    // Validation errors
                    const errors = xhr.responseJSON.errors;
                    displayErrors(errors);
                    showAlert('danger', 'Vui lòng kiểm tra lại thông tin nhập vào');
                } else {
                    showAlert('danger', 'Có lỗi xảy ra khi cập nhật thông tin liên hệ');
                }
            },
            complete: function() {
                // Reset loading state
                submitBtn.prop('disabled', false);
                spinner.addClass('d-none');
                icon.removeClass('d-none');
            }
        });
    });
});

function clearErrors() {
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').text('');
}

function displayErrors(errors) {
    $.each(errors, function(field, messages) {
        const input = $(`[name="${field}"]`);
        const errorDiv = $(`#${field}-error`);
        
        input.addClass('is-invalid');
        errorDiv.text(messages[0]);
    });
}

function showAlert(type, message) {
    const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    $('#alert-container').html(alertHtml);
    
    // Auto hide after 5 seconds
    setTimeout(function() {
        $('#alert-container .alert').fadeOut();
    }, 5000);
}
</script>

<style>
.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.text-danger {
    color: #dc3545 !important;
}

.card {
    border-radius: 0.5rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.card-header {
    border-radius: 0.5rem 0.5rem 0 0 !important;
}

.btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: 1.1rem;
}
</style>
@endpush
