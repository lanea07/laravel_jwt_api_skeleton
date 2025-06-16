<?php

namespace App\Contracts;

use App\Enums\HttpStatusCodes;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Cookie;

interface ResponseFormatter {

    /**
     * @param mixed $data Payload to send to frontend
     * @param string $message Message to send to frontend
     * @param HttpStatusCodes $httpCode Http status code
     * @param bool $resetJWT Indicates if JWT must be refreshed and submitted to frontend. All JWT tokens are stored in cookies.
     * @param ?Cookie $cookie If needed, a Cookie instance can be submitted in the response.
     * 
     * @return JsonResponse
     */
    public function sendResponse(
        mixed $data = [],
        string $message = '',
        HttpStatusCodes $httpCode = HttpStatusCodes::OK_200,
        bool $resetJWT = false,
        ?Cookie $cookie = null
    ): JsonResponse;
}
