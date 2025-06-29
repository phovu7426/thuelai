<?php

use App\Http\Controllers\Admin\Categories\CategoryController;
use App\Http\Controllers\Admin\Permissions\PermissionController;
use App\Http\Controllers\Admin\Posts\PostController;
use App\Http\Controllers\Admin\Roles\RoleController;
use App\Http\Controllers\Admin\Series\SeriesController;
use App\Http\Controllers\Admin\Stone\ApplicationController;
use App\Http\Controllers\Admin\Stone\CategoryController as StoneCategoryController;
use App\Http\Controllers\Admin\Stone\ContactController;
use App\Http\Controllers\Admin\Stone\MaterialController;
use App\Http\Controllers\Admin\Stone\OrderController;
use App\Http\Controllers\Admin\Stone\ProductController as StoneProductController;
use App\Http\Controllers\Admin\Stone\ProjectController;
use App\Http\Controllers\Admin\Stone\ShowroomController;
use App\Http\Controllers\Admin\Stone\SurfaceController;
use App\Http\Controllers\Admin\Stone\VideoController;
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

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', function () {
        return view('admin.index');
    })->name('index');

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Users
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/info', [UserController::class, 'getUserInfo'])->name('user.info');
    });

    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
    });

    // Roles
    Route::resource('roles', RoleController::class);

    // Permissions
    Route::resource('permissions', PermissionController::class);

    // Categories
    Route::resource('categories', CategoryController::class);

    // Series
    Route::resource('series', SeriesController::class);

    // Posts
    Route::resource('posts', PostController::class);
    
    // Stone - Quản lý đá
    Route::prefix('stone')->name('stone.')->group(function () {
        // Danh mục đá
        Route::resource('categories', StoneCategoryController::class);
        
        // Chất liệu đá
        Route::resource('materials', MaterialController::class);
        
        // Bề mặt đá
        Route::resource('surfaces', SurfaceController::class);
        
        // Ứng dụng đá
        Route::resource('applications', ApplicationController::class);
        
        // Sản phẩm đá
        Route::resource('products', StoneProductController::class);
        
        // Dự án đá
        Route::resource('projects', ProjectController::class);
        
        // Showroom
        Route::resource('showrooms', ShowroomController::class);
        
        // Video
        Route::resource('videos', VideoController::class);
        
        // Đơn hàng
        Route::resource('orders', OrderController::class);

        // Stone - Quản lý liên hệ
        Route::prefix('contacts')->name('contacts.')->group(function () {
            Route::get('/', [ContactController::class, 'index'])->name('index');
            Route::get('/{id}', [ContactController::class, 'show'])->name('show');
            Route::delete('/{id}', [ContactController::class, 'destroy'])->name('destroy');
            Route::post('/mark-as-read', [ContactController::class, 'markAsRead'])->name('mark-as-read');
            Route::post('/bulk-delete', [ContactController::class, 'bulkDelete'])->name('bulk-delete');
        });
    });
});
