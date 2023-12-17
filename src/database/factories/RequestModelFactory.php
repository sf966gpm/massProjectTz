<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RequestModel>
 */
class RequestModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::all()->pluck('id');
        $status = fake()->randomElement(['Active', 'Resolved']);
        $comment = $status === 'Resolved' ? fake()->text(20) : null;
        return [
            'users_id' => fake()->randomElement($userIds),
            'status' => $status,
            'message' => fake()->text(20),
            'comment' => $comment,
        ];
    }
}
