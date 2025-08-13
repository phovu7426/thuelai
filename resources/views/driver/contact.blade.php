@extends('driver.layouts.main')

@section('title', 'Liên hệ - Dịch vụ tài xế thuê lái')

@section('meta')
<meta name="description" content="Liên hệ với chúng tôi để được tư vấn và đặt dịch vụ tài xế thuê lái. Hotline 24/7, hỗ trợ khách hàng chuyên nghiệp.">
<meta name="keywords" content="liên hệ tài xế, hotline thuê lái, địa chỉ công ty, hỗ trợ khách hàng">
@endsection

@push('styles')
<style>
.contact-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 80px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.contact-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('{{ asset("images/bg-pattern-dark.png") }}') repeat;
    opacity: 0.1;
}

.contact-hero .container {
    position: relative;
    z-index: 2;
}

.contact-hero h1 {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.contact-hero p {
    font-size: 1.2rem;
    opacity: 0.9;
    max-width: 600px;
    margin: 0 auto;
}

.contact-content {
    padding: 80px 0;
}

.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    margin-top: 50px;
}

.contact-form-section {
    background: white;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.contact-form-section h3 {
    font-size: 1.8rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 1.5rem;
    text-align: center;
}

.form-group {
    margin-bottom: 25px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #2c3e50;
}

.form-control {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.form-control:focus {
    outline: none;
    border-color: #007bff;
    background: white;
    box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
}

.form-control.error {
    border-color: #dc3545;
}

.error-message {
    color: #dc3545;
    font-size: 0.9rem;
    margin-top: 5px;
    display: none;
}

textarea.form-control {
    resize: vertical;
    min-height: 120px;
}

.btn-submit {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,123,255,0.3);
}

.btn-submit:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.contact-info-section {
    background: #f8f9fa;
    padding: 40px;
    border-radius: 15px;
}

.contact-info-section h3 {
    font-size: 1.8rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 1.5rem;
    text-align: center;
}

.contact-item {
    display: flex;
    align-items: center;
    margin-bottom: 25px;
    padding: 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.contact-item:hover {
    transform: translateY(-3px);
}

.contact-item .icon {
    width: 50px;
    height: 50px;
    background: #007bff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 20px;
    color: white;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.contact-item .content h5 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 5px;
}

.contact-item .content p {
    color: #6c757d;
    margin: 0;
    line-height: 1.5;
}

.contact-item .content a {
    color: #007bff;
    text-decoration: none;
    font-weight: 500;
}

.contact-item .content a:hover {
    text-decoration: underline;
}

.working-hours {
    background: white;
    padding: 25px;
    border-radius: 10px;
    margin-top: 20px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.1);
}

.working-hours h5 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 15px;
    text-align: center;
}

.hours-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.hours-list li {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid #e9ecef;
}

.hours-list li:last-child {
    border-bottom: none;
}

.hours-list .day {
    font-weight: 500;
    color: #2c3e50;
}

.hours-list .time {
    color: #6c757d;
}

.qr-section {
    background: white;
    padding: 25px;
    border-radius: 10px;
    margin-top: 20px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.1);
    text-align: center;
}

.qr-section h5 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 15px;
}

.qr-code {
    width: 120px;
    height: 120px;
    background: #f8f9fa;
    border: 2px dashed #dee2e6;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    color: #6c757d;
    font-size: 2rem;
}

.qr-section p {
    color: #6c757d;
    font-size: 0.9rem;
    margin: 0;
}

.map-section {
    margin-top: 80px;
}

.map-section h3 {
    font-size: 2rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 2rem;
    text-align: center;
}

.map-container {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.map-placeholder {
    width: 100%;
    height: 400px;
    background: #e9ecef;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    font-size: 1.1rem;
    border: 2px dashed #dee2e6;
}

.map-placeholder i {
    font-size: 3rem;
    margin-bottom: 15px;
    display: block;
}

.emergency-contact {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
    padding: 40px;
    border-radius: 15px;
    text-align: center;
    margin-top: 40px;
}

.emergency-contact h4 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.emergency-contact p {
    opacity: 0.9;
    margin-bottom: 1.5rem;
}

.emergency-btn {
    background: white;
    color: #dc3545;
    border: none;
    padding: 15px 30px;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
}

.emergency-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(255,255,255,0.3);
    color: #dc3545;
    text-decoration: none;
}

