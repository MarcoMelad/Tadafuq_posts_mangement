<?php

namespace App\Repositories;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\interfaces\UserAuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserAuthRepository implements UserAuthRepositoryInterface
{

    public function login(array $data): array
    {
        if (!$token = auth('api')->attempt($data)) {
            return failedResponse(404, ['error' => 'These credentials do not match our records.']);
        }

        $result = new UserResource(auth('api')->user());
        $result['token'] = createNewToken($token);
        return successResponse(200, $result);
    }

    public function register(array $data): array
    {
        $user = User::create([
            'name' => $data['name'],
            'user_name' => $data['user_name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        if ($user->save()) {

            $token = auth('api')->attempt($data);
            $result = new UserResource($user);
            $result['token'] = createNewToken($token);

            return successResponse(201, $result);
        }
        return failedResponse(400, ['error' => 'Bad Request']);
    }

    public function user_profile(): array
    {
        $user = auth('api')->user();
        return successResponse(200, new UserResource($user));
    }

    public function logout(): array
    {
        auth('api')->logout();
        return successResponse(200, ['message' => 'User logged out successfully']);
    }
}
