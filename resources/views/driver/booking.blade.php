@extends('driver.layouts.main')

@section('page_title', 'Đặt dịch vụ lái xe - ThuêLai.vn')

@section('content')
<!-- Hero Section -->
<section class="hero-section booking-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1 class="hero-title">Đặt dịch vụ lái xe</h1>
                    <p class="hero-subtitle">Chọn dịch vụ phù hợp và đặt lịch ngay hôm nay để được phục vụ tốt nhất</p>
                    <div class="hero-features">
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Đặt lịch nhanh chóng</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Giá cả minh bạch</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Lái xe chuyên nghiệp</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image">
                    <img src="{{ asset('images/driver-booking-hero.jpg') }}" alt="Đặt dịch vụ lái xe" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-section">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">Dịch vụ lái xe</h2>
            <p class="section-subtitle">Chọn dịch vụ phù hợp với nhu cầu của bạn</p>
        </div>
        
        <div class="row" id="services-container">
            @foreach($services as $service)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="service-card" data-service-id="{{ $service->id }}" data-service-name="{{ $service->name }}">
                    <div class="service-image">
                        <img src="{{ $service->image_url }}" alt="{{ $service->name }}" class="img-fluid">
                        @if($service->is_featured)
                        <div class="featured-badge">
                            <i class="fas fa-star"></i>
                            <span>Nổi bật</span>
                        </div>
                        @endif
                    </div>
                    <div class="service-content">
                        <div class="service-icon">
                            <i class="{{ $service->icon ?? 'fas fa-car' }}"></i>
                        </div>
                        <h3 class="service-title">{{ $service->name }}</h3>
                        <p class="service-description">{{ $service->short_description }}</p>
                        <div class="service-pricing">
                            @if($service->price_per_hour)
                            <div class="price-item">
                                <span class="price-label">Theo giờ:</span>
                                <span class="price-value">{{ number_format($service->price_per_hour) }}đ/giờ</span>
                            </div>
                            @endif
                            @if($service->price_per_trip)
                            <div class="price-item">
                                <span class="price-label">Theo chuyến:</span>
                                <span class="price-value">{{ number_format($service->price_per_trip) }}đ/chuyến</span>
                            </div>
                            @endif
                        </div>
                        <button class="btn btn-primary select-service-btn" data-service-id="{{ $service->id }}" data-service-name="{{ $service->name }}">
                            <i class="fas fa-check"></i>
                            Chọn dịch vụ
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Booking Form Section -->
<section class="booking-form-section" id="booking-form-section" style="display: none;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="booking-form-card">
                    <div class="form-header">
                        <h3 class="form-title">Đặt dịch vụ lái xe</h3>
                        <p class="form-subtitle">Vui lòng điền thông tin để đặt dịch vụ</p>
                    </div>
                    
                    <form id="booking-form" class="booking-form">
                        @csrf
                        <input type="hidden" id="selected-service-id" name="driver_service_id">
                        <input type="hidden" id="selected-service-name" name="service_name">
                        
                        <!-- Selected Service Display -->
                        <div class="selected-service-display mb-4">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                <strong>Dịch vụ đã chọn:</strong> <span id="display-service-name"></span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customer_name" class="form-label">Họ và tên *</label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customer_phone" class="form-label">Số điện thoại *</label>
                                    <input type="tel" class="form-control" id="customer_phone" name="customer_phone" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customer_email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="customer_email" name="customer_email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_type" class="form-label">Loại dịch vụ *</label>
                                    <select class="form-control" id="service_type" name="service_type" required onchange="updatePricing()">
                                        <option value="">Chọn loại dịch vụ</option>
                                        <option value="hourly">Theo giờ</option>
                                        <option value="trip">Theo chuyến</option>
                                        <option value="custom">Tùy chỉnh</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pickup_datetime" class="form-label">Thời gian đón *</label>
                                    <input type="datetime-local" class="form-control" id="pickup_datetime" name="pickup_datetime" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="hours-group" style="display: none;">
                                    <label for="hours" class="form-label">Số giờ *</label>
                                    <input type="number" class="form-control" id="hours" name="hours" min="1" max="24">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pickup_location" class="form-label">Địa điểm đón *</label>
                                    <input type="text" class="form-control" id="pickup_location" name="pickup_location" placeholder="Nhập địa chỉ đón" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="destination" class="form-label">Điểm đến</label>
                                    <input type="text" class="form-control" id="destination" name="destination" placeholder="Nhập địa chỉ đến">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="special_requirements" class="form-label">Yêu cầu đặc biệt</label>
                            <textarea class="form-control" id="special_requirements" name="special_requirements" rows="3" placeholder="Nhập yêu cầu đặc biệt (nếu có)"></textarea>
                        </div>
                        
                        <!-- Pricing Display -->
                        <div class="pricing-display mb-4" id="pricing-display" style="display: none;">
                            <div class="alert alert-success">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h5 class="mb-0"><i class="fas fa-calculator"></i> Thông tin giá</h5>
                                        <p class="mb-0" id="pricing-details"></p>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <div class="total-amount">
                                            <span class="amount-label">Tổng tiền:</span>
                                            <span class="amount-value" id="total-amount">0đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary me-2" onclick="resetForm()">
                                <i class="fas fa-undo"></i>
                                Làm mới
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i>
                                Đặt dịch vụ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="why-choose-section">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">Tại sao chọn ThuêLai.vn?</h2>
            <p class="section-subtitle">Những lý do khiến chúng tôi trở thành lựa chọn hàng đầu</p>
        </div>
        
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4 class="feature-title">An toàn tuyệt đối</h4>
                    <p class="feature-description">Lái xe được đào tạo chuyên nghiệp, có bằng lái và kinh nghiệm</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h4 class="feature-title">24/7 phục vụ</h4>
                    <p class="feature-description">Dịch vụ hoạt động 24/7, sẵn sàng phục vụ mọi lúc</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <h4 class="feature-title">Giá cả hợp lý</h4>
                    <p class="feature-description">Mức giá cạnh tranh, minh bạch, không phát sinh chi phí</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4 class="feature-title">Hỗ trợ tận tâm</h4>
                    <p class="feature-description">Đội ngũ CSKH chuyên nghiệp, hỗ trợ 24/7</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">Câu hỏi thường gặp</h2>
            <p class="section-subtitle">Giải đáp những thắc mắc phổ biến về dịch vụ</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Làm thế nào để đặt dịch vụ lái xe?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Bạn có thể đặt dịch vụ bằng cách điền form trên trang này, gọi điện thoại hoặc liên hệ qua email. Chúng tôi sẽ xác nhận và sắp xếp lái xe phù hợp.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Dịch vụ hoạt động vào những giờ nào?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Dịch vụ của chúng tôi hoạt động 24/7, sẵn sàng phục vụ mọi lúc bạn cần. Bạn có thể đặt lịch trước hoặc gọi khẩn cấp.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Lái xe có kinh nghiệm và bằng cấp không?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Tất cả lái xe của chúng tôi đều có bằng lái hợp lệ, kinh nghiệm lái xe từ 3 năm trở lên và được đào tạo về kỹ năng phục vụ khách hàng.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Có thể hủy đặt lịch không?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Bạn có thể hủy đặt lịch trước 2 giờ so với thời gian đón. Vui lòng liên hệ với chúng tôi để được hỗ trợ hủy lịch.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.booking-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 80px 0;
    position: relative;
    overflow: hidden;
}

