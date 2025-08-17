<?php

use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Permissions\PermissionController;
use App\Http\Controllers\Admin\Posts\PostController;
use App\Http\Controllers\Admin\Roles\RoleController;
use App\Http\Controllers\Admin\Series\SeriesController;
use App\Http\Controllers\Admin\Slides\SlideController;
use App\Http\Controllers\Admin\Users\ProfileController;
use App\Http\Controllers\Admin\Users\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Categories\CategoryController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::middleware('canAny:access_dashboard,access_users,access_roles,access_permissions,access_slides,access_contact-info')->get('/', function () {
        // Ưu tiên dashboard
        if (auth()->user()->can('access_dashboard')) {
            return redirect()->route('admin.dashboard');
        }
        if (auth()->user()->can('access_users')) {
            return redirect()->route('admin.users.index');
        }
        if (auth()->user()->can('access_roles')) {
            return redirect()->route('admin.roles.index');
        }
        if (auth()->user()->can('access_permissions')) {
            return redirect()->route('admin.permissions.index');
        }
        if (auth()->user()->can('access_slides')) {
            return redirect()->route('admin.slides.index');
        }
        if (auth()->user()->can('access_contact-info')) {
            return redirect()->route('admin.contact-info.edit');
        }
        // Nếu không có quyền nào thì về dashboard hoặc trang báo lỗi
        return abort(403, 'Bạn không có quyền truy cập!');
    })->name('index');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('canAny:access_dashboard')
        ->name('dashboard');

    Route::prefix('users')->name('users.')->middleware('canAny:access_users')->group(function () { // Chức năng quản lý tài khoản
        Route::get('/index', [UserController::class, 'index'])->name('index'); // Hiển thị danh sách tài khoản
        Route::get('/create', [UserController::class, 'create'])->name('create'); // Hiển thị form tạo tài khoản
        Route::post('/store', [UserController::class, 'store'])->name('store'); // Xử lý tạo tài khoản
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit'); // Hiển thị form chỉnh sửa
        Route::post('/update/{id}', [UserController::class, 'update'])->name('update'); // Xử lý chỉnh sửa
        Route::post('/delete/{id}', [UserController::class, 'delete'])->name('delete'); // Xử lý xóa
        // 🚀 Hiển thị giao diện phân vai trò
        Route::get('/assign-roles/{id}', [UserController::class, 'showAssignRolesForm'])->name('showAssignRolesForm');
        // 🚀 Xử lý gán vai trò cho người dùng
        Route::post('/assign-roles/{id}', [UserController::class, 'assignRoles'])->name('assignRoles');
        Route::post('/toggle-block/{id}', [UserController::class, 'toggleBlock'])->name('toggleBlock');
        Route::get('/autocomplete', [UserController::class, 'autocomplete'])->name('autocomplete'); // Lấy vai trò theo từ
    });

    Route::prefix('profiles')->name('profiles.')->group(function () { // Chức năng quản lý hồ sơ
        Route::get('/edit/{user_id}', [ProfileController::class, 'edit'])->name('edit'); // Hiển thị form chỉnh sửa
        Route::post('/update/{user_id}', [ProfileController::class, 'update'])->name('update'); // Xử lý chỉnh sửa
    });

    Route::prefix('roles')->name('roles.')->middleware('canAny:access_roles')->group(function () { // Chức năng quản lý vai trò
        Route::get('/index', [RoleController::class, 'index'])->name('index'); // Hiển thị danh sách vai trò
        Route::get('/create', [RoleController::class, 'create'])->name('create'); // Hiển thị form tạo mới vai trò
        Route::post('/store', [RoleController::class, 'store'])->name('store'); // Xử lý thêm mới vai trò
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [RoleController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [RoleController::class, 'delete'])->name('delete');
        Route::get('/autocomplete', [RoleController::class, 'autocomplete'])->name('autocomplete'); // Lấy vai trò theo từ
    });

    // Chức năng quản lý quyền
    Route::prefix('permissions')->name('permissions.')->middleware('canAny:access_permissions')->group(function () {
        Route::get('/index', [PermissionController::class, 'index'])->name('index'); // Hiển thị danh sách quyền
        Route::get('/create', [PermissionController::class, 'create'])->name('create'); // Hiển thị form tạo mới quyền
        Route::post('/store', [PermissionController::class, 'store'])->name('store'); // Xử lý thêm mới quyền
        Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('edit'); // Hiển thị form sửa quyền
        Route::put('/update/{id}', [PermissionController::class, 'update'])->name('update'); // Xử lý sửa quyền
        Route::delete('/delete/{id}', [PermissionController::class, 'delete'])->name('delete'); // Xử lý xóa quyền
        Route::get('/autocomplete', [PermissionController::class, 'autocomplete'])->name('autocomplete'); // Lấy quyền theo từ
    });

    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
    });

    // Roles - Using resource routes
    // Route::resource('roles', RoleController::class);

    // Permissions - Using resource routes
    // Route::resource('permissions', PermissionController::class);

    // Categories
    Route::resource('categories', CategoryController::class);

    // Series
    Route::resource('series', SeriesController::class);

    // Posts
    Route::resource('posts', PostController::class)->middleware('canAny:access_users');

    // Slides
    Route::resource('slides', \App\Http\Controllers\Admin\Slides\SlideController::class)->middleware('canAny:access_users');
    Route::patch('/slides/{slide}/toggle-status', [\App\Http\Controllers\Admin\Slides\SlideController::class, 'toggleStatus'])->name('slides.toggle-status');
    Route::patch('/slides/{slide}/toggle-featured', [\App\Http\Controllers\Admin\Slides\SlideController::class, 'toggleFeatured'])->name('slides.toggle-featured');

    // Posts Management
    Route::prefix('posts')->name('posts.')->middleware('canAny:access_users')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\PostController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Admin\PostController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Admin\PostController::class, 'store'])->name('store');
        Route::get('/{post}/edit', [\App\Http\Controllers\Admin\PostController::class, 'edit'])->name('edit');
        Route::put('/{post}', [\App\Http\Controllers\Admin\PostController::class, 'update'])->name('update');
        Route::delete('/{post}', [\App\Http\Controllers\Admin\PostController::class, 'destroy'])->name('destroy');
        Route::patch('/{post}/toggle-status', [\App\Http\Controllers\Admin\PostController::class, 'toggleStatus'])->name('toggle-status');
        Route::patch('/{post}/toggle-featured', [\App\Http\Controllers\Admin\PostController::class, 'toggleFeatured'])->name('toggle-featured');
    });

    // Post Categories Management
    Route::prefix('post-categories')->name('post-categories.')->middleware('canAny:access_users')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\PostCategoryController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Admin\PostCategoryController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Admin\PostCategoryController::class, 'store'])->name('store');
        Route::get('/{category}/edit', [\App\Http\Controllers\Admin\PostCategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [\App\Http\Controllers\Admin\PostCategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [\App\Http\Controllers\Admin\PostCategoryController::class, 'destroy'])->name('destroy');
        Route::patch('/{category}/toggle-status', [\App\Http\Controllers\Admin\PostCategoryController::class, 'toggleStatus'])->name('toggle-status');
    });

    // Post Tags Management
    Route::prefix('post-tags')->name('post-tags.')->middleware('canAny:access_users')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\PostTagController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Admin\PostTagController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Admin\PostTagController::class, 'store'])->name('store');
        Route::get('/{tag}/edit', [\App\Http\Controllers\Admin\PostTagController::class, 'edit'])->name('edit');
        Route::put('/{tag}', [\App\Http\Controllers\Admin\PostTagController::class, 'update'])->name('update');
        Route::delete('/{tag}', [\App\Http\Controllers\Admin\PostTagController::class, 'destroy'])->name('destroy');
        Route::patch('/{tag}/toggle-status', [\App\Http\Controllers\Admin\PostTagController::class, 'toggleStatus'])->name('toggle-status');
    });

    // Cấu hình thông tin liên hệ
    Route::get('contact-info', [\App\Http\Controllers\Admin\ContactInfoController::class, 'edit'])->middleware('canAny:access_contact-info')->name('contact-info.edit');
    Route::post('contact-info', [\App\Http\Controllers\Admin\ContactInfoController::class, 'update'])->middleware('canAny:access_contact-info')->name('contact-info.update');



    // ===== DRIVER SERVICE ADMIN ROUTES =====
    Route::prefix('driver')->name('driver.')->middleware('canAny:access_driver_services,access_driver_testimonials,access_driver_contacts')->group(function () {
        
        // Dashboard
        Route::get('/', [\App\Http\Controllers\Admin\Driver\DriverDashboardController::class, 'index'])->name('dashboard');
        Route::get('/chart-data', [\App\Http\Controllers\Admin\Driver\DriverDashboardController::class, 'getChartData'])->name('chart-data');
        Route::get('/real-time-stats', [\App\Http\Controllers\Admin\Driver\DriverDashboardController::class, 'getRealTimeStats'])->name('real-time-stats');
        
        // Quản lý dịch vụ lái xe
        Route::prefix('services')->name('services.')->middleware('auth')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\Driver\DriverServiceController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\Admin\Driver\DriverServiceController::class, 'create'])->name('create');
            Route::post('/', [\App\Http\Controllers\Admin\Driver\DriverServiceController::class, 'store'])->name('store');
            Route::post('/update-order', [\App\Http\Controllers\Admin\Driver\DriverServiceController::class, 'updateOrder'])->name('update-order');
            Route::get('/{driverService}/edit', [\App\Http\Controllers\Admin\Driver\DriverServiceController::class, 'edit'])->name('edit');
            Route::put('/{driverService}', [\App\Http\Controllers\Admin\Driver\DriverServiceController::class, 'update'])->name('update');
            Route::delete('/{driverService}', [\App\Http\Controllers\Admin\Driver\DriverServiceController::class, 'destroy'])->name('destroy');
            Route::patch('/{driverService}/toggle-status', [\App\Http\Controllers\Admin\Driver\DriverServiceController::class, 'toggleStatus'])->name('toggle-status');
            Route::patch('/{driverService}/toggle-featured', [\App\Http\Controllers\Admin\Driver\DriverServiceController::class, 'toggleFeatured'])->name('toggle-featured');
            Route::get('/{driverService}', [\App\Http\Controllers\Admin\Driver\DriverServiceController::class, 'show'])->name('show');
        });




        // Quản lý quy tắc giá cố định
        Route::prefix('pricing-rules')->name('pricing-rules.')->middleware('canAny:access_driver_services')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\Driver\DriverPricingRuleController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\Admin\Driver\DriverPricingRuleController::class, 'create'])->name('create');
            Route::post('/', [\App\Http\Controllers\Admin\Driver\DriverPricingRuleController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [\App\Http\Controllers\Admin\Driver\DriverPricingRuleController::class, 'edit'])->name('edit');
            Route::put('/{id}', [\App\Http\Controllers\Admin\Driver\DriverPricingRuleController::class, 'update'])->name('update');
            Route::delete('/{id}', [\App\Http\Controllers\Admin\Driver\DriverPricingRuleController::class, 'destroy'])->name('destroy');
        });

        // Quản lý khoảng cách
        Route::prefix('distance-tiers')->name('distance-tiers.')->middleware('canAny:access_driver_services')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\Driver\DriverDistanceTierController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\Admin\Driver\DriverDistanceTierController::class, 'create'])->name('create');
            Route::post('/', [\App\Http\Controllers\Admin\Driver\DriverDistanceTierController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [\App\Http\Controllers\Admin\Driver\DriverDistanceTierController::class, 'edit'])->name('edit');
            Route::put('/{id}', [\App\Http\Controllers\Admin\Driver\DriverDistanceTierController::class, 'update'])->name('update');
            Route::delete('/{id}', [\App\Http\Controllers\Admin\Driver\DriverDistanceTierController::class, 'destroy'])->name('destroy');
        });

        // Quản lý giá theo khoảng cách linh hoạt
        Route::prefix('pricing-tiers')->name('pricing-tiers.')->middleware('canAny:access_driver_services')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\Driver\DriverPricingTierController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\Admin\Driver\DriverPricingTierController::class, 'create'])->name('create');
            Route::post('/', [\App\Http\Controllers\Admin\Driver\DriverPricingTierController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [\App\Http\Controllers\Admin\Driver\DriverPricingTierController::class, 'edit'])->name('edit');
            Route::put('/{id}', [\App\Http\Controllers\Admin\Driver\DriverPricingTierController::class, 'update'])->name('update');
            Route::delete('/{id}', [\App\Http\Controllers\Admin\Driver\DriverPricingTierController::class, 'destroy'])->name('destroy');
        });



        // Quản lý testimonials
        Route::prefix('testimonials')->name('testimonials.')->middleware('canAny:access_driver_testimonials')->group(function () {
            Route::resource('/', \App\Http\Controllers\Admin\Driver\TestimonialController::class)->except(['show']);
            Route::get('/{testimonial}', [\App\Http\Controllers\Admin\Driver\TestimonialController::class, 'show'])->name('show');
            Route::patch('/{testimonial}/toggle-status', [\App\Http\Controllers\Admin\Driver\TestimonialController::class, 'toggleStatus'])->name('toggle-status');
            Route::patch('/{testimonial}/toggle-featured', [\App\Http\Controllers\Admin\Driver\TestimonialController::class, 'toggleFeatured'])->name('toggle-featured');
            Route::post('/update-order', [\App\Http\Controllers\Admin\Driver\TestimonialController::class, 'updateOrder'])->name('update-order');
            Route::get('/filter/status', [\App\Http\Controllers\Admin\Driver\TestimonialController::class, 'filterByStatus'])->name('filter-by-status');
            Route::get('/search', [\App\Http\Controllers\Admin\Driver\TestimonialController::class, 'search'])->name('search');
            Route::post('/bulk-action', [\App\Http\Controllers\Admin\Driver\TestimonialController::class, 'bulkAction'])->name('bulk-action');
        });

        // Quản lý liên hệ từ website lái xe
        Route::prefix('contacts')->name('contacts.')->middleware('canAny:access_driver_contacts')->group(function () {
            Route::resource('/', \App\Http\Controllers\Admin\Driver\DriverContactController::class)->except(['show']);
            Route::get('/{id}', [\App\Http\Controllers\Admin\Driver\DriverContactController::class, 'show'])->name('show');
            Route::post('/{id}/status', [\App\Http\Controllers\Admin\Driver\DriverContactController::class, 'updateStatus'])->name('update-status');
            Route::post('/{id}/mark-read', [\App\Http\Controllers\Admin\Driver\DriverContactController::class, 'markAsRead'])->name('mark-read');
            Route::patch('/{id}/toggle-status', [\App\Http\Controllers\Admin\Driver\DriverContactController::class, 'toggleStatus'])->name('toggle-status');
            Route::get('/filter/status', [\App\Http\Controllers\Admin\Driver\DriverContactController::class, 'filterByStatus'])->name('filter-by-status');
            Route::get('/search', [\App\Http\Controllers\Admin\Driver\DriverContactController::class, 'search'])->name('search');
            Route::post('/bulk-action', [\App\Http\Controllers\Admin\Driver\DriverContactController::class, 'bulkAction'])->name('bulk-action');
            Route::get('/export', [\App\Http\Controllers\Admin\Driver\DriverContactController::class, 'export'])->name('export');
        });
    });
});
