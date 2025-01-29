<?php

use src\support\ArrayWrapper;
use src\validation\rules\RequireRule;
use src\validation\Validator;

require_once "src/support/helpers.php";
require_once base_path() . "vendor/autoload.php";
require_once base_path() . "routes/web.php";

app()->run();

$validator = new Validator();

$validator->setRules([
  'username' => ['required', 'between:5, 10'
]]);

$validator->make([
  'username' => 'yossabbbbbbbbb',
]);

echo '<pre>';
var_dump($validator->errors());
echo '</pre>';;