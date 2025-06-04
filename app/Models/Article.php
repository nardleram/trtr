<?php

namespace App\Models;

use App\Models\Comment;
use App\Enums\ArticleSource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'source' => ArticleSource::class,
    ];

    protected $fillable = [
        'title', 'main_image', 'category', 'body', 'seo', 'keywords', 'slug', 'source', 'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public static function most_commented()
    {
        return self::select('title', 'slug')->withCount('comments')->take(5)->orderBy('comments_count', 'desc')->get();
    }
}
