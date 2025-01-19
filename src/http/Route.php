<?php

namespace src\http;

class Route 
{
  // route place to get code 
  // action what to do in this place
  public static array $route_map = [];

  // get here means get Method the url get method
  public static function get($route, callable|array $action) 
  {
    self::$route_map['get'][$route] = $action;
  }
  public static function post($route, callable|array $action) 
  {
    self::$route_map['post'][$route] = $action;
  }
}