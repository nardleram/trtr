<?php

namespace App\Exceptions;

use App\Enums\ExceptionCode;

class ThreadException extends InternalException
{
    public static function threadNotFound()
    {
        return self::new(
            ExceptionCode::ThreadNotFound,
        );
    }
}