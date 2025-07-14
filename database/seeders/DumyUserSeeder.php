<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DumyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'username' => 'admin',
                'email' => 'adminti@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ],
            [
                'username' => 'alumni',
                'email' => 'alumni@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'alumni',
            ],
            [
                'username' => 'irfan',
                'email' => 'irfankntl@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'alumni',
            ],
            [
                'username' => 'superadmin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'superadmin',
            ]

        ];

        foreach ($userData as $user)
            User::create([
                'username' => $user['username'],
                'email' => $user['email'],
                'password' => $user['password'],
                'role' => $user['role'],
            ]
        );
    }
}
