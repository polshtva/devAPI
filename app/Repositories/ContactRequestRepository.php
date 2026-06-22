<?php

namespace App\Repositories;

class ContactRequestRepository
{
    private string $path;

    public function __construct()
    {
        $this->path = storage_path('app/contact_requests.json');

        if (!file_exists($this->path)) {
            file_put_contents($this->path, json_encode([]));
        }
    }

    public function create(array $data): array
    {
        $items = json_decode(file_get_contents($this->path), true);

        $id = count($items) + 1;

        $entry = [
            'id'         => $id,
            'name'       => $data['name'] ?? null,
            'email'      => $data['email'] ?? null,
            'phone'      => $data['phone'] ?? null,   // ← ДОБАВИТЬ
            'comment'    => $data['comment'] ?? null,
            'sentiment'  => $data['sentiment'] ?? null,
            'ai_reply'   => $data['ai_reply'] ?? null,
            'ai_used'    => $data['ai_used'] ?? false,
            'created_at' => now()->toDateTimeString(),
        ];


        $items[] = $entry;

        file_put_contents($this->path, json_encode($items, JSON_PRETTY_PRINT));

        return $entry;
    }

    public function count(): int
    {
        $items = json_decode(file_get_contents($this->path), true);
        return count($items);
    }
}
