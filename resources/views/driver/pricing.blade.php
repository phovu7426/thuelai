@extends('driver.layouts.main')

@section('page_title', 'Bảng giá dịch vụ lái xe thuê - ThuêLai.vn')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-video-bg">
            <div class="hero-overlay"></div>
            <div class="hero-particles"></div>
        </div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <span class="badge-glow">
                        <i class="fas fa-star"></i>
                        Giá cả minh bạch
                    </span>
                </div>
                <h1 class="hero-title">
                    <span class="title-line">Bảng giá dịch vụ</span>
                    <span class="title-highlight">cạnh tranh</span>
                    <span class="title-line">và minh bạch</span>
                </h1>
                <p class="hero-description">
                    Khám phá bảng giá dịch vụ lái xe thuê với mức giá cạnh tranh, 
                    không phát sinh chi phí ẩn và nhiều ưu đãi hấp dẫn
                </p>
            </div>
        </div>
        <div class="scroll-indicator">
            <div class="scroll-arrow">
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Gói dịch vụ nổi bật</h2>
                <p class="section-subtitle">
                    Những gói dịch vụ được khách hàng lựa chọn nhiều nhất với giá cả hợp lý
                </p>
            </div>

            <div class="pricing-grid">
                @if(count($services) > 0)
                    @foreach($services->where('is_featured', true)->take(3) as $service)
                        <div class="pricing-card-modern animate-in">
                            <div class="pricing-header">
                                <h3>{{ $service->name }}</h3>
                                <p>{{ $service->short_description }}</p>
                            </div>
                            <div class="pricing-body">
                                <div class="price-display">
                                    @if($service->price_per_hour)
                                        <div class="price-item mb-3">
                                            <span class="currency">₫</span>
                                            <span class="amount">{{ number_format($service->price_per_hour) }}</span>
                                            <span class="period">/giờ</span>
                                        </div>
                                    @endif
                                    
                                    @if($service->price_per_trip)
                                        <div class="price-item">
                                            <span class="currency">₫</span>
                                            <span class="amount">{{ number_format($service->price_per_trip) }}</span>
                                            <span class="period">/chuyến</span>
                                        </div>
                                    @endif
                                </div>
                                
                                <button class="btn-book-pricing book-service-btn" 
                                        data-service-id="{{ $service->id }}" 
                                        data-service-name="{{ $service->name }}">
                                    <i class="fas fa-calendar-check"></i>
                                    <span>Đặt ngay</span>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-tags"></i>
                        </div>
                        <h3>Chưa có gói dịch vụ nào</h3>
                        <p>Vui lòng quay lại sau hoặc liên hệ với chúng tôi để được tư vấn.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Pricing Table Section -->
    <section class="services-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Bảng giá chi tiết</h2>
                <p class="section-subtitle">
                    Xem chi tiết giá cả của tất cả các dịch vụ chúng tôi cung cấp
                </p>
            </div>

            <div class="booking-form-container">
                <div class="booking-form-modern">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 30%;">Loại dịch vụ</th>
                                    <th class="text-center" style="width: 20%;">Giá theo giờ</th>
                                    <th class="text-center" style="width: 20%;">Giá theo chuyến</th>
                                    <th class="text-center" style="width: 20%;">Ghi chú</th>
                                    <th class="text-center" style="width: 10%;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($services) > 0)
                                    @foreach($services as $service)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($service->icon)
                                                        <img src="{{ $service->icon_url }}" alt="{{ $service->name }}" class="me-3" style="width: 40px; height: 40px; border-radius: 50%;">
                                                    @else
                                                        <div class="service-icon-wrapper me-3" style="width: 40px; height: 40px;">
                                                            <i class="fas fa-car"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-1">{{ $service->name }}</h6>
                                                        <small class="text-muted">{{ $service->short_description }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if($service->price_per_hour)
                                                    <span class="price-amount">{{ number_format($service->price_per_hour) }}đ</span>
                                                    <br><small class="text-muted">/giờ</small>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($service->price_per_trip)
                                                    <span class="price-amount">{{ number_format($service->price_per_trip) }}đ</span>
                                                    <br><small class="text-muted">/chuyến</small>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <small class="text-muted">
                                                    @if($service->is_featured)
                                                        <span class="badge-modern">Nổi bật</span><br>
                                                    @endif
                                                    {{ $service->description ? Str::limit($service->description, 50) : 'Không có mô tả' }}
                                                </small>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn-book-service book-service-btn" 
                                                        data-service-id="{{ $service->id }}" 
                                                        data-service-name="{{ $service->name }}">
                                                    <i class="fas fa-calendar-check"></i>
                                                    <span>Đặt</span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="empty-state">
                                                <div class="empty-icon">
                                                    <i class="fas fa-car"></i>
                                                </div>
                                                <h3>Chưa có dịch vụ nào</h3>
                                                <p>Vui lòng quay lại sau hoặc liên hệ với chúng tôi.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Thông tin bổ sung</h2>
                <p class="section-subtitle">
                    Những thông tin quan trọng về dịch vụ và chính sách của chúng tôi
                </p>
            </div>

            <div class="features-grid">
                <div class="feature-item animate-in">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Giờ làm việc</h3>
                        <p>Dịch vụ 24/7, hỗ trợ mọi lúc mọi nơi với đội ngũ tài xế chuyên nghiệp</p>
                    </div>
                </div>

                <div class="feature-item animate-in">
                    <div class="feature-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Khu vực phục vụ</h3>
                        <p>Toàn bộ Hà Nội và các tỉnh lân cận với mạng lưới tài xế rộng khắp</p>
                    </div>
                </div>

                <div class="feature-item animate-in">
                    <div class="feature-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Hình thức thanh toán</h3>
                        <p>Tiền mặt, chuyển khoản, ví điện tử với nhiều lựa chọn thuận tiện</p>
                    </div>
                </div>

                <div class="feature-item animate-in">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Bảo hiểm đầy đủ</h3>
                        <p>Bảo hiểm đầy đủ cho khách hàng và phương tiện với mức bồi thường cao</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-content">
                <div class="contact-info">
                    <h2>Bạn cần tư vấn về giá?</h2>
                    <p>Hãy liên hệ ngay với chúng tôi để được tư vấn chi tiết và báo giá tốt nhất.</p>
                </div>
                
                <div class="contact-methods">
                    <div class="contact-method">
                        <div class="method-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="method-info">
                            <h4>Gọi điện thoại</h4>
                            <p>1900 1234</p>
                            <span>Hỗ trợ 24/7</span>
                        </div>
                    </div>

                    <div class="contact-method">
                        <div class="method-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="method-info">
                            <h4>Gửi email</h4>
                            <p>info@thuelai.vn</p>
                            <span>Phản hồi trong 2h</span>
                        </div>
                    </div>

                    <div class="contact-method">
                        <div class="method-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="method-info">
                            <h4>Chat trực tuyến</h4>
                            <p>Zalo, Facebook</p>
                            <span>Phản hồi ngay lập tức</span>
                        </div>
                    </div>
                </div>

                <div class="hero-actions" style="margin-top: 3rem;">
                    <a href="{{ route('driver.contact') }}" class="btn-primary-glow">
                        <span class="btn-text">Liên hệ ngay</span>
                        <span class="btn-icon">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </a>
                    <a href="{{ route('driver.home') }}#booking" class="btn-secondary">
                        <i class="fas fa-calendar-check"></i>
                        <span>Đặt dịch vụ</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Intersection Observer for animations
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

    // Observe all elements with animate-in class
    document.querySelectorAll('.animate-in').forEach(el => {
        observer.observe(el);
    });

    // Handle service booking buttons
    const bookButtons = document.querySelectorAll('.book-service-btn');
    bookButtons.forEach(button => {
        button.addEventListener('click', function() {
            const serviceId = this.getAttribute('data-service-id');
            const serviceName = this.getAttribute('data-service-name');
            
            // Store service info in localStorage
            localStorage.setItem('selectedService', JSON.stringify({
                id: serviceId,
                name: serviceName
            }));
            
            // Redirect to home page with booking form
            window.location.href = '{{ route("driver.home") }}#booking';
        });
    });

    // Smooth scroll for scroll indicator
    const scrollArrow = document.querySelector('.scroll-arrow');
    if (scrollArrow) {
        scrollArrow.addEventListener('click', function() {
            const pricingSection = document.querySelector('.pricing-section');
            if (pricingSection) {
                pricingSection.scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    }
});
</script>
@endsection
