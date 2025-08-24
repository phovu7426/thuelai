<?php

namespace App\Providers;

use App\Helpers\ContactInfoHelper;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ContactInfoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Chia sẻ thông tin liên hệ cho tất cả các view
        View::composer('*', function ($view) {
            $contactInfo = ContactInfoHelper::getContactInfoArray();
            $view->with('globalContactInfo', $contactInfo);
        });
    }
}
