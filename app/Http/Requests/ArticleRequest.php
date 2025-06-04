<?php

namespace App\Http\Requests;

use App\Enums\ArticleSource;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (auth()->id()) {
            return true;
        }

        return false;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'main_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required|string|max:55',
            'body' => 'required|string',
            'seo' => 'required|string|max:200',
            'keywords' => 'required|string|max:150',
            'source' => ['required', new Enum(ArticleSource::class)],
        ];
    }
}
