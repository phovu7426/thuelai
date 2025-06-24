<?php

include_once('admin.php');

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Home\Posts\PostController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login.index'); // Hiển thị form login
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login'); // Xử lý login
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout'); // Xử lý đăng xuất
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login'); // Hiển thị form đăng nhập với google
Route::get('/auth/google/callback', [GoogleController::class, 'callback']); // Xử lý đăng nhập với google

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register.index'); // Hiển thị form đăng ký
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register'); // Xử lý đăng ký
Route::post('/send-otp-register', [RegisterController::class, 'sendOtp'])->name('send.register'); // Gửi OTP đăng ký tài khoản

Route::get('/forgot-password', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('forgot.password.index'); // Hiển thị form quên mật khẩu
Route::post('/send-otp-forgot-password', [ForgotPasswordController::class, 'sendOtp'])->name('send.forgot.password'); // Gửi OTP quên mật khẩu
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password'); // Xử lý tạo lại mật khẩu

Route::get('/', [PostController::class, 'index'])->name('home');
// Routes cho phần trang chủ (không yêu cầu đăng nhập)
Route::prefix('home')->name('home.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('home');
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

