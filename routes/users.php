<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'users'])->name('users.index');
Route::post('/login', [UserController::class, 'userLogin'])->name('users.login');
Route::get('/users/tasks/index', [TaskController::class, 'index'])->name('tasks.index');

//Создание таски
Route::get('/users/tasks/create', [TaskController::class, 'createTask'])->name('users.tasks.create');
Route::post('/users/tasks/create', [TaskController::class, 'storeTask'])->name('users.tasks.store');

Route::post('/telegram/generate-code', [UserController::class, 'generate'])
    ->name('telegram.generate');
