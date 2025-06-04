<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $levels = [
        //
    ];

    protected $dontReport = [
        //
    ];

     protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->renderable(function (InternalException $e) {
            return response()->view('errors.internal-exception', [
                'state' => 'error',
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'description' => $e->getDescription(),
                'route' => $e->getRoute()
            ], $e->getCode());
        });
    }
}
