<?php

namespace src\view;

class View 
{
  public static function make($view, $args = [])
  {
    $base_content = self::get_base_content();
    $view_content = self::get_view_content($view, args: $args);
    echo str_replace("{{content}}", $view_content, $base_content);
  }
  public static function make_error($error)
  {
    self::get_view_content($error, true);
  }
  protected static function get_base_content() 
  {
    //@ new information you can return include file
    // return include base_path(). "views/layouts/main.php";
    ob_start();
    // buffer the web page because we don't want to use a lot of memory yield
    include base_path() . "views/layouts/main.php";
    return ob_get_clean();
  }
  protected static function get_view_content($view, $isError = false, $args = [])
  {

    $path = $isError ? view_path() . "errors/" : view_path() ;
    if(str_contains($view, '.')) {
      $views = explode('.', $view);
      foreach($views as $view) {
        if(is_dir($path . $view)) {
          $path = $path . $view . "/";
        }
      }
      $view = $path . end($views) . ".php";
    } else {
      $view = $path . $view . ".php"; 

    }
    foreach($args as $param => $value) {
      $$param = $value;
    }

    if($isError) {
      include $view;
    } else {
      ob_start();
      include $view;
      return ob_get_clean();
    }
    return "";
  }
}