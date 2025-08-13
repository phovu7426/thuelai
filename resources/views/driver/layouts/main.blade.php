<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title', 'Dịch vụ lái xe thuê')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/driver.css') }}" rel="stylesheet">
    
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('driver.home') }}">
                <i class="fas fa-car me-2"></i>ThuêLai.vn
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('driver.home') }}">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('driver.services') }}">Dịch vụ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('driver.pricing') }}">Bảng giá</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('driver.news') }}">Tin tức</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('driver.about') }}">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('driver.contact') }}">Liên hệ</a>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Quản lý</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Đăng xuất</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login.index') }}">Đăng nhập</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main style="margin-top: 76px;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="mb-3">ThuêLai.vn</h5>
                    <p class="text-muted">Dịch vụ lái xe thuê chuyên nghiệp, an toàn và uy tín hàng đầu Việt Nam.</p>
                    <div class="social-links">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-youtube fa-lg"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-tiktok fa-lg"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="mb-3">Dịch vụ</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('driver.services') }}" class="text-muted text-decoration-none">Lái xe theo giờ</a></li>
                        <li><a href="{{ route('driver.services') }}" class="text-muted text-decoration-none">Lái xe theo chuyến</a></li>
                        <li><a href="{{ route('driver.services') }}" class="text-muted text-decoration-none">Lái xe doanh nghiệp</a></li>
                        <li><a href="{{ route('driver.services') }}" class="text-muted text-decoration-none">Lái xe sự kiện</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="mb-3">Hỗ trợ</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('driver.contact') }}" class="text-muted text-decoration-none">Liên hệ</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">FAQ</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Hướng dẫn</a></li>
                        <li><a href="#" class="text-muted text-decoration-none">Chính sách</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mb-4">
                    <h6 class="mb-3">Liên hệ</h6>
                    <div class="contact-info">
                        <p class="mb-2"><i class="fas fa-phone me-2"></i>1900 xxxx</p>
                        <p class="mb-2"><i class="fas fa-envelope me-2"></i>info@thuelai.vn</p>
                        <p class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>Hà Nội, Việt Nam</p>
                        <p class="mb-0"><i class="fas fa-clock me-2"></i>24/7</p>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-muted">&copy; {{ date('Y') }} ThuêLai.vn. Tất cả quyền được bảo lưu.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0 text-muted">Được phát triển bởi <a href="#" class="text-white text-decoration-none">ThuêLai.vn</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/driver.js') }}"></script>
    
    @yield('scripts')
    @stack('scripts')
</body>
</html>
