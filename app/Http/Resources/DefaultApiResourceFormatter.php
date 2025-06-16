<?php

namespace App\Http\Resources;

use App\Contracts\ApiResourceFormatter;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;

class DefaultApiResourceFormatter implements ApiResourceFormatter
{
    public function buildResponse(mixed $data, string $message, int $httpCode, ?Cookie $cookie): JsonResponse{
        $response = Response::json([
            'message' => $message,
            'data' => $data,
        ], $httpCode);

        if ($cookie) {
            $response->withCookie($cookie);
        }

        return $response;
    }
}
