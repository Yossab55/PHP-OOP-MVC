<?php

namespace src\http;

class Response 
{
  public function setStatuesCode(int $code) 
  {
    http_response_code($code);
  }
  public function back()
  {
    header('Location:' . $_SERVER['HTTP_REFERER']);
  }
}