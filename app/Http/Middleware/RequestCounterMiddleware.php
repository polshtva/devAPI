<?php

namespace App\Http\Middleware;

use Closure;

class RequestCounterMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $path = storage_path('app/metrics.json');

        // Если файла нет — создаём
        if (!file_exists($path)) {
            file_put_contents($path, json_encode(['total_requests' => 0]));
        }

        $data = json_decode(file_get_contents($path), true);

        // Увеличиваем счётчик
        $data['total_requests'] = ($data['total_requests'] ?? 0) + 1;

        // Сохраняем обратно
        file_put_contents($path, json_encode($data));

        return $response;
    }
}
