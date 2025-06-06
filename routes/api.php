<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResponseController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['jwt','hasActions'])->group(function () {

    Route::prefix('user-actions')->group(function() {
        Route::get('/user', [AuthController::class, 'getUser'])->defaults('permissions', [1,100]);
        Route::post('/logout', [AuthController::class, 'logout'])->defaults('permissions', [1,100]);
        Route::put('/user', [AuthController::class, 'updateUser'])->defaults('permissions', [1,100]);
    });

    Route::prefix('other-routes')->group(function () {
        Route::get('/response', [ResponseController::class, 'index'])->defaults('permissions', [1,100]);

    });
});
