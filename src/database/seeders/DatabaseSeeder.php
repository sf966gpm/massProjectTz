<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        UserRole::factory(2)->create();
        User::factory(10)->create();
//        $this->addRoles();
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }

    private function addRoles()
    {
        UserRole::factory()->create(['name' => 'admin']);
        UserRole::factory()->create(['name' => 'user']);
    }
    private function addTestUsers()
    {
//        User::factory()
    }
}
