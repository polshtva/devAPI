<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ContactRequestRepository;

class MetricsController extends Controller
{
    public function __construct(private ContactRequestRepository $repo) {}

    public function __invoke()
    {
        return response()->json([
            'total_requests' => $this->repo->count(),
        ]);
    }
}
