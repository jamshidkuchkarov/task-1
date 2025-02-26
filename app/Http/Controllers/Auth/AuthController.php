<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Responses\ApiResponse;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $this->authService->register($request->validated());
        return ApiResponse::success($data, 'Foydalanuvchi muvaffaqiyatli ro‘yxatdan o‘tdi');
    }

    public function login(LoginRequest $request)
    {
        $data = $this->authService->login($request->validated());
        return ApiResponse::success($data, 'Tizimga muvaffaqiyatli kirdingiz');
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return ApiResponse::success([], 'Tizimdan chiqdingiz');
    }

    public function profile(Request $request)
    {
        return ApiResponse::success($request->user(), 'Foydalanuvchi profili');
    }
}
