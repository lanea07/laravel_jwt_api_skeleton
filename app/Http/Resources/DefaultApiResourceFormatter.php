<?php

namespace App\Http\Resources;

use App\Contracts\ApiResourceFormatter;
use App\Enums\HttpStatusCodes;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Cookie;

class DefaultApiResourceFormatter implements ApiResourceFormatter {

    public function buildResponse(mixed $data, string $message, HttpStatusCodes $httpCode, ?Cookie $cookie): JsonResource {
        return new DefaultResponseResource($data, $message, false, $cookie, $httpCode);
    }
}
