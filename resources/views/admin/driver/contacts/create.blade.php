@extends('admin.layouts.main')

@section('title', 'Tạo liên hệ mới')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tạo liên hệ mới</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.driver.contacts.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.driver.contacts.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Họ tên <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Số điện thoại <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject">Tiêu đề <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                           id="subject" name="subject" value="{{ old('subject') }}" required>
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message">Nội dung tin nhắn <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                      id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact_type">Loại liên hệ</label>
                                    <select class="form-control @error('contact_type') is-invalid @enderror" 
                                            id="contact_type" name="contact_type">
                                        <option value="general" {{ old('contact_type') == 'general' ? 'selected' : '' }}>Liên hệ chung</option>

                                        <option value="support" {{ old('contact_type') == 'support' ? 'selected' : '' }}>Hỗ trợ</option>
                                        <option value="complaint" {{ old('contact_type') == 'complaint' ? 'selected' : '' }}>Khiếu nại</option>
                                        <option value="feedback" {{ old('contact_type') == 'feedback' ? 'selected' : '' }}>Phản hồi</option>
                                    </select>
                                    @error('contact_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Trạng thái</label>
                                    <select class="form-control @error('status') is-invalid @enderror" 
                                            id="status" name="status">
                                        <option value="new" {{ old('status') == 'new' ? 'selected' : '' }}>Mới</option>
                                        <option value="read" {{ old('status') == 'read' ? 'selected' : '' }}>Đã đọc</option>
                                        <option value="replied" {{ old('status') == 'replied' ? 'selected' : '' }}>Đã trả lời</option>
                                        <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>Đã đóng</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="priority">Mức độ ưu tiên</label>
                                    <select class="form-control @error('priority') is-invalid @enderror" 
                                            id="priority" name="priority">
                                        <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Thấp</option>
                                        <option value="normal" {{ old('priority') == 'normal' ? 'selected' : '' }}>Bình thường</option>
                                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>Cao</option>
                                        <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Khẩn cấp</option>
                                    </select>
                                    @error('priority')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="source">Nguồn liên hệ</label>
                                    <select class="form-control @error('source') is-invalid @enderror" 
                                            id="source" name="source">
                                        <option value="website" {{ old('source') == 'website' ? 'selected' : '' }}>Website</option>
                                        <option value="phone" {{ old('source') == 'phone' ? 'selected' : '' }}>Điện thoại</option>
                                        <option value="email" {{ old('source') == 'email' ? 'selected' : '' }}>Email</option>
                                        <option value="social" {{ old('source') == 'social' ? 'selected' : '' }}>Mạng xã hội</option>
                                        <option value="referral" {{ old('source') == 'referral' ? 'selected' : '' }}>Giới thiệu</option>
                                    </select>
                                    @error('source')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="notes">Ghi chú</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Tạo liên hệ
                            </button>
                            <a href="{{ route('admin.driver.contacts.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Hủy
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
