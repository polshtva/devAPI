<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RateLimitMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $ip  = $request->ip();
        $key = 'contact:' . $ip;
        $max = 5; // 5 запросов в минуту

        $count = cache()->get($key, 0);

        if ($count >= $max) {
            return response()->json([
                'message' => 'Too many requests',
            ], 429);
        }

        cache()->put($key, $count + 1, now()->addMinute());

        return $next($request);
    }
}
