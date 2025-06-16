<?php

namespace App\Providers;

use App\Contracts\ApiResourceFormatter;
use App\Http\Resources\DefaultApiResourceFormatter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class ApiServiceProvider extends ServiceProvider {
    /**
     * Register services.
     */
    public function register(): void {
        $this->app->bind(ApiResourceFormatter::class, DefaultApiResourceFormatter::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {
        App::setLocale(env('APP_LOCALE', 'es'));
    }
}
