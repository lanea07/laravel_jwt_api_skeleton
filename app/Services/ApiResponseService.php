<?php

namespace App\Services;

use App\Contracts\ApiResourceFormatter;
use App\Contracts\ResponseFormatter;
use App\Enums\HttpStatusCodes;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Cookie;

class ApiResponseService implements ResponseFormatter {

    public function __construct(
        protected ApiResourceFormatter $formatter
    ) {
    }

    public function sendResponse(
        mixed $data = [],
        string $message = '',
        HttpStatusCodes $httpCode = HttpStatusCodes::OK_200,
        bool $resetJWT = false,
        ?Cookie $cookie = null
    ): JsonResource {
        if ($resetJWT) {
            $token = Auth::refresh();
            $cookie = cookie('token', $token, env('COOKIE_LIFETIME', 60), null, null, true, true, false, 'Strict');
        }

        return $this->formatter->buildResponse($data, $message, $httpCode, $cookie);
    }
}
