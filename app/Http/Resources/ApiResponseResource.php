<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Cookie;

class ApiResponseResource extends JsonResource {
    protected string $message;
    protected bool $resetJWT;
    protected ?Cookie $cookie;
    protected int $statusCode;

    public function __construct(
        $resource,
        string $message = '',
        bool $resetJWT = false,
        ?Cookie $cookie = null,
        int $statusCode = 200
    ) {
        parent::__construct($resource);
        $this->message = $message;
        $this->resetJWT = $resetJWT;
        $this->cookie = $cookie;
        $this->statusCode = $statusCode;
    }

    public function toArray(Request $request): array {
        return [
            'message' => $this->message,
            'data' => $this->resource,
        ];
    }

    public function withResponse($request, $response): void {
        $response->setStatusCode($this->statusCode);

        if ($this->resetJWT) {
            $token = Auth::refresh();
            $this->cookie = cookie('token', $token, 60, null, null, true, true, false, 'Strict');
        }

        if ($this->cookie) {
            $response->headers->setCookie($this->cookie);
        }
    }
}
