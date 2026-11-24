<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS in production, staging, behind Cloudflare proxy, or whenever not on localhost
        if (config('app.env') === 'production' 
            || !app()->environment('local')
            || request()->isSecure() 
            || request()->header('x-forwarded-proto') === 'https'
            || request()->header('cf-visitor') !== null
            || str_contains(config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }

        // Register the minimal error layout as an anonymous component
        // so error pages (resources/views/errors/*.blade.php) can use <x-layout>.
        Blade::anonymousComponentNamespace('errors', 'errors');

        Blade::component('errors.layout', 'layout');
    }
}
