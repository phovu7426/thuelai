<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test HTML - {{ $application->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <h1>Test HTML - {{ $application->name }}</h1>
        
        <div class="alert alert-info">
            <p>Đây là trang test để kiểm tra cách hiển thị nội dung HTML.</p>
            <p>URL hiện tại: <code>{{ url()->current() }}</code></p>
        </div>
        
        <div class="card my-4">
            <div class="card-header">
                <h3>Nội dung gốc (Raw Content)</h3>
            </div>
            <div class="card-body">
                <pre>{{ $application->content }}</pre>
            </div>
        </div>
        
        <div class="card my-4">
            <div class="card-header">
                <h3>Nội dung HTML (Rendered with {!! $application->content !!})</h3>
            </div>
            <div class="card-body">
                {!! $application->content !!}
            </div>
        </div>
        
        <div class="card my-4">
            <div class="card-header">
                <h3>Nội dung HTML (Rendered with {!! html_entity_decode($application->content) !!})</h3>
            </div>
            <div class="card-body">
                {!! html_entity_decode($application->content) !!}
            </div>
        </div>
        
        <div class="card my-4">
            <div class="card-header">
                <h3>Mô tả (Description) - Sử dụng {!! $application->description !!}</h3>
            </div>
            <div class="card-body">
                {!! $application->description !!}
            </div>
        </div>
        
        <div class="card my-4">
            <div class="card-header">
                <h3>Mô tả (Description) - Sử dụng {{ $application->description }}</h3>
            </div>
            <div class="card-body">
                {{ $application->description }}
            </div>
        </div>
        
        <div class="card my-4">
            <div class="card-header">
                <h3>Loại (Type)</h3>
            </div>
            <div class="card-body">
                {{ $application->type_text }}
            </div>
        </div>
        
        <div class="mt-4">
            <a href="{{ route('stone.applications.show', $application->slug) }}" class="btn btn-primary">Quay lại trang chi tiết</a>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 