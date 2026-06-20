<?php

namespace App\Repositories;

use App\Models\ContactRequest;

class ContactRequestRepository
{
    public function create(array $data): ContactRequest
    {
        return ContactRequest::create($data);
    }

    public function count(): int
    {
        return ContactRequest::count();
    }
}
