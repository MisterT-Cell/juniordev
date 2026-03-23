<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'role' => fake()->randomElement(['student', 'company']),
            'is_blocked' => false,
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    public function student(): static
    {
        return $this->state(['role' => 'student']);
    }

    public function company(): static
    {
        return $this->state(['role' => 'company']);
    }

    public function admin(): static
    {
        return $this->state(['role' => 'admin']);
    }

    public function unverified(): static
    {
        return $this->state(['email_verified_at' => null]);
    }
}
