<?php 

namespace src\validation\rules;

use src\validation\rules\contract\Rule;

class AlphaNumerical implements Rule
{
  public function apply($field, $value, $data)
  {
    return preg_match("/^[a-zA-z0-9]+/", $value);
  }
  public function __toString()
  {
    return "%s must be characters and numbers only";
  }
}