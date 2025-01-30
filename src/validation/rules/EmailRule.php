<?php 

namespace src\validation\rules;

use src\validation\rules\contract\Rule;

class EmailRule implements Rule
{
  public function apply($field, $value, $data)
  {
    return filter_var($value, FILTER_VALIDATE_EMAIL);
  }
  public function __toString()
  {
    return "%s must be a valid email";
  }
}