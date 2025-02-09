<?php

namespace src\validation\rules;

use src\validation\rules\contract\Rule;

class UniqueRule implements Rule
{
  protected $table;
  protected $column;
  public function __construct($table, $column)
  {
    $this->table = $table;
    $this->column = $column;
  }
  public function apply($field, $value, $data)
  {
    return !(app()->db->row(
      "SELECT * FROM {$this->table} WHERE {$this->column} = ?", [$value]
    ));
  }
  public function __toString()
  {
    return "your %s is already exist";
  }
}