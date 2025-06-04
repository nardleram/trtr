<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactoryHelper extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [];
    }

    public function createAdminUser(string $email, string $name): User
    {
        return $this->state(function() use ($email, $name) {
            return [
                'name' => $name,
                'email' => $email,
                'id' => Str::uuid()->toString(),
                'role_id' => UserRole::Admin->value,
                'password' => Hash::make('s3cretP4$w0rD!'),
                'email_verified_at' => now(),
            ];
        })->create();
    }

    public function createAuthorUser(string $email, string $name): User
    {
        return $this->state(function() use ($email, $name) {
            return [
                'name' => $name,
                'email' => $email,
                'id' => Str::uuid()->toString(),
                'role_id' => UserRole::Author->value,
                'password' => Hash::make('0rthArV4n!t3E'),
                'email_verified_at' => now(),
            ];
        })->create();
    }
}
