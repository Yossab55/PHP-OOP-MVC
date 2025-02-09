<?php 

namespace src\http;

use ArrayAccess;
use src\support\ArrayWrapper;

class Request 
{
  public function method() 
  {
    return strtolower($_SERVER["REQUEST_METHOD"]);
  }
  public function path() 
  {
    $uri = $_SERVER['REQUEST_URI'];
    $parts = explode('/', $uri); 
    $path = "/" . end($parts); 
    return str_contains($path, "?") ? explode('?', $path)[0] : $path;
  }
  public function all() {
    return $_REQUEST;
  }
  public function get($key) {
    return ArrayWrapper::get($this->all(), $key);
  }
  public function only($key) {
    return ArrayWrapper::only($this->all(), $key);
  }
}