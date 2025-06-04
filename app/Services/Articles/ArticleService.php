<?php

namespace App\Services\Articles;

use App\Models\Article;
use Illuminate\Support\Str;
use App\DataTransferObjects\ArticleDto;
use App\Services\Comments\CommentService;
use App\Services\Images\ImageService;

class ArticleService
{
    public function __construct(
        protected CommentService $commentService,
        protected ImageService $imageService
    ){}

    public function store(ArticleDto $dto)
    {
        $path = $dto->main_image->store('images/articles', 'public');

        return Article::create([
            'title' => $dto->title,
            'main_image' => $path,
            'category' => $dto->category,
            'seo' => $dto->seo,
            'keywords' => $dto->keywords,
            'body' => $dto->body,
            'slug' => Str::slug($dto->title),
            'user_id' => $dto->user_id,
            'source' => $dto->source
        ]);
    }

    public function update(Article $article, ArticleDto $dto)
    {
        if ($dto->main_image) {
            $this->imageService->destroy($article->main_image);
            $path = $dto->main_image->store('images/articles', 'public');
        } else {
            $path = $article->main_image;
        }

        return tap($article)->update([
            'title' => $dto->title,
            'main_image' => $path,
            'seo' => $dto->seo,
            'keywords' => $dto->keywords,
            'body' => $dto->body,
            'slug' => Str::slug($dto->title),
            'user_id' => $dto->user_id,
            'source' => $dto->source
        ]);
    }

    public function show($id)
    {
        $article = Article::where('id', $id)->first();
        
        $article->comments = $this->commentService->nestComments($id, 'App\Models\Article');
        
        return $article;
    }
}