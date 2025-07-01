@extends('stone.layouts.main')

@section('title', 'Trang chủ - Đá tự nhiên cao cấp')

@section('content')
    <!-- Hero Slider -->
    <div class="swiper hero-slider">
        <div class="swiper-wrapper">
            @if (count($slides) > 0)
                @foreach ($slides as $slide)
                    <div class="swiper-slide hero-slide"
                        style="background-image: url('{{ asset('storage/' . $slide->image) }}');">
                        <div class="hero-content">
                            <h1>{{ $slide->title }}</h1>
                            <p>{{ $slide->description }}</p>
                            @if ($slide->link)
                                <a href="{{ $slide->link }}" class="btn btn-primary me-2">Xem chi tiết</a>
                            @else
                                <a href="{{ url('/stone/products') }}" class="btn btn-primary me-2">Xem sản phẩm</a>
                            @endif
                            <a href="{{ url('/stone/contact') }}" class="btn btn-outline-light">Liên hệ ngay</a>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Fallback slides khi không có dữ liệu -->
                <div class="swiper-slide hero-slide"
                    style="background-image: url('{{ asset('images/default/default_image.png') }}');">
                    <div class="hero-content">
                        <h1>Đá tự nhiên cao cấp</h1>
                        <p>Chuyên cung cấp và thi công đá tự nhiên cao cấp với chất lượng tốt nhất, mẫu mã đa dạng và giá cả
                            cạnh tranh.</p>
                        <a href="{{ url('/stone/products') }}" class="btn btn-primary me-2">Xem sản phẩm</a>
                        <a href="{{ url('/stone/contact') }}" class="btn btn-outline-light">Liên hệ ngay</a>
                    </div>
                </div>
                <div class="swiper-slide hero-slide"
                    style="background-image: url('{{ asset('images/default/default_image.png') }}');">
                    <div class="hero-content">
                        <h1>Đá Marble cao cấp</h1>
                        <p>Đá Marble nhập khẩu từ các mỏ đá nổi tiếng trên thế giới như Ý, Tây Ban Nha, Brazil...</p>
                        <a href="{{ url('/stone/products') }}" class="btn btn-primary me-2">Xem sản phẩm</a>
                        <a href="{{ url('/stone/contact') }}" class="btn btn-outline-light">Liên hệ ngay</a>
                    </div>
                </div>
                <div class="swiper-slide hero-slide"
                    style="background-image: url('{{ asset('images/default/default_image.png') }}');">
                    <div class="hero-content">
                        <h1>Thi công chuyên nghiệp</h1>
                        <p>Đội ngũ thợ lành nghề với nhiều năm kinh nghiệm, đảm bảo thi công đúng kỹ thuật, chính xác và
                            thẩm mỹ cao.</p>
                        <a href="{{ url('/stone/projects') }}" class="btn btn-primary me-2">Xem dự án</a>
                        <a href="{{ url('/stone/contact') }}" class="btn btn-outline-light">Liên hệ ngay</a>
                    </div>
                </div>
            @endif
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <!-- Intro Section -->
    <section class="section bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="{{ get_image_url('about_image.jpg') }}" alt="Về chúng tôi" class="img-fluid rounded shadow">
                </div>
                <div class="col-lg-6">
                    <h2 class="mb-4">Thanh Tùng Stone</h2>
                    <p class="lead mb-4">Đơn vị hàng đầu trong lĩnh vực cung cấp và thi công đá tự nhiên cao cấp tại Việt
                        Nam.</p>
                    <p>Với hơn 10 năm kinh nghiệm, chúng tôi tự hào mang đến cho khách hàng những sản phẩm đá tự nhiên chất
                        lượng cao, mẫu mã đa dạng với giá cả cạnh tranh nhất thị trường.</p>
                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-medal text-primary fa-2x"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">Chất lượng hàng đầu</h5>
                                    <p class="mb-0">Đá tự nhiên cao cấp</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-tools text-primary fa-2x"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">Thi công chuyên nghiệp</h5>
                                    <p class="mb-0">Đội ngũ thợ lành nghề</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ url('/stone/about') }}" class="btn btn-primary mt-4">Tìm hiểu thêm</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Danh mục sản phẩm</h2>
                <p>Khám phá các loại đá tự nhiên cao cấp của chúng tôi</p>
            </div>

            <div class="row">
                @if (count($categories) > 0)
                    @foreach ($categories as $category)
                        <div class="col-lg-4 col-md-6">
                            <div class="category-card">
                                <img src="{{ asset('images/default/default_image.png') }}" alt="{{ $category->name }}">
                                <div class="overlay">
                                    <div class="category-content">
                                        <h3 class="category-title">{{ $category->name }}</h3>
                                        <a href="{{ url('/stone/products/category/' . $category->slug) }}"
                                            class="btn btn-sm btn-primary">Xem sản phẩm</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <p>Không có danh mục nào.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="section bg-light">
        <div class="container">
            <div class="section-title">
                <h2>Sản phẩm nổi bật</h2>
                <p>Những sản phẩm đá tự nhiên cao cấp được ưa chuộng nhất</p>
            </div>

            <div class="row">
                @if (count($featuredProducts) > 0)
                    @foreach ($featuredProducts as $product)
                        <div class="col-lg-3 col-md-6">
                            <div class="product-card card h-100">
                                <img src="{{ asset('images/default/default_image.png') }}" class="card-img-top"
                                    alt="{{ $product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->category->name ?? 'Không có danh mục' }}</p>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <span class="text-primary fw-bold">{{ $product->material->name ?? '' }}</span>
                                    <a href="{{ url('/stone/products/' . $product->slug) }}"
                                        class="btn btn-sm btn-outline-primary">Chi tiết</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <p>Không có sản phẩm nổi bật nào.</p>
                    </div>
                @endif
            </div>

            <div class="text-center mt-5">
                <a href="{{ url('/stone/products') }}" class="btn btn-primary">Xem tất cả sản phẩm</a>
            </div>
        </div>
    </section>

    <!-- Applications Section -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Ứng dụng đá tự nhiên</h2>
                <p>Khám phá những ứng dụng tuyệt vời của đá tự nhiên trong kiến trúc và nội thất</p>
            </div>

            <div class="row">
                @if (count($applications) > 0)
                    @foreach ($applications as $application)
                        <div class="col-lg-6 col-md-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="row g-0">
                                    <div class="col-md-5">
                                        <img src="{{ asset('images/default/default_image.png') }}"
                                            class="img-fluid h-100" style="object-fit: cover;"
                                            alt="{{ $application->name }}">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $application->name }}</h5>
                                            <p class="card-text">
                                                {{ \Illuminate\Support\Str::limit($application->description ?? 'Không có mô tả', 100) }}
                                            </p>
                                            <a href="{{ url('/stone/applications/' . $application->slug) }}"
                                                class="btn btn-sm btn-outline-primary">Tìm hiểu thêm</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <p>Không có ứng dụng nào.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section class="section bg-light">
        <div class="container">
            <div class="section-title">
                <h2>Dự án tiêu biểu</h2>
                <p>Những công trình đã được chúng tôi thi công và hoàn thiện</p>
            </div>

            <div class="row">
                @if (count($featuredProjects) > 0)
                    @foreach ($featuredProjects as $project)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm overflow-hidden">
                                <img src="{{ asset('images/default/default_image.png') }}" class="card-img-top"
                                    alt="{{ $project->name }}" style="height: 250px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $project->name }}</h5>
                                    <p class="card-text">
                                        {{ \Illuminate\Support\Str::limit($project->description ?? 'Không có mô tả', 100) }}
                                    </p>
                                    <a href="{{ url('/stone/projects/' . $project->slug) }}"
                                        class="btn btn-sm btn-outline-primary">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <p>Không có dự án nào.</p>
                    </div>
                @endif
            </div>

            <div class="text-center mt-4">
                <a href="{{ url('/stone/projects') }}" class="btn btn-primary">Xem tất cả dự án</a>
            </div>
        </div>
    </section>

    <!-- Showrooms Section -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Showroom của chúng tôi</h2>
                <p>Ghé thăm showroom để trải nghiệm sản phẩm đá tự nhiên cao cấp</p>
            </div>

            <div class="row">
                @if (count($showrooms) > 0)
                    @foreach ($showrooms as $showroom)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <img src="{{ get_image_url($showroom->image) }}" class="card-img-top"
                                    alt="{{ $showroom->name }}" style="height: 250px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $showroom->name }}</h5>
                                    <p class="mb-2"><i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        {{ $showroom->address }}</p>
                                    <p class="mb-2"><i class="fas fa-phone text-primary me-2"></i>
                                        {{ $showroom->phone }}</p>
                                    <p class="mb-3"><i class="fas fa-envelope text-primary me-2"></i>
                                        {{ $showroom->email }}</p>
                                    <a href="{{ url('/stone/showrooms/' . $showroom->slug) }}"
                                        class="btn btn-sm btn-outline-primary">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <p>Không có showroom nào.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section bg-dark text-white"
        style="background-image: url('{{ asset('images/default/default_image.png') }}'); background-size: cover; background-position: center; position: relative;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.7);">
        </div>
        <div class="container position-relative">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mb-4">Bạn cần tư vấn về sản phẩm đá tự nhiên?</h2>
                    <p class="lead mb-4">Hãy liên hệ ngay với chúng tôi để được tư vấn chi tiết và báo giá tốt nhất.</p>
                    <a href="{{ url('/stone/contact') }}" class="btn btn-primary btn-lg">Liên hệ ngay</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Hero Slider
            var heroSwiper = new Swiper('.hero-slider', {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        });
    </script>
@endsection
