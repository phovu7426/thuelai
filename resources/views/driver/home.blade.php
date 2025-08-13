@extends('driver.layouts.main')

@section('page_title', 'Trang chủ - Dịch vụ lái xe thuê an toàn')

@section('content')
    <!-- Hero Banner -->
    <section class="hero-banner position-relative overflow-hidden">
        <div class="hero-background">
            <div class="hero-gradient"></div>
            <div class="hero-pattern"></div>
        </div>
        <div class="container position-relative">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6">
                    <div class="hero-content text-white">
                        <div class="hero-badge mb-4">
                            <span class="badge bg-primary bg-opacity-25 text-white px-3 py-2 rounded-pill">
                                <i class="fas fa-star me-2"></i>Dịch vụ 5 sao
                            </span>
                        </div>
                        <h1 class="hero-title mb-4">
                            <span class="d-block">Lái xe an toàn,</span>
                            <span class="d-block text-primary">chuyên nghiệp</span>
                        </h1>
                        <p class="hero-subtitle mb-4">Dịch vụ lái xe thuê 24/7 với đội ngũ tài xế giàu kinh nghiệm, đảm bảo an toàn tuyệt đối cho bạn và phương tiện.</p>
                        <div class="hero-stats mb-4">
                            <div class="row">
                                <div class="col-4">
                                    <div class="stat-item text-center">
                                        <div class="stat-number">1000+</div>
                                        <div class="stat-label">Khách hàng</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-item text-center">
                                        <div class="stat-number">24/7</div>
                                        <div class="stat-label">Hỗ trợ</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-item text-center">
                                        <div class="stat-number">5.0</div>
                                        <div class="stat-label">Đánh giá</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hero-buttons">
                            <a href="#booking-form" class="btn btn-primary btn-lg me-3 px-4 py-3">
                                <i class="fas fa-car me-2"></i>Đặt tài xế ngay
                            </a>
                            <a href="{{ route('driver.services') }}" class="btn btn-outline-light btn-lg px-4 py-3">
                                <i class="fas fa-list me-2"></i>Xem dịch vụ
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="hero-image text-center">
                        <div class="floating-card card border-0 shadow-lg bg-white bg-opacity-10 backdrop-blur">
                            <div class="card-body p-4">
                                <div class="driver-avatar mb-3">
                                    <i class="fas fa-user-tie fa-4x text-primary"></i>
                                </div>
                                <h5 class="text-white mb-2">Tài xế chuyên nghiệp</h5>
                                <p class="text-white-50 mb-0">Được đào tạo bài bản, có giấy phép lái xe hợp lệ</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-scroll-indicator">
            <div class="scroll-arrow">
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
    </section>

    <!-- Giới thiệu nhanh -->
    <section class="intro-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="intro-content">
                        <div class="section-badge mb-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                                <i class="fas fa-info-circle me-2"></i>Giới thiệu
                            </span>
                        </div>
                        <h2 class="section-title mb-4">Tại sao chọn dịch vụ lái xe của chúng tôi?</h2>
                        <p class="section-subtitle text-muted mb-4">Chúng tôi cam kết mang đến dịch vụ lái xe thuê chất lượng cao với đội ngũ tài xế chuyên nghiệp, phương tiện hiện đại và dịch vụ 24/7.</p>
                        <div class="intro-features">
                            <div class="feature-item d-flex align-items-center mb-3">
                                <div class="feature-icon me-3">
                                    <i class="fas fa-check-circle text-success"></i>
                                </div>
                                <span>Đội ngũ tài xế được đào tạo bài bản</span>
                            </div>
                            <div class="feature-item d-flex align-items-center mb-3">
                                <div class="feature-icon me-3">
                                    <i class="fas fa-check-circle text-success"></i>
                                </div>
                                <span>Phương tiện hiện đại, sạch sẽ</span>
                            </div>
                            <div class="feature-item d-flex align-items-center mb-3">
                                <div class="feature-icon me-3">
                                    <i class="fas fa-check-circle text-success"></i>
                                </div>
                                <span>Dịch vụ 24/7, đáp ứng mọi nhu cầu</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="intro-image text-center">
                        <div class="image-container position-relative">
                            <div class="main-image">
                                <i class="fas fa-car fa-8x text-primary"></i>
                            </div>
                            <div class="floating-element floating-1">
                                <i class="fas fa-shield-alt fa-2x text-success"></i>
                            </div>
                            <div class="floating-element floating-2">
                                <i class="fas fa-clock fa-2x text-warning"></i>
                            </div>
                            <div class="floating-element floating-3">
                                <i class="fas fa-star fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Các gói dịch vụ -->
    <section class="services-section py-5 bg-light">
        <div class="container">
            <div class="section-header text-center mb-5">
                <div class="section-badge mb-3">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                        <i class="fas fa-cogs me-2"></i>Dịch vụ
                    </span>
                </div>
                <h2 class="section-title">Dịch vụ của chúng tôi</h2>
                <p class="section-subtitle text-muted">Đa dạng các gói dịch vụ phù hợp với mọi nhu cầu</p>
            </div>

            <div class="row">
                @if(count($services) > 0)
                    @foreach($services as $service)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="service-card card h-100 border-0 shadow-sm hover-lift">
                                <div class="service-card-header position-relative">
                                    <div class="service-icon-wrapper">
                                        @if($service->icon)
                                            <img src="{{ $service->icon_url }}" alt="{{ $service->name }}" class="service-icon">
                                        @else
                                            <i class="fas fa-car service-icon"></i>
                                        @endif
                                    </div>
                                    @if($service->is_featured)
                                        <div class="featured-badge">
                                            <span class="badge bg-warning text-dark">Nổi bật</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body text-center p-4">
                                    <h5 class="card-title mb-3">{{ $service->name }}</h5>
                                    <p class="card-text text-muted mb-4">{{ $service->short_description }}</p>
                                    
                                    <div class="service-pricing mb-4">
                                        @if($service->price_per_hour)
                                            <div class="price-item mb-2">
                                                <span class="price-amount">{{ number_format($service->price_per_hour) }}đ</span>
                                                <span class="price-unit">/giờ</span>
                                            </div>
                                        @endif
                                        
                                        @if($service->price_per_trip)
                                            <div class="price-item mb-2">
                                                <span class="price-amount">{{ number_format($service->price_per_trip) }}đ</span>
                                                <span class="price-unit">/chuyến</span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <button class="btn btn-primary book-service-btn w-100" 
                                            data-service-id="{{ $service->id }}" 
                                            data-service-name="{{ $service->name }}">
                                        <i class="fas fa-calendar-check me-2"></i>Đặt ngay
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <div class="empty-state">
                            <i class="fas fa-car fa-4x text-muted mb-3"></i>
                            <p class="text-muted">Chưa có dịch vụ nào.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Lợi ích nổi bật -->
    <section class="benefits-section py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <div class="section-badge mb-3">
                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                        <i class="fas fa-thumbs-up me-2"></i>Lợi ích
                    </span>
                </div>
                <h2 class="section-title">Tại sao chọn chúng tôi?</h2>
                <p class="section-subtitle text-muted">Những lợi ích vượt trội khi sử dụng dịch vụ</p>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="benefit-card text-center p-4 h-100">
                        <div class="benefit-icon-wrapper mb-4">
                            <div class="benefit-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                        </div>
                        <h5 class="benefit-title mb-3">Tư vấn 24/7</h5>
                        <p class="benefit-description text-muted">Hỗ trợ tư vấn và đặt dịch vụ mọi lúc, mọi nơi</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="benefit-card text-center p-4 h-100">
                        <div class="benefit-icon-wrapper mb-4">
                            <div class="benefit-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                        </div>
                        <h5 class="benefit-title mb-3">An toàn tuyệt đối</h5>
                        <p class="benefit-description text-muted">Đảm bảo an toàn cho bạn và phương tiện</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="benefit-card text-center p-4 h-100">
                        <div class="benefit-icon-wrapper mb-4">
                            <div class="benefit-icon">
                                <i class="fas fa-smile"></i>
                            </div>
                        </div>
                        <h5 class="benefit-title mb-3">Phục vụ chuyên nghiệp</h5>
                        <p class="benefit-description text-muted">Đội ngũ tài xế thân thiện, chuyên nghiệp</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="benefit-card text-center p-4 h-100">
                        <div class="benefit-icon-wrapper mb-4">
                            <div class="benefit-icon">
                                <i class="fas fa-award"></i>
                            </div>
                        </div>
                        <h5 class="benefit-title mb-3">Kinh nghiệm dày dặn</h5>
                        <p class="benefit-description text-muted">Tài xế có nhiều năm kinh nghiệm lái xe</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Phản hồi khách hàng -->
    @if(count($testimonials) > 0)
    <section class="testimonials-section py-5 bg-light">
        <div class="container">
            <div class="section-header text-center mb-5">
                <div class="section-badge mb-3">
                    <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill">
                        <i class="fas fa-comments me-2"></i>Đánh giá
                    </span>
                </div>
                <h2 class="section-title">Khách hàng nói gì về chúng tôi?</h2>
                <p class="section-subtitle text-muted">Những đánh giá chân thực từ khách hàng</p>
            </div>

            <div class="testimonials-carousel">
                <div class="row">
                    @foreach($testimonials as $testimonial)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="testimonial-card card h-100 border-0 shadow-sm hover-lift">
                                <div class="card-body p-4">
                                    <div class="testimonial-header mb-3">
                                        @if($testimonial->image)
                                            <div class="testimonial-avatar">
                                                <img src="{{ $testimonial->image_url }}" alt="{{ $testimonial->customer_name }}" class="rounded-circle">
                                            </div>
                                        @else
                                            <div class="testimonial-avatar">
                                                <i class="fas fa-user-circle"></i>
                                            </div>
                                        @endif
                                        <div class="testimonial-info">
                                            <h6 class="testimonial-name mb-1">{{ $testimonial->customer_name }}</h6>
                                            @if($testimonial->customer_title)
                                                <small class="testimonial-title text-muted">{{ $testimonial->customer_title }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="rating mb-3">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $testimonial->rating)
                                                <i class="fas fa-star text-warning"></i>
                                            @else
                                                <i class="far fa-star text-muted"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    
                                    <blockquote class="testimonial-content">
                                        <p class="mb-0">"{{ $testimonial->content }}"</p>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Quy trình đặt tài xế -->
    <section class="steps-section py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <div class="section-badge mb-3">
                    <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">
                        <i class="fas fa-route me-2"></i>Quy trình
                    </span>
                </div>
                <h2 class="section-title">Quy trình đặt tài xế</h2>
                <p class="section-subtitle text-muted">Chỉ 4 bước đơn giản để có tài xế chuyên nghiệp</p>
            </div>

            <div class="steps-timeline">
                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="step-item text-center position-relative">
                            <div class="step-number-wrapper mb-4">
                                <div class="step-number">1</div>
                            </div>
                            <div class="step-icon mb-3">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <h5 class="step-title mb-3">Gọi hotline hoặc điền form</h5>
                            <p class="step-description text-muted">Liên hệ qua hotline hoặc điền form đặt dịch vụ</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="step-item text-center position-relative">
                            <div class="step-number-wrapper mb-4">
                                <div class="step-number">2</div>
                            </div>
                            <div class="step-icon mb-3">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h5 class="step-title mb-3">Xác nhận dịch vụ</h5>
                            <p class="step-description text-muted">Chúng tôi xác nhận thông tin và báo giá chi tiết</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="step-item text-center position-relative">
                            <div class="step-number-wrapper mb-4">
                                <div class="step-number">3</div>
                            </div>
                            <div class="step-icon mb-3">
                                <i class="fas fa-car"></i>
                            </div>
                            <h5 class="step-title mb-3">Tài xế đến đón</h5>
                            <p class="step-description text-muted">Tài xế đến đúng địa điểm và thời gian đã hẹn</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="step-item text-center position-relative">
                            <div class="step-number-wrapper mb-4">
                                <div class="step-number">4</div>
                            </div>
                            <div class="step-icon mb-3">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <h5 class="step-title mb-3">Thanh toán sau chuyến</h5>
                            <p class="step-description text-muted">Thanh toán sau khi hoàn thành chuyến đi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bảng giá nổi bật -->
    <section class="pricing-section py-5 bg-light">
        <div class="container">
            <div class="section-header text-center mb-5">
                <div class="section-badge mb-3">
                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">
                        <i class="fas fa-tags me-2"></i>Bảng giá
                    </span>
                </div>
                <h2 class="section-title">Bảng giá dịch vụ</h2>
                <p class="section-subtitle text-muted">Giá cả minh bạch, không phát sinh chi phí</p>
            </div>

            <div class="row">
                @if(count($featuredServices) > 0)
                    @foreach($featuredServices as $service)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="pricing-card card h-100 border-0 shadow-sm hover-lift">
                                <div class="card-header bg-primary text-white text-center py-4">
                                    <h5 class="card-title mb-0">{{ $service->name }}</h5>
                                </div>
                                <div class="card-body text-center p-4">
                                    <p class="card-text text-muted mb-4">{{ $service->short_description }}</p>
                                    
                                    @if($service->price_per_hour)
                                        <div class="pricing-amount mb-3">
                                            <span class="price-currency">₫</span>
                                            <span class="price-value">{{ number_format($service->price_per_hour) }}</span>
                                            <span class="price-period">/giờ</span>
                                        </div>
                                    @endif
                                    
                                    @if($service->price_per_trip)
                                        <div class="pricing-amount mb-3">
                                            <span class="price-currency">₫</span>
                                            <span class="price-value">{{ number_format($service->price_per_trip) }}</span>
                                            <span class="price-period">/chuyến</span>
                                        </div>
                                    @endif
                                    
                                    <button class="btn btn-primary book-service-btn w-100" 
                                            data-service-id="{{ $service->id }}" 
                                            data-service-name="{{ $service->name }}">
                                        <i class="fas fa-calendar-check me-2"></i>Đặt ngay
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            
            <div class="text-center mt-5">
                <a href="{{ route('driver.pricing') }}" class="btn btn-outline-primary btn-lg px-5">
                    <i class="fas fa-list me-2"></i>Xem bảng giá đầy đủ
                </a>
            </div>
        </div>
    </section>

    <!-- Thông tin liên hệ nhanh -->
    <section class="contact-info-section py-5 bg-gradient-primary text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="section-badge mb-3">
                        <span class="badge bg-white bg-opacity-25 text-white px-3 py-2 rounded-pill">
                            <i class="fas fa-phone me-2"></i>Liên hệ
                        </span>
                    </div>
                    <h2 class="section-title mb-5">Liên hệ ngay với chúng tôi</h2>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="contact-item">
                                <div class="contact-icon mb-3">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <h5 class="contact-title mb-2">Hotline</h5>
                                <p class="contact-value mb-0">1900 xxxx</p>
                                <small class="contact-subtitle">Hỗ trợ 24/7</small>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="contact-item">
                                <div class="contact-icon mb-3">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h5 class="contact-title mb-2">Email</h5>
                                <p class="contact-value mb-0">info@thuelai.vn</p>
                                <small class="contact-subtitle">Phản hồi nhanh</small>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="contact-item">
                                <div class="contact-icon mb-3">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <h5 class="contact-title mb-2">Địa chỉ</h5>
                                <p class="contact-value mb-0">Hà Nội, Việt Nam</p>
                                <small class="contact-subtitle">Trụ sở chính</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Form đặt dịch vụ nhanh -->
    <section id="booking-form" class="booking-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="section-header text-center mb-5">
                        <div class="section-badge mb-3">
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                <i class="fas fa-calendar-check me-2"></i>Đặt dịch vụ
                            </span>
                        </div>
                        <h2 class="section-title">Đặt dịch vụ nhanh</h2>
                        <p class="section-subtitle text-muted">Điền thông tin để được tư vấn và đặt dịch vụ ngay</p>
                    </div>
                    
                    <div class="card border-0 shadow-lg">
                        <div class="card-header bg-primary text-white text-center py-4">
                            <h3 class="mb-0">
                                <i class="fas fa-car me-2"></i>Thông tin đặt dịch vụ
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <form id="quick-booking-form">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="customer_name" class="form-label">
                                            <i class="fas fa-user me-2"></i>Họ tên *
                                        </label>
                                        <input type="text" class="form-control form-control-lg" id="customer_name" name="customer_name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="customer_phone" class="form-label">
                                            <i class="fas fa-phone me-2"></i>Số điện thoại *
                                        </label>
                                        <input type="tel" class="form-control form-control-lg" id="customer_phone" name="customer_phone" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="driver_service_id" class="form-label">
                                            <i class="fas fa-cogs me-2"></i>Loại dịch vụ *
                                        </label>
                                        <select class="form-select form-select-lg" id="driver_service_id" name="driver_service_id" required>
                                            <option value="">Chọn dịch vụ</option>
                                            @foreach($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="service_type" class="form-label">
                                            <i class="fas fa-clock me-2"></i>Hình thức dịch vụ *
                                        </label>
                                        <select class="form-select form-select-lg" id="service_type" name="service_type" required>
                                            <option value="">Chọn hình thức</option>
                                            <option value="hourly">Theo giờ</option>
                                            <option value="trip">Theo chuyến</option>
                                            <option value="custom">Tùy chỉnh</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="pickup_datetime" class="form-label">
                                            <i class="fas fa-calendar me-2"></i>Thời gian đón *
                                        </label>
                                        <input type="datetime-local" class="form-control form-control-lg" id="pickup_datetime" name="pickup_datetime" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="hours" class="form-label">
                                            <i class="fas fa-hourglass-half me-2"></i>Số giờ (nếu theo giờ)
                                        </label>
                                        <input type="number" class="form-control form-control-lg" id="hours" name="hours" min="1" value="4">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="pickup_location" class="form-label">
                                        <i class="fas fa-map-marker-alt me-2"></i>Địa điểm đón *
                                    </label>
                                    <input type="text" class="form-control form-control-lg" id="pickup_location" name="pickup_location" required>
                                </div>
                                <div class="mb-3">
                                    <label for="destination" class="form-label">
                                        <i class="fas fa-flag-checkered me-2"></i>Điểm đến
                                    </label>
                                    <input type="text" class="form-control form-control-lg" id="destination" name="destination">
                                </div>
                                <div class="mb-4">
                                    <label for="special_requirements" class="form-label">
                                        <i class="fas fa-clipboard-list me-2"></i>Yêu cầu đặc biệt
                                    </label>
                                    <textarea class="form-control form-control-lg" id="special_requirements" name="special_requirements" rows="3" placeholder="Nhập yêu cầu đặc biệt nếu có..."></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg px-5 py-3">
                                        <i class="fas fa-paper-plane me-2"></i>Gửi yêu cầu
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý form đặt dịch vụ
    const form = document.getElementById('quick-booking-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());
            
            // Gửi request AJAX
            fetch('{{ route("driver.order.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    form.reset();
                } else {
                    alert('Có lỗi xảy ra. Vui lòng thử lại.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra. Vui lòng thử lại.');
            });
        });
    }

    // Xử lý nút đặt dịch vụ
    const bookButtons = document.querySelectorAll('.book-service-btn');
    bookButtons.forEach(button => {
        button.addEventListener('click', function() {
            const serviceId = this.getAttribute('data-service-id');
            const serviceName = this.getAttribute('data-service-name');
            
            // Chọn dịch vụ trong form
            document.getElementById('driver_service_id').value = serviceId;
            
            // Scroll đến form
            document.getElementById('booking-form').scrollIntoView({ behavior: 'smooth' });
        });
    });

    // Animation cho các elements khi scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    // Observe các elements cần animation
    document.querySelectorAll('.service-card, .benefit-card, .testimonial-card, .step-item').forEach(el => {
        observer.observe(el);
    });
});
</script>
@endsection
