<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Page - {{ $application->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="alert alert-info">
            <h2>Đây là trang test đơn giản</h2>
            <p>URL: {{ url()->current() }}</p>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h1>{{ $application->name }}</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset('images/default/default_image.png') }}" class="img-fluid" alt="{{ $application->name }}">
                    </div>
                    <div class="col-md-8">
                        <h3>Mô tả</h3>
                        <p>{{ $application->description }}</p>
                        
                        <h3>Nội dung</h3>
                        <div class="content border p-3 mt-3">
                            {!! $application->content !!}
                        </div>
                        
                        <h3>Loại</h3>
                        <p>{{ $application->type_text }}</p>
                        
                        <a href="{{ route('stone.applications.index') }}" class="btn btn-primary mt-3">Quay lại danh sách</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 