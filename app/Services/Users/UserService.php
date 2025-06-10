<?php

namespace App\Services\Users;

use App\DataTransferObjects\UpdateUserDto;
use App\DataTransferObjects\UserDto;
use App\Enums\UserRole;
use App\Models\User;
use App\Notifications\NewRegistrant;
use Illuminate\Support\Facades\Notification;

class UserService
{
    public function store(UserDto $dto): User
    {
        $user = User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->password,
            'role_id' => $dto->role_id
        ]);

        Notification::send(User::where('role_id', UserRole::Admin->value)->get(), new NewRegistrant($user));

        return $user;
    }

    public function update(User $user, UpdateUserDto $dto): User
    {
        return tap($user)->update([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->newpassword ? $dto->newpassword : $dto->password,
        ]);
    }
}