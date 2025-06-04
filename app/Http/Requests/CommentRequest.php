<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'body' => 'required|string',
            'user_id' => 'required|uuid',
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required|string',
            'parent_id' => 'required|integer',
            'parent_type' => 'required|string',
            'indent_level' => 'required|integer',
        ];
    }
}
