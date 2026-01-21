<?php

namespace App\Console\Commands;

use App\Enums\Status;
use App\Models\Task;
use Illuminate\Console\Command;
use Telegram\Bot\Api;
use App\Models\User;

class TelegramPoll extends Command
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
                        $text = trim($update->getMessage()->getText());

                        // /start
                        if ($text === '/start') {
                            $telegram->sendMessage([
                                'chat_id' => $chat_id,
                                'text' => <<<TEXT
Привет 👋

Я присылаю уведомления о заявках.

⚠️ Чтобы начать:
1️⃣ Авторизуйся на сайте http://89.104.65.138/
2️⃣ Нажми «Подключить Telegram»
3️⃣ Отправь мне сгенерированный код
💬 Чтобы отобразить все свои задачи напиши мне /show
TEXT

                            ]);
                            continue;
                        }

                        if ($text === '/show') {
                            $user = User::where('telegram_chat_id', $chat_id)->first();
                            $tasks = Task::where('creator_id', $user->id)->get();

                            if ($tasks->isEmpty()) {
                                $telegram->sendMessage([
                                    'chat_id' => $chat_id,
                                    'text' => "У вас нет задач"
                                ]);
                                continue;
                            }

                            $message = "🔥Ваши задачи:\n\n";

                            foreach ($tasks as $task) {
                                $status = Status::from($task->status)->label();
                                $message .= "❕Название: {$task->title}\nСтатус:- {$status}\n\n";
                            }

                            $telegram->sendMessage([
                                'chat_id' => $chat_id,
                                'text' => $message
                            ]);

                            continue;
                        }


                            $existingUser = User::where('telegram_chat_id', $chat_id)->first();
                        if ($existingUser) {
                            $telegram->sendMessage([
                                'chat_id' => $chat_id,
                                'text' => "✅ Вы уже авторизованы"
                            ]);
                            continue;
                        }

                        // Проверяем код
                        $user = User::where('telegram_auth_code', $text)->first();

                        if ($user) {
                            $user->telegram_chat_id = $chat_id;
                            $user->telegram_username = $update->getMessage()->getFrom()->getUsername();
                            $user->telegram_auth_code = null;
                            $user->save();

                            $telegram->sendMessage([
                                'chat_id' => $chat_id,
                                'text' => '✅ Авторизация прошла успешно!'
                            ]);
                        } else {
                            $telegram->sendMessage([
                                'chat_id' => $chat_id,
                                'text' => '❌ Код не найден. Проверьте правильность ввода.'
                            ]);
                        }
                    }

                }
            } catch (\Exception $e) {
                $this->error($e->getMessage());
                sleep(5);
            }
        }
    }
}
