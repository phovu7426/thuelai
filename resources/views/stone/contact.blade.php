@extends('stone.layouts.main')

@section('title', 'Liên hệ - Thanh Tùng Stone')

@section('content')
    <!-- Hero Section -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="mb-4">Liên hệ với chúng tôi</h1>
                    <p class="lead">Hãy liên hệ ngay với chúng tôi để được tư vấn chi tiết và báo giá tốt nhất cho các sản phẩm đá tự nhiên.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Info & Form -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Contact Information -->
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <h2 class="mb-4">Thông tin liên hệ</h2>
                    
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="mb-3">Văn phòng chính</h5>
                            <p class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i> 123 Nguyễn Văn Linh, Q. Hải Châu, Đà Nẵng</p>
                            <p class="mb-2"><i class="fas fa-phone text-primary me-2"></i> +84 123 456 789</p>
                            <p class="mb-2"><i class="fas fa-envelope text-primary me-2"></i> info@thanhtungstone.com</p>
                            <p class="mb-0"><i class="fas fa-clock text-primary me-2"></i> Thứ 2 - Thứ 7: 8:00 - 17:30</p>
                        </div>
                    </div>
                    
                    <h4 class="mb-3">Kết nối với chúng tôi</h4>
                    <div class="d-flex mb-4">
                        <a href="#" class="me-3 text-primary" style="font-size: 1.5rem;"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="me-3 text-primary" style="font-size: 1.5rem;"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="me-3 text-primary" style="font-size: 1.5rem;"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="text-primary" style="font-size: 1.5rem;"><i class="fab fa-tiktok"></i></a>
                    </div>
                    
                    <h4 class="mb-3">Showrooms</h4>
                    <div class="accordion" id="showroomAccordion">
                        @foreach($showrooms as $index => $showroom)
                        <div class="accordion-item border mb-3">
                            <h2 class="accordion-header" id="heading{{ $index }}">
                                <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                    {{ $showroom->name }}
                                </button>
                            </h2>
                            <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#showroomAccordion">
                                <div class="accordion-body">
                                    <p><i class="fas fa-map-marker-alt text-primary me-2"></i> {{ $showroom->address }}</p>
                                    <p><i class="fas fa-phone text-primary me-2"></i> {{ $showroom->phone }}</p>
                                    <p><i class="fas fa-envelope text-primary me-2"></i> {{ $showroom->email }}</p>
                                    <a href="{{ route('stone.showrooms.show', $showroom->slug) }}" class="btn btn-sm btn-outline-primary">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div class="col-lg-7">
                    <div class="card border-0 shadow">
                        <div class="card-body p-4">
                            <h3 class="mb-4">Gửi tin nhắn cho chúng tôi</h3>
                            <form>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" placeholder="Nhập họ và tên" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="phone" placeholder="Nhập số điện thoại" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" placeholder="Nhập địa chỉ email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Tiêu đề</label>
                                    <input type="text" class="form-control" id="subject" placeholder="Nhập tiêu đề">
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Nội dung <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="message" rows="5" placeholder="Nhập nội dung tin nhắn" required></textarea>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="agreeTerms" required>
                                    <label class="form-check-label" for="agreeTerms">
                                        Tôi đồng ý với <a href="#">điều khoản và điều kiện</a> của Thanh Tùng Stone
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Gửi tin nhắn</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Map Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Bản đồ</h2>
            <div class="ratio ratio-21x9">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.1104354852604!2d108.21987800000001!3d16.0599033!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219b155249737%3A0x794d131032eb1ee1!2zMTIzIE5ndXnhu4VuIFbEg24gTGluaCwgVsSpbmggVHJ1bmcsIFRoYW5oIEtow6osIMSQw6AgTuG6tW5nLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1688997139607!5m2!1svi!2s" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
@endsection 