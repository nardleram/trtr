<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    public function definition(): array
    {
        return [
            //
        ];
    }

    public function createAdminRole(string $name): Role
    {
        return $this->state(function() use ($name) {
            return [
                'name' => $name,
            ];
        })->create();
    }

    public function createAuthorRole(string $name): Role
    {
        return $this->state(function() use ($name) {
            return [
                'name' => $name
            ];
        })->create();
    }

    public function createGuestRole(string $name): Role
    {
        return $this->state(function() use ($name) {
            return [
                'name' => $name,
            ];
        })->create();
    }
}
