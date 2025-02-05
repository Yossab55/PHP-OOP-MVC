<?php

namespace app\models;

use src\support\Str;

abstract class Model
{
  protected static $instance;

  public static function create(array $attributes)
  {
    self::$instance = static::$instance;

    return app()->db->create($attributes);
  }

  public static function all()
  {
    self::$instance = static::$instance;

    return app()->db->read();
  }
  public static function delete($id)
  {
    self::$instance = static::$instance;

    return app()->db->delete($id);
  }

  public static function where($filter, $columns = '*')
  {
    self::$instance = static::$instance;

    return app()->db->read($columns, $filter);
  }

  public static function getModelName()
  {
    return self::$instance;
  }

  public static function getTableName()
  {
    return Str::lower(Str::plural(class_base_name(self::$instance)));
  }
}