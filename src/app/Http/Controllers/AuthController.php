<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginUserRequest $request, UserService $userService): JsonResponse
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated)) {
            return $this->error('', 'Не совпадают данные учетной записи.', 401);
        }

        return $this->success($userService->loginUserData($validated['email']));
    }

    public function register(StoreUserRequest $request, UserService $userService): JsonResponse
    {
        $validated = $request->validated();
        return $this->success($userService->registerUserData($validated));
    }

    public function logout(): JsonResponse
    {
        $tokenCount = Auth::user()->tokens()->where('tokenable_id', Auth::id())->delete();

        return $this->success('', 'Вы успешно вышли из системы. ' .
            'Токенов было удалено - ' . $tokenCount . ' шт.');
    }
}
