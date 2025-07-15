<?php

use App\Framework\Enums\HttpStatusCodes;
use App\Framework\Facades\ApiResponse;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ApiResponse::sendResponse(message: __('messages.web_access__api_mode_only'), httpCode: HttpStatusCodes::FORBIDDEN_403);
});

// Test route to verify Framework structure
Route::get('/test-framework', function () {
    return ApiResponse::sendResponse(
        data: ['status' => 'Framework refactoring successful'],
        message: 'All Framework classes are working correctly',
        httpCode: HttpStatusCodes::OK_200
    );
});
