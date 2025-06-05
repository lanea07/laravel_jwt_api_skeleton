<?php

namespace App\Contracts;

use App\Enums\HttpStatusCodes;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Cookie;

interface ResponseFormatter {
    public static function sendResponse(array|null|string $data = [], array|null|string $message = '', HttpStatusCodes $httpCode = HttpStatusCodes::OK_200, bool $resetSession = false, Cookie|null $cookie = null): JsonResponse;
}
