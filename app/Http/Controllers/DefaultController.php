<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatusCodes;
use App\Facades\ApiResponse;
use Illuminate\Support\Facades\Auth;

class DefaultController extends Controller {
    
    public function index() {
        $permissions = Auth::user()->getAllPermissions();
        return ApiResponse::sendResponse($permissions, __('controllers/default_controller.default_controller_response'), HttpStatusCodes::OK_200, true);
    }
}
