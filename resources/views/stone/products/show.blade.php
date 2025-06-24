@extends('stone.layouts.main')

@section('title', $product->name . ' - Thanh Tùng Stone')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('stone.home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('stone.products.index') }}">Sản phẩm</a></li>
                @if($product->category)
                <li class="breadcrumb-item"><a href="{{ route('stone.products.category', $product->category->slug) }}">{{ $product->category->name }}</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </div>
    </nav>

    <!-- Product Details -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Product Images -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="position-relative mb-4">
                        <img src="{{ $product->main_image ? asset('storage/'.$product->main_image) : asset('images/default/default_image.png') }}" class="img-fluid rounded shadow" alt="{{ $product->name }}" id="mainImage">
                        @if($product->is_new)
                        <span class="position-absolute top-0 start-0 bg-success text-white px-3 py-1 m-2 rounded">Mới</span>
                        @endif
                    </div>
                    
                    @if(count($product->images) > 0)
                    <div class="row">
                        <div class="col-3 mb-3">
                            <img src="{{ $product->main_image ? asset('storage/'.$product->main_image) : asset('images/default/default_image.png') }}" class="img-fluid rounded cursor-pointer product-thumbnail" alt="{{ $product->name }}" onclick="changeMainImage(this.src)">
                        </div>
                        @foreach($product->images as $image)
                        <div class="col-3 mb-3">
                            <img src="{{ asset('storage/'.$image->image) }}" class="img-fluid rounded cursor-pointer product-thumbnail" alt="{{ $product->name }}" onclick="changeMainImage(this.src)">
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                
                <!-- Product Info -->
                <div class="col-lg-6">
                    <h1 class="mb-3">{{ $product->name }}</h1>
                    
                    @if($product->code)
                    <p class="text-muted mb-3">Mã sản phẩm: {{ $product->code }}</p>
                    @endif
                    
                    <div class="mb-4">
                        @if($product->price)
                        <h3 class="text-primary">{{ number_format($product->price) }} VNĐ</h3>
                        @else
                        <h5 class="text-muted">Giá: Liên hệ</h5>
                        @endif
                    </div>
                    
                    <div class="mb-4">
                        <p>{{ $product->short_description }}</p>
                    </div>
                    
                    <div class="d-flex flex-wrap mb-4">
                        @if($product->category)
                        <div class="me-4 mb-3">
                            <strong>Danh mục:</strong>
                            <a href="{{ route('stone.products.category', $product->category->slug) }}">{{ $product->category->name }}</a>
                        </div>
                        @endif
                        
                        @if($product->material)
                        <div class="me-4 mb-3">
                            <strong>Chất liệu:</strong>
                            <a href="{{ route('stone.products.material', $product->material->slug) }}">{{ $product->material->name }}</a>
                        </div>
                        @endif
                        
                        @if($product->surface)
                        <div class="me-4 mb-3">
                            <strong>Bề mặt:</strong>
                            <a href="{{ route('stone.products.surface', $product->surface->slug) }}">{{ $product->surface->name }}</a>
                        </div>
                        @endif
                        
                        @if($product->finish)
                        <div class="me-4 mb-3">
                            <strong>Hoàn thiện:</strong>
                            <a href="{{ route('stone.products.finish', $product->finish->slug) }}">{{ $product->finish->name }}</a>
                        </div>
                        @endif
                    </div>
                    
                    @if($product->origin)
                    <div class="mb-4">
                        <strong>Xuất xứ:</strong> {{ $product->origin }}
                    </div>
                    @endif
                    
                    @if($product->size)
                    <div class="mb-4">
                        <strong>Kích thước:</strong> {{ $product->size }}
                    </div>
                    @endif
                    
                    <div class="mb-4">
                        <a href="tel:+84123456789" class="btn btn-primary me-2">
                            <i class="fas fa-phone me-2"></i> Liên hệ đặt hàng
                        </a>
                        <a href="{{ route('stone.contact') }}" class="btn btn-outline-primary">
                            <i class="fas fa-envelope me-2"></i> Gửi yêu cầu báo giá
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Product Description & Features -->
            <div class="row mt-5">
                <div class="col-12">
                    <ul class="nav nav-tabs" id="productTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Mô tả</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="features-tab" data-bs-toggle="tab" data-bs-target="#features" type="button" role="tab" aria-controls="features" aria-selected="false">Đặc điểm</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="applications-tab" data-bs-toggle="tab" data-bs-target="#applications" type="button" role="tab" aria-controls="applications" aria-selected="false">Ứng dụng</button>
                        </li>
                    </ul>
                    <div class="tab-content p-4 border border-top-0 rounded-bottom" id="productTabContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                            {!! $product->description !!}
                        </div>
                        <div class="tab-pane fade" id="features" role="tabpanel" aria-labelledby="features-tab">
                            {!! $product->features !!}
                        </div>
                        <div class="tab-pane fade" id="applications" role="tabpanel" aria-labelledby="applications-tab">
                            {!! $product->applications !!}
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Related Products -->
            @if(count($relatedProducts) > 0)
            <div class="mt-5">
                <h3 class="mb-4">Sản phẩm liên quan</h3>
                <div class="row">
                    @foreach($relatedProducts as $relatedProduct)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ $relatedProduct->main_image ? asset('storage/'.$relatedProduct->main_image) : asset('images/default/default_image.png') }}" class="card-img-top" alt="{{ $relatedProduct->name }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $relatedProduct->name }}</h5>
                                <p class="card-text small">{{ Str::limit($relatedProduct->short_description, 80) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    @if($relatedProduct->price)
                                    <p class="text-primary fw-bold mb-0">{{ number_format($relatedProduct->price) }} VNĐ</p>
                                    @else
                                    <p class="text-muted mb-0">Liên hệ</p>
                                    @endif
                                    <a href="{{ route('stone.products.show', $relatedProduct->slug) }}" class="btn btn-sm btn-outline-primary">Chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>
@endsection

@section('additional_js')
<script>
    function changeMainImage(src) {
        document.getElementById('mainImage').src = src;
    }
</script>
@endsection 