<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Services\Comments\CommentService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThreadResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        dd('Thread resource');
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'creatThis' => $this->created_at->format('j M y, H:i'),

            'comments' => CommentService::compileComments($this->commentable_id, 'App\Models\Thread'),

            'user' => User::where('id', $this->user_id)->pluck('name')
        ];
    }
}
