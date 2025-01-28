<?php

use src\support\ArrayWrapper;

require_once "src/support/helpers.php";
require_once base_path() . "vendor/autoload.php";
require_once base_path() . "routes/web.php";

app()->run();
