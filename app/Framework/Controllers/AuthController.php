<?php

namespace App\Framework\Controllers;

use App\Framework\Enums\HttpStatusCodes;
use App\Framework\Facades\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        try {
            $token = JWTAuth::fromUser($user);
        } catch (JWTException $e) {
            return ApiResponse::sendResponse(message: __('auth.could_not_create_jwt_token'), httpCode: HttpStatusCodes::INTERNAL_SERVER_ERROR_500);
        }

        return ApiResponse::sendResponse([
            'token' => $token,
            'user' => $user,
        ], __('auth.user_created'), HttpStatusCodes::CREATED_201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return ApiResponse::sendResponse(message: __('auth.login__invalid_credentials'), httpCode: HttpStatusCodes::UNAUTHORIZED_401);
            }
        } catch (JWTException $e) {
            return ApiResponse::sendResponse(message: __('auth.could_not_create_jwt_token'), httpCode: HttpStatusCodes::INTERNAL_SERVER_ERROR_500);
        }

        $cookie = cookie('token', $token, env('COOKIE_LIFETIME', 60), null, null, true, true, false, 'Strict');
        return ApiResponse::sendResponse(data: [
            'token' => $token,
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ], message: __('auth.login_succesful'), httpCode: HttpStatusCodes::OK_200, cookie: $cookie);
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch (JWTException $e) {
            return ApiResponse::sendResponse(message: __('auth.failed_logout'), httpCode: HttpStatusCodes::INTERNAL_SERVER_ERROR_500);
        }

        return ApiResponse::sendResponse(message: __('auth.succesful_logout'), httpCode: HttpStatusCodes::OK_200);
    }

    public function getUser()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return ApiResponse::sendResponse(message: __('auth.user_not_found'), httpCode: HttpStatusCodes::NOT_FOUND_404);
            }
            return ApiResponse::sendResponse(data: is_array($user) ? $user : $user->toArray(), httpCode: HttpStatusCodes::OK_200, resetJWT: true);
        } catch (JWTException $e) {
            return ApiResponse::sendResponse($e->getMessage(), __('auth.failed_fetch_user_profile'), HttpStatusCodes::INTERNAL_SERVER_ERROR_500);
        }
    }

    public function updateUser(Request $request)
    {
        try {
            $user = Auth::user();
            $user->update($request->only(['name', 'email']));

            return ApiResponse::sendResponse($user, __('auth.user_updated_succesfully'), HttpStatusCodes::ACCEPTED_202, true);
        } catch (JWTException $e) {
            return ApiResponse::sendResponse($e->getMessage(), __('auth.user_updated_failed'), HttpStatusCodes::INTERNAL_SERVER_ERROR_500);
        }
    }
}
