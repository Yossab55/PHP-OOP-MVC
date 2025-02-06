<?php
session_start();

use app\models\User;
use src\database\managers\MySQLManager;

require_once "src/support/helpers.php";
require_once base_path() . "vendor/autoload.php";
require_once base_path() . "routes/web.php";

app()->run();
