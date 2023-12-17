<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Создаем пользователя
     * @param array $validated
     * @return array
     */
    public function registerUserData(array $validated): array
    {
        $user = User::create([
            'user_roles_id' => $validated['user_roles_id'],
            'email' => $validated['email'],
            'name' => $validated['name'],
            'password' => Hash::make($validated['password']),
        ]);

        return $this->userData($user);

    }

    /**
     * Отдаём массив userData с данными.
     * @param string $email
     * Проверен на существование в базе
     * @return array
     */
    public function loginUserData(string $email): array
    {
        $user = User::where(['email' => $email])->first();
        return $this->userData($user);

    }

    /**
     * Делает выборку данных у user
     * @param User $user
     * @return array
     */
    private function userData(User $user): array
    {
        return [
            'user' => $user,
            'token' => $user->createToken('API Token для ' . $user->email)->plainTextToken,
            'token_type' => 'Bearer'
        ];
    }
}
