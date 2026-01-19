<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TelegramAuthController extends Controller
{
    public function generate(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        // Генерируем уникальный код
        $code = Str::upper(Str::random(6));
        $user->telegram_auth_code = $code;
        $user->save();

        return response()->json(['code' => $code]);
    }

}

