<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatusCodes;
use App\Services\ApiResponse;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller {

    public function __construct(
        private ApiResponse $apiResponse
    ) {
    }

    public function index() {
        $permissions = Auth::user()->getAllPermissions();
        return $this->apiResponse->sendResponse($permissions, 'Product list', HttpStatusCodes::OK_200, true);
    }
}
