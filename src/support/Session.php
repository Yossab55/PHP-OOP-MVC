<?php

namespace src\support;

class Session
{
  public function __construct()
  {
    $flash_cards = $_SESSION['flash_messages'] ?? []; 

    foreach($flash_cards as $key => &$flash_card) {
      $flash_card['remove'] = true;

    }
    $_SERVER['flash_messages'] = $flash_cards;
  }
  public function set($key, $value)
  {
    $_SESSION[$key] = $value;
  }
  
  public function get($key)
  {
    return $_SESSION[$key] ?? false;
  }

  public function has($key)
  {
    return (isset($_SESSION[$key]));
  }
  public function remove($key) 
  {
    if($this->has($key)) {
      unset($_SESSION[$key]);
    }
  }

  public function setFlash($key, $message) 
  {
    $_SESSION['flash_messages'][$key] = [
      'remove' => false,
      'content' => $message
    ];
  }
  public function hasFlash($key)
  {
    return isset($_SESSION['flash_messages'][$key]);
  }
  public function getFlash($key)
  {
    return $_SESSION['flash_messages'][$key]['content'] ?? false;
  }
  public function __destruct()
  {
    $this->removeFlash();
  }
  public function removeFlash()
  {
    $flash_cards = $_SESSION['flash_messages'] ?? []; 

    foreach($flash_cards as $key => $flash_card) {

      if($flash_card['remove']) {
        unset($flash_cards[$key]);
      }
    }
    $_SERVER['flash_messages'] = $flash_cards;
  }
}