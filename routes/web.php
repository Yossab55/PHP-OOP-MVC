<?php

use app\controllers\HomeController;
use app\controllers\RegisterController;
use src\http\Route;

Route::get('/', [HomeController::class, "index"]);
Route::get('/signup', [RegisterController::class, 'index']);

Route::post('/signup', [RegisterController::class, 'store']);