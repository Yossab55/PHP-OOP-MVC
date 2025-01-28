<?php

namespace http\support;

class Hash 
{
  public static function password($value) 
  {
    return password_hash($value, PASSWORD_BCRYPT);
  }
  public static function make($value)
  {
    //to make random passwords 
    return sha1($value . time());
  }
  public static function verify($value, $hashed)
  {
    return password_verify($value, $hashed);
  }
}