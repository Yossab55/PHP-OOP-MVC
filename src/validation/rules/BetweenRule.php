<?php 

namespace src\validation\rules;

use src\validation\rules\contract\Rule;

class BetweenRule implements Rule
{
  private int $start;
  private int $end;
  
  public function __construct($start, $end)
  {
    $this->start = $start;
    $this->end = $end;
  }
  public function apply($field, $value, $data)
  {
    return (strlen($value) > $this->start && strlen($value) < $this->end);
  }
  public function __toString()
  {
    return "%s length must me greater than {$this->start} & less than {$this->end}";
  }
}