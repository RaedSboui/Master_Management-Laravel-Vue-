<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsLocked
{
    public function handle(Request $request, Closure $next)
    {
        if(!auth()->user()->isLocked) return $next($request);
        abort(403);
    }
}