@media (max-width: 768px) {
    .contact-hero h1 {
        font-size: 2.5rem;
    }
    
    .contact-hero p {
        font-size: 1.1rem;
    }
    
    .contact-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .contact-form-section,
    .contact-info-section {
        padding: 30px 20px;
    }
    
    .map-placeholder {
        height: 300px;
    }
}
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="contact-hero">
    <div class="container">
        <h1>Liên Hệ Với Chúng Tôi</h1>
        <p>Chúng tôi luôn sẵn sàng hỗ trợ và tư vấn để mang đến dịch vụ tốt nhất cho bạn</p>
    </div>
</section>

<!-- Contact Content Section -->
<section class="contact-content">
    <div class="container">
        <div class="contact-grid">
            <!-- Contact Form -->
            <div class="contact-form-section">
                <h3>Gửi Tin Nhắn</h3>
                <form id="contactForm" action="{{ route('driver.contact.submit') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Họ và tên *</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                        <div class="error-message" id="name-error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                        <div class="error-message" id="email-error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Số điện thoại *</label>
                        <input type="tel" id="phone" name="phone" class="form-control" required>
                        <div class="error-message" id="phone-error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Chủ đề</label>
                        <select id="subject" name="subject" class="form-control">
                            <option value="">Chọn chủ đề</option>
                            <option value="booking">Đặt dịch vụ</option>
                            <option value="consultation">Tư vấn</option>
                            <option value="complaint">Khiếu nại</option>
                            <option value="partnership">Hợp tác</option>
                            <option value="other">Khác</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Nội dung tin nhắn *</label>
                        <textarea id="message" name="message" class="form-control" required></textarea>
                        <div class="error-message" id="message-error"></div>
                    </div>
                    
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <span class="btn-text">Gửi tin nhắn</span>
                        <span class="btn-loading" style="display: none;">
                            <i class="fas fa-spinner fa-spin"></i> Đang gửi...
                        </span>
                    </button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="contact-info-section">
                <h3>Thông Tin Liên Hệ</h3>
                
                <div class="contact-item">
                    <div class="icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="content">
                        <h5>Địa chỉ</h5>
                        <p>{{ $contactInfo->address ?? 'Tòa nhà A, 123 Đường ABC, Quận 1, TP.HCM' }}</p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="content">
                        <h5>Hotline</h5>
                        <p><a href="tel:{{ $contactInfo->hotline ?? '1900-xxxx' }}">{{ $contactInfo->hotline ?? '1900-xxxx' }}</a></p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="content">
                        <h5>Email</h5>
                        <p><a href="mailto:{{ $contactInfo->email ?? 'info@thuelai.vn' }}">{{ $contactInfo->email ?? 'info@thuelai.vn' }}</a></p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="content">
                        <h5>Giờ làm việc</h5>
                        <p>24/7 - Hỗ trợ khách hàng mọi lúc</p>
                    </div>
                </div>

                <!-- Working Hours -->
                <div class="working-hours">
                    <h5>Giờ Làm Việc Chi Tiết</h5>
                    <ul class="hours-list">
                        <li>
                            <span class="day">Thứ 2 - Thứ 6</span>
                            <span class="time">8:00 - 18:00</span>
                        </li>
                        <li>
                            <span class="day">Thứ 7</span>
                            <span class="time">8:00 - 17:00</span>
                        </li>
                        <li>
                            <span class="day">Chủ nhật</span>
                            <span class="time">9:00 - 16:00</span>
                        </li>
                        <li>
                            <span class="day">Dịch vụ 24/7</span>
                            <span class="time">Luôn sẵn sàng</span>
                        </li>
                    </ul>
                </div>

                <!-- QR Code -->
                <div class="qr-section">
                    <h5>Quét mã QR</h5>
                    <div class="qr-code">
                        <i class="fas fa-qrcode"></i>
                    </div>
                    <p>Quét mã QR để lưu thông tin liên hệ vào điện thoại</p>
                </div>
            </div>
        </div>

        <!-- Emergency Contact -->
        <div class="emergency-contact">
            <h4>Liên Hệ Khẩn Cấp</h4>
            <p>Trong trường hợp khẩn cấp, hãy gọi ngay cho chúng tôi để được hỗ trợ 24/7</p>
            <a href="tel:{{ $contactInfo->emergency ?? '1900-xxxx' }}" class="emergency-btn">
                <i class="fas fa-phone"></i> {{ $contactInfo->emergency ?? '1900-xxxx' }}
            </a>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section">
    <div class="container">
        <h3>Vị Trí Của Chúng Tôi</h3>
        <div class="map-container">
            <div class="map-placeholder">
                <div>
                    <i class="fas fa-map-marked-alt"></i>
                    <p>Bản đồ Google Maps sẽ được nhúng tại đây</p>
                    <small>Địa chỉ: {{ $contactInfo->address ?? 'Tòa nhà A, 123 Đường ABC, Quận 1, TP.HCM' }}</small>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');

    // Form validation
    function validateField(field, errorElement, validationRules) {
        const value = field.value.trim();
        let isValid = true;
        let errorMessage = '';

        if (validationRules.required && !value) {
            isValid = false;
            errorMessage = 'Trường này là bắt buộc';
        } else if (validationRules.email && value && !isValidEmail(value)) {
            isValid = false;
            errorMessage = 'Email không hợp lệ';
        } else if (validationRules.phone && value && !isValidPhone(value)) {
            isValid = false;
            errorMessage = 'Số điện thoại không hợp lệ';
        } else if (validationRules.minLength && value.length < validationRules.minLength) {
            isValid = false;
            errorMessage = `Tối thiểu ${validationRules.minLength} ký tự`;
        }

        if (!isValid) {
            field.classList.add('error');
            errorElement.textContent = errorMessage;
            errorElement.style.display = 'block';
        } else {
            field.classList.remove('error');
            errorElement.style.display = 'none';
        }

        return isValid;
    }

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function isValidPhone(phone) {
        const phoneRegex = /^[0-9+\-\s()]{10,}$/;
        return phoneRegex.test(phone);
    }

    // Real-time validation
    const fields = {
        name: { required: true, minLength: 2 },
        email: { required: true, email: true },
        phone: { required: true, phone: true },
        message: { required: true, minLength: 10 }
    };

    Object.keys(fields).forEach(fieldName => {
        const field = document.getElementById(fieldName);
        const errorElement = document.getElementById(fieldName + '-error');
        
        if (field && errorElement) {
            field.addEventListener('blur', () => {
                validateField(field, errorElement, fields[fieldName]);
            });
            
            field.addEventListener('input', () => {
                if (field.classList.contains('error')) {
                    validateField(field, errorElement, fields[fieldName]);
                }
            });
        }
    });

    // Form submission
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Validate all fields
        let isFormValid = true;
        Object.keys(fields).forEach(fieldName => {
            const field = document.getElementById(fieldName);
            const errorElement = document.getElementById(fieldName + '-error');
            
            if (field && errorElement) {
                if (!validateField(field, errorElement, fields[fieldName])) {
                    isFormValid = false;
                }
            }
        });

        if (!isFormValid) {
            return;
        }

        // Show loading state
        submitBtn.disabled = true;
        btnText.style.display = 'none';
        btnLoading.style.display = 'inline-block';

        try {
            const formData = new FormData(form);
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            if (response.ok) {
                // Success
                showAlert('Tin nhắn đã được gửi thành công! Chúng tôi sẽ phản hồi sớm nhất.', 'success');
                form.reset();
            } else {
                // Error
                const data = await response.json();
                showAlert(data.message || 'Có lỗi xảy ra, vui lòng thử lại.', 'error');
            }
        } catch (error) {
            showAlert('Có lỗi xảy ra, vui lòng thử lại.', 'error');
        } finally {
            // Reset button state
            submitBtn.disabled = false;
            btnText.style.display = 'inline-block';
            btnLoading.style.display = 'none';
        }
    });

    // Alert system
    function showAlert(message, type) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        form.insertBefore(alertDiv, form.firstChild);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }

    // Phone number formatting
    const phoneField = document.getElementById('phone');
    if (phoneField) {
        phoneField.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (value.startsWith('84')) {
                    value = value.replace(/^84/, '0');
                }
                if (value.length <= 3) {
                    value = value;
                } else if (value.length <= 6) {
                    value = value.slice(0, 3) + ' ' + value.slice(3);
                } else if (value.length <= 10) {
                    value = value.slice(0, 3) + ' ' + value.slice(3, 6) + ' ' + value.slice(6);
                } else {
                    value = value.slice(0, 3) + ' ' + value.slice(3, 6) + ' ' + value.slice(6, 8) + ' ' + value.slice(8);
                }
            }
            e.target.value = value;
        });
    }
});
</script>
@endpush
