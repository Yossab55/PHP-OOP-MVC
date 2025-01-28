<?php

use src\Application;
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

