<?php

namespace App\Services\Users;

use App\DataTransferObjects\UserDto;
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

        Notification::send(User::where('email', 'toby@truthtransparent.com')->first(), new NewRegistrant($user));

        return $user;
    }

    public function update(User $user, UserDto $dto): User
    {
        return tap($user)->update([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->password,
            'role_id' => $dto->role_id
        ]);
    }
}