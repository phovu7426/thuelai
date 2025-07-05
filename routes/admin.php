<?php

use App\Http\Controllers\Admin\Stone\InventoryController;
use App\Http\Controllers\Admin\Stone\CategoryController as StoneCategoryController;
use App\Http\Controllers\Admin\Stone\MaterialController;
use App\Http\Controllers\Admin\Stone\ProductController;
use App\Http\Controllers\Admin\Stone\SurfaceController;
use App\Http\Controllers\Admin\Stone\ApplicationController;
use App\Http\Controllers\Admin\Stone\ProjectController;
use App\Http\Controllers\Admin\Stone\ShowroomController;
use App\Http\Controllers\Admin\Stone\VideoController;
use App\Http\Controllers\Admin\Stone\OrderController;
use App\Http\Controllers\Admin\Stone\ContactController;
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
    Route::get('/', function () {
        return view('admin.index');
    })->name('index');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Stone routes
    Route::prefix('stone')->name('stone.')->group(function () {
        // Inventory routes
        Route::get('inventory', [InventoryController::class, 'index'])->name('inventory.index');
        Route::put('inventory/{id}/update-quantity', [InventoryController::class, 'updateQuantity'])->name('inventory.update-quantity');

        // Danh mục đá
        Route::resource('categories', StoneCategoryController::class);

        // Chất liệu đá
        Route::resource('materials', MaterialController::class);

        // Bề mặt đá
        Route::resource('surfaces', SurfaceController::class);

        // Ứng dụng đá
        Route::resource('applications', ApplicationController::class);

        // Sản phẩm đá
        Route::resource('products', ProductController::class);

        // Dự án đá
        Route::resource('projects', ProjectController::class);

        // Showroom
        Route::resource('showrooms', ShowroomController::class);

        // Video
        Route::resource('videos', VideoController::class);

        // Đơn hàng
        Route::resource('orders', OrderController::class);
        Route::post('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

        // Stone - Quản lý liên hệ
        Route::prefix('contacts')->name('contacts.')->group(function () {
            Route::get('/', [ContactController::class, 'index'])->name('index');
            Route::get('/{id}', [ContactController::class, 'show'])->name('show');
            Route::delete('/{id}', [ContactController::class, 'destroy'])->name('destroy');
            Route::post('/mark-as-read', [ContactController::class, 'markAsRead'])->name('mark-as-read');
            Route::post('/bulk-delete', [ContactController::class, 'bulkDelete'])->name('bulk-delete');
        });
    });

    Route::prefix('users')->name('users.')->group(function () { // Chức năng quản lý tài khoản
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
        Route::post('/toggle-block/{id}', [UserController::class, 'changeStatus'])->name('toggleBlock');
        Route::get('/autocomplete', [UserController::class, 'autocomplete'])->name('autocomplete'); // Lấy vai trò theo từ
    });

    Route::prefix('profiles')->name('profiles.')->group(function () { // Chức năng quản lý hồ sơ
        Route::get('/edit/{user_id}', [ProfileController::class, 'edit'])->name('edit'); // Hiển thị form chỉnh sửa
        Route::post('/update/{user_id}', [ProfileController::class, 'update'])->name('update'); // Xử lý chỉnh sửa
    });

    Route::prefix('roles')->name('roles.')->group(function () { // Chức năng quản lý vai trò
        Route::get('/index', [RoleController::class, 'index'])->name('index'); // Hiển thị danh sách vai trò
        Route::get('/create', [RoleController::class, 'create'])->name('create'); // Hiển thị form tạo mới vai trò
        Route::post('/store', [RoleController::class, 'store'])->name('store'); // Xử lý thêm mới vai trò
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [RoleController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [RoleController::class, 'delete'])->name('delete');
        Route::get('/autocomplete', [RoleController::class, 'autocomplete'])->name('autocomplete'); // Lấy vai trò theo từ
    });

    // Chức năng quản lý quyền
    Route::prefix('permissions')->name('permissions.')->group(function () {
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
    Route::resource('posts', PostController::class);

    // Slides
    Route::resource('slides', SlideController::class);

    // Cấu hình thông tin liên hệ
    Route::get('contact-info', [\App\Http\Controllers\Admin\ContactInfoController::class, 'edit'])->name('contact-info.edit');
    Route::post('contact-info', [\App\Http\Controllers\Admin\ContactInfoController::class, 'update'])->name('contact-info.update');
});
