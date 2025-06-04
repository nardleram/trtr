<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IsGuestAtLeast
{
    public function handle(Request $request, Closure $next): RedirectResponse | Response
    {
        abort_if($request->user()->role_id < 1, 403);
        
        return $next($request);
    }
}
