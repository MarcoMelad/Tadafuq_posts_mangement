<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginUserRequest;
use App\Http\Requests\Authentication\RegisterUserRequest;
use App\interfaces\UserAuthRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private readonly UserAuthRepositoryInterface $authRepository)
    {
    }

    public function register(RegisterUserRequest $request): JsonResponse
    {
        $result = $this->authRepository->register($request->validated());
        return response()->json($result, $result['status_code']);
    }

    public function login(LoginUserRequest $request): JsonResponse
    {
        $result = $this->authRepository->login($request->validated());
        return response()->json($result, $result['status_code']);
    }

    public function user_profile(): JsonResponse
    {
        $result = $this->authRepository->user_profile();
        return response()->json($result, $result['status_code']);
    }

    public function logout(): JsonResponse
    {
        $result = $this->authRepository->logout();
        return response()->json($result, $result['status_code']);
    }
}
