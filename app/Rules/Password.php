<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Password implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/[a-z]/', $value) || 
            !preg_match('/[A-Z]/', $value) ||
            !preg_match('/[0-9]/', $value) ||
            !preg_match('/[^A-Za-z0-9]/', $value) ||
            strlen($value) < 10 ) {
            $fail('Your :attribute must have a lowercase and uppercase letter, a number, a symbol (non-alphanumeric character, e.g. $), and be at least 10 characters long.');
        }
    }
}
