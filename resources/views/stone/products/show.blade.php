@extends('stone.layouts.main')

@section('page_title', $product->name . ' - Thanh Tùng Stone')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <style>
        .product-gallery {
            position: relative;
            margin-bottom: 30px;
        }

        .product-gallery-main {
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 15px;
        }

        .product-gallery-main .swiper-slide {
            height: 450px;
        }

        .product-gallery-main img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-gallery-thumbs {
            height: 100px;
        }

        .product-gallery-thumbs .swiper-slide {
            opacity: 0.5;
            cursor: pointer;
            height: 100px;
            border-radius: 4px;
            overflow: hidden;
            border: 2px solid transparent;
            transition: all 0.3s;
        }

        .product-gallery-thumbs .swiper-slide-thumb-active {
            opacity: 1;
            border-color: var(--primary-color);
        }

        .product-gallery-thumbs img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info h1 {
            font-size: 28px;
            margin-bottom: 15px;
        }

        .product-price {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .product-price .old-price {
            text-decoration: line-through;
            color: #999;
            font-size: 18px;
            margin-right: 10px;
        }

        .product-meta {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .product-meta-item {
            display: flex;
            margin-bottom: 10px;
        }

        .product-meta-label {
            width: 120px;
            color: #666;
        }

        .product-meta-value {
            font-weight: 500;
        }

        .product-description {
            margin-bottom: 30px;
        }

        .product-actions {
            margin-bottom: 30px;
        }

        .quantity-input {
            width: 120px;
            margin-right: 15px;
        }

        .product-tabs {
            margin-top: 60px;
        }

        .nav-tabs {
            border-bottom: 2px solid #eee;
        }

        .nav-tabs .nav-link {
            border: none;
            border-bottom: 2px solid transparent;
            color: #666;
            font-weight: 500;
            padding: 12px 20px;
            margin-bottom: -2px;
        }

        .nav-tabs .nav-link.active {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .tab-content {
            padding: 30px 0;
        }

        .related-products {
            margin-top: 60px;
        }

        .related-products h2 {
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
        }

        .related-products h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--primary-color);
        }

        .product-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 10;
        }
    </style>
@endsection

