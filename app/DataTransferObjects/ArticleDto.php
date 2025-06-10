<?php

namespace App\DataTransferObjects;

use App\Enums\ArticleSource;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\UploadedFile;

readonly class ArticleDto
{
    public function __construct(
        public readonly string $title,
        public  readonly UploadedFile $main_image,
        public readonly string $category,
        public readonly string $seo,
        public readonly string $keywords,
        public readonly string $body,
        public readonly string $user_id,
        public readonly ArticleSource $source,
    ) {}

    public static function fromRequest(ArticleRequest $request): self
    {
        return new self(
            title: $request->validated('title'),
            main_image: $request->validated('main_image'),
            category: $request->validated('category'),
            seo: $request->validated('seo'),
            keywords: $request->validated('keywords'),
            body: $request->validated('body'),
            user_id: auth()->id(),
            source: ArticleSource::App,
        );
    }
}