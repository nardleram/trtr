<?php

namespace App\DataTransferObjects;

use App\Http\Requests\CommentRequest;

readonly class CommentDto
{
    public function __construct(
        public readonly string $body,
        public readonly string $user_id,
        public readonly int $commentable_id,
        public readonly string $commentable_type,
        public readonly int $parent_id,
        public readonly string $parent_type,
        public readonly int $indent_level
    ) {}

    public static function fromRequest(CommentRequest $request): self
    {
        return new self(
            body: $request->validated('body'),
            user_id: $request->validated('user_id'),
            commentable_id: $request->validated('commentable_id'),
            commentable_type: $request->validated('commentable_type'),
            parent_id: $request->validated('parent_id'),
            parent_type: $request->validated('parent_type'),
            indent_level: $request->validated('indent_level')
        );
    }
}