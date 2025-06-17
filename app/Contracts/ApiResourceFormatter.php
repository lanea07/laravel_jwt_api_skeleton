<?php

namespace App\Contracts;

use App\Enums\HttpStatusCodes;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Cookie;

interface ApiResourceFormatter {

    /**
     * @param mixed $data Payload to send to frontend
     * @param string $message Message to send to frontend
     * @param HttpStatusCodes $httpCode Http status code
     * @param ?Cookie $cookie If needed, a Cookie instance can be submitted in the response.
     * 
     * @return JsonResource
     */
    public function buildResponse(mixed $data, string $message, HttpStatusCodes $httpCode, ?Cookie $cookie): JsonResource;
}
