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
use App\Http\Controllers\Stone\CartController;
use App\Http\Controllers\Stone\CheckoutController;
use App\Http\Controllers\Stone\HomeController;
use App\Http\Controllers\Stone\OrderController;
use App\Http\Controllers\Stone\ProductController;
use App\Http\Controllers\Stone\ProjectController;
use App\Http\Controllers\Stone\ShowroomController;
use App\Http\Controllers\Stone\VideoController;
use App\Http\Controllers\Stone\TestController;
use App\Http\Controllers\Stone\ShowroomListController;
use App\Http\Controllers\Stone\ApplicationDetailController;
use App\Http\Controllers\Stone\ContactController;
use App\Http\Controllers\Home\SlideController as HomeSlideController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

Route::get('/_setup', function () {
    Artisan::call('key:generate');
    Artisan::call('migrate', ['--force' => true]);
    Artisan::call('storage:link');
    return '✅ Laravel initialized';
});
Route::get('/_log', function () {
    return nl2br(file_get_contents(storage_path('logs/laravel.log')));
});

// Chuyển hướng trang chủ đến trang đá
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login.index'); // Hiển thị form login
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.post'); // Xử lý đăng nhập
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout'); // Xử lý đăng xuất
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
require __DIR__ . '/admin.php';

// Trang web đá
Route::name('stone.')->middleware('web')->group(function () {
    // Trang chủ
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Trang giới thiệu
    Route::get('/gioi-thieu', [HomeController::class, 'about'])->name('about');

    // Trang liên hệ
    Route::get('/lien-he', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/lien-he', [ContactController::class, 'store'])->name('contact.store');

    // Sản phẩm đá
    Route::prefix('san-pham')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/danh-muc/{slug}', [ProductController::class, 'category'])->name('category');
        Route::get('/chat-lieu/{slug}', [ProductController::class, 'material'])->name('material');
        Route::get('/be-mat/{slug}', [ProductController::class, 'surface'])->name('surface');
        Route::get('/{slug}', [ProductController::class, 'show'])->name('show');
        Route::get('/hoan-thien/{slug}', [ProductController::class, 'finish'])->name('finish');
    });

    // Giỏ hàng
    Route::prefix('gio-hang')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/them', [CartController::class, 'add'])->name('add');
        Route::post('/cap-nhat', [CartController::class, 'update'])->name('update');
        Route::post('/xoa', [CartController::class, 'remove'])->name('remove');
        Route::post('/xoa-tat-ca', [CartController::class, 'clear'])->name('clear');
    });

    // Thanh toán
    Route::prefix('thanh-toan')->name('checkout.')->middleware('auth')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('index');
        Route::post('/xu-ly', [CheckoutController::class, 'process'])->name('process');
        Route::get('/thanh-cong/{order}', [CheckoutController::class, 'success'])->name('success');
    });

    // Đơn hàng
    Route::prefix('don-hang')->name('orders.')->middleware('auth')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{id}', [OrderController::class, 'show'])->name('show');
        Route::post('/{id}/huy', [OrderController::class, 'cancel'])->name('cancel');
    });

    // Ứng dụng đá
    Route::prefix('ung-dung')->name('applications.')->group(function () {
        Route::get('/', [ApplicationController::class, 'index'])->name('index');
        Route::get('/test-html/{slug}', [ApplicationController::class, 'testHtml'])->name('test_html');
        Route::get('/simple-test/{slug}', [ApplicationController::class, 'simpleTest'])->name('simple_test');
        Route::get('/minimal-test/{slug}', [ApplicationController::class, 'testMinimal'])->name('minimal_test');
        Route::get('/via-he-custom', [ApplicationController::class, 'viaHe'])->name('via_he_custom');
        Route::get('/chi-tiet/{slug}', [ApplicationDetailController::class, 'show'])->name('detail');
        Route::get('/{slug}', [ApplicationController::class, 'show'])->name('show');
    });

    // Dự án đá
    Route::prefix('du-an')->name('projects.')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::get('/{slug}', [ProjectController::class, 'show'])->name('show');
    });

    // Showroom
    Route::prefix('showroom')->name('showrooms.')->group(function () {
        Route::get('/', [App\Http\Controllers\Stone\ShowroomPageController::class, 'index'])->name('index');
        Route::get('/{slug}', [App\Http\Controllers\Stone\ShowroomPageController::class, 'show'])->name('show');
    });

    // Video
    Route::prefix('video')->name('videos.')->group(function () {
        Route::get('/', [VideoController::class, 'index'])->name('index');
    });

    // Test route
    Route::get('/test', [TestController::class, 'index'])->name('test');

    // New showroom list route
    Route::get('/danh-sach-showroom', [ShowroomListController::class, 'index'])->name('showrooms.list');
});

// Test Blade rendering
Route::get('/test-blade', function () {
    return view('test_blade');
});

Route::get('/slides', [HomeSlideController::class, 'index'])->name('home.slides');

// Test showroom page
Route::get('/test-showroom', [App\Http\Controllers\TestShowroomController::class, 'index'])->name('test.showroom');

Route::get('/test-send-mail', function() {
    Mail::raw('Đây là email test gửi từ hệ thống Laravel.', function($message) {
        $message->to('vumanhhoang140799@gmail.com')
                ->subject('Test gửi mail từ Laravel');
    });
    return 'Đã gửi mail test!';
});

Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create()
        ->add(Url::create('/'))
        ->add(Url::create('/gioi-thieu'))
        ->add(Url::create('/lien-he'))
        ->add(Url::create('/san-pham'))
        ->add(Url::create('/ung-dung'))
        ->add(Url::create('/du-an'))
        ->add(Url::create('/showroom'));

    // Nếu có danh sách sản phẩm động:
    foreach (\App\Models\StoneProduct::all() as $product) {
        $sitemap->add(Url::create('/san-pham/' . $product->slug));
    }

    return $sitemap->toResponse(request());
});