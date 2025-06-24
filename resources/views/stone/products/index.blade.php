@extends('stone.layouts.main')

@section('title', 'Sản phẩm đá tự nhiên - Thanh Tùng Stone')

@section('content')
    <!-- Hero Section -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="mb-4">Sản phẩm đá tự nhiên</h1>
                    <p class="lead">Thanh Tùng Stone cung cấp đa dạng các loại đá tự nhiên cao cấp với nhiều mẫu mã, màu sắc và hoa văn đẹp, phù hợp với mọi không gian.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="py-4 border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 mb-3 mb-md-0">
                    <h5 class="mb-0">Lọc sản phẩm:</h5>
                </div>
                <div class="col-md-8">
                    <div class="d-flex flex-wrap gap-2">
                        <div class="dropdown me-2 mb-2 mb-md-0">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Danh mục
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                                <li><a class="dropdown-item" href="{{ route('stone.products.index') }}">Tất cả</a></li>
                                @foreach($categories as $category)
                                <li><a class="dropdown-item" href="{{ route('stone.products.category', $category->slug) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <div class="dropdown me-2 mb-2 mb-md-0">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="materialDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Chất liệu
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="materialDropdown">
                                <li><a class="dropdown-item" href="{{ route('stone.products.index') }}">Tất cả</a></li>
                                @foreach($materials as $material)
                                <li><a class="dropdown-item" href="{{ route('stone.products.material', $material->slug) }}">{{ $material->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <div class="dropdown me-2 mb-2 mb-md-0">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="surfaceDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Bề mặt
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="surfaceDropdown">
                                <li><a class="dropdown-item" href="{{ route('stone.products.index') }}">Tất cả</a></li>
                                @foreach($surfaces as $surface)
                                <li><a class="dropdown-item" href="{{ route('stone.products.surface', $surface->slug) }}">{{ $surface->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <div class="dropdown mb-2 mb-md-0">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Sắp xếp
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}">Giá: Thấp đến cao</a></li>
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}">Giá: Cao đến thấp</a></li>
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}">Mới nhất</a></li>
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'name_asc']) }}">Tên: A-Z</a></li>
                                <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'name_desc']) }}">Tên: Z-A</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-5">
        <div class="container">
            @if($products->count() > 0)
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ $product->main_image ? asset('storage/'.$product->main_image) : asset('images/default/default_image.png') }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text small">{{ Str::limit($product->short_description, 80) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    @if($product->price)
                                    <p class="text-primary fw-bold mb-0">{{ number_format($product->price) }} VNĐ</p>
                                    @else
                                    <p class="text-muted mb-0">Liên hệ</p>
                                    @endif
                                    <a href="{{ route('stone.products.show', $product->slug) }}" class="btn btn-sm btn-outline-primary">Chi tiết</a>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-top-0">
                                <div class="d-flex text-muted small">
                                    @if($product->category)
                                    <span class="me-3"><i class="fas fa-tag me-1"></i> {{ $product->category->name }}</span>
                                    @endif
                                    @if($product->material)
                                    <span><i class="fas fa-cube me-1"></i> {{ $product->material->name }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <h4>Không tìm thấy sản phẩm nào</h4>
                    <p>Vui lòng thử lại với bộ lọc khác hoặc xem tất cả sản phẩm của chúng tôi</p>
                    <a href="{{ route('stone.products.index') }}" class="btn btn-primary mt-3">Xem tất cả sản phẩm</a>
                </div>
            @endif
        </div>
    </section>
@endsection 