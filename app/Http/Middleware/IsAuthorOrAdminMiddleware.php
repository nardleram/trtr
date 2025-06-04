<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class IsAuthorOrAdminMiddleware
{
    public function handle(Request $request, Closure $next): RedirectResponse | Response
    {
        abort_if($request->user()->role_id > 2, 403);
        
        return $next($request);
    }
}
