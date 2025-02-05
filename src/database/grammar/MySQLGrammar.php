<?php

namespace src\database\grammar;

use app\models\Model;

class MySQLGrammar
{
  public static function buildInsertQuery($keys)
  {
    $columns = '(`' . implode('`, `', $keys) . '`)';
    $values = '';
    for($i = 0; $i < count($keys); $i++) {
      $values .= '?';
      if($i < count($keys) - 1) $values .= ', ';
    }
    $query = "INSERT INTO " . Model::getTableName() . ' ' . $columns . ' VALUES('. $values .')';

    return $query;
  }

  public static function buildSelectQuery($columns, $filter)
  {
    if(is_array($columns)) {
      $columns = implode(', ', $columns);
    }

    $query = "SELECT {$columns} from " . Model::getTableName();

    if($filter) {
      $query .= " WHERE {$filter[0]} {$filter[1]} ?";
    }

    return $query;
  }

  public static function buildUpdateQuery($columns, $filter) 
  {
    $columns = (array) $columns;
    $set = implode('=?, ',$columns) . '=?';
    
    $query = 
      "UPDATE " . Model::getTableName() . 
      " SET {$set} WHERE {$filter[0]} {$filter[1]} ?";

    return $query;
  }
  public static function buildDeleteQuery()
  {
    $query = 'DELETE FROM ' . Model::getTableName() . " WHERE ID =  ?";

    return $query;
  }
}
