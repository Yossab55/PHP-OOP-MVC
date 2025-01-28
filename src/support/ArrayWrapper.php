<?php

namespace src\support;

use ArrayAccess;

class ArrayWrapper 
{
    public static function exists($array, $key)
  {
    if($array instanceof ArrayAccess) {
      return $array->offsetExists($key);
    }

    return array_key_exists($key, $array);
  }
  public static function only($array, $key)
  {
    //array_intersect_key compare keys not values 
    // and the key in this situation is a value return will be null
    // but if you array_flip then the $key will be a $key in array and if 
    // exists in $array as key will return it
    return array_intersect_key($array, array_flip((array) $key)); //(array) if I sent a string
  }
  public static function accessible($value)
  {
    return is_array($value) || $value instanceof ArrayAccess;
  }
  public static function get($array, $key, $default = null)
  {
    if(! static::accessible($array)) {
      return value($default);
    }
    if(is_null($key)) {
      return $array;
    }
    if(static::exists($array, $key)) {
      return $array[$key];
    }
    if(! str_contains($key, ".")) {
      return $array[$key] ?? value($default);
    }
    
    foreach(explode(".", $key) as $part) {
      if(static::exists($array, $part) && static::accessible($array)) {
        $array = $array[$part];
      } else {
        return value($default);
      }
    }
    return $array;
  }

  public static function set(&$array, $key, $value) {
    if(is_null($key)) {
      return array_push($array, $value);
    }
    $parts = explode('.', $key);
    while(count($parts) > 1) {
      $part = array_shift($parts);
      $array = &$array[$part];
    }
    array_push($array[array_shift($parts)], $value);
    return $array;
  }
  public static function unset($array, $key) 
  {
    return static::set($array, $key, null);
  }
  public static function has($array, $keys)
  {
    if(is_null($keys)) return false;

    $keys = (array) $keys;

    if($keys == []) return false;

    foreach($keys as $key) {
      $subArray = $array;
      
      if(self::exists($array, $key)) continue;
      //Array: ["database"=> ["connection" => ["db" => "mySql"] ] ] 
      //keys: database.connection.db
      foreach(explode(".", $key) as $segment) {

        if(self::accessible($subArray) && self::exists($subArray, $segment)) {
          $subArray = $subArray[$segment];
        } else {
          return false;
        }
      }
    }
    return true;
  }

  public static function flatten($array, $depth = INF) 
  {
    $result = [];
    //@ depth are used for if user wants to flatten to a particular number like 1 or 2
    foreach($array as $item) {
      if(! is_array($item)) {
        $result[] = $item;
      } else if($depth == 1) {
        $result = array_merge($result , array_values($item));
      } else {
        $result = array_merge($result, static::flatten($item, $depth - 1));
      }
    }
    return $result;
  }
  public static function expect($array, $keys) {
    return static::forget($array, $keys);
  }

  public static function forget($array, array|string $keys)
  {
    $keys = (array) $keys;
    if(! count($keys)) return;
    foreach($keys as $key) {
      if(static::exists($array, $key)) {
        unset($key);
        continue;
      }
      $parts = explode(".", $key);
      while(count($parts) > 1) {
        $part = array_shift($parts);
        if(isset($array[$part]) && is_array($array[$part])) {
          $array = $array[$part]; 
        }
      }
      unset($array[array_shift($parts)]);
    }
  }
  public static function last($array, callable $call = null, $default = null )
  {
    if(is_null($call)) {
      return empty($array) ? value($default) : end($array);
    }
    return self::first(array_reverse($array, true), $call, $default);
  }
  public static function first($array, callable $call = null, $default = null )
  {
    if(is_null($call)) {
      if(empty($array)) return value($default);
      foreach($array as $item) return $item;
    }

    foreach($array as $key => $value) {
      if(call_user_func($call, $value, $key)) {
        return $value;
      }
    }
    return value($default);
  }

}