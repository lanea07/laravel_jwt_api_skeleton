<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatusCodes;
use App\Services\ApiResponseService;

class ResponseController extends Controller {

    public function __construct(
        private ApiResponseService $apiResponseService
    ) {
    }

    public function index() {
        $products = ['product1', 'product2'];
        return $this->apiResponseService->success($products, 'Product list', HttpStatusCodes::OK_200, false);
    }
}
