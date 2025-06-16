<?php

namespace App\Providers;

use App\Contracts\ResponseFormatter;
use App\Services\ApiResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        $this->app->bind(ResponseFormatter::class, ApiResponse::class);
        $this->app->singleton('ApiResponse', function () {
            return new ApiResponse();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        App::setLocale(env('APP_LOCALE', 'en'));
    }
}
