<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Services\ApiResponseService;

class ApiResponse extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ApiResponseService::class;
    }
}