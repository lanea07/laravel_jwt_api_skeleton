<?php

namespace App\Services;

use App\Contracts\ResponseFormatter;
use App\Enums\HttpStatusCodes;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Cookie;

class ApiResponse implements ResponseFormatter {

    public static function sendResponse(array|null|string $data = [], array|null|string $message = '', HttpStatusCodes $httpCode = HttpStatusCodes::OK_200, bool $resetSession = false, Cookie|null $cookie = null): JsonResponse {
        if ($resetSession) {
            Session::flush();
        }

        if($cookie) {
            return response()->json([
                'message' => $message,
                'data' => $data
            ], $httpCode->value)->cookie($cookie);
        } else {
            return response()->json([
                'message' => $message,
                'data' => $data
            ], $httpCode->value);
        }
    }
}
