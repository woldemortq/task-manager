<?php
namespace App\Http\Controllers;


use Illuminate\Support\Str;

class TelegramAuthController extends Controller
{
    public function generate()
    {
        $user = auth()->user();


        $code = strtoupper(Str::random(6));

        $user->update([
            'telegram_auth_code' => $code,
        ]);



        return response()->json([
            'url' => "https://t.me/task_trackerManager_bot?start={$code}",
        ]);
    }
}

