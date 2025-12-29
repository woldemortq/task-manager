<?php


use App\Http\Controllers\UserController;

// Вход в панель задач
Route::get('/users', [UserController::class, 'users'])->name('users.index');

// Пост запрос, передаем данные для входа в панель управления
Route::post('/login', [UserController::class, 'userLogin'])->name('users.login');


