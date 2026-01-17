<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'users'])->name('users.index');
//});
    Route::post('/login', [UserController::class, 'userLogin'])->name('users.login');