.hero-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.hero-subtitle {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    opacity: 0.9;
}

.hero-features {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.feature-item i {
    color: #4ade80;
    font-size: 1.2rem;
}

.services-section {
    padding: 80px 0;
    background: #f8f9fa;
}

.service-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
    border: 2px solid transparent;
}

.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.service-card.selected {
    border-color: #667eea;
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
}

.service-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.service-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.featured-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #ff6b6b;
    color: white;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.8rem;
    display: flex;
    align-items: center;
    gap: 5px;
}

.service-content {
    padding: 1.5rem;
    text-align: center;
}

.service-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    color: white;
    font-size: 1.5rem;
}

.service-title {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.service-description {
    color: #6c757d;
    margin-bottom: 1rem;
    line-height: 1.5;
}

.service-pricing {
    margin-bottom: 1.5rem;
}

.price-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.5rem;
    padding: 0.5rem;
    background: #f8f9fa;
    border-radius: 8px;
}

.price-label {
    font-weight: 500;
    color: #495057;
}

.price-value {
    font-weight: 600;
    color: #667eea;
}

.select-service-btn {
    width: 100%;
    padding: 0.75rem;
    border-radius: 8px;
    font-weight: 500;
}

.booking-form-section {
    padding: 80px 0;
    background: white;
}

.booking-form-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.form-header {
    text-align: center;
    margin-bottom: 2rem;
}

.form-title {
    font-size: 2rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 0.5rem;
}

.form-subtitle {
    color: #6c757d;
    font-size: 1.1rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
}

.form-control {
    border-radius: 8px;
    border: 2px solid #e9ecef;
    padding: 0.75rem;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.pricing-display {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    border-radius: 8px;
}

.total-amount {
    text-align: right;
}

.amount-label {
    display: block;
    font-size: 0.9rem;
    color: #155724;
}

.amount-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: #155724;
}

.form-actions {
    text-align: center;
    margin-top: 2rem;
}

.why-choose-section {
    padding: 80px 0;
    background: #f8f9fa;
}

.feature-card {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    height: 100%;
}

.feature-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: white;
    font-size: 2rem;
}

.feature-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #333;
}

.feature-description {
    color: #6c757d;
    line-height: 1.6;
}

.faq-section {
    padding: 80px 0;
    background: white;
}

