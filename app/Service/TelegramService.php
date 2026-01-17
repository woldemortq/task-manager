<?php
namespace App\Service;

use Illuminate\Support\Facades\Http;

class TelegramService
{
    public static function notify($chatId, string $message)
    {
        if (!$chatId) return;

        Http::post(
            'https://api.telegram.org/bot' . config('services.telegram.token') . '/sendMessage',
            [
                'chat_id' => $chatId,
                'text' => $message,
            ]
        );
    }
}

