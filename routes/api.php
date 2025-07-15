<?php

use Illuminate\Support\Facades\Route;
use App\Framework\Controllers\AuthController;
use App\Http\Controllers\DefaultController;

Route::prefix('{version}/{lang}')
    ->group(function () {

        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);

        Route::middleware(['jwt', 'hasActions'])->group(function () {

            Route::prefix('user-actions')->group(function () {
                Route::get('/user', [AuthController::class, 'getUser'])->defaults('permissions', [1, 100])->defaults('endSession', false);
                Route::post('/logout', [AuthController::class, 'logout'])->defaults('permissions', [1, 100])->defaults('endSession', false);
                Route::put('/user', [AuthController::class, 'updateUser'])->defaults('permissions', [1, 100])->defaults('endSession', false);
            });

            Route::prefix('default-controller')->group(function () {
                Route::get('/response', [DefaultController::class, 'index'])->defaults('permissions', [1, 100])->defaults('endSession', false);
                Route::get('/temp-table', [DefaultController::class, 'tempTableExample'])->defaults('permissions', [1, 100])->defaults('endSession', false);
            });
        });
    });
