<?php

namespace App\Contracts;

use App\Enums\HttpStatusCodes;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Cookie;

interface ResponseFormatter {
    public function sendResponse(
        mixed $data = [],
        string $message = '',
        HttpStatusCodes $httpCode = HttpStatusCodes::OK_200,
        bool $resetJWT = false,
        ?Cookie $cookie = null
    ): JsonResource;
}
