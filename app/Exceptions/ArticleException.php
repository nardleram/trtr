<?php

namespace App\Exceptions;

use App\Enums\ExceptionCode;

class ArticleException extends InternalException
{
    public static function articleNotFound()
    {
        return self::new(
            ExceptionCode::ArticleNotFound,
        );
    }
}