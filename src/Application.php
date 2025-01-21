<?php

namespace src;
use src\http\{Route, Response, Request};
class Application 
{
  protected $route;
  protected $response;
  protected $request;

  public function __construct()
  {
    $this->response = new Response();
    $this->request = new Request();
  $this->route = new Route($this->response, $this->request);
  }
  public function run() 
  {
    return $this->route->resolve();
  }
  public function __get($name)
  {
    if(property_exists($this, $name)) {
      return $this->$name;
    }
  }
}