<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Api;
use App\Models\User;

class TelegramBotPoll extends Command
{
    protected $signature = 'telegram:poll';
    protected $description = 'Запуск бота через polling';

    public function handle()
    {
        $this->info('Бот запущен через polling...');

        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
        $offset = 0;

        while (true) {
            try {
                $updates = $telegram->getUpdates([
                    'offset' => $offset,
                    'timeout' => 30,
                ]);

                foreach ($updates as $update) {
                    $offset = $update->getUpdateId() + 1;

                    if ($update->getMessage() && $update->getMessage()->getText()) {
                        $chat_id = $update->getMessage()->getChat()->getId();
                        $code = $update->getMessage()->getText();

                        // Проверяем код в базе
                        $user = User::where('telegram_auth_code', $code)->first();

                        if ($user) {
                            $user->telegram_chat_id = $chat_id;
                            $user->telegram_username = $update->getMessage()->getFrom()->getUsername();
                            $user->telegram_auth_code = null; // очищаем код
                            $user->save();

                            $telegram->sendMessage([
                                'chat_id' => $chat_id,
                                'text' => 'Авторизация прошла успешно!'
                            ]);
                        } else {
                            $telegram->sendMessage([
                                'chat_id' => $chat_id,
                                'text' => 'Код не найден. Проверьте правильность ввода.'
                            ]);
                        }
                    }
                }
            } catch (\Exception $e) {
                $this->error($e->getMessage());
                sleep(5); // ждем перед следующей попыткой
            }
        }
    }
}
