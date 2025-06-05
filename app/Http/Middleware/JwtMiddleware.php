<?php

namespace App\Http\Middleware;

use App\Enums\HttpStatusCodes;
use App\Services\ApiResponse;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Illuminate\Http\Request;

class JwtMiddleware {
    
    public function handle(Request $request, Closure $next) {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            return ApiResponse::sendResponse(message: __('Unauthorized'), httpCode: HttpStatusCodes::UNAUTHORIZED_401);
        }

        return $next($request);
    }
}
