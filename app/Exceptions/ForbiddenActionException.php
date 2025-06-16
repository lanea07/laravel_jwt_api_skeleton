<?php

namespace App\Exceptions;

use App\Enums\HttpStatusCodes;
use App\Facades\ApiResponse;
use Exception;
use Illuminate\Http\Resources\Json\JsonResource;

class ForbiddenActionException extends Exception {

    public function render(): JsonResource {
        return ApiResponse::sendResponse(message: __('messages.forbidden__insufficient_permissions'), httpCode: HttpStatusCodes::FORBIDDEN_403, resetJWT: true);
    }
}
