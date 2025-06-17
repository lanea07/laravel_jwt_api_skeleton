<?php

namespace App\Http\Resources;

use App\Enums\HttpStatusCodes;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Cookie;

class DefaultResponseResource extends JsonResource {
    protected string $message;
    protected bool $resetJWT;
    protected ?Cookie $cookie;
    protected int $statusCode;

    public function __construct(
        $resource,
        string $message = '',
        bool $resetJWT = false,
        ?Cookie $cookie = null,
        HttpStatusCodes $statusCode = HttpStatusCodes::OK_200
    ) {
        parent::__construct($resource);
        $this->message = $message;
        $this->resetJWT = $resetJWT;
        $this->cookie = $cookie;
        $this->statusCode = $statusCode->value;
    }

    public function toArray(Request $request): array {
        return [
            'message' => $this->message,
            'data' => $this->resource
        ];
    }

    public function withResponse($request, $response): void {
        $response->setStatusCode($this->statusCode);
    }
}
