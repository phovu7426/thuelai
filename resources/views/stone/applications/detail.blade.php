<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $application->name }} - Cơ sở sản xuất đá ốp lát DN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mb-4">{{ $application->name }}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <img src="{{ get_image_url($application->image) }}" class="img-fluid mb-4" alt="{{ $application->name }}">
                        
                        <div class="content">
                            {!! $application->content !!}
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Thông tin</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Loại:</strong> {{ $application->type_text }}</p>
                    </div>
                </div>
                
                @if(count($relatedApplications) > 0)
                    <div class="card">
                        <div class="card-header">
                            <h5>Ứng dụng liên quan</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach($relatedApplications as $relatedApp)
                                    <li class="list-group-item">
                                        <a href="{{ route('stone.applications.detail', $relatedApp->slug) }}">
                                            {{ $relatedApp->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        @if(count($products) > 0)
            <div class="row mt-5">
                <div class="col-md-12">
                    <h3 class="mb-3">Sản phẩm sử dụng cho ứng dụng này</h3>
                </div>
            </div>
            
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('images/default/default_image.png') }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ number_format($product->price) }}đ</p>
                            </div>
                            <div class="card-footer bg-white border-top-0">
                                <a href="{{ route('stone.products.show', $product->slug) }}" class="btn btn-primary w-100">Chi tiết</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($products->hasPages())
                <div class="row mt-4">
                    <div class="col-md-12">
                        {{ $products->links() }}
                    </div>
                </div>
            @endif
        @endif
        
        <div class="mt-4">
            <a href="{{ route('stone.applications.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 