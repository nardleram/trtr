<?php

namespace App\Exceptions;

use App\Enums\ExceptionCode;
use Exception;

class InternalException extends Exception
{
    protected string $description;
    protected string $route;
    protected ExceptionCode $internalCode;

    public static function new(
        ExceptionCode $code,
        ?string $message = null,
        ?string $description = null,
        ?int $statusCode = null
    ): static
    {
        $exception = new static(
            $message ?? $code->getMessage(),
            $statusCode ?? $code->getStatusCode(),
        );

        $exception->internalCode = $code;
        $exception->description = $description ?? $code->getDescription();
        $exception->route = $route ?? $code->getRoute();

        return $exception;
    }

    public function getInternalCode(): ExceptionCode
    {
        return $this->internalCode;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getRoute(): string
    {
        return $this->route;
    }
}