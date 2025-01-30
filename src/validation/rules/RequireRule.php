<?php

namespace src\validation\rules;

use src\validation\rules\contract\Rule;

class RequireRule implements Rule
{
  public function apply($field, $value, $data)
  {
    return !empty($value);
  }
  public function __toString()
  {
    return "%s is required and cannot be empty";
  }
}