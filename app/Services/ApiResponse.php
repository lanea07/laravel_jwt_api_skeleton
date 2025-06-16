<?php

namespace App\Services;

use App\Contracts\ResponseFormatter;
use App\Enums\HttpStatusCodes;
use App\Http\Resources\ApiResponseResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Cookie;

class ApiResponse implements ResponseFormatter {

    public function sendResponse(
        mixed $data = [],
        string $message = '',
        HttpStatusCodes $httpCode = HttpStatusCodes::OK_200,
        bool $resetJWT = false,
        ?Cookie $cookie = null
    ): JsonResource {
        return new ApiResponseResource($data, $message, $resetJWT, $cookie, $httpCode->value);
    }
}
