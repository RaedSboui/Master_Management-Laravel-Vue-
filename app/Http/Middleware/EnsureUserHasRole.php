<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string $roles)
    {
        if(auth()->user()->roles->whereIn('name', explode(',', $roles))) return $next($request);
        abort(403);
    }
}
