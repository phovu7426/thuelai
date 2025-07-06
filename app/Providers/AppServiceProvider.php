<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        try {
            // Chỉ thực hiện nếu kết nối thành công
            if (DB::connection()->getPdo() && Schema::hasTable('contact_infos')) {
                // Code logic cần thiết
            }
        } catch (\Exception $e) {
            // Không có DB → không thực hiện gì, chỉ log hoặc im lặng
            Log::warning('DB not ready: ' . $e->getMessage());
        }
    }
}
