<?php

namespace App\Http\Requests;

use App\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'role_id' => $this->role_id ? $this->role_id : 3,
        ]);
    }
    
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:150',
            'email' => 'required|email',
            'role_id' => 'nullable|integer|max:3',
            'password' => ['required', 'string', 'confirmed', new Password]
        ];
    }
}
