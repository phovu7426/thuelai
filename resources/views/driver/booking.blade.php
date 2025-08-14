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
                            <div class="feature-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <span class="feature-text">Đặt lịch nhanh chóng</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <span class="feature-text">Giá cả minh bạch</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <span class="feature-text">Lái xe chuyên nghiệp</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image">
                    <div class="image-placeholder">
                        <i class="fas fa-car"></i>
                        <h3>Dịch vụ lái xe chuyên nghiệp</h3>
                        <p>An toàn - Nhanh chóng - Uy tín</p>
                    </div>
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
    background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
    color: white;
    padding: 100px 0;
    position: relative;
    overflow: hidden;
    margin-top: 80px;
}

.booking-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    pointer-events: none;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    background: linear-gradient(45deg, #ffffff, #f0f8ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    position: relative;
}

.hero-subtitle {
    font-size: 1.3rem;
    margin-bottom: 3rem;
    opacity: 0.95;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    font-weight: 300;
    line-height: 1.6;
}

.hero-features {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    background: rgba(255, 255, 255, 0.15);
    padding: 1.5rem 2rem;
    border-radius: 20px;
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.feature-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.feature-item:hover::before {
    left: 100%;
}

.feature-item:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateX(10px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    border-color: rgba(255, 255, 255, 0.4);
}

.feature-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #4ade80, #22c55e);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 8px 20px rgba(74, 222, 128, 0.4);
    position: relative;
    overflow: hidden;
}

.feature-icon::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transform: rotate(45deg);
    transition: transform 0.6s;
}

.feature-item:hover .feature-icon::before {
    transform: rotate(45deg) translate(50%, 50%);
}

.feature-icon i {
    color: white;
    font-size: 1.5rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    z-index: 1;
    position: relative;
}

.feature-text {
    font-size: 1.2rem;
    font-weight: 600;
    color: #ffffff;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    letter-spacing: 0.5px;
}

/* Hero Image Placeholder */
.hero-image {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    position: relative;
}

.hero-image::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    animation: pulse 3s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.5; }
    50% { transform: translate(-50%, -50%) scale(1.1); opacity: 0.8; }
}

.image-placeholder {
    background: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 30px;
    padding: 4rem 3rem;
    text-align: center;
    backdrop-filter: blur(20px);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

.image-placeholder::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
    border-radius: 30px;
}

.image-placeholder:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.6);
    transform: translateY(-10px) scale(1.05);
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
}

.image-placeholder i {
    font-size: 5rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 1.5rem;
    text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    position: relative;
    z-index: 1;
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.image-placeholder h3 {
    font-size: 1.8rem;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 1rem;
    text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    position: relative;
    z-index: 1;
}

.image-placeholder p {
    font-size: 1.1rem;
    color: rgba(255, 255, 255, 0.9);
    margin: 0;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    position: relative;
    z-index: 1;
    font-weight: 300;
}

.services-section {
    padding: 100px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    position: relative;
}

.services-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 100px;
    background: linear-gradient(to bottom, transparent, rgba(248, 249, 250, 0.8));
}

.service-card {
    background: white;
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    border: 2px solid transparent;
    position: relative;
}

.service-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.service-card:hover::before {
    transform: scaleX(1);
}

.service-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}

.service-card.selected {
    border-color: #667eea;
    box-shadow: 0 25px 50px rgba(102, 126, 234, 0.3);
}

.service-card.selected::before {
    transform: scaleX(1);
}