.accordion-item {
    border: none;
    margin-bottom: 1rem;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.accordion-button {
    background: #f8f9fa;
    border: none;
    font-weight: 600;
    color: #333;
    padding: 1rem 1.5rem;
}

.accordion-button:not(.collapsed) {
    background: #667eea;
    color: white;
}

.accordion-body {
    padding: 1.5rem;
    background: white;
    color: #6c757d;
    line-height: 1.6;
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .booking-form-card {
        padding: 1.5rem;
    }
    
    .form-title {
        font-size: 1.5rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
let selectedService = null;
let services = @json($services);

function selectService(serviceId, serviceName) {
    // Remove previous selection
    document.querySelectorAll('.service-card').forEach(card => {
        card.classList.remove('selected');
    });
    
    // Add selection to clicked card
    const clickedCard = document.querySelector(`[data-service-id="${serviceId}"]`).closest('.service-card');
    clickedCard.classList.add('selected');
    
    // Store selected service
    selectedService = services.find(s => s.id === serviceId);
    
    // Update form
    document.getElementById('selected-service-id').value = serviceId;
    document.getElementById('selected-service-name').value = serviceName;
    document.getElementById('display-service-name').textContent = serviceName;
    
    // Show booking form
    document.getElementById('booking-form-section').style.display = 'block';
    
    // Scroll to form
    document.getElementById('booking-form-section').scrollIntoView({ 
        behavior: 'smooth' 
    });
    
    // Update pricing if service type is selected
    if (document.getElementById('service_type').value) {
        updatePricing();
    }
}

// Add event listeners to service buttons
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.select-service-btn').forEach(button => {
        button.addEventListener('click', function() {
            const serviceId = parseInt(this.getAttribute('data-service-id'));
            const serviceName = this.getAttribute('data-service-name');
            selectService(serviceId, serviceName);
        });
    });
});

function updatePricing() {
    const serviceType = document.getElementById('service_type').value;
    const hours = document.getElementById('hours').value;
    const pricingDisplay = document.getElementById('pricing-display');
    const pricingDetails = document.getElementById('pricing-details');
    const totalAmount = document.getElementById('total-amount');
    
    if (!selectedService || !serviceType) {
        pricingDisplay.style.display = 'none';
        return;
    }
    
    let total = 0;
    let details = '';
    
    if (serviceType === 'hourly' && hours) {
        total = selectedService.price_per_hour * hours;
        details = `Giá theo giờ: ${formatCurrency(selectedService.price_per_hour)}đ/giờ × ${hours} giờ`;
        document.getElementById('hours-group').style.display = 'block';
    } else if (serviceType === 'trip') {
        total = selectedService.price_per_trip;
        details = `Giá theo chuyến: ${formatCurrency(selectedService.price_per_trip)}đ/chuyến`;
        document.getElementById('hours-group').style.display = 'none';
    } else if (serviceType === 'custom') {
        total = selectedService.price_per_hour * 4; // Default 4 hours
        details = `Giá tùy chỉnh: ${formatCurrency(selectedService.price_per_hour)}đ/giờ × 4 giờ (mặc định)`;
        document.getElementById('hours-group').style.display = 'none';
    }
    
    if (total > 0) {
        pricingDetails.textContent = details;
        totalAmount.textContent = formatCurrency(total) + 'đ';
        pricingDisplay.style.display = 'block';
    } else {
        pricingDisplay.style.display = 'none';
    }
}

function formatCurrency(amount) {
    return new Intl.NumberFormat('vi-VN').format(amount);
}

function resetForm() {
    document.getElementById('booking-form').reset();
    document.getElementById('pricing-display').style.display = 'none';
    document.getElementById('hours-group').style.display = 'none';
    document.querySelectorAll('.service-card').forEach(card => {
        card.classList.remove('selected');
    });
    selectedService = null;
}

// Form submission
document.getElementById('booking-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    if (!selectedService) {
        alert('Vui lòng chọn dịch vụ trước khi đặt hàng!');
        return;
    }
    
    const formData = new FormData(this);
    
    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang xử lý...';
    submitBtn.disabled = true;
    
    fetch('{{ route("driver.order.store") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message
            Swal.fire({
                icon: 'success',
                title: 'Đặt dịch vụ thành công!',
                text: data.message,
                confirmButtonText: 'Đóng'
            }).then(() => {
                // Reset form and scroll to top
                resetForm();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        } else {
            throw new Error(data.message || 'Có lỗi xảy ra');
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Có lỗi xảy ra!',
            text: error.message,
            confirmButtonText: 'Đóng'
        });
    })
    .finally(() => {
        // Restore button state
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
});

// Show/hide hours field based on service type
document.getElementById('service_type').addEventListener('change', function() {
    const hoursGroup = document.getElementById('hours-group');
    if (this.value === 'hourly') {
        hoursGroup.style.display = 'block';
    } else {
        hoursGroup.style.display = 'none';
        document.getElementById('hours').value = '';
    }
    updatePricing();
});

// Update pricing when hours change
document.getElementById('hours').addEventListener('input', updatePricing);

// Set minimum datetime for pickup
document.getElementById('pickup_datetime').addEventListener('change', function() {
    const selected = new Date(this.value);
    const now = new Date();
    
    if (selected <= now) {
        alert('Thời gian đón phải sau thời gian hiện tại!');
        this.value = '';
    }
});
</script>
@endpush
