<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nim' => $this->faker->unique()->numerify('##########'), // contoh NIM acak 10 digit
            'password' => Hash::make('password123'), // bisa diubah sesuai kebutuhan
        ];
    }
}