.service-image {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.service-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.service-card:hover .service-image img {
    transform: scale(1.1);
}

.featured-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: linear-gradient(135deg, #ff6b6b, #ee5a52);
    color: white;
    padding: 8px 15px;
    border-radius: 25px;
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 5px;
    box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
    font-weight: 600;
}

.service-content {
    padding: 2rem;
    text-align: center;
}

.service-icon {
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
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    transition: transform 0.3s ease;
}

.service-card:hover .service-icon {
    transform: scale(1.1) rotate(5deg);
}

.service-title {
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
    color: #2d3748;
}

.service-description {
    color: #718096;
    margin-bottom: 1.5rem;
    line-height: 1.6;
    font-size: 0.95rem;
}

.service-pricing {
    margin-bottom: 2rem;
}

.price-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.75rem;
    padding: 0.75rem 1rem;
    background: linear-gradient(135deg, #f7fafc, #edf2f7);
    border-radius: 12px;
    border: 1px solid #e2e8f0;
}

.price-label {
    font-weight: 600;
    color: #4a5568;
}

.price-value {
    font-weight: 700;
    color: #667eea;
    font-size: 1.1rem;
}

.select-service-btn {
    width: 100%;
    padding: 1rem;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border: none;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.select-service-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.select-service-btn:hover::before {
    left: 100%;
}

.select-service-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
}

.booking-form-section {
    padding: 100px 0;
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
}

.booking-form-card {
    background: white;
    border-radius: 30px;
    padding: 3rem;
    box-shadow: 0 20px 60px rgba(0,0,0,0.1);
    border: 1px solid #e2e8f0;
}

.form-header {
    text-align: center;
    margin-bottom: 3rem;
}

.form-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #2d3748;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.form-subtitle {
    color: #718096;
    font-size: 1.2rem;
    font-weight: 400;
}

.form-group {
    margin-bottom: 2rem;
}

.form-label {
    font-weight: 700;
    color: #4a5568;
    margin-bottom: 0.75rem;
    font-size: 1rem;
}

.form-control {
    border-radius: 12px;
    border: 2px solid #e2e8f0;
    padding: 1rem;
    transition: all 0.3s ease;
    font-size: 1rem;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    transform: translateY(-2px);
}

.pricing-display {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    border: 2px solid #c3e6cb;
    border-radius: 15px;
    padding: 1.5rem;
}

.total-amount {
    text-align: right;
}

.amount-label {
    display: block;
    font-size: 1rem;
    color: #155724;
    font-weight: 600;
}

.amount-value {
    font-size: 2rem;
    font-weight: 800;
    color: #155724;
}

.form-actions {
    text-align: center;
    margin-top: 3rem;
}

.btn {
    padding: 1rem 2rem;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    border: none;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
}

.btn-secondary {
    background: linear-gradient(135deg, #718096, #4a5568);
    color: white;
}

.btn-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(113, 128, 150, 0.4);
}

.why-choose-section {
    padding: 100px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.feature-card {
    background: white;
    padding: 3rem 2rem;
    border-radius: 25px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    height: 100%;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid #e2e8f0;
    position: relative;
    overflow: hidden;
}

.feature-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
}

.feature-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}

.feature-icon {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    color: white;
    font-size: 2.5rem;
    box-shadow: 0 15px 35px rgba(102, 126, 234, 0.3);
    transition: transform 0.3s ease;
}

.feature-card:hover .feature-icon {
    transform: scale(1.1) rotate(10deg);
}

.feature-title {
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    color: #2d3748;
}

.feature-description {
    color: #718096;
    line-height: 1.7;
    font-size: 1rem;
}

.faq-section {
    padding: 100px 0;
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
}

.accordion-item {
    border: none;
    margin-bottom: 1.5rem;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    background: white;
}

.accordion-button {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border: none;
    font-weight: 700;
    color: #2d3748;
    padding: 1.5rem 2rem;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.accordion-button:not(.collapsed) {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}

.accordion-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.accordion-body {
    padding: 2rem;
    background: white;
    color: #718096;
    line-height: 1.7;
    font-size: 1rem;
}

@media (max-width: 768px) {
    .booking-hero {
        padding: 80px 0;
        margin-top: 70px;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .feature-item {
        padding: 1rem 1.5rem;
        gap: 1rem;
    }
    
    .feature-icon {
        width: 50px;
        height: 50px;
    }
    
    .feature-icon i {
        font-size: 1.2rem;
    }
    
    .feature-text {
        font-size: 1rem;
    }
    
    .image-placeholder {
        padding: 2.5rem 1.5rem;
    }
    
    .image-placeholder i {
        font-size: 3.5rem;
    }
    
    .image-placeholder h3 {
        font-size: 1.4rem;
    }
    
    .booking-form-card {
        padding: 2rem;
    }
    
    .form-title {
        font-size: 2rem;
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
