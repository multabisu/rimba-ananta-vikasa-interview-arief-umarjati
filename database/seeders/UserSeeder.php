<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample users
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'age' => 30,
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'age' => 25,
            ],
            [
                'name' => 'Bob Johnson',
                'email' => 'bob@example.com',
                'age' => 40,
            ],
            [
                'name' => 'Alice Williams',
                'email' => 'alice@example.com',
                'age' => 35,
            ],
            [
                'name' => 'Charlie Brown',
                'email' => 'charlie@example.com',
                'age' => 28,
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}