@section('content')
    <!-- Breadcrumb -->
    <section class="bg-light py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/stone') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/stone/products') }}">Sản phẩm</a></li>
                    @if ($product->category)
                        <li class="breadcrumb-item"><a
                                href="{{ url('/stone/products/category/' . $product->category->slug) }}">{{ $product->category->name }}</a>
                        </li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Product Detail -->
    <section class="section">
        <div class="container">
            <div class="row">
                <!-- Product Gallery -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="product-gallery">
                        @if ($product->is_new)
                            <div class="product-badge">
                                <span class="badge bg-primary">Mới</span>
                            </div>
                        @endif
                        @if ($product->discount_percent > 0)
                            <div class="product-badge" style="left: auto; right: 15px;">
                                <span class="badge bg-danger">-{{ $product->discount_percent }}%</span>
                            </div>
                        @endif

                        <!-- Main Gallery -->
                        <div class="swiper product-gallery-main">
                            <div class="swiper-wrapper">
                                <!-- Main image -->
                                @if ($product->main_image)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}">
                                    </div>
                                @endif

                                <!-- Gallery images -->
                                @if ($product->gallery && is_array($product->gallery))
                                    @foreach ($product->gallery as $image)
                                        <div class="swiper-slide">
                                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>

                        <!-- Thumbnails -->
                        <div class="swiper product-gallery-thumbs">
                            <div class="swiper-wrapper">
                                <!-- Main image thumbnail -->
                                @if ($product->main_image)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}">
                                    </div>
                                @endif

                                <!-- Gallery thumbnails -->
                                @if ($product->gallery && is_array($product->gallery))
                                    @foreach ($product->gallery as $image)
                                        <div class="swiper-slide">
                                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-6">
                    <div class="product-info">
                        <h1>{{ $product->name }}</h1>

                        @if ($product->code)
                            <div class="product-meta-item">
                                <div class="product-meta-label">Mã sản phẩm:</div>
                                <div class="product-meta-value">{{ $product->code }}</div>
                            </div>
                        @endif

                        <div class="product-meta-item">
                            <div class="product-meta-label">Tình trạng:</div>
                            <div class="product-meta-value">
                                @if($product->quantity > 0)
                                    <span class="text-success">Còn hàng ({{ $product->quantity }} sản phẩm)</span>
                                @else
                                    <span class="text-danger">Hết hàng</span>
                                @endif
                            </div>
                        </div>

                        <div class="product-price">
                            @if ($product->sale_price > 0)
                                <span class="old-price">{{ number_format($product->price) }}đ</span>
                                <span class="current-price">{{ number_format($product->sale_price) }}đ</span>
                            @else
                                <span class="current-price">{{ number_format($product->price) }}đ</span>
                            @endif
                        </div>

                        <div class="product-meta">
                            @if ($product->category)
                                <div class="product-meta-item">
                                    <div class="product-meta-label">Danh mục:</div>
                                    <div class="product-meta-value">
                                        <a
                                            href="{{ url('/stone/products/category/' . $product->category->slug) }}">{{ $product->category->name }}</a>
                                    </div>
                                </div>
                            @endif

                            @if ($product->material)
                                <div class="product-meta-item">
                                    <div class="product-meta-label">Chất liệu:</div>
                                    <div class="product-meta-value">{{ $product->material->name }}</div>
                                </div>
                            @endif

                            @if ($product->origin)
                                <div class="product-meta-item">
                                    <div class="product-meta-label">Xuất xứ:</div>
                                    <div class="product-meta-value">{{ $product->origin }}</div>
                                </div>
                            @endif

                            @if ($product->size)
                                <div class="product-meta-item">
                                    <div class="product-meta-label">Kích thước:</div>
                                    <div class="product-meta-value">{{ $product->size }}</div>
                                </div>
                            @endif

                            @if ($product->thickness)
                                <div class="product-meta-item">
                                    <div class="product-meta-label">Độ dày:</div>
                                    <div class="product-meta-value">{{ $product->thickness }}</div>
                                </div>
                            @endif

                            @if ($product->surface)
                                <div class="product-meta-item">
                                    <div class="product-meta-label">Bề mặt:</div>
                                    <div class="product-meta-value">{{ $product->surface->name }}</div>
                                </div>
                            @endif
                        </div>

                        <div class="product-description mb-4">
                            <p>{{ $product->short_description ?? 'Không có mô tả ngắn' }}</p>
                        </div>

                        <form action="{{ route('stone.cart.add') }}" method="POST" class="product-actions">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="d-flex flex-wrap align-items-center">
                                <div class="quantity-input me-3 mb-3">
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary" type="button"
                                            id="decrease-qty">-</button>
                                        <input type="number" class="form-control text-center" id="quantity"
                                            name="quantity" value="1" min="1">
                                        <button class="btn btn-outline-secondary" type="button"
                                            id="increase-qty">+</button>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary me-2 mb-3">
                                    <i class="fas fa-shopping-cart me-2"></i> Thêm vào giỏ hàng
                                </button>

                                <button type="button" class="btn btn-outline-primary me-2 mb-3">
                                    <i class="fas fa-heart"></i>
                                </button>

                                <button type="button" class="btn btn-outline-primary mb-3">
                                    <i class="fas fa-exchange-alt"></i>
                                </button>
                            </div>
                        </form>

                        <div class="mt-4">
                            <a href="{{ url('/stone/contact') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-phone-alt me-2"></i> Liên hệ tư vấn
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Tabs -->
    <section class="section bg-light product-tabs">
        <div class="container">
            <ul class="nav nav-tabs" id="productTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                        data-bs-target="#description" type="button" role="tab" aria-controls="description"
                        aria-selected="true">Mô tả</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="specifications-tab" data-bs-toggle="tab"
                        data-bs-target="#specifications" type="button" role="tab" aria-controls="specifications"
                        aria-selected="false">Thông số kỹ thuật</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="applications-tab" data-bs-toggle="tab" data-bs-target="#applications"
                        type="button" role="tab" aria-controls="applications" aria-selected="false">Ứng
                        dụng</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews"
                        type="button" role="tab" aria-controls="reviews" aria-selected="false">Đánh giá
                        (0)</button>
                </li>
            </ul>

            <div class="tab-content" id="productTabsContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel"
                    aria-labelledby="description-tab">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="product-description">
                                {!! $product->description ?? 'Chưa có mô tả chi tiết cho sản phẩm này.' !!}
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="mb-3">Ưu điểm sản phẩm</h5>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Chất
                                            lượng cao cấp</li>
                                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Độ bền
                                            cao</li>
                                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Dễ dàng
                                            vệ sinh</li>
                                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Màu sắc
                                            đẹp, tự nhiên</li>
                                        <li><i class="fas fa-check-circle text-primary me-2"></i> Thi công nhanh chóng</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="specifications" role="tabpanel" aria-labelledby="specifications-tab">
                    <div class="row">
                        <div class="col-lg-8">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th style="width: 30%">Mã sản phẩm</th>
                                        <td>{{ $product->code ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Danh mục</th>
                                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Chất liệu</th>
                                        <td>{{ $product->material->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Xuất xứ</th>
                                        <td>{{ $product->origin ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kích thước</th>
                                        <td>{{ $product->size ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Độ dày</th>
                                        <td>{{ $product->thickness ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bề mặt</th>
                                        <td>{{ $product->surface->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Độ cứng</th>
                                        <td>{{ $product->hardness ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Độ hút nước</th>
                                        <td>{{ $product->water_absorption ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Khả năng chịu nhiệt</th>
                                        <td>{{ $product->heat_resistance ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="applications" role="tabpanel" aria-labelledby="applications-tab">
                    <div class="row">
                        <div class="col-lg-8">
                            <h5 class="mb-4">Ứng dụng của {{ $product->name }}</h5>

                            <div class="mb-4">
                                <h6><i class="fas fa-home text-primary me-2"></i> Ứng dụng trong nội thất</h6>
                                <p>Sản phẩm đá {{ $product->name }} thích hợp cho các ứng dụng nội thất như mặt bàn bếp,
                                    mặt bàn phòng khách, bậc cầu thang, bậc cửa, mặt lavabo...</p>
                            </div>

                            <div class="mb-4">
                                <h6><i class="fas fa-building text-primary me-2"></i> Ứng dụng trong ngoại thất</h6>
                                <p>Ngoài ra, sản phẩm còn được sử dụng trong các công trình ngoại thất như ốp mặt tiền, lát
                                    sân vườn, bậc thềm, đường dạo...</p>
                            </div>

                            <div>
                                <h6><i class="fas fa-hotel text-primary me-2"></i> Ứng dụng trong công trình công cộng</h6>
                                <p>Đá {{ $product->name }} cũng được sử dụng rộng rãi trong các công trình công cộng như
                                    khách sạn, trung tâm thương mại, văn phòng...</p>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="mb-3">Dự án đã sử dụng</h5>
                                    <div class="list-group list-group-flush">
                                        @if (count($relatedProjects) > 0)
                                            @foreach ($relatedProjects as $project)
                                                <a href="{{ url('/stone/projects/' . $project->slug) }}"
                                                    class="list-group-item list-group-item-action border-0 px-0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <img src="{{ get_image_url($project->main_image) }}"
                                                                alt="{{ $project->name }}" class="rounded"
                                                                style="width: 60px; height: 60px; object-fit: cover;">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1">{{ $project->name }}</h6>
                                                            <small class="text-muted">{{ $project->location }}</small>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        @else
                                            <p class="mb-0">Chưa có dự án nào sử dụng sản phẩm này.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-4">
                                <h5>Đánh giá sản phẩm</h5>
                                <p>Chưa có đánh giá nào cho sản phẩm này.</p>
                            </div>

                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="mb-4">Viết đánh giá</h5>
                                    <form>
                                        <div class="mb-3">
                                            <label for="rating" class="form-label">Đánh giá của bạn</label>
                                            <div class="rating">
                                                <i class="far fa-star fs-5 me-1"></i>
                                                <i class="far fa-star fs-5 me-1"></i>
                                                <i class="far fa-star fs-5 me-1"></i>
                                                <i class="far fa-star fs-5 me-1"></i>
                                                <i class="far fa-star fs-5"></i>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="review-name" class="form-label">Tên của bạn</label>
                                            <input type="text" class="form-control" id="review-name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="review-email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="review-email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="review-content" class="form-label">Nội dung đánh giá</label>
                                            <textarea class="form-control" id="review-content" rows="5" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    <section class="section related-products">
        <div class="container">
            <h2>Sản phẩm liên quan</h2>

            <div class="row mt-4">
                @if (count($relatedProducts) > 0)
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="product-card card h-100">
                                <div class="position-relative">
                                    <img src="{{ get_image_url($relatedProduct->main_image) }}" class="card-img-top"
                                        alt="{{ $relatedProduct->name }}">
                                    @if ($relatedProduct->is_new)
                                        <span
                                            class="position-absolute top-0 start-0 bg-primary text-white px-2 py-1 m-2 rounded-pill">Mới</span>
                                    @endif
                                    @if ($relatedProduct->discount_percent > 0)
                                        <span
                                            class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1 m-2 rounded-pill">-{{ $relatedProduct->discount_percent }}%</span>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $relatedProduct->name }}</h5>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div>
                                            @if ($relatedProduct->discount_price)
                                                <span
                                                    class="text-decoration-line-through text-muted me-2">{{ number_format($relatedProduct->price) }}đ</span>
                                                <span
                                                    class="fw-bold text-danger">{{ number_format($relatedProduct->discount_price) }}đ</span>
                                            @else
                                                <span class="fw-bold">{{ number_format($relatedProduct->price) }}đ</span>
                                            @endif
                                        </div>
                                        <a href="{{ url('/stone/products/' . $relatedProduct->slug) }}"
                                            class="btn btn-sm btn-outline-primary">Chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <p>Không có sản phẩm liên quan.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize gallery slider
            var galleryThumbs = new Swiper('.product-gallery-thumbs', {
                spaceBetween: 10,
                slidesPerView: 4,
                freeMode: true,
                watchSlidesProgress: true,
            });

            var galleryMain = new Swiper('.product-gallery-main', {
                spaceBetween: 10,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                thumbs: {
                    swiper: galleryThumbs
                }
            });

            // Quantity input
            const quantityInput = document.getElementById('quantity');
            const decreaseBtn = document.getElementById('decrease-qty');
            const increaseBtn = document.getElementById('increase-qty');

            decreaseBtn.addEventListener('click', function() {
                const currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });

            increaseBtn.addEventListener('click', function() {
                const currentValue = parseInt(quantityInput.value);
                quantityInput.value = currentValue + 1;
            });

            // Rating stars
            const stars = document.querySelectorAll('.rating .fa-star');
            stars.forEach((star, index) => {
                star.addEventListener('click', () => {
                    stars.forEach((s, i) => {
                        if (i <= index) {
                            s.classList.remove('far');
                            s.classList.add('fas');
                        } else {
                            s.classList.remove('fas');
                            s.classList.add('far');
                        }
                    });
                });
            });
        });
    </script>
@endsection
