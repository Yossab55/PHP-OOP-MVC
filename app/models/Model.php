<?php

namespace app\models;

use src\support\Str;
class Model
{
  protected static $instance;

  public static function create(array $attributes)
  {
    static::setInstance();
    return app()->db->create($attributes);
  }

  public static function all()
  {
    static::setInstance();
    return app()->db->read();
  }

  public static function delete($id)
  {
    static::setInstance();
    return app()->db->delete($id);
  }

  public static function where($filter, $columns = '*')
  {
    static::setInstance();
    return app()->db->read($columns, $filter);
  }

  public static function getModelName()
  {
    static::setInstance();
    return self::$instance;
  }

  public static function getTableName()
  {
    static::setInstance();
    return Str::lower(Str::plural(class_base_name(self::$instance)));
  }

  protected static function setInstance()
  {
    if (!self::$instance) {
      self::$instance = get_called_class(); // Set to the child class
    }
  }
}
