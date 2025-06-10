<?php

namespace App\DataTransferObjects;

use App\Http\Requests\UpdateUserRequest;

readonly class UpdateUserDto
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        public readonly ?string $newpassword
    ) {}

    public static function fromRequest(UpdateUserRequest $request): self
    {
        return new self(
            name: $request->validated('name'),
            email: $request->validated('email'),
            password: $request->validated('password'),
            newpassword: $request->validated('newpassword'),
        );
    }
}