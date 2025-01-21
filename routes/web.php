<?php

use app\controllers\HomeController;
use src\http\Route;

Route::get('/', [HomeController::class, "index"]);
