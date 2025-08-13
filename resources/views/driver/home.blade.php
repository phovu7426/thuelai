@extends('driver.layouts.main')

@section('page_title', 'Trang chủ - Dịch vụ lái xe thuê an toàn')

@section('content')
    <!-- Hero Section với Video Background -->
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
                        Dịch vụ 5 sao được tin cậy
                    </span>
                </div>
                
                <h1 class="hero-title">
                    <span class="title-line">Lái xe an toàn</span>
                    <span class="title-highlight">chuyên nghiệp</span>
                    <span class="title-line">24/7</span>
                </h1>
                
                <p class="hero-description">
                    Dịch vụ lái xe thuê cao cấp với đội ngũ tài xế giàu kinh nghiệm, 
                    phương tiện hiện đại và dịch vụ khách hàng xuất sắc
                </p>
                
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-number" data-count="1000">0</div>
                        <div class="stat-label">Khách hàng hài lòng</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="24">0</div>
                        <div class="stat-label">Giờ hỗ trợ</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="5">0</div>
                        <div class="stat-label">Sao đánh giá</div>
                    </div>
                </div>
                
                <div class="hero-actions">
                    <a href="#booking" class="btn-primary-glow">
                        <span class="btn-text">Đặt tài xế ngay</span>
                        <span class="btn-icon">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </a>
                    <a href="#services" class="btn-secondary">
                        <i class="fas fa-play"></i>
                        <span>Xem dịch vụ</span>
                    </a>
                </div>
            </div>
            
            <div class="hero-visual">
                <div class="floating-cards">
                    <div class="card-1">
                        <div class="card-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="card-content">
                            <h4>Tài xế chuyên nghiệp</h4>
                            <p>Được đào tạo bài bản</p>
                        </div>
                    </div>
                    <div class="card-2">
                        <div class="card-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="card-content">
                            <h4>An toàn tuyệt đối</h4>
                            <p>Bảo hiểm đầy đủ</p>
                        </div>
                    </div>
                    <div class="card-3">
                        <div class="card-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="card-content">
                            <h4>Dịch vụ 24/7</h4>
                            <p>Luôn sẵn sàng phục vụ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="scroll-indicator">
            <div class="scroll-arrow">
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services-section">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <span class="badge-modern">
                        <i class="fas fa-cogs"></i>
                        Dịch vụ của chúng tôi
                    </span>
                </div>
                <h2 class="section-title">Dịch vụ đa dạng</h2>
                <p class="section-subtitle">
                    Chúng tôi cung cấp đầy đủ các dịch vụ lái xe thuê phù hợp với mọi nhu cầu
                </p>
            </div>
            
            <div class="services-grid">
                @if(count($services) > 0)
                    @foreach($services as $service)
                        <div class="service-card-modern">
                            <div class="service-header">
                                <div class="service-icon-wrapper">
                                    @if($service->icon)
                                        <img src="{{ $service->icon_url }}" alt="{{ $service->name }}">
                                    @else
                                        <i class="fas fa-car"></i>
                                    @endif
                                </div>
                                @if($service->is_featured)
                                    <div class="featured-tag">
                                        <span>Nổi bật</span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="service-content">
                                <h3 class="service-title">{{ $service->name }}</h3>
                                <p class="service-description">{{ $service->short_description }}</p>
                                
                                <div class="service-pricing">
                                    @if($service->price_per_hour)
                                        <div class="price-item">
                                            <span class="price-amount">{{ number_format($service->price_per_hour) }}đ</span>
                                            <span class="price-unit">/giờ</span>
                                        </div>
                                    @endif
                                    
                                    @if($service->price_per_trip)
                                        <div class="price-item">
                                            <span class="price-amount">{{ number_format($service->price_per_trip) }}đ</span>
                                            <span class="price-unit">/chuyến</span>
                                        </div>
                                    @endif
                                </div>
                                
                                <button class="btn-book-service" 
                                        data-service-id="{{ $service->id }}" 
                                        data-service-name="{{ $service->name }}">
                                    <span>Đặt ngay</span>
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <h3>Chưa có dịch vụ</h3>
                        <p>Chúng tôi đang cập nhật dịch vụ mới</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Tư vấn 24/7</h3>
                        <p>Đội ngũ tư vấn chuyên nghiệp luôn sẵn sàng hỗ trợ bạn mọi lúc</p>
                    </div>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="feature-content">
                        <h3>An toàn tuyệt đối</h3>
                        <p>Bảo hiểm đầy đủ và cam kết an toàn cho mọi chuyến đi</p>
                    </div>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-smile"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Phục vụ chuyên nghiệp</h3>
                        <p>Tài xế thân thiện, có kinh nghiệm và phục vụ tận tâm</p>
                    </div>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Kinh nghiệm dày dặn</h3>
                        <p>Đội ngũ tài xế có nhiều năm kinh nghiệm lái xe</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="process-section">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <span class="badge-modern">
                        <i class="fas fa-route"></i>
                        Quy trình đơn giản
                    </span>
                </div>
                <h2 class="section-title">4 bước đặt tài xế</h2>
                <p class="section-subtitle">
                    Quy trình đặt dịch vụ đơn giản, nhanh chóng chỉ trong vài phút
                </p>
            </div>
            
            <div class="process-timeline">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <div class="step-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h3>Liên hệ</h3>
                    <p>Gọi hotline hoặc điền form đặt dịch vụ</p>
                </div>
                
                <div class="process-step">
                    <div class="step-number">2</div>
                    <div class="step-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3>Xác nhận</h3>
                    <p>Chúng tôi xác nhận thông tin và báo giá</p>
                </div>
                
                <div class="process-step">
                    <div class="step-number">3</div>
                    <div class="step-icon">
                        <i class="fas fa-car"></i>
                    </div>
                    <h3>Đón khách</h3>
                    <p>Tài xế đến đúng địa điểm và thời gian</p>
                </div>
                
                <div class="process-step">
                    <div class="step-number">4</div>
                    <div class="step-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h3>Thanh toán</h3>
                    <p>Thanh toán sau khi hoàn thành chuyến đi</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    @if(count($testimonials) > 0)
    <section class="testimonials-section">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <span class="badge-modern">
                        <i class="fas fa-comments"></i>
                        Đánh giá khách hàng
                    </span>
                </div>
                <h2 class="section-title">Khách hàng nói gì?</h2>
                <p class="section-subtitle">
                    Những đánh giá chân thực từ khách hàng đã sử dụng dịch vụ
                </p>
            </div>
            
            <div class="testimonials-grid">
                @foreach($testimonials as $testimonial)
                    <div class="testimonial-card-modern">
                        <div class="testimonial-header">
                            @if($testimonial->image)
                                <img src="{{ $testimonial->image_url }}" alt="{{ $testimonial->customer_name }}" class="customer-avatar">
                            @else
                                <div class="customer-avatar-placeholder">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                            <div class="customer-info">
                                <h4>{{ $testimonial->customer_name }}</h4>
                                @if($testimonial->customer_title)
                                    <span>{{ $testimonial->customer_title }}</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="rating-stars">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $testimonial->rating)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        
                        <blockquote>
                            "{{ $testimonial->content }}"
                        </blockquote>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Pricing Section -->
    <section class="pricing-section">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <span class="badge-modern">
                        <i class="fas fa-tags"></i>
                        Bảng giá
                    </span>
                </div>
                <h2 class="section-title">Giá cả minh bạch</h2>
                <p class="section-subtitle">
                    Không phát sinh chi phí, giá cả rõ ràng và cạnh tranh
                </p>
            </div>
            
            <div class="pricing-grid">
                @if(count($featuredServices) > 0)
                    @foreach($featuredServices as $service)
                        <div class="pricing-card-modern">
                            <div class="pricing-header">
                                <h3>{{ $service->name }}</h3>
                                <p>{{ $service->short_description }}</p>
                            </div>
                            
                            <div class="pricing-body">
                                @if($service->price_per_hour)
                                    <div class="price-display">
                                        <span class="currency">₫</span>
                                        <span class="amount">{{ number_format($service->price_per_hour) }}</span>
                                        <span class="period">/giờ</span>
                                    </div>
                                @endif
                                
                                @if($service->price_per_trip)
                                    <div class="price-display">
                                        <span class="currency">₫</span>
                                        <span class="amount">{{ number_format($service->price_per_trip) }}</span>
                                        <span class="period">/chuyến</span>
                                    </div>
                                @endif
                                
                                <button class="btn-book-pricing" 
                                        data-service-id="{{ $service->id }}" 
                                        data-service-name="{{ $service->name }}">
                                    Đặt ngay
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-content">
                <div class="contact-info">
                    <div class="section-badge">
                        <span class="badge-modern">
                            <i class="fas fa-phone"></i>
                            Liên hệ ngay
                        </span>
                    </div>
                    <h2>Hãy liên hệ với chúng tôi</h2>
                    <p>Đội ngũ tư vấn chuyên nghiệp luôn sẵn sàng hỗ trợ bạn</p>
                    
                    <div class="contact-methods">
                        <div class="contact-method">
                            <div class="method-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="method-info">
                                <h4>Hotline</h4>
                                <p>1900 xxxx</p>
                                <span>Hỗ trợ 24/7</span>
                            </div>
                        </div>
                        
                        <div class="contact-method">
                            <div class="method-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="method-info">
                                <h4>Email</h4>
                                <p>info@thuelai.vn</p>
                                <span>Phản hồi nhanh</span>
                            </div>
                        </div>
                        
                        <div class="contact-method">
                            <div class="method-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="method-info">
                                <h4>Địa chỉ</h4>
                                <p>Hà Nội, Việt Nam</p>
                                <span>Trụ sở chính</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Form Section -->
    <section id="booking" class="booking-section">
        <div class="container">
            <div class="booking-content">
                <div class="section-header">
                    <div class="section-badge">
                        <span class="badge-modern">
                            <i class="fas fa-calendar-check"></i>
                            Đặt dịch vụ
                        </span>
                    </div>
                    <h2 class="section-title">Đặt dịch vụ nhanh</h2>
                    <p class="section-subtitle">
                        Điền thông tin để được tư vấn và đặt dịch vụ ngay lập tức
                    </p>
                </div>
                
                <div class="booking-form-container">
                    <form id="quick-booking-form" class="booking-form-modern">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="customer_name">
                                    <i class="fas fa-user"></i>
                                    Họ tên *
                                </label>
                                <input type="text" id="customer_name" name="customer_name" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="customer_phone">
                                    <i class="fas fa-phone"></i>
                                    Số điện thoại *
                                </label>
                                <input type="tel" id="customer_phone" name="customer_phone" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="driver_service_id">
                                    <i class="fas fa-cogs"></i>
                                    Loại dịch vụ *
                                </label>
                                <select id="driver_service_id" name="driver_service_id" required>
                                    <option value="">Chọn dịch vụ</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="service_type">
                                    <i class="fas fa-clock"></i>
                                    Hình thức dịch vụ *
                                </label>
                                <select id="service_type" name="service_type" required>
                                    <option value="">Chọn hình thức</option>
                                    <option value="hourly">Theo giờ</option>
                                    <option value="trip">Theo chuyến</option>
                                    <option value="custom">Tùy chỉnh</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="pickup_datetime">
                                    <i class="fas fa-calendar"></i>
                                    Thời gian đón *
                                </label>
                                <input type="datetime-local" id="pickup_datetime" name="pickup_datetime" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="hours">
                                    <i class="fas fa-hourglass-half"></i>
                                    Số giờ (nếu theo giờ)
                                </label>
                                <input type="number" id="hours" name="hours" min="1" value="4">
                            </div>
                        </div>
                        
                        <div class="form-group full-width">
                            <label for="pickup_location">
                                <i class="fas fa-map-marker-alt"></i>
                                Địa điểm đón *
                            </label>
                            <input type="text" id="pickup_location" name="pickup_location" required>
                        </div>
                        
                        <div class="form-group full-width">
                            <label for="destination">
                                <i class="fas fa-flag-checkered"></i>
                                Điểm đến
                            </label>
                            <input type="text" id="destination" name="destination">
                        </div>
                        
                        <div class="form-group full-width">
                            <label for="special_requirements">
                                <i class="fas fa-clipboard-list"></i>
                                Yêu cầu đặc biệt
                            </label>
                            <textarea id="special_requirements" name="special_requirements" rows="3" placeholder="Nhập yêu cầu đặc biệt nếu có..."></textarea>
                        </div>
                        
                        <div class="form-submit">
                            <button type="submit" class="btn-submit">
                                <span>Gửi yêu cầu</span>
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Counter Animation
    const counters = document.querySelectorAll('.stat-number');
    const animateCounters = () => {
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-count'));
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;
            
            const updateCounter = () => {
                current += step;
                if (current < target) {
                    counter.textContent = Math.floor(current);
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target;
                }
            };
            
            updateCounter();
        });
    };

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                
                // Trigger counter animation for hero stats
                if (entry.target.classList.contains('hero-stats')) {
                    animateCounters();
                }
            }
        });
    }, observerOptions);

    // Observe elements
    document.querySelectorAll('.service-card-modern, .feature-item, .process-step, .testimonial-card-modern, .pricing-card-modern, .hero-stats').forEach(el => {
        observer.observe(el);
    });

    // Form handling
    const form = document.getElementById('quick-booking-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());
            
            // Show loading state
            const submitBtn = form.querySelector('.btn-submit');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang gửi...';
            submitBtn.disabled = true;
            
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
                    showNotification('Thành công! Chúng tôi sẽ liên hệ với bạn sớm nhất.', 'success');
                    form.reset();
                } else {
                    showNotification('Có lỗi xảy ra. Vui lòng thử lại.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Có lỗi xảy ra. Vui lòng thử lại.', 'error');
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
    }

    // Book service buttons
    document.querySelectorAll('.btn-book-service, .btn-book-pricing').forEach(button => {
        button.addEventListener('click', function() {
            const serviceId = this.getAttribute('data-service-id');
            const serviceName = this.getAttribute('data-service-name');
            
            document.getElementById('driver_service_id').value = serviceId;
            document.getElementById('booking').scrollIntoView({ behavior: 'smooth' });
        });
    });

    // Smooth scroll for navigation
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Notification function
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);
        
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }
});
</script>
@endsection
