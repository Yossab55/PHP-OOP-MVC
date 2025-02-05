<?php

namespace src\database\concerns;

use src\database\managers\contracts\DatabaseManager;

trait ConnectTo
{
  public static function connect(DatabaseManager $manager)
  {
    return $manager->connect();
  }
}