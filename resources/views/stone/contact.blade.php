@extends('stone.layouts.main')

@section('title', 'Liên hệ - Thanh Tùng Stone')

@section('content')
<!-- Hero Section -->
<section class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="mb-4">Liên hệ với chúng tôi</h1>
                <p class="lead">Hãy liên hệ ngay với chúng tôi để được tư vấn chi tiết và báo giá tốt nhất cho các sản phẩm đá tự nhiên cao cấp.</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h2 class="mb-4">Thông tin liên hệ</h2>
                <div class="mb-4">
                    <h5 class="mb-3">Trụ sở chính</h5>
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <i class="fas fa-map-marker-alt text-primary"></i>
                        </div>
                        <div>
                            <p class="mb-0">123 Nguyễn Văn Linh, Q. Hải Châu, Đà Nẵng</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <i class="fas fa-phone text-primary"></i>
                        </div>
                        <div>
                            <p class="mb-0">0123.456.789</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <i class="fas fa-envelope text-primary"></i>
                        </div>
                        <div>
                            <p class="mb-0">info@thanhtungstone.com</p>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h5 class="mb-3">Showroom 1</h5>
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <i class="fas fa-map-marker-alt text-primary"></i>
                        </div>
                        <div>
                            <p class="mb-0">456 Lê Duẩn, Q. Thanh Khê, Đà Nẵng</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <i class="fas fa-phone text-primary"></i>
                        </div>
                        <div>
                            <p class="mb-0">0987.654.321</p>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h5 class="mb-3">Showroom 2</h5>
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <i class="fas fa-map-marker-alt text-primary"></i>
                        </div>
                        <div>
                            <p class="mb-0">789 Nguyễn Tất Thành, Q. Liên Chiểu, Đà Nẵng</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <i class="fas fa-phone text-primary"></i>
                        </div>
                        <div>
                            <p class="mb-0">0909.123.456</p>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h5 class="mb-3">Giờ làm việc</h5>
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <i class="fas fa-clock text-primary"></i>
                        </div>
                        <div>
                            <p class="mb-0">Thứ 2 - Thứ 7: 8:00 - 17:30</p>
                            <p class="mb-0">Chủ nhật: 8:00 - 12:00</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <h5 class="mb-3">Kết nối với chúng tôi</h5>
                    <div class="social-links">
                        <a href="#" class="me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="me-2"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="me-2"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card border-0 shadow">
                    <div class="card-body p-4">
                        <h3 class="mb-4">Gửi tin nhắn cho chúng tôi</h3>
                        <form action="{{ route('stone.contact.submit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Tiêu đề</label>
                                <input type="text" class="form-control" id="subject" name="subject">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Nội dung <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi tin nhắn</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-5">Bản đồ</h2>
                <div class="ratio ratio-21x9">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.1104354055627!2d108.20760867580728!3d16.060856084632177!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142177f2ced6d8b%3A0xeac35f2960ca74a4!2zTmd1eeG7hW4gVsSDbiBMaW5oLCDEkMOgIE7hurVuZywgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1687759471120!5m2!1svi!2s" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Showrooms Section -->
<section class="section">
    <div class="container">
        <h2 class="text-center mb-5">Showroom của chúng tôi</h2>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow">
                    <img src="{{ asset('images/default/default_image.png') }}" class="card-img-top" alt="Showroom 1" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h4 class="card-title">Showroom Hải Châu</h4>
                        <p class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i> 123 Nguyễn Văn Linh, Q. Hải Châu, Đà Nẵng</p>
                        <p class="mb-2"><i class="fas fa-phone text-primary me-2"></i> 0123.456.789</p>
                        <p class="mb-3"><i class="fas fa-clock text-primary me-2"></i> 8:00 - 17:30 (Thứ 2 - Thứ 7)</p>
                        <a href="#" class="btn btn-outline-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow">
                    <img src="{{ asset('images/default/default_image.png') }}" class="card-img-top" alt="Showroom 2" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h4 class="card-title">Showroom Thanh Khê</h4>
                        <p class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i> 456 Lê Duẩn, Q. Thanh Khê, Đà Nẵng</p>
                        <p class="mb-2"><i class="fas fa-phone text-primary me-2"></i> 0987.654.321</p>
                        <p class="mb-3"><i class="fas fa-clock text-primary me-2"></i> 8:00 - 17:30 (Thứ 2 - Thứ 7)</p>
                        <a href="#" class="btn btn-outline-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow">
                    <img src="{{ asset('images/default/default_image.png') }}" class="card-img-top" alt="Showroom 3" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h4 class="card-title">Showroom Liên Chiểu</h4>
                        <p class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i> 789 Nguyễn Tất Thành, Q. Liên Chiểu, Đà Nẵng</p>
                        <p class="mb-2"><i class="fas fa-phone text-primary me-2"></i> 0909.123.456</p>
                        <p class="mb-3"><i class="fas fa-clock text-primary me-2"></i> 8:00 - 17:30 (Thứ 2 - Thứ 7)</p>
                        <a href="#" class="btn btn-outline-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 