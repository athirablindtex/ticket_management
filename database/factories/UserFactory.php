<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'username' => $this->faker->unique()->userName(),
            'password' => bcrypt('password'), // Hashing the password
            'role' => $this->faker->randomElement(['admin', 'user']),
            'date_of_birth' => $this->faker->date(),
            'work_joined' => $this->faker->date(),
            'department' => $this->faker->word(),
            'designation' => $this->faker->word(),
            'photo' => 'default.jpg', // Assuming you have a default photo
        ];
    }
}
