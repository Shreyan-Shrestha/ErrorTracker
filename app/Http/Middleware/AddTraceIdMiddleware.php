<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Context;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Str;

class AddTraceIdMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $traceId = (string) Str::uuid()->toString();

        Context::add('trace_id', $traceId);
        return $next($request);
    }
}
