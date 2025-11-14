<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Landlord;
use App\Models\User;
use Faker\Factory as Faker;
class LandlordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $users = [
        //     [
        //         'name' => fake()->name,
        //         'email' => fake()->unique()->safeEmail(),
        //         'role' => 1,
        //         'password' => bcrypt('123456'),
        //     ],
        //     [
        //         'name' => fake()->name,
        //         'email' => fake()->unique()->safeEmail(),
        //         'role' => 1,
        //         'password' => bcrypt('123456'),
        //     ],
        //     [
        //         'name' => fake()->name,
        //         'email' => fake()->unique()->safeEmail(),
        //         'role' => 1,
        //         'password' => bcrypt('123456'),
        //     ],

        // ];
        // foreach ($users as $userData) {
        //     $user = User::create($userData);

        //     // Create associated role-specific record
        //     if ($user->role == 'user') {
        //         student::create(['user_id' => $user->id]);
        //     } elseif ($user->role == 'landlord') {
        //         Landlord::create(['user_id' => $user->id]);
        //     } elseif ($user->role == 'admin') {
        //         Admin::create(['user_id' => $user->id]);
        //     }
        // };

        $faker = Faker::create();

        // Create 10 landlord 
        for ($i = 0; $i < 15; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'role' => 1, // Set role to 1 for landlords
                'password' => bcrypt('123456'),
                'email_verified_at' => now(),
            ]);
            // Create associated landlord record
            if ($user->role == 'user') {
                student::create(['user_id' => $user->id]);
            } elseif ($user->role == 'landlord') {
                Landlord::create(['user_id' => $user->id]);
            } elseif ($user->role == 'admin') {
                Admin::create(['user_id' => $user->id]);
            }
        }

        //user
        for ($i = 0; $i < 15; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'role' => 0, // Set role to 1 for landlords
                'password' => bcrypt('123456'),
                'email_verified_at' => now(),
            ]);
            // Create associated landlord record
            if ($user->role == 'user') {
                student::create(['user_id' => $user->id]);
            } elseif ($user->role == 'landlord') {
                Landlord::create(['user_id' => $user->id]);
            } elseif ($user->role == 'admin') {
                Admin::create(['user_id' => $user->id]);
            }
        }
    }
}
