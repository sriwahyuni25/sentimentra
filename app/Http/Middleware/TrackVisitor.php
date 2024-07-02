<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        Visitor::create(['ip_address' => $ip]);

        return $next($request);
    }
}

