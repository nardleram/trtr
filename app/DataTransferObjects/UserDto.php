<?php

namespace App\DataTransferObjects;

use App\Http\Requests\UserRequest;

readonly class UserDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public int $role_id
    ) {}

    public static function fromRequest(UserRequest $request): self
    {
        return new self(
            name: $request->validated('name'),
            email: $request->validated('email'),
            password: $request->validated('password'),
            role_id: $request->validated('role_id'),
        );
    }
}