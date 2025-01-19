<?php 

namespace src\http;
class Request 
{
  public function method() 
  {
    return strtolower($_SERVER["REQUEST_METHOD"]);
  }
  public function getPath() 
  {
    $path = $_SERVER['REQUEST_URI'][0] ?? '/';
    return str_contains($path, "?") ? explode('?', $path)[0] : $path;
  }
}