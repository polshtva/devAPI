<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class MetricsController extends Controller
{
    public function __invoke()
    {
        $path = storage_path('app/metrics.json');

        // Если файла нет — создаём с нулём
        if (!file_exists($path)) {
            file_put_contents($path, json_encode(['total_requests' => 0]));
        }

        $data = json_decode(file_get_contents($path), true);

        return response()->json([
            'total_requests' => $data['total_requests'] ?? 0,
        ]);
    }
}
