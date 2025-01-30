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
  'password' => 'required|confirmed',
  'password_confirmation' => 'required'
]);

$validator->make([
  'password' => 'abc',
  'password_confirmation' => 'abc'
]);

echo '<pre>';
var_dump($validator->errors());
echo '</pre>';;