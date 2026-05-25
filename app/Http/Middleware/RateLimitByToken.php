<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class RateLimitByToken
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        $key = 'rate_limit:token' . ($token ?? $request->ip());

        $max_attempts = !$token ? 30: 60; 
        if(RateLimiter::tooManyAttempts($key,$max_attempts)){
            return response()->json([
                'message' => 'Rate limited exceeded',
                'max_attempts' => $max_attempts,
            ],429);
        }
        RateLimiter::hit($key,60);
        return $next($request);
    }
}
