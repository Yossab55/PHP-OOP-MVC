<?php 

namespace src\validation\rules;

use src\validation\rules\contract\Rule;

class MaxRule implements Rule
{
  private int $max;

  public function __construct($max)
  {
    $this->max = $max;
  }
  public function apply($field, $value, $data)
  {
    return (strlen($value) < $this->max);
  }
  public function __toString()
  {
    return "%s length must me less than {$this->max}";
  }
}