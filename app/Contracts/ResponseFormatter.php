<?php

namespace App\Contracts;

use App\Enums\HttpStatusCodes;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Cookie;

interface ResponseFormatter {
    public static function sendResponse(mixed $data = [], mixed $message = '', HttpStatusCodes $httpCode = HttpStatusCodes::OK_200, bool $resetJWT = false, Cookie|null $cookie = null): JsonResponse;
}
