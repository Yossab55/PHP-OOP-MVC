<?php

namespace src\http;
use src\view\View;
class Route 
{
  public Response $response;
  public Request $request;
  // route place to get code 
  // action what to do in this place
  protected static array $route_map = [];
  public function __construct(Response $response, Request $request)
  {
    $this->response = $response;
    $this->request = $request;
  }
  public function resolve()
  {

    $path = $this->request->path();
    $method = $this->request->method();
    $action = self::$route_map[$method][$path] ?? false;

    if(!array_key_exists($path, self::$route_map[$method])) {
      return View::make_error(404);
    }
    if(!$action) {
      return;
    } 

    if(is_callable($action)) {
      call_user_func_array($action, []/**array pass arguments */);
    } 
    if(is_array($action)) {
      // [name of class, action];
      $controller = new $action[0]; // why need new key word because call_user_func_array 
      $method = $action[1];
      //* call the function as a static member not instance member in the class
      call_user_func_array([$controller, $method], []);
      // and this means get the object controller and invoke the action 1 
    }
  }
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