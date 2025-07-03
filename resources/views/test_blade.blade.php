<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Blade Rendering</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="card">
            <div class="card-header">
                <h1>Test Blade Rendering</h1>
            </div>
            <div class="card-body">
                <h2>Biến đơn giản</h2>
                <p>Thời gian hiện tại: {{ date('Y-m-d H:i:s') }}</p>
                
                <h2>Vòng lặp</h2>
                <ul>
                    @for($i = 1; $i <= 5; $i++)
                        <li>Item {{ $i }}</li>
                    @endfor
                </ul>
                
                <h2>Điều kiện</h2>
                @if(date('H') < 12)
                    <p>Chào buổi sáng!</p>
                @elseif(date('H') < 18)
                    <p>Chào buổi chiều!</p>
                @else
                    <p>Chào buổi tối!</p>
                @endif
                
                <h2>HTML Content</h2>
                {!! "<p>Đây là <strong>HTML</strong> được render bằng {!! !!}</p>" !!}
                
                <h2>Escaped Content</h2>
                {{ "<p>Đây là <strong>HTML</strong> được escape bằng {{ }}</p>" }}
            </div>
        </div>
    </div>
</body>
</html> 