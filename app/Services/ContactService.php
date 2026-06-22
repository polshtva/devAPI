<?php

namespace App\Services;

use App\Mail\ContactOwnerMail;
use App\Mail\ContactUserCopyMail;
use App\Repositories\ContactRequestRepository;
use App\Services\Ai\AiService;
use Illuminate\Support\Facades\Mail;

class ContactService
{
    public function __construct(
        private ContactRequestRepository $repo,
        private AiService $ai,
    ) {}

    public function handle(array $data): array
    {
        // 1) AI анализ + ответ
        $aiResult = $this->ai->analyzeAndReply($data['comment'], $data['name']);

        // 2) Сохраняем в файл (НЕ в БД)
        $saved = $this->repo->create([
            ...$data,
            'sentiment' => $aiResult['sentiment'],
            'ai_reply'  => $aiResult['reply'],
            'ai_used'   => $aiResult['ai_used'],
        ]);

        // 3) Письмо владельцу
        Mail::to(config('mail.owner.address'))->send(
            new ContactOwnerMail([
                'request' => $saved,
                'ai'      => $aiResult,
            ])
        );

        // 4) Копия пользователю
        Mail::to($saved['email'])->send(
            new ContactUserCopyMail([
                'request' => $saved,
                'ai'      => $aiResult,
            ])
        );

        // 5) Ответ API
        return [
            'id'        => $saved['id'],
            'sentiment' => $saved['sentiment'],
            'reply'     => $saved['ai_reply'],
            'ai_used'   => $saved['ai_used'],
        ];
    }
}
