<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class JWTAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if($guard != null)
        {
            auth()->shouldUse($guard);
            try {
                $user = JWTAuth::parseToken()->authenticate();
            } catch (\Exception $e) {
                if ($e instanceof TokenExpiredException) {
                    $newToken = JWTAuth::parseToken()->refresh();
                    return response()->json(['success'=>false, 'status'=>'Expired', 'token'=>$newToken], 200);
                } else if ($e instanceof TokenInvalidException) {
                    return response()->json(['success'=>false, 'message'=>'Token Invalid'], 401);
                } else {
                    return response()->json(['success'=>false, 'message'=>'Token Not Found'], 401);
                }
            }
        }
        return $next($request);
    }
}
