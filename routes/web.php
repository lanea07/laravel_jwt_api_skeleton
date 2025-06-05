<?php

use App\Enums\HttpStatusCodes;
use App\Services\ApiResponse;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ApiResponse::sendResponse(message: __('Project is API mode only'), httpCode: HttpStatusCodes::FORBIDDEN_403);
});