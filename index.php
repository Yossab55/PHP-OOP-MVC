<?php
session_start();

use app\models\User;
use Dotenv\Dotenv;

require_once "src/support/helpers.php";
require_once base_path() . "vendor/autoload.php";
require_once base_path() . "routes/web.php";

$dotenvFile = Dotenv::createImmutable(base_path());

$dotenvFile->load();

app()->run();