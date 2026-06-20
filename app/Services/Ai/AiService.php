<?php

namespace App\Services\Ai;

use Illuminate\Support\Facades\Http;
use Throwable;

class AiService
{
    public function analyzeAndReply(string $comment, string $name): array
    {
        try {
            $apiKey = config('services.openrouter.key');

            if (!$apiKey) {
                return $this->fallback($comment, $name, false);
            }

            $response = Http::withHeaders([
                'Authorization' => "Bearer {$apiKey}",
                'Content-Type'  => 'application/json',
                'HTTP-Referer'  => 'http://localhost', // требуется OpenRouter
                'X-Title'       => 'Dev Landing AI',   // любое название проекта
            ])->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => 'groq/llama-3.1-8b-instant', // Groq через OpenRouter
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Ты помощник, который анализирует тональность комментария и пишет короткий, дружелюбный ответ.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $comment
                    ]
                ],
                'max_tokens' => 150,
                'temperature' => 0.7,
            ]);

            if (!$response->ok()) {
                return $this->fallback($comment, $name, false);
            }

            $reply = $response->json('choices.0.message.content') ?? '';
            $sentiment = $this->simpleSentiment($comment);

            return [
                'sentiment' => $sentiment,
                'reply'     => trim($reply),
                'ai_used'   => true,
            ];
        } catch (Throwable $e) {
            return $this->fallback($comment, $name, false);
        }
    }

    private function simpleSentiment(string $comment): string
    {
        $lower = mb_strtolower($comment);

        if (str_contains($lower, 'спасибо') || str_contains($lower, 'класс') || str_contains($lower, 'отлично')) {
            return 'positive';
        }

        if (str_contains($lower, 'плохо') || str_contains($lower, 'ужас') || str_contains($lower, 'недоволен')) {
            return 'negative';
        }

        return 'neutral';
    }

    private function fallback(string $comment, string $name, bool $aiUsed): array
    {
        return [
            'sentiment' => $this->simpleSentiment($comment),
            'reply'     => "Спасибо, $name! Мы получили ваше сообщение и свяжемся с вами в ближайшее время.",
            'ai_used'   => $aiUsed,
        ];
    }
}
