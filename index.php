<?php

use src\http\Request;
use src\http\Response;
use src\http\Route;

require_once "src/support/helpers.php";
require_once base_path() . "vendor/autoload.php";
require_once base_path() . "routes/web.php";

$route = new Route(new Response(), new Request() );

$route->resolve();
