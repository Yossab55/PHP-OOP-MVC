<?php

namespace src;
use src\http\{Route, Response, Request};
use src\support\Config;
use src\database\DB;
use src\database\managers\MySQLManager;

class Application 
{
  protected $route;
  protected $response;
  protected $request;
  public $config;
  protected $db;

  public function __construct()
  {
    $this->response = new Response();
    $this->request = new Request();
    $this->route = new Route($this->response, $this->request);
    $this->config = new Config($this->loadConfiguration());
    $this->db = new DB($this->getDatabaseManager());
  }
  protected function getDatabaseManager()
  {
    return match(env('DB_DRIVER')){
      'mysql' => new MySQLManager,
      default => new MySQLManager
    };
  }
  protected function loadConfiguration() {
    //see scandir

    foreach(scandir(config_path()) as $file) {
      if($file == '.' || $file == '..') continue;
      $filename = explode('.', $file)[0];
      yield $filename => require config_path() . $file;
    }
  }
  public function run() 
  {
    $this->db->init();
    return $this->route->resolve();
  }
  public function __get($name)
  {
    if(property_exists($this, $name)) {
      return $this->$name;
    }
  }
}