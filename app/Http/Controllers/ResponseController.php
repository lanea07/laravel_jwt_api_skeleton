<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatusCodes;
use App\Facades\ApiResponse;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller {

    public function index() {
        $permissions = Auth::user()->getAllPermissions();
        return ApiResponse::sendResponse($permissions, 'Product list', HttpStatusCodes::OK_200, true);
    }
}
