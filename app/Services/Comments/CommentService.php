<?php

namespace App\Services\Comments;

use Carbon\Carbon;
use App\Models\Comment;
use App\DataTransferObjects\CommentDto;
use App\Exceptions\ArticleException;
use App\Exceptions\ThreadException;
use App\Models\Article;
use App\Models\Thread;
use App\Notifications\CommentAdded;
use Exception;
use Illuminate\Support\Facades\Notification;

class CommentService
{
    public function store(CommentDto $dto)
    {
        if (! auth()->user()) {
            abort(401, 'Please register or log in to comment.');
        }
        
        if ($dto->commentable_type === 'App\Models\Article') {
            try {
                Article::where('id', $dto->commentable_id)->firstOrFail();
            } catch (Exception $e) {
                throw ArticleException::ArticleNotFound();
            }
        }

        if ($dto->commentable_type === 'App\Models\Thread') {
            try {
                Thread::where('id', $dto->commentable_id)->firstOrFail();
            } catch (Exception $e) {
                throw ThreadException::ThreadNotFound();
            }
        }

        $comment = Comment::create([
            'body' => $dto->body,
            'user_id' => $dto->user_id,
            'commentable_id' => $dto->commentable_id,
            'commentable_type' => $dto->commentable_type,
            'parent_id' => $dto->parent_id,
            'parent_type' => $dto->parent_type,
            'indent_level' => $dto->indent_level,
        ]);

        /** Collect all users who need to be notified of new comment
         * and dispatch email notifications as required.
         */
        $commenters = $comment->commentable->comments->map(function ($comment) {
            return $comment->user;
        })->unique();

        // Exclude user who just commented
        $commenters = $commenters->reject(function ($user) use ($comment) {
            return $user->id === $comment->user_id;
        });

        // Add article author if not already present
        if ( $comment->user->id !== $comment->commentable->user->id && 
            !$commenters->contains('email', $comment->commentable->user->email) ) {
            $commenters->push($comment->commentable->user);
        }

        // Dispatch email notifications
        foreach ($commenters as $user) {
            Notification::send($user, new CommentAdded($comment, $user));
        }

        return $comment;
    }

    // public function update(Comment $comment, CommentDto $dto)
    // {
    //     return tap($comment)->update([
    //         'body' => $dto->body,
    //         'user_id' => $dto->user_id,
    //         'commentable_id' => $dto->commentable_id,
    //         'commentable_type' => $dto->commentable_type,
    //         'parent_id' => $dto->parent_id,
    //         'parent_type' => $dto->parent_type,
    //         'indent_level' => $dto->indent_level,
    //     ]);
    // }

    public function nestComments($id, $model) {

        $rawComments = Comment::where('comments.commentable_type', '=', $model)
            ->where('comments.commentable_id', '=', $id)
            ->leftJoin('users AS commentUsers', function ($join) {
                $join->on('comments.user_id', '=', 'commentUsers.id');
            })
            ->select([
                'commentUsers.name AS comment_author',
                'comments.created_at AS created_at',
                'comments.body AS body',
                'comments.id AS comment_id',
                'comments.parent_type AS parent_type',
                'comments.parent_id AS parent_id',
                'comments.indent_level AS indent_level',
            ])
            ->get(); 

        $comments = [];
        $commentsCollection = collect();
        $comment = false;

        if (count($rawComments) > 0) {
            $thisComment = $rawComments->first();

            $thisComment['created'] = Carbon::parse($thisComment['created_at'])->format('j M Y, H:i');

            array_push($comments, $thisComment);

            $remainingComments = $rawComments->where('comment_id', '!=', $thisComment->comment_id);

            // Determine $nextComment to display...
            while (count($comments) < $rawComments->count()) {
                // Does $thisComment have a child (reply) in $remainingComments?
                $nextComment = $remainingComments->first(function ($item) use ($thisComment) {
                    return ($item->parent_id === $thisComment->comment_id);
                });
                
                // Or does $thisComment have sibling (same parent_id)?
                if (!$nextComment) {
                    $nextComment = $remainingComments->first(function ($item) use ($thisComment) {
                        return (($item->parent_id === $thisComment->parent_id)
                        && ($item->parent_type === 'App\Models\Comment'));
                    });
                }
                

                // Or is $thisComment a child of a now-nested comment?
                if (!$nextComment) {
                    $commentsSorted = $remainingComments->sortByDesc('indent_level');
                    foreach($commentsSorted as $cmnt) {
                        if (in_array($cmnt->parent_id, array_column($comments, 'comment_id'))) {
                            $nextComment = $cmnt;
                            break;
                        }
                    }
                }

                // All above failed, $nextComment must be a reply to the article...
                if (!$nextComment) {
                    $nextComment = $remainingComments->first(function ($item) use ($model) {
                        return $item->parent_type === $model;
                    });
                }

                // Catch last comment in array if not caught by above (not response to article: must have parent in $comments)
                // Do I need this???
                if (!$nextComment && count($remainingComments) === 1) {
                    $nextComment = $remainingComments->first();
                }

                // Add needed data
                if ($nextComment && !$comment) { 
                    $comment = $rawComments->first(function ($item) use ($nextComment) {
                        return ($item->comment_id === $nextComment->parent_id);
                    });
                }
                
                if ($nextComment && $comment) {
                    $nextComment['reply_to'] = $comment['comment_author'];
                    $nextComment['parent_created_at'] = Carbon::parse($comment['created_at'])->format('j M Y, H:i');
                }

                if ($nextComment && count($comments) < count($rawComments)) {
                    $nextComment['created'] = Carbon::parse($nextComment['created_at'])->format('j M Y, H:i');
                    
                    if (!in_array($nextComment->comment_id, array_column($comments, 'comment_id'))) {
                        array_push($comments, $nextComment);
                        $commentsCollection->push($nextComment);
                    }

                    $remainingComments = $remainingComments->filter(function ($item) use ($nextComment) {
                        return $item->comment_id !== $nextComment->comment_id;
                    });
                }
                
                $thisComment = $nextComment;
                $nextComment = null;
                $comment = false;
            }
        }

        return collect($comments);
    }
}