<?php

include_once('admin.php');

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Home\Posts\PostController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Home\Posts\PostController as HomePostController;
use App\Http\Controllers\Stone\ApplicationController;
use App\Http\Controllers\Stone\HomeController;
use App\Http\Controllers\Stone\ProductController;
use App\Http\Controllers\Stone\ProjectController;
use App\Http\Controllers\Stone\ShowroomController;
use App\Http\Controllers\Stone\VideoController;

// Chuyển hướng trang chủ đến trang đá
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login.index'); // Hiển thị form login
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.post'); // Xử lý đăng nhập
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('login.logout'); // Xử lý đăng xuất
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login'); // Hiển thị form đăng nhập với google
Route::get('/auth/google/callback', [GoogleController::class, 'callback']); // Xử lý đăng nhập với google

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register.index'); // Hiển thị form đăng ký
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register'); // Xử lý đăng ký
Route::post('/send-otp-register', [RegisterController::class, 'sendOtp'])->name('send.register'); // Gửi OTP đăng ký tài khoản

Route::get('/forgot-password', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('forgot.password.index'); // Hiển thị form quên mật khẩu
Route::post('/send-otp-forgot-password', [ForgotPasswordController::class, 'sendOtp'])->name('send.forgot.password'); // Gửi OTP quên mật khẩu
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password'); // Xử lý tạo lại mật khẩu

// Routes cho phần trang chủ (không yêu cầu đăng nhập)
Route::prefix('home')->name('home.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/{id}', [PostController::class, 'show'])->name('show');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

Route::post('/upload', [UploadController::class, 'upload'])->name('upload');

// Home Post routes
Route::get('/posts', [HomePostController::class, 'index'])->name('home.posts.index');
Route::get('/posts/{slug}', [HomePostController::class, 'show'])->name('home.posts.show');

// Admin routes
require __DIR__.'/admin.php';

// Trang web đá
Route::prefix('stone')->name('stone.')->group(function () {
    // Trang chủ
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    // Trang giới thiệu
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    
    // Trang liên hệ
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::post('/contact/submit', [HomeController::class, 'contactSubmit'])->name('contact.submit');
    
    // Sản phẩm đá
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/category/{slug}', [ProductController::class, 'category'])->name('category');
        Route::get('/material/{slug}', [ProductController::class, 'material'])->name('material');
        Route::get('/surface/{slug}', [ProductController::class, 'surface'])->name('surface');
        Route::get('/{slug}', [ProductController::class, 'show'])->name('show');
        Route::get('/finish/{slug}', [ProductController::class, 'finish'])->name('finish');
    });
    
    // Ứng dụng đá
    Route::prefix('applications')->name('applications.')->group(function () {
        Route::get('/', [ApplicationController::class, 'index'])->name('index');
        Route::get('/{slug}', [ApplicationController::class, 'show'])->name('show');
    });
    
    // Dự án đá
    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::get('/{slug}', [ProjectController::class, 'show'])->name('show');
    });
    
    // Showroom
    Route::prefix('showrooms')->name('showrooms.')->group(function () {
        Route::get('/', [ShowroomController::class, 'index'])->name('index');
        Route::get('/{slug}', [ShowroomController::class, 'show'])->name('show');
    });
    
    // Video
    Route::prefix('videos')->name('videos.')->group(function () {
        Route::get('/', [VideoController::class, 'index'])->name('index');
    });
});

