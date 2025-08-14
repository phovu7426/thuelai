<?php

use App\Http\Controllers\Driver\HomeController;
use App\Http\Controllers\Driver\OrderController;
use App\Http\Controllers\Driver\ContactController;
use App\Http\Controllers\Driver\BookingController;
use Illuminate\Support\Facades\Route;

Route::name('driver.')->group(function () {
    Route::get('/gioi-thieu', [HomeController::class, 'about'])->name('about');
    Route::get('/dich-vu', [HomeController::class, 'services'])->name('services');
    Route::get('/dat-dich-vu', [BookingController::class, 'index'])->name('booking');
    Route::get('/bang-gia', [HomeController::class, 'pricing'])->name('pricing');
    Route::get('/tin-tuc', [HomeController::class, 'news'])->name('news');
    Route::get('/tin-tuc/{slug}', [HomeController::class, 'newsDetail'])->name('news.detail');
    Route::get('/lien-he', [HomeController::class, 'contact'])->name('contact');
    
    // Contact form submission
    Route::post('/lien-he', [ContactController::class, 'submit'])->name('contact.submit');
    
    // Order submission
    Route::post('/dat-dich-vu', [OrderController::class, 'store'])->name('order.store');
    
    // Protected routes
    Route::middleware('auth')->group(function () {
        Route::get('/don-hang', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/don-hang/{id}', [OrderController::class, 'show'])->name('order.show');
    });
});
