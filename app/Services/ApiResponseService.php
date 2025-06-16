<?php

namespace App\Services;

use App\Contracts\ResponseFormatter;
use App\Enums\HttpStatusCodes;
use App\Http\Resources\DefaultResponseResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Cookie;

class ApiResponseService implements ResponseFormatter {

    public function sendResponse(
        mixed $data = [],
        string $message = '',
        HttpStatusCodes $httpCode = HttpStatusCodes::OK_200,
        bool $resetJWT = false,
        ?Cookie $cookie = null
    ): JsonResource {
        return new DefaultResponseResource($data, $message, $resetJWT, $cookie, $httpCode->value);
    }
}
