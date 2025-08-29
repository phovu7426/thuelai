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
                <h2 class="section-title">BẢNG BÁO GIÁ LÁI XE HỖ THEO CHUYẾN</h2>
                <p class="section-subtitle">
                    Không phát sinh chi phí, giá cả rõ ràng và cạnh tranh
                </p>
            </div>

            <div class="pricing-table-container">
                <div class="pricing-table-modern">
                    <div class="table-responsive">
                        <table class="table table-bordered pricing-table">
                            <thead>
                                <tr class="table-header">
                                    <th class="text-center"
                                        style="width: {{ count($pricingRules) > 0 ? 100 / (count($pricingRules) + 1) : 20 }}%;">
                                        Thời gian</th>
                                    @foreach ($pricingRules as $rule)
                                        <th class="text-center" style="width: {{ 100 / (count($pricingRules) + 1) }}%;">
                                            <div class="time-info">
                                                <i class="{{ $rule->time_icon }}"></i>
                                                <span class="time-text">{{ $rule->time_slot }}</span>
                                            </div>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($distanceTiers as $tier)
                                    <tr class="pricing-row">
                                        <td class="distance-slot">
                                            <div class="distance-info">
                                                <i class="fas fa-route"></i>
                                                <span class="distance-text">{{ $tier->display_text }}</span>
                                            </div>
                                        </td>
                                        @foreach ($pricingRules as $rule)
                                            <td class="price-cell">
                                                @php
                                                    $pricingDistance = $rule->pricingDistances
                                                        ->where('distance_tier_id', $tier->id)
                                                        ->first();
                                                @endphp
                                                @if ($pricingDistance)
                                                    @if ($pricingDistance->price_text)
                                                        <span
                                                            class="price-negotiable">{{ $pricingDistance->price_text }}</span>
                                                    @else
                                                        <span
                                                            class="price-amount">{{ number_format($pricingDistance->price / 1000, 0) }}k</span>
                                                        <small class="price-unit">
                                                            @if ($tier->from_distance == 0 && $tier->to_distance)
                                                                /chuyến
                                                            @else
                                                                /km
                                                            @endif
                                                        </small>
                                                    @endif
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ count($pricingRules) + 1 }}" class="text-center py-5">
                                            <div class="empty-state">
                                                <div class="empty-icon">
                                                    <i class="fas fa-calculator"></i>
                                                </div>
                                                <h3>Chưa có bảng giá</h3>
                                                <p>Vui lòng liên hệ với chúng tôi để được tư vấn về giá cả.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pricing Notes -->
                <div class="pricing-notes">
                    Lưu ý: Đặt xe trước 60 phút trở lên giảm 5% - Phụ thu phí phát sinh cho đợi 50k/h
                </div>

                <!-- CTA Button -->
                <div class="pricing-cta">
                    <a href="{{ route('driver.contact') }}" class="btn-contact-now">
                        <i class="fas fa-phone"></i>
                        Liên hệ ngay
                    </a>
                </div>
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
                @if (count($services) > 0)
                    @foreach ($services as $service)
                        <div class="service-card-modern">
                            <div class="service-header">
                                <div class="service-icon-wrapper">
                                    @if ($service->icon)
                                        <img src="{{ $service->icon }}" alt="{{ $service->name }}">
                                    @else
                                        <i class="fas fa-car"></i>
                                    @endif
                                </div>
                                @if ($service->is_featured)
                                    <div class="featured-tag">
                                        <span>Nổi bật</span>
                                    </div>
                                @endif
                            </div>

                            <div class="service-content">
                                <h3 class="service-title">{{ $service->name }}</h3>
                                <p class="service-description">{{ $service->short_description }}</p>

                                <a href="{{ route('driver.contact') }}" class="btn-book-service">
                                    <span>Liên hệ tư vấn</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
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
                    Dịch vụ lái xe chất lượng, uy tín và chuyên nghiệp
                </p>
            </div>

            <div class="process-timeline">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <div class="step-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h3>Liên hệ</h3>
                    <p>Gọi hotline hoặc liên hệ trực tiếp</p>
                </div>

                <div class="process-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>

                <div class="process-step">
                    <div class="step-number">2</div>
                    <div class="step-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3>Xác nhận</h3>
                    <p>Chúng tôi xác nhận thông tin và báo giá</p>
                </div>

                <div class="process-arrow">
                    <i class="fas fa-arrow-right"></i>
                </div>

                <div class="process-step">
                    <div class="step-number">3</div>
                    <div class="step-icon">
                        <i class="fas fa-car"></i>
                    </div>
                    <h3>Đón khách</h3>
                    <p>Tài xế đến đúng địa điểm và thời gian</p>
                </div>

                <div class="process-arrow">
                    <i class="fas fa-arrow-right"></i>
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
    @if (count($testimonials) > 0)
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
                    @foreach ($testimonials as $testimonial)
                        <div class="testimonial-card-modern">
                            <div class="testimonial-header">
                                @if ($testimonial->image)
                                    <img src="{{ $testimonial->image_url }}" alt="{{ $testimonial->customer_name }}"
                                        class="customer-avatar">
                                @else
                                    <div class="customer-avatar-placeholder">
                                        <i class="fas fa-user"></i>
                                    </div>
                                @endif
                                <div class="customer-info">
                                    <h4>{{ $testimonial->customer_name }}</h4>
                                    @if ($testimonial->customer_title)
                                        <span>{{ $testimonial->customer_title }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="rating-stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $testimonial->rating)
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
                        @if ($contactPhone)
                            <div class="contact-method">
                                <div class="method-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="method-info">
                                    <h4>Hotline</h4>
                                    <p>{{ $contactPhone }}</p>
                                    <span>{{ $contactWorkingTime ?: 'Hỗ trợ 24/7' }}</span>
                                </div>
                            </div>
                        @endif

                        @if ($contactEmail)
                            <div class="contact-method">
                                <div class="method-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="method-info">
                                    <h4>Email</h4>
                                    <p>{{ $contactEmail }}</p>
                                    <span>Phản hồi nhanh</span>
                                </div>
                            </div>
                        @endif

                        @if ($contactAddress)
                            <div class="contact-method">
                                <div class="method-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="method-info">
                                    <h4>Địa chỉ</h4>
                                    <p>{{ $contactAddress }}</p>
                                    <span>Trụ sở chính</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Form Section -->
    <section id="booking" class="booking-section">
        <div class="container">
            <div class="booking-content">

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
            document.querySelectorAll(
                '.service-card-modern, .feature-item, .process-step, .testimonial-card-modern, .pricing-card-modern, .hero-stats'
            ).forEach(el => {
                observer.observe(el);
            });





            // Smooth scroll for navigation
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
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
