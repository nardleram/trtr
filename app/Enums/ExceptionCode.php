<?php

namespace App\Enums;

enum ExceptionCode: int
{
    case ThreadNotFound = 8_000;
    
    case ArticleNotFound = 9_000;

    case UserEmailAlreadyRegistered = 10_000;

    case NoAccess = 11_000;

    public function getStatusCode(): int
    {
        $value = $this->value;

        return match (true) {
            $value >= 8_000 => 404,
            $value >= 9_000 => 404,
            $value >= 10_000 => 400,
            $value >= 20_000 => 403,
            default => 500,
        };
    }

    public function getMessage(): string
    {
        $key = "exceptions.{$this->value}.message";

        $translation = __($key);

        if ($key === $translation) {
            return "An unknow error occured.";
        }

        return $translation;
    }

    public function getDescription(): string
    {
        $key = "exceptions.{$this->value}.description";

        $translation = __($key);

        if ($key === $translation) {
            return "No additional description provided.";
        }

        return $translation;
    }

    public function getRoute(): string
    {
        $key = "exceptions.{$this->value}.route";

        $translation = __($key);

        if ($key === $translation) {
            return route('/');
        }

        return $translation;
    }
}