<?php

namespace src\database;

use src\database\managers\contracts\DatabaseManager;
use src\database\concerns\ConnectTo;
class DB
{
  protected DatabaseManager $manager;

  public function __construct(DatabaseManager $manager)
  {
    $this->manager = $manager;
  }

  public function init()
  {
    return ConnectTo::connect($this->manager);
  }

  public function row($query, $values = [])
  {
    return $this->manager->query($query, $values);
  }

  public function create(array $data)
  {
    return $this->manager->create($data);
  }

  public function read($columns = "*", $filter = null)
  {
    return $this->manager->read($columns, $filter);
  }

  public function update($id, $data)
  {
    return $this->manager->update($id, $data);
  }

  public function delete($id)
  {
    return $this->manager->delete($id);
  }
  public function __call($name, $args)
  {
    if(method_exists($this, $name)) {
      call_user_func_array([$this, $name], $args);
    }
  }
}