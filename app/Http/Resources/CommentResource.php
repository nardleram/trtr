<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'body' => $this->title,
            'indent_level' => $this->indent_level,
            'parent_id' => $this->parent_id,
            'created_at' => $this->created_at
        ];
    }
}
