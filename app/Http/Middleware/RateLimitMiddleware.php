<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class RateLimitMiddleware
{
    public function handle($request, Closure $next)
    {
        $key = 'rate_limit:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 60)) {
            return response()->json([
                'message' => 'Too many requests'
            ], Response::HTTP_TOO_MANY_REQUESTS);
        }

        RateLimiter::hit($key, 60);

        return $next($request);
    }
}
