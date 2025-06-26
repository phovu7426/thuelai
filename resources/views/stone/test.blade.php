<!DOCTYPE html>
<html>
<head>
    <title>Test Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <h1>Test Page</h1>
        
        <div class="row mt-4">
            @foreach($showrooms as $showroom)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>{{ $showroom->name }}</h5>
                            <p>{{ $showroom->address }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-4">
            {!! $showrooms->links() !!}
        </div>
    </div>
</body>
</html> 