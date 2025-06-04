<?php

namespace App\Exceptions;

use App\Enums\ExceptionCode;

class UserException extends InternalException
{
    public static function userEmailAlreadyRegistered()
    {
        return self::new(
            ExceptionCode::UserEmailAlreadyRegistered,
        );
    }
}