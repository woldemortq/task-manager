<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Вход в админку
Route::get('/admin', [UserController::class, 'admin'])->name('users.admin');

// Пост запрос, передаем данные для входа в админку
Route::post('/admin', [UserController::class, 'adminLogin'])->name('users.admin.login');

//Ручка создания пользователя
Route::get('/admin/create', [UserController::class, 'createUsers'])->name('admin.create.users');

//Передаем данные созданного пользователя в бд
Route::post('/admin/create', [UserController::class, 'storeUsers'])->name('admin.store.users');

Route::get('/admins', [UserController::class, 'index'])->name('admin.index');
