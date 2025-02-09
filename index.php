<?php
session_start();

use app\controllers\RegisterController;
use Dotenv\Dotenv;
use src\http\Request;

require_once "src/support/helpers.php";
require_once base_path() . "vendor/autoload.php";
require_once base_path() . "routes/web.php";

$dotenvFile = Dotenv::createImmutable(base_path());

$dotenvFile->load();

app()->run();
var_dump( app()->db->row("SELECT DATABASE()"));

