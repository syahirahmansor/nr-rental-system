<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use App\Models\Landlord;
use App\Models\Student;
use Illuminate\Support\Facades\Log;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'User',
                'email' => 'user@demo.com',
                'role' => 0,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Marry John',
                'email' => 'landlord@demo.com',
                'role' => 1,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Terry Maquire',
                'email' => 'landlord2@demo.com',
                'role' => 1,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Sora Walle',
                'email' => 'landlord3@demo.com',
                'role' => 1,
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@demo.com',
                'role' => 2,
                'password' => bcrypt('123456'),
            ],

        ];
        foreach ($users as $userData) {
            $user = User::create($userData);

            // Create associated role-specific record
            if ($user->role == 'user') {
                student::create(['user_id' => $user->id]);
            } elseif ($user->role == 'landlord') {
                Landlord::create(['user_id' => $user->id]);
            } elseif ($user->role == 'admin') {
                Admin::create(['user_id' => $user->id]);
            }
        };
        
    }
}

