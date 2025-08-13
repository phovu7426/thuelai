@extends('driver.layouts.main')

@section('page_title', 'Trang chủ - Dịch vụ lái xe thuê an toàn')

@section('content')
    <!-- Hero Banner -->
    <section class="hero-banner" style="background-image: url('{{ asset('images/default/default_image.png') }}');">
        <div class="hero-overlay">
            <div class="container">
                <div class="row align-items-center min-vh-100">
                    <div class="col-lg-6">
                        <div class="hero-content text-white">
                            <h1 class="display-4 fw-bold mb-4">Lái xe an toàn, chuyên nghiệp</h1>
                            <p class="lead mb-4">Dịch vụ lái xe thuê 24/7 với đội ngũ tài xế giàu kinh nghiệm, đảm bảo an toàn tuyệt đối cho bạn và phương tiện.</p>
                            <div class="hero-buttons">
                                <a href="#booking-form" class="btn btn-primary btn-lg me-3">Đặt tài xế ngay</a>
                                <a href="{{ route('driver.services') }}" class="btn btn-outline-light btn-lg">Xem dịch vụ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Giới thiệu nhanh -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mb-4">Tại sao chọn dịch vụ lái xe của chúng tôi?</h2>
                    <p class="lead text-muted">Chúng tôi cam kết mang đến dịch vụ lái xe thuê chất lượng cao với đội ngũ tài xế chuyên nghiệp, phương tiện hiện đại và dịch vụ 24/7.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Các gói dịch vụ -->
    <section class="py-5">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Dịch vụ của chúng tôi</h2>
                <p class="text-muted">Đa dạng các gói dịch vụ phù hợp với mọi nhu cầu</p>
            </div>

            <div class="row">
                @if(count($services) > 0)
                    @foreach($services as $service)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="service-card card h-100 border-0 shadow-sm">
                                <div class="card-body text-center p-4">
                                    @if($service->icon)
                                        <div class="service-icon mb-3">
                                            <img src="{{ $service->icon_url }}" alt="{{ $service->name }}" class="img-fluid" style="width: 64px; height: 64px;">
                                        </div>
                                    @else
                                        <div class="service-icon mb-3">
                                            <i class="fas fa-car fa-3x text-primary"></i>
                                        </div>
                                    @endif
                                    <h5 class="card-title">{{ $service->name }}</h5>
                                    <p class="card-text text-muted">{{ $service->short_description }}</p>
                                    
                                    @if($service->price_per_hour)
                                        <div class="price-info mb-3">
                                            <span class="text-primary fw-bold">{{ number_format($service->price_per_hour) }}đ/giờ</span>
                                        </div>
                                    @endif
                                    
                                    @if($service->price_per_trip)
                                        <div class="price-info mb-3">
                                            <span class="text-primary fw-bold">{{ number_format($service->price_per_trip) }}đ/chuyến</span>
                                        </div>
                                    @endif
                                    
                                    <button class="btn btn-primary book-service-btn" data-service-id="{{ $service->id }}" data-service-name="{{ $service->name }}">
                                        Đặt ngay
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <p class="text-muted">Chưa có dịch vụ nào.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Lợi ích nổi bật -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Tại sao chọn chúng tôi?</h2>
                <p class="text-muted">Những lợi ích vượt trội khi sử dụng dịch vụ</p>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="benefit-item text-center">
                        <div class="benefit-icon mb-3">
                            <i class="fas fa-headset fa-3x text-primary"></i>
                        </div>
                        <h5>Tư vấn 24/7</h5>
                        <p class="text-muted">Hỗ trợ tư vấn và đặt dịch vụ mọi lúc, mọi nơi</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="benefit-item text-center">
                        <div class="benefit-icon mb-3">
                            <i class="fas fa-shield-alt fa-3x text-primary"></i>
                        </div>
                        <h5>An toàn tuyệt đối</h5>
                        <p class="text-muted">Đảm bảo an toàn cho bạn và phương tiện</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="benefit-item text-center">
                        <div class="benefit-icon mb-3">
                            <i class="fas fa-smile fa-3x text-primary"></i>
                        </div>
                        <h5>Phục vụ chuyên nghiệp</h5>
                        <p class="text-muted">Đội ngũ tài xế thân thiện, chuyên nghiệp</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="benefit-item text-center">
                        <div class="benefit-icon mb-3">
                            <i class="fas fa-award fa-3x text-primary"></i>
                        </div>
                        <h5>Kinh nghiệm dày dặn</h5>
                        <p class="text-muted">Tài xế có nhiều năm kinh nghiệm lái xe</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Phản hồi khách hàng -->
    @if(count($testimonials) > 0)
    <section class="py-5">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Khách hàng nói gì về chúng tôi?</h2>
                <p class="text-muted">Những đánh giá chân thực từ khách hàng</p>
            </div>

            <div class="row">
                @foreach($testimonials as $testimonial)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="testimonial-card card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                @if($testimonial->image)
                                    <div class="testimonial-avatar mb-3">
                                        <img src="{{ $testimonial->image_url }}" alt="{{ $testimonial->customer_name }}" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                                    </div>
                                @else
                                    <div class="testimonial-avatar mb-3">
                                        <i class="fas fa-user-circle fa-4x text-muted"></i>
                                    </div>
                                @endif
                                <div class="rating mb-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $testimonial->rating)
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star text-muted"></i>
                                        @endif
                                    @endfor
                                </div>
                                <p class="card-text fst-italic">"{{ $testimonial->content }}"</p>
                                <h6 class="card-title mb-1">{{ $testimonial->customer_name }}</h6>
                                @if($testimonial->customer_title)
                                    <small class="text-muted">{{ $testimonial->customer_title }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Quy trình đặt tài xế -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Quy trình đặt tài xế</h2>
                <p class="text-muted">Chỉ 4 bước đơn giản để có tài xế chuyên nghiệp</p>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="step-item text-center">
                        <div class="step-number mb-3">
                            <span class="badge bg-primary rounded-circle p-3">1</span>
                        </div>
                        <h5>Gọi hotline hoặc điền form</h5>
                        <p class="text-muted">Liên hệ qua hotline hoặc điền form đặt dịch vụ</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="step-item text-center">
                        <div class="step-number mb-3">
                            <span class="badge bg-primary rounded-circle p-3">2</span>
                        </div>
                        <h5>Xác nhận dịch vụ</h5>
                        <p class="text-muted">Chúng tôi xác nhận thông tin và báo giá chi tiết</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="step-item text-center">
                        <div class="step-number mb-3">
                            <span class="badge bg-primary rounded-circle p-3">3</span>
                        </div>
                        <h5>Tài xế đến đón</h5>
                        <p class="text-muted">Tài xế đến đúng địa điểm và thời gian đã hẹn</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="step-item text-center">
                        <div class="step-number mb-3">
                            <span class="badge bg-primary rounded-circle p-3">4</span>
                        </div>
                        <h5>Thanh toán sau chuyến</h5>
                        <p class="text-muted">Thanh toán sau khi hoàn thành chuyến đi</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bảng giá nổi bật -->
    <section class="py-5">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Bảng giá dịch vụ</h2>
                <p class="text-muted">Giá cả minh bạch, không phát sinh chi phí</p>
            </div>

            <div class="row">
                @if(count($featuredServices) > 0)
                    @foreach($featuredServices as $service)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="pricing-card card h-100 border-0 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <h5 class="card-title">{{ $service->name }}</h5>
                                    <p class="card-text text-muted">{{ $service->short_description }}</p>
                                    
                                    @if($service->price_per_hour)
                                        <div class="price mb-3">
                                            <span class="display-6 text-primary fw-bold">{{ number_format($service->price_per_hour) }}đ</span>
                                            <span class="text-muted">/giờ</span>
                                        </div>
                                    @endif
                                    
                                    @if($service->price_per_trip)
                                        <div class="price mb-3">
                                            <span class="display-6 text-primary fw-bold">{{ number_format($service->price_per_trip) }}đ</span>
                                            <span class="text-muted">/chuyến</span>
                                        </div>
                                    @endif
                                    
                                    <button class="btn btn-primary book-service-btn" data-service-id="{{ $service->id }}" data-service-name="{{ $service->name }}">
                                        Đặt ngay
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('driver.pricing') }}" class="btn btn-outline-primary btn-lg">Xem bảng giá đầy đủ</a>
            </div>
        </div>
    </section>

    <!-- Thông tin liên hệ nhanh -->
    <section class="py-5 bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mb-4">Liên hệ ngay với chúng tôi</h2>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="contact-item">
                                <i class="fas fa-phone fa-2x mb-3 text-primary"></i>
                                <h5>Hotline</h5>
                                <p class="mb-0">1900 xxxx</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="contact-item">
                                <i class="fas fa-envelope fa-2x mb-3 text-primary"></i>
                                <h5>Email</h5>
                                <p class="mb-0">info@thuelai.vn</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt fa-2x mb-3 text-primary"></i>
                                <h5>Địa chỉ</h5>
                                <p class="mb-0">Hà Nội, Việt Nam</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Form đặt dịch vụ nhanh -->
    <section id="booking-form" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card border-0 shadow">
                        <div class="card-header bg-primary text-white text-center py-3">
                            <h3 class="mb-0">Đặt dịch vụ nhanh</h3>
                        </div>
                        <div class="card-body p-4">
                            <form id="quick-booking-form">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="customer_name" class="form-label">Họ tên *</label>
                                        <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="customer_phone" class="form-label">Số điện thoại *</label>
                                        <input type="tel" class="form-control" id="customer_phone" name="customer_phone" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="driver_service_id" class="form-label">Loại dịch vụ *</label>
                                        <select class="form-select" id="driver_service_id" name="driver_service_id" required>
                                            <option value="">Chọn dịch vụ</option>
                                            @foreach($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="service_type" class="form-label">Hình thức dịch vụ *</label>
                                        <select class="form-select" id="service_type" name="service_type" required>
                                            <option value="">Chọn hình thức</option>
                                            <option value="hourly">Theo giờ</option>
                                            <option value="trip">Theo chuyến</option>
                                            <option value="custom">Tùy chỉnh</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="pickup_datetime" class="form-label">Thời gian đón *</label>
                                        <input type="datetime-local" class="form-control" id="pickup_datetime" name="pickup_datetime" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="hours" class="form-label">Số giờ (nếu theo giờ)</label>
                                        <input type="number" class="form-control" id="hours" name="hours" min="1" value="4">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="pickup_location" class="form-label">Địa điểm đón *</label>
                                    <input type="text" class="form-control" id="pickup_location" name="pickup_location" required>
                                </div>
                                <div class="mb-3">
                                    <label for="destination" class="form-label">Điểm đến</label>
                                    <input type="text" class="form-control" id="destination" name="destination">
                                </div>
                                <div class="mb-3">
                                    <label for="special_requirements" class="form-label">Yêu cầu đặc biệt</label>
                                    <textarea class="form-control" id="special_requirements" name="special_requirements" rows="3"></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">Gửi yêu cầu</button>
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
});
</script>
@endsection
