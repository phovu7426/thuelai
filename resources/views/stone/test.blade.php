<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <h1>Test Page - {{ $application->name }}</h1>
        
        <div class="card my-4">
            <div class="card-header">
                <h3>Nội dung (Content)</h3>
            </div>
            <div class="card-body">
                {!! $application->content !!}
            </div>
        </div>
        
        <div class="card my-4">
            <div class="card-header">
                <h3>Mô tả (Description)</h3>
            </div>
            <div class="card-body">
                {!! $application->description !!}
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
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 