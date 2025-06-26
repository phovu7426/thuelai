<?php
// Bootstrap Laravel
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// Get showrooms
$showrooms = App\Models\StoneShowroom::where('status', 1)
    ->orderBy('order', 'asc')
    ->get();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Showroom đá</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container py-5">
        <h1 class="mb-4">Hệ thống showroom</h1>
        
        <div class="row mt-4">
            <?php if(count($showrooms) > 0): ?>
                <?php foreach($showrooms as $showroom): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="<?php echo asset('images/default/default_image.png'); ?>" class="card-img-top" alt="<?php echo $showroom->name; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $showroom->name; ?></h5>
                                <p class="card-text"><i class="fas fa-map-marker-alt me-2"></i> <?php echo $showroom->address; ?></p>
                                <p class="card-text"><i class="fas fa-phone me-2"></i> <?php echo $showroom->phone; ?></p>
                                <a href="<?php echo route('stone.showrooms.show', $showroom->slug); ?>" class="btn btn-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info">
                        Không có showroom nào.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 