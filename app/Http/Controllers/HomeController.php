<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Task;
use App\Models\User;
use App\Service\TelegramService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

}
