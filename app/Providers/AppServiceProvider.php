<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

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
        // Use Bootstrap for pagination
        Paginator::useBootstrap();

        // Add custom debug directive
        Blade::directive('debug', function ($expression) {
            return "<?php if(config('app.debug')): ?><pre><?php print_r($expression); ?></pre><?php endif; ?>";
        });

        // Chia sẻ biến contactInfo cho tất cả view
        $contactInfo = \App\Models\ContactInfo::first();
        view()->share('contactInfo', $contactInfo);
    }
}
