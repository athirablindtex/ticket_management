<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Make sure to import the User model
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create a default admin user
        User::create([
            'name' => 'Admin User',
            'phone' => '1234567890',
            'email' => 'admin@example.com',
            'username' => 'admin',
            'password' => bcrypt('password'), // Hashing the password
            'role' => 'admin',
            'date_of_birth' => '1990-01-01',
            'work_joined' => '2020-01-01',
            'department' => 'IT',
            'designation' => 'Administrator',
            'photo' => 'default.jpg', // Assuming you have a default photo
        ]);

        // Create 10 random users
        \App\Models\User::factory(10)->create();
    }
}
