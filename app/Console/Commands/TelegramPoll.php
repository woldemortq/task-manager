<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class TelegramPoll extends Command
{
    protected $signature = 'telegram:poll';
    protected $description = 'Telegram bot polling';

    private int $offset = 0;

    public function handle()
    {
        $this->info('Telegram polling started');

        while (true) {



            $response = Http::timeout(35) // ⬅️ ВАЖНО
            ->get(
                'https://api.telegram.org/bot' . config('services.telegram.token') . '/getUpdates',
                [
                    'offset' => $this->offset,
                    'limit' => 1,
                ]
            )
                ->json();
            Log::info('TG RESPONSE', $response);
            if (!($response['ok'] ?? false)) {
                sleep(1);
                continue;
            }

            foreach ($response['result'] as $update) {
                $this->offset = $update['update_id'] + 1;
                $this->handleUpdate($update);
            }

            usleep(300000);
        }
    }


    private function handleUpdate(array $update)
    {
        if (!isset($update['message']['text'])) {
            return;
        }

        $chatId = $update['message']['chat']['id'];
        $username = $update['message']['chat']['username'] ?? null;
        $text = trim($update['message']['text']);

        Log::info('TG POLLING', $update);

        if (str_starts_with($text, '/start')) {
            $parts = explode(' ', $text);

            if (!isset($parts[1])) {
                $this->send($chatId, "Введите код привязки:\n/start ABC123");
                return;
            }

            $code = $parts[1];

            $user = User::where('telegram_auth_code', $code)->first();

            if (!$user) {
                $this->send($chatId, "❌ Неверный код");
                return;
            }

            $user->update([
                'telegram_chat_id' => $chatId,
                'telegram_username' => $username,
                'telegram_auth_code' => null,
            ]);

            $this->send($chatId, "✅ Telegram успешно привязан");
        }
    }

    private function send($chatId, $text)
    {
        Http::post(
            'https://api.telegram.org/bot' . config('services.telegram.token') . '/sendMessage',
            [
                'chat_id' => $chatId,
                'text' => $text,
            ]
        );
    }
}
