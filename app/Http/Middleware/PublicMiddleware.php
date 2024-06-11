<?php

namespace App\Http\Middleware;

use Closure;

class PublicMiddleware
{
    public function handle($request, Closure $next)
    {
        // No login required for public access
        return $next($request);
    }
}

