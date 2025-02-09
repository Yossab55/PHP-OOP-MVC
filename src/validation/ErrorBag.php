<?php
namespace src\validation;

class ErrorBag
{
  protected array $errors = [];
  
  public function add($key, $message) 
  {
    $this->errors[$key][] = $message;
  }
  public function __get($key)
  {
    if( property_exists($this, $key)) {
      return $this->$key;
    }
  }
}