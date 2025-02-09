<?php

use http\support\Hash;
use src\Application;
use src\http\Request;
use src\http\Response;
use src\view\View;

if(!function_exists('env')) {
  function env($key, $default = null)
  {
    return $_ENV[$key] ?? value($default);
  }
}
if(!function_exists('app')) {
  function app()
  {
    //! static to hold the same object over the files
    static $instance = null;
    if(! $instance) {
      $instance = new Application;
    }
    return $instance;
  }
}
if(!function_exists('bcrypt')) {
  function bcrypt($password)
  {
    return Hash::password($password);
  }
}
if(!function_exists('class_base_name')) {
  function class_base_name($class) 
  {
    $class = is_object($class) ? get_class($class) : $class;

    return basename(str_replace('\\', '/', $class));
  }
}
if(!function_exists('value')) 
{
  function value($value)
  {
    return ($value instanceof \Closure) ? $value() : $value;
  }
}
if(!function_exists('config_path')) {
  function config_path()
  {
    return base_path() . "config/";
  }
}
if(!function_exists('config')) {
  function config($key = null, $default = null) {
    if(is_null($key)) {
      return app()->config;
    }
    if(is_array($key)) {
      app()->config->set($key);
    }
    return app()->config->get($key, $default);
  }
}
if(!function_exists('base_path')) {
  function base_path()
  {
    //* dirname return to base folder
    // __DIR__ return where you are now
    return dirname(__DIR__ ) . "/../";
  }
}
if(!function_exists('view_path')) {
  function view_path()
  {
    //* dirname return to base folder
    // __DIR__ return where you are now
    return base_path() . 'views/';
  }
}
if(! function_exists('view')) {
  function view($view, $args = []) {
    return View::make($view, $args);
  }
}

if(! function_exists('old')) {
  function old($key)
  {
    if(app()->session->hasFlash($key)) {
      return app()->session->getFlash($key);
    }
  }
}
if(! function_exists('request')) {
  function request($key = null)
  {
    $instance = new Request;
    if($key) {
      return $instance->get($key);
    }
    if(is_array($key)) {
      return $instance->only($key);
    }
    return $instance;
  }
}
if(! function_exists('back')) {
  function back()
  {
    return (new Response)->back();
  }
}
