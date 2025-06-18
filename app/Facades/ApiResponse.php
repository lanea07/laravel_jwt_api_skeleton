<?php

namespace App\Facades;

use App\Contracts\ApiResponseContract;
use Illuminate\Support\Facades\Facade;

class ApiResponse extends Facade {
    
    protected static function getFacadeAccessor(): string {
        return ApiResponseContract::class;
    }
}
