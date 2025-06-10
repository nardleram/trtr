<?php

namespace App\DataTransferObjects;

use App\Http\Requests\CommentRequest;

readonly class CommentDto
{
    public function __construct(
        public string $body,
        public string $user_id,
        public int $commentable_id,
        public string $commentable_type,
        public int $parent_id,
        public string $parent_type,
        public int $indent_level
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