<?php

use App\Http\Controllers\CommentsController;

//Отображение всех комментариев
Route::get('tasks/comments', [CommentsController::class, 'index'])->name('users.comments');
