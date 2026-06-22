<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class RequestLoggerMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        Log::channel('daily')->info('API Request', [
            'method' => $request->method(),
            'url'    => $request->fullUrl(),
            'ip'     => $request->ip(),
            'status' => $response->status(),
        ]);

        return $response;
    }
}
