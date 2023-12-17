<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\RequestModel;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->addRoles();
        $this->addTestUsers();
        User::factory(10)->create();
        RequestModel::factory(1000)->create();
    }

    private function addRoles()
    {
        UserRole::factory()->create(['name' => 'admin']);
        UserRole::factory()->create(['name' => 'user']);
    }

    private function addTestUsers()
    {
        User::factory()->create([
            'email' => 'admin@mail.ru',
            'name' => 'Админ Админ Админ',
            'user_roles_id' => 1
        ]);
        User::factory()->create([
            'email' => 'user@mail.ru',
            'name' => 'Пользователь Пользователь Пользователь',
            'user_roles_id' => 2
        ]);
    }
}
