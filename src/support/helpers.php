<?php

if(!function_exists('env')) {
  function env($key, $default = null)
  {
    return $_ENV[$key] ?? value($default);
  }
}
if(!function_exists('value')) 
{
  function value($value)
  {
    return ($value instanceof \Closure) ? $value() : $value;
  }
}
if(!function_exists('base_path')) {
  function base_path()
  {
    //* dirname return to base folder
    // __DIR__ return where you are now
    return dirname(__DIR__);
  }
}

