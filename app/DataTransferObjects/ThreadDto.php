<?php

namespace App\DataTransferObjects;

use App\Http\Requests\ThreadRequest;

readonly class ThreadDto
{
    public function __construct(
        public string $title,
        public string $body,
        public string $user_id
    ) {}

    public static function fromRequest(ThreadRequest $request): self
    {
        return new self(
            title: $request->validated('title'),
            body: $request->validated('body'),
            user_id: auth()->id()
        );
    }
}