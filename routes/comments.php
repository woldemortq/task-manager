<?php

use App\Http\Controllers\CommentsController;

//Отображение всех комментариев
Route::get('/tasks/{task}/comments', [CommentsController::class, 'index'])->name('users.comments');
Route::get('tasks/{task}/comments/create', [CommentsController::class, 'createComment'])->name('comments.create');
Route::post('tasks/{task}/comments', [CommentsController::class, 'storeComment'])->name('comments.store');

