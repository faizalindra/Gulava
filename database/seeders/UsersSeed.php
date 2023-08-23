<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'code' => 'ADM01',
                'name' => 'Admin',
                'email' => 'admin@email.com',
                'password' => bcrypt('admin'),
                'role' => 'admin',
                'is_active' => true,   
            ],
            [
                'code' => 'USR01',
                'name' => 'User',
                'email' => 'user@email.com',
                'password' => bcrypt('user'),
                'role' => 'user',
                'is_active' => true,   
            ]
        ];
        User::insert($users);
    }
}
