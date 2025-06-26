<?php

namespace App\Http\Controllers\Stone;

use App\Http\Controllers\Controller;
use App\Models\StoneShowroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ShowroomController extends Controller
{
    /**
     * Hiển thị danh sách showroom
     */
    public function index()
    {
        $showrooms = StoneShowroom::where('status', 1)
            ->orderBy('order', 'asc')
            ->paginate(12);
            
        // Generate HTML directly
        $html = '
<!DOCTYPE html>
<html>
<head>
    <title>Showroom đá</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Thanh Tùng Stone</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/stone/products">Sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/stone/showrooms">Showroom</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/stone/contact">Liên hệ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <h1 class="mb-4">Hệ thống showroom</h1>
        
        <div class="row mt-4">';
        
        if ($showrooms->count() > 0) {
            foreach ($showrooms as $showroom) {
                $html .= '
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="' . asset('images/default/default_image.png') . '" class="card-img-top" alt="' . htmlspecialchars($showroom->name) . '">
                    <div class="card-body">
                        <h5 class="card-title">' . htmlspecialchars($showroom->name) . '</h5>
                        <p class="card-text"><i class="fas fa-map-marker-alt me-2"></i> ' . htmlspecialchars($showroom->address) . '</p>
                        <p class="card-text"><i class="fas fa-phone me-2"></i> ' . htmlspecialchars($showroom->phone) . '</p>
                        <a href="' . route('stone.showrooms.show', $showroom->slug) . '" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>';
            }
        } else {
            $html .= '
            <div class="col-12">
                <div class="alert alert-info">
                    Không có showroom nào.
                </div>
            </div>';
        }
        
        $html .= '
        </div>
        
        <div class="mt-4 d-flex justify-content-center">
            ' . $showrooms->links('vendor.pagination.bootstrap-4')->toHtml() . '
        </div>
    </div>
    
    <footer class="bg-dark text-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Thanh Tùng Stone</h5>
                    <p>Chuyên cung cấp đá tự nhiên cao cấp</p>
                </div>
                <div class="col-md-4">
                    <h5>Liên hệ</h5>
                    <p>Email: contact@example.com<br>
                    Phone: 0123.456.789</p>
                </div>
                <div class="col-md-4">
                    <h5>Theo dõi chúng tôi</h5>
                    <div class="social-icons">
                        <a href="#" class="text-light me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-light me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-light me-2"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <p>&copy; ' . date('Y') . ' Thanh Tùng Stone. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>';
        
        return response($html);
    }
    
    /**
     * Hiển thị chi tiết showroom
     */
    public function show($slug)
    {
        $showroom = StoneShowroom::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();
            
        // Lấy các showroom khác
        $otherShowrooms = StoneShowroom::where('status', 1)
            ->where('id', '!=', $showroom->id)
            ->orderBy('order', 'asc')
            ->get();
            
        return view('stone.showrooms.show', compact('showroom', 'otherShowrooms'));
    }
} 