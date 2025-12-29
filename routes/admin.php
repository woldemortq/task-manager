<?php


use App\Http\Controllers\UserController;

// Вход в админку
Route::get('/admin', [UserController::class, 'admin'])->name('users.admin');

// Пост запрос, передаем данные для входа в админку
Route::post('/admin', [UserController::class, 'adminLogin'])->name('users.admin.login');

//Ручка создания пользователя
Route::get('/admin/create', [UserController::class, 'createUsers'])->name('admin.create.users');

//Передаем данные созданного пользователя в бд
Route::post('/admin/create', [UserController::class, 'storeUsers'])->name('admin.store.users');
