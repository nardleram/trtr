<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Comments\CommentService;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'user_id' => $this->user_id,
            'source' => $this->source,

            'comments' => CommentService::compileComments($this->commentable_id, 'App\Models\Article'),

            'user' => User::where('id', $this->user_id)->pluck('name')
        ];
    }
}
