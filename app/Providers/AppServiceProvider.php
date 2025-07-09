<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use App\Models\ContactInfo;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        try {
            // Chỉ thực hiện nếu kết nối thành công
            if (DB::connection()->getPdo() && Schema::hasTable('contact_infos')) {
                View::composer('stone.layouts.main', function ($view) {
                    $contactInfo = ContactInfo::first();
                    $view->with('contactInfo', $contactInfo);
                });
            }
        } catch (\Exception $e) {
            // Không có DB → không thực hiện gì, chỉ log hoặc im lặng
            Log::warning('DB not ready: ' . $e->getMessage());
        }
    }
}
