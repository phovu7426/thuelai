<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title', 'Dịch vụ lái xe thuê')</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('fontawesome-free-6.5.1-web/css/all.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/driver.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body>
    <!-- Modern Header -->
    <header class="modern-header">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ route('driver.home') }}">
                    <div class="brand-logo">
                        <i class="fas fa-car"></i>
                        <span>ThuêLai.vn</span>
                    </div>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('driver.home') }}">
                                <i class="fas fa-home"></i>
                                <span>Trang chủ</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('driver.services') }}">
                                <i class="fas fa-cogs"></i>
                                <span>Dịch vụ</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('driver.pricing') }}">
                                <i class="fas fa-tags"></i>
                                <span>Bảng giá</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('driver.news') }}">
                                <i class="fas fa-newspaper"></i>
                                <span>Tin tức</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('driver.about') }}">
                                <i class="fas fa-info-circle"></i>
                                <span>Giới thiệu</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('driver.contact') }}">
                                <i class="fas fa-phone"></i>
                                <span>Liên hệ</span>
                            </a>
                        </li>
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle user-menu" href="#" role="button"
                                    data-bs-toggle="dropdown">
                                    <div class="user-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <span>{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu modern-dropdown">

                                    <li>
                                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                                            <i class="fas fa-tachometer-alt"></i>
                                            <span>Quản lý</span>
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-sign-out-alt"></i>
                                                <span>Đăng xuất</span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link login-btn" href="{{ route('login.index') }}">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span>Đăng nhập</span>
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Floating Social Icons -->
    <div class="floating-social-container" id="floatingSocial">
        <div class="floating-social-toggle" id="socialToggle">
            <i class="fas fa-comments"></i>
        </div>
        <div class="floating-social-menu" id="socialMenu">
            <div class="social-close-btn" id="socialCloseBtn">
                <i class="fas fa-times"></i>
            </div>

            {{-- Zalo --}}
            <div class="social-item" id="zaloBtn">
                <div class="social-icon zalo">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <span class="social-label">Zalo</span>
            </div>

            {{-- Facebook --}}
            <div class="social-item" id="facebookBtn">
                <div class="social-icon facebook">
                    <i class="fab fa-facebook-f"></i>
                </div>
                <span class="social-label">Facebook</span>
            </div>

            {{-- Hotline --}}
            @if ($contactPhone)
                <div class="social-item" id="phoneBtn">
                    <div class="social-icon phone">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <span class="social-label">Hotline</span>
                </div>
            @endif
        </div>
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Modern Footer -->
    <footer class="modern-footer">
        <div class="footer-waves">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="currentColor" fill-opacity="1"
                    d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg>
        </div>

        <div class="footer-content">
            <div class="container">
                <div class="footer-grid">
                    <div class="footer-section">
                        <div class="footer-brand">
                            <div class="brand-logo">
                                <i class="fas fa-car"></i>
                                <span>ThuêLai.vn</span>
                            </div>
                            <p>Dịch vụ lái xe thuê chuyên nghiệp, an toàn và uy tín hàng đầu Việt Nam. Cam kết mang đến
                                trải nghiệm dịch vụ tốt nhất cho khách hàng.</p>
                            @if (!empty($globalSocialLinks))
                                <div class="social-links">
                                    @foreach ($globalSocialLinks as $key => $social)
                                        <a href="{{ $social['url'] }}" target="_blank" class="social-link"
                                            title="{{ $social['name'] }}">
                                            @if ($key == 'facebook')
                                                <i class="fab fa-facebook-f"></i>
                                            @elseif($key == 'youtube')
                                                <i class="fab fa-youtube"></i>
                                            @elseif($key == 'instagram')
                                                <i class="fab fa-instagram"></i>
                                            @elseif($key == 'linkedin')
                                                <i class="fab fa-linkedin"></i>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="footer-section">
                        <h4>Dịch vụ</h4>
                        <ul class="footer-links">
                            <li><a href="{{ route('driver.services') }}">Lái xe theo giờ</a></li>
                            <li><a href="{{ route('driver.services') }}">Lái xe theo chuyến</a></li>
                            <li><a href="{{ route('driver.services') }}">Lái xe doanh nghiệp</a></li>
                            <li><a href="{{ route('driver.services') }}">Lái xe sự kiện</a></li>
                            <li><a href="{{ route('driver.services') }}">Lái xe du lịch</a></li>
                        </ul>
                    </div>

                    <div class="footer-section">
                        <h4>Hỗ trợ</h4>
                        <ul class="footer-links">
                            <li><a href="{{ route('driver.contact') }}">Liên hệ</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Hướng dẫn</a></li>
                            <li><a href="#">Chính sách</a></li>
                            <li><a href="#">Điều khoản</a></li>
                        </ul>
                    </div>

                    <div class="footer-section">
                        <h4>Liên hệ</h4>
                        <div class="contact-info">
                            @if ($contactPhone)
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="contact-details">
                                        <span class="contact-label">Hotline</span>
                                        <span class="contact-value">{{ $contactPhone }}</span>
                                    </div>
                                </div>
                            @endif

                            @if ($contactEmail)
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="contact-details">
                                        <span class="contact-label">Email</span>
                                        <span class="contact-value">{{ $contactEmail }}</span>
                                    </div>
                                </div>
                            @endif

                            @if ($contactAddress)
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="contact-details">
                                        <span class="contact-label">Địa chỉ</span>
                                        <span class="contact-value">{{ $contactAddress }}</span>
                                    </div>
                                </div>
                            @endif

                            @if ($contactWorkingTime)
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="contact-details">
                                        <span class="contact-label">Thời gian</span>
                                        <span class="contact-value">{{ $contactWorkingTime }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="footer-bottom">
                    <div class="footer-bottom-content">
                        <div class="copyright">
                            <p>&copy; {{ date('Y') }} <strong>ThuêLai.vn</strong>. Tất cả quyền được bảo lưu.</p>
                        </div>
                        <div class="footer-actions">
                            <a href="#" class="footer-action-link">Chính sách bảo mật</a>
                            <a href="#" class="footer-action-link">Điều khoản sử dụng</a>
                            <a href="#" class="footer-action-link">Sitemap</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <!-- Contact Data for JavaScript -->
    <script>
        window.contactData = {
            phone: @json($contactPhone ?? ''),
            email: @json($contactEmail ?? ''),
            socialLinks: @json($globalSocialLinks ?? [])
        };
    </script>

    <!-- Custom JS -->
    <script src="{{ asset('js/driver.js') }}"></script>

    <!-- Zalo SDK -->
    <script>
        // Zalo SDK Configuration
        window.ZaloSocialSDK = window.ZaloSocialSDK || {};
        window.ZaloSocialSDK.config = {
            appId: "your-zalo-app-id", // Thay bằng App ID thực tế từ Zalo Developer
            version: "v2.0"
        };

        // Load Zalo SDK
        (function(d, s, id) {
            var js, zjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "https://sp.zalo.me/plugins/sdk.js";
            zjs.parentNode.insertBefore(js, zjs);
        }(document, 'script', 'zalo-jssdk'));
    </script>

    @yield('scripts')
    @stack('scripts')
</body>

</html>
