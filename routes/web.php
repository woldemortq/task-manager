<?php

use App\Http\Controllers\HomeController;

Route::get('/',  [HomeController::class, "index"])->name('index');


require __DIR__.'/users.php';
require __DIR__.'/comments.php';
require __DIR__.'/admin.php';
