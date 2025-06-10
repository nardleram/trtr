<?php

namespace App\DataTransferObjects;

use App\Enums\ArticleSource;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\UploadedFile;

readonly class ArticleDto
{
    public function __construct(
        public string $title,
        public UploadedFile $main_image,
        public string $category,
        public string $seo,
        public string $keywords,
        public string $body,
        public string $user_id,
        public ArticleSource $source,
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