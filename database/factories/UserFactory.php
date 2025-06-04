<?php

namespace Database\Factories;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'Toby',
            'email' => 'tobyrussell@protonmail.com',
            'role_id' => UserRole::Admin->value,
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Store admin user.
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role_id' => UserRole::Admin->value,
        ]);
    }

    /**
     * Store author user.
     */
    public function author(): static
    {
        return $this->state(fn (array $attributes) => [
            'role_id' => UserRole::Author->value,
        ]);
    }
}
