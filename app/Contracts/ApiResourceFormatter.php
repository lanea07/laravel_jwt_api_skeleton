<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cookie;

interface ApiResourceFormatter {

    /**
     * @param mixed $data Payload to send to frontend
     * @param string $message Message to send to frontend
     * @param HttpStatusCodes $httpCode Http status code
     * @param ?Cookie $cookie If needed, a Cookie instance can be submitted in the response.
     * 
     * @return JsonResponse
     */
    public function buildResponse(
        mixed $data,
        string $message,
        int $httpCode,
        ?Cookie $cookie
    ): JsonResponse;
}
