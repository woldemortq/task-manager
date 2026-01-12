<?php

//Главная страница с задачами
use App\Http\Controllers\TaskController;

Route::get('/tasks/index', [TaskController::class, 'index'])->name('tasks.index');

//Создание таски
Route::get('tasks/create', [TaskController::class, 'createTask'])->name('users.tasks.create');
Route::post('tasks/create', [TaskController::class, 'storeTask'])->name('users.tasks.store');
