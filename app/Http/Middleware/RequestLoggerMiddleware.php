<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RequestLoggerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        Log::channel('daily')->info('API Request', [
            'method' => $request->method(),
            'url'    => $request->fullUrl(),
            'ip'     => $request->ip(),
            'body'   => $request->all(),
        ]);

        return $next($request);
    }
}
