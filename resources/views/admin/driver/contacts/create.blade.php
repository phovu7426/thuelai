@extends('admin.index')

@section('page_title', 'Tạo liên hệ mới')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.driver.dashboard') }}">Dịch vụ lái xe</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.driver.contacts.index') }}">Liên hệ lái xe</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tạo mới</li>
@endsection

@section('content')
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-envelope-plus"></i> Tạo liên hệ mới
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.driver.contacts.store') }}" method="POST">
                            @csrf
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">
                                            <i class="bi bi-person"></i> Họ tên <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" placeholder="👤 Nhập họ tên..." value="{{ old('name') }}" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">
                                            <i class="bi bi-telephone"></i> Số điện thoại <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                               id="phone" name="phone" placeholder="📱 Nhập số điện thoại..." value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">
                                            <i class="bi bi-envelope"></i> Email
                                        </label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" placeholder="📧 Nhập email..." value="{{ old('email') }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="subject" class="form-label">
                                            <i class="bi bi-chat-text"></i> Tiêu đề <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                               id="subject" name="subject" placeholder="📝 Nhập tiêu đề..." value="{{ old('subject') }}" required>
                                        @error('subject')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="message" class="form-label">
                                            <i class="bi bi-chat-dots"></i> Nội dung tin nhắn <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control @error('message') is-invalid @enderror" 
                                                  id="message" name="message" rows="6" 
                                                  placeholder="💬 Nhập nội dung tin nhắn..." required>{{ old('message') }}</textarea>
                                        @error('message')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="contact_type" class="form-label">
                                            <i class="bi bi-tags"></i> Loại liên hệ
                                        </label>
                                        <select class="form-control @error('contact_type') is-invalid @enderror" 
                                                id="contact_type" name="contact_type">
                                            <option value="">🏷️ Chọn loại liên hệ</option>
                                            <option value="general" {{ old('contact_type') == 'general' ? 'selected' : '' }}>Liên hệ chung</option>
                                            <option value="support" {{ old('contact_type') == 'support' ? 'selected' : '' }}>Hỗ trợ</option>
                                            <option value="complaint" {{ old('contact_type') == 'complaint' ? 'selected' : '' }}>Khiếu nại</option>
                                            <option value="feedback" {{ old('contact_type') == 'feedback' ? 'selected' : '' }}>Phản hồi</option>
                                        </select>
                                        @error('contact_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">
                                            <i class="bi bi-toggle-on"></i> Trạng thái
                                        </label>
                                        <select class="form-control @error('status') is-invalid @enderror" 
                                                id="status" name="status">
                                            <option value="">🔄 Chọn trạng thái</option>
                                            <option value="unread" {{ old('status') == 'unread' ? 'selected' : '' }}>Chưa đọc</option>
                                            <option value="read" {{ old('status') == 'read' ? 'selected' : '' }}>Đã đọc</option>
                                            <option value="replied" {{ old('status') == 'replied' ? 'selected' : '' }}>Đã trả lời</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <a href="{{ route('admin.driver.contacts.index') }}" class="btn btn-secondary">
                                            <i class="bi bi-arrow-left"></i> Hủy
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle"></i> Tạo mới
                                        </button>
                                    </div>
                                </div>
                            </div> <!-- row -->
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Auto-fill subject based on contact type
    $('#contact_type').on('change', function() {
        const contactType = $(this).val();
        const subject = $('#subject');
        
        if (!subject.val()) {
            switch(contactType) {

                case 'support':
                    subject.val('Yêu cầu hỗ trợ');
                    break;
                case 'complaint':
                    subject.val('Khiếu nại dịch vụ');
                    break;
                case 'feedback':
                    subject.val('Phản hồi dịch vụ');
                    break;
                default:
                    subject.val('Liên hệ chung');
            }
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

    // Character counter for message
    $('#message').on('input', function() {
        const maxLength = 1000;
        const currentLength = $(this).val().length;
        const remaining = maxLength - currentLength;
        
        if (!$(this).next('.char-counter').length) {
            $(this).after('<small class="form-text text-muted char-counter"></small>');
        }
        
        $(this).next('.char-counter').text(`${currentLength}/${maxLength} ký tự`);
        
        if (remaining < 0) {
            $(this).next('.char-counter').addClass('text-danger');
        } else {
            $(this).next('.char-counter').removeClass('text-danger');
        }
    });
});
</script>

<style>
.form-group label {
    font-weight: 600;
    color: #333;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.char-counter {
    font-size: 12px;
}

.text-danger {
    color: #dc3545 !important;
}
</style>
@endsection
