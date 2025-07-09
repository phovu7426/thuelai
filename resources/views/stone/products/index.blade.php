@extends('stone.layouts.main')

@section('page_title', 'Sản phẩm - Cơ sở sản xuất đá ốp lát DN')

@section('content')
    <!-- Hero Section -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="mb-4">Sản phẩm đá tự nhiên cao cấp</h1>
                    <p class="lead">Khám phá bộ sưu tập đá tự nhiên đa dạng và cao cấp của chúng tôi, được nhập khẩu từ các
                        mỏ đá nổi tiếng trên thế giới.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="py-4 border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <form action="" method="GET" class="d-flex gap-2">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Tìm kiếm sản phẩm..." value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> Tìm kiếm
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                    <div class="btn-group" role="group" id="view-mode">
                        <button type="button" class="btn btn-outline-primary active" data-bs-view="grid">
                            <i class="fas fa-th"></i>
                        </button>
                        <button type="button" class="btn btn-outline-primary" data-bs-view="list">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="section">
        <div class="container">
            <div class="row" id="products-grid">
                @if (count($products) > 0)
                    @foreach ($products as $product)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="product-card card h-100">
                                <div class="position-relative">
                                    <img src="{{ get_image_url($product->main_image) }}" class="card-img-top"
                                        alt="{{ $product->name }}">
                                    <!-- @if ($product->is_new)
                                        <span
                                            class="position-absolute top-0 start-0 bg-primary text-white px-2 py-1 m-2 rounded-pill">Mới</span>
                                    @endif
                                    @if ($product->discount_percent > 0)
                                        <span
                                            class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1 m-2 rounded-pill">-{{ $product->discount_percent }}%</span>
                                    @endif -->
                                    <div class="product-actions position-absolute bottom-0 end-0 m-2">
                                        <button class="btn btn-sm btn-light rounded-circle me-1" data-bs-toggle="tooltip"
                                            title="Yêu thích">
                                            <i class="far fa-heart"></i>
                                        </button>
                                        <button class="btn btn-sm btn-light rounded-circle" data-bs-toggle="tooltip"
                                            title="So sánh">
                                            <i class="fas fa-exchange-alt"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span
                                            class="badge bg-light text-dark">{{ $product->category->name ?? 'Không có danh mục' }}</span>
                                        <span class="text-primary fw-bold">{{ $product->material->name ?? '' }}</span>
                                    </div>
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text small">
                                        {!! \Illuminate\Support\Str::limit(strip_tags($product->description) ?? 'Không có mô tả', 60) !!}
                                    </p>
                                    
                                    <!-- Trạng thái sản phẩm -->
                                    <div class="text-muted small mb-2">
                                        @if($product->quantity > 0)
                                            <span class="text-success">Còn {{ $product->quantity }} sản phẩm</span>
                                        @else
                                            <span class="text-danger">Hết hàng</span>
                                        @endif
                                    </div>
                                    
                                    <hr class="my-2">
                                    
                                    <!-- Giá và nút -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <!-- Giá -->
                                        <div>
                                            @if ($product->sale_price > 0)
                                                <div>
                                                    <del class="text-muted small">{{ number_format($product->price) }}đ</del><br>
                                                    <span class="fw-bold text-danger">{{ number_format($product->sale_price) }}đ</span>
                                                </div>
                                            @else
                                                <span class="fw-bold">{{ number_format($product->price) }}đ</span>
                                            @endif
                                        </div>
                                        
                                        <!-- Nút -->
                                        <div>
                                            <form action="{{ route('stone.cart.add') }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn btn-sm btn-primary" {{ $product->quantity == 0 ? 'disabled' : '' }}>
                                                    <i class="fas fa-cart-plus"></i>
                                                </button>
                                            </form>
                                            <a href="{{ route('stone.products.show', $product->slug) }}"
                                                class="btn btn-sm btn-outline-primary ms-1">Chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-box-open fa-4x text-muted"></i>
                        </div>
                        <h4>Không tìm thấy sản phẩm nào</h4>
                        <p>Vui lòng thử lại với bộ lọc khác hoặc xem tất cả sản phẩm của chúng tôi.</p>
                        <a href="{{ route('stone.products.index') }}" class="btn btn-primary mt-3">Xem tất cả sản phẩm</a>
                    </div>
                @endif
            </div>

            <div class="row d-none" id="products-list">
                @if (count($products) > 0)
                    @foreach ($products as $product)
                        <div class="col-12 mb-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="row g-0">
                                    <div class="col-md-3 position-relative">
                                        <img src="{{ get_image_url($product->main_image) }}" class="img-fluid h-100"
                                            style="object-fit: cover;" alt="{{ $product->name }}">
                                        @if ($product->is_new)
                                            <span
                                                class="position-absolute top-0 start-0 bg-primary text-white px-2 py-1 m-2 rounded-pill">Mới</span>
                                        @endif
                                        @if ($product->discount_percent > 0)
                                            <span
                                                class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1 m-2 rounded-pill">-{{ $product->discount_percent }}%</span>
                                        @endif
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span
                                                    class="badge bg-light text-dark">{{ $product->category->name ?? 'Không có danh mục' }}</span>
                                                <span
                                                    class="text-primary fw-bold">{{ $product->material->name ?? '' }}</span>
                                            </div>
                                            <h4 class="card-title">{{ $product->name }}</h4>
                                            <p class="card-text">
                                                {!! \Illuminate\Support\Str::limit(strip_tags($product->description) ?? 'Không có mô tả', 150) !!}
                                            </p>
                                            <div class="d-flex align-items-center mt-3 mb-3">
                                                <div class="text-muted">
                                                    @if($product->quantity > 0)
                                                        <span class="text-success">Còn {{ $product->quantity }} sản phẩm</span>
                                                    @else
                                                        <span class="text-danger">Hết hàng</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row align-items-center mt-4">
                                                <div class="col-md-6">
                                                    <div class="mb-3 mb-md-0">
                                                        @if ($product->sale_price > 0)
                                                            <span
                                                                class="text-decoration-line-through text-muted me-2">{{ number_format($product->price) }}đ</span>
                                                            <span
                                                                class="fw-bold text-danger fs-5">{{ number_format($product->sale_price) }}đ</span>
                                                        @else
                                                            <span
                                                                class="fw-bold fs-5">{{ number_format($product->price) }}đ</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6 text-md-end">
                                                    <form action="{{ route('stone.cart.add') }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->id }}">
                                                        <input type="hidden" name="quantity" value="1">
                                                        <button type="submit" class="btn btn-primary me-2" {{ $product->quantity == 0 ? 'disabled' : '' }}>
                                                            <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('stone.products.show', $product->slug) }}"
                                                        class="btn btn-outline-primary me-2">Chi tiết</a>
                                                    <button class="btn btn-sm btn-light rounded-circle me-1"
                                                        data-bs-toggle="tooltip" title="Yêu thích">
                                                        <i class="far fa-heart"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-light rounded-circle"
                                                        data-bs-toggle="tooltip" title="So sánh">
                                                        <i class="fas fa-exchange-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Pagination -->
            @if ($products->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </section>

    <!-- Categories Section -->
    <section class="section bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Danh mục sản phẩm</h2>
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="category-card shadow-sm rounded overflow-hidden">
                            <img src="{{ get_image_url($category->image) }}" 
                                alt="{{ $category->name }}" class="img-fluid w-100" style="height: 250px; object-fit: cover;">
                            <div class="overlay">
                                <div class="category-content">
                                    <h3 class="category-title">{{ $category->name }}</h3>
                                    <p class="text-white mb-2">{{ $category->products_count ?? 0 }} sản phẩm</p>
                                    @if($category->children_count > 0)
                                        <p class="text-white-50 small mb-3">{{ $category->children_count }} danh mục con</p>
                                    @endif
                                    <a href="{{ route('stone.products.category', $category->slug) }}"
                                        class="btn btn-sm btn-primary">Xem sản phẩm</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mb-4">Bạn cần tư vấn về sản phẩm?</h2>
                    <p class="lead mb-4">Hãy liên hệ ngay với chúng tôi để được tư vấn chi tiết và báo giá tốt nhất.</p>
                    <a href="{{ route('stone.contact.index') }}" class="btn btn-primary btn-lg">Liên hệ ngay</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // View mode switching
            const gridView = document.getElementById('products-grid');
            const listView = document.getElementById('products-list');
            const viewButtons = document.querySelectorAll('[data-bs-view]');

            viewButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const viewMode = this.getAttribute('data-bs-view');

                    viewButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    if (viewMode === 'grid') {
                        gridView.classList.remove('d-none');
                        listView.classList.add('d-none');
                    } else {
                        gridView.classList.add('d-none');
                        listView.classList.remove('d-none');
                    }
                });
            });

            // Filter handling
            const categoryFilter = document.getElementById('category-filter');
            const materialFilter = document.getElementById('material-filter');
            const colorFilter = document.getElementById('color-filter');
            const sortBy = document.getElementById('sort-by');

            function applyFilters() {
                const params = new URLSearchParams();

                if (categoryFilter && categoryFilter.value) params.append('category_id', categoryFilter.value);
                if (materialFilter && materialFilter.value) params.append('material_id', materialFilter.value);
                if (colorFilter && colorFilter.value) params.append('color_id', colorFilter.value);
                if (sortBy && sortBy.value) params.append('sort', sortBy.value);

                window.location.href = `${window.location.pathname}?${params.toString()}`;
            }

            if (categoryFilter) categoryFilter.addEventListener('change', applyFilters);
            if (materialFilter) materialFilter.addEventListener('change', applyFilters);
            if (colorFilter) colorFilter.addEventListener('change', applyFilters);
            if (sortBy) sortBy.addEventListener('change', applyFilters);
        });
    </script>
@endsection
