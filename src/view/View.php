<?php

namespace src\view;

class View 
{
  public static function make($view, $args = [])
  {
    $base_content = self::get_base_content();
    $view_content = self::get_view_content($view, $args);
  }
  public static function get_base_content() 
  {

  }
  public static function get_view_content($view, $args)
  {
    
  }
}