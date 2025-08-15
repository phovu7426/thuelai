@extends('driver.layouts.main')

@section('page_title', 'Dịch vụ lái xe thuê - ThuêLai.vn')

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
                        Dịch vụ chất lượng cao
                    </span>
                </div>
                <h1 class="hero-title">
                    <span class="title-line">Dịch vụ lái xe</span>
                    <span class="title-highlight">chuyên nghiệp</span>
                    <span class="title-line">đa dạng</span>
                </h1>
                <p class="hero-description">
                    Khám phá các gói dịch vụ lái xe thuê đa dạng, phù hợp với mọi nhu cầu 
                    từ cá nhân đến doanh nghiệp với chất lượng dịch vụ hàng đầu
                </p>
            </div>
        </div>
        <div class="scroll-indicator">
            <div class="scroll-arrow">
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Các gói dịch vụ của chúng tôi</h2>
                <p class="section-subtitle">
                    Đa dạng các gói dịch vụ lái xe thuê phù hợp với mọi nhu cầu của bạn
                </p>
            </div>

            <div class="services-grid">
                @if(count($services) > 0)
                    @foreach($services as $service)
                        <div class="service-card-modern animate-in">
                            <div class="service-header">
                                @if($service->image)
                                    <div class="service-icon-wrapper">
                                        <img src="{{ $service->image_url }}" alt="{{ $service->name }}">
                                    </div>
                                @else
                                    <div class="service-icon-wrapper">
                                        <i class="fas fa-car"></i>
                                    </div>
                                @endif
                                @if($service->is_featured)
                                    <div class="featured-tag">Nổi bật</div>
                                @endif
                            </div>
                            
                            <div class="service-content">
                                <h3 class="service-title">{{ $service->name }}</h3>
                                <p class="service-description">{{ $service->description }}</p>
                                

                                
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
                        <h3>Chưa có dịch vụ nào</h3>
                        <p>Vui lòng quay lại sau hoặc liên hệ với chúng tôi để được tư vấn.</p>
                    </div>
                @endif
            </div>
            
            <!-- Pagination -->
            @if($services->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $services->links() }}
                </div>
            @endif
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Tại sao chọn chúng tôi?</h2>
                <p class="section-subtitle">
                    Những lý do khiến ThuêLai.vn trở thành lựa chọn hàng đầu cho dịch vụ lái xe thuê
                </p>
            </div>

            <div class="features-grid">
                <div class="feature-item animate-in">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="feature-content">
                        <h3>An toàn tuyệt đối</h3>
                        <p>Tài xế được đào tạo bài bản, xe được bảo dưỡng định kỳ và bảo hiểm đầy đủ</p>
                    </div>
                </div>

                <div class="feature-item animate-in">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Dịch vụ 24/7</h3>
                        <p>Luôn sẵn sàng phục vụ mọi lúc, mọi nơi với đội ngũ tài xế chuyên nghiệp</p>
                    </div>
                </div>

                <div class="feature-item animate-in">
                    <div class="feature-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Giá cả hợp lý</h3>
                        <p>Bảng giá minh bạch, không phát sinh chi phí ẩn và nhiều ưu đãi hấp dẫn</p>
                    </div>
                </div>

                <div class="feature-item animate-in">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Hỗ trợ tận tâm</h3>
                        <p>Đội ngũ chăm sóc khách hàng chuyên nghiệp, sẵn sàng hỗ trợ mọi vấn đề</p>
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
                    <h2>Bạn cần tư vấn về dịch vụ?</h2>
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
                    <a href="{{ route('driver.pricing') }}" class="btn-secondary">
                        <i class="fas fa-list"></i>
                        <span>Xem bảng giá</span>
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



    // Smooth scroll for scroll indicator
    const scrollArrow = document.querySelector('.scroll-arrow');
    if (scrollArrow) {
        scrollArrow.addEventListener('click', function() {
            const servicesSection = document.querySelector('.services-section');
            if (servicesSection) {
                servicesSection.scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    }
});
</script>
@endsection

