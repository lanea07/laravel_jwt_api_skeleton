<?php

namespace App\Services;

use App\Contracts\ResponseFormatter;
use App\Enums\HttpStatusCodes;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Cookie;

class ApiResponse implements ResponseFormatter {

    public static function sendResponse(mixed $data = [], mixed $message = '', HttpStatusCodes $httpCode = HttpStatusCodes::OK_200, bool $resetJWT = false, Cookie|null $cookie = null): JsonResponse {
        if ($resetJWT) {
            $token = Auth::refresh();
            $cookie = cookie('token', $token, 60, null, null, true, true, false, 'Strict');
        }

        if($cookie) {
            return response()->json(['message' => $message, 'data' => $data], $httpCode->value)->cookie($cookie);
        } else {
            return response()->json(['message' => $message, 'data' => $data], $httpCode->value);
        }
    }
}
