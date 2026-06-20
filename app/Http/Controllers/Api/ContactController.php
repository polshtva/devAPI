<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequestForm;
use App\Services\ContactService;

class ContactController extends Controller
{
    public function __construct(private ContactService $service) {}

    public function store(ContactRequestForm $request)
    {
        $data = $this->service->handle($request->validated());

        return response()->json([
            'message' => 'Contact request accepted',
            'data'    => $data,
        ], 201);
    }
}
