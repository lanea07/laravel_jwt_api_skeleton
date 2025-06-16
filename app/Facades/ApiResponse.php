<?php

namespace App\Facades;

use App\Contracts\ResponseFormatter;
use Illuminate\Support\Facades\Facade;

class ApiResponse extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ResponseFormatter::class;
    }
}
