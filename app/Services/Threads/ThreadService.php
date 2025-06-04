<?php

namespace App\Services\Threads;

use App\Models\Thread;
use App\DataTransferObjects\ThreadDto;
use App\Services\Comments\CommentService;

class ThreadService
{
    public function __construct(
        protected CommentService $commentService
    )   {}

    public function store(ThreadDto $dto)
    {
        return Thread::create([
            'title' => $dto->title,
            'body' => $dto->body,
            'user_id' => $dto->user_id
        ]);
    }

    public function update(Thread $thread, ThreadDto $dto)
    {
        return tap($thread)->update([
            'title' => $dto->title,
            'body' => $dto->body,
            'user_id' => $dto->user_id
        ]);
    }

    public function show(int $id)
    {
        $thread = Thread::where('threads.id', $id)
                    ->leftJoin('users', function ($join) {
                        $join->on('threads.user_id', '=', 'users.id');
                    })
                    ->select([
                        'threads.id AS id',
                        'threads.title AS title',
                        'threads.body AS body',
                        'threads.created_at AS created_at',
                        'users.name AS name',
                    ])
                    ->get(); 
        
        $thread->comments = $this->commentService->nestComments($id, 'App\Models\Thread');
        
        return $thread;
    }
}