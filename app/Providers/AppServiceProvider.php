<?php

namespace App\Providers;

use App\Services\ApiResponseService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        $this->app->singleton('ApiResponse', function () {
            return new ApiResponseService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        App::setLocale(env('APP_LOCALE', 'en'));
    }
}
