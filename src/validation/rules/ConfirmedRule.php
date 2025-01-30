<?php 

namespace src\validation\rules;

use src\validation\rules\contract\Rule;

class ConfirmedRule implements Rule
{
  public function apply($field, $value, $data)
  {
    return ($value === $data[$field . "_confirmation"]);
  }
  public function __toString()
  {
    return "%s doesn't match %s confirmation";
  }
}