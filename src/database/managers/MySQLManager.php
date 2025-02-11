<?php

namespace src\database\managers;


use app\models\Model;
use src\database\grammar\MySQLGrammar;
use src\database\managers\contracts\DatabaseManager;

class MySQLManager implements DatabaseManager
{
  protected static $instance;

  public function connect(): \PDO
  {
    if(self::$instance == null) {
      self::$instance = new \PDO(
        env('DB_DRIVER')
        . ':host=' . env('DB_HOST') 
        . ';dbname=' . env('DB_DATABASE')
        . ';',
        env('DB_USERNAME'), env('DB_PASSWORD'));
    }
    return self::$instance;
  }
  
  public function query(string $query, $values = []) 
  {
    $statement = self::$instance->prepare($query);
    for($i = 1; $i <= count($values); $i++) {
      $statement->bindValue($i, $values[$i - 1]);
    }
    $statement->execute();

    return $statement->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function create($data)
  {
    $query = MySQLGrammar::buildInsertQuery(array_keys($data));
    $statement = self::$instance->prepare($query);
    for($i = 1; $i <= count($values = array_values($data)); $i++) {
      $statement->bindValue($i, $values[$i - 1]);
    }
    return $statement->execute();
  }
  
  public function read($columns = "*", $filter = null)
  {
    $query = MySQLGrammar::buildSelectQuery($columns, $filter);

    $statement = self::$instance->prepare($query);

    if($filter) {
      $statement->bindValue(1, $filter[2]);
    }

    $statement->execute();

    return $statement->fetchAll(\PDO::FETCH_CLASS, Model::getModelName());
  }

  public function update($id, $data)
  {
    $query = MySQLGrammar::buildUpdateQuery(array_keys($data), $id);
    $statement = self::$instance->prepare($query);
    for($i = 1; $i <= count($values = array_values($data)); $i++) {
      $statement->bindValue($i, $values[$i - 1]);
      if($i == count($values)) {
        $statement->bindValue($i + 1 , $id);
      }
    }
    return $statement->execute();
  }

  public function delete($id)
  {
    $query = MySQLGrammar::buildDeleteQuery();

    $statement = self::$instance->prepare($query);
    $statement->bindValue(1, $id);

    return $statement->execute();
  }
}