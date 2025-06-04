<?php

namespace App\Services\Users;

use App\DataTransferObjects\UserDto;
use App\Models\User;

class UserService
{
    public function store(UserDto $dto)
    {
        return User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->password,
            'role_id' => $dto->role_id
        ]);
    }

    public function update(User $user, UserDto $dto)
    {
        return tap($user)->update([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->password,
            'role_id' => $dto->role_id
        ]);
    }
}