<?php

namespace src\validation;
use src\validation\rules\{AlphaNumerical, BetweenRule, ConfirmedRule, EmailRule, MaxRule, RequireRule};

trait RuleMap 
{
  protected static array $rules_map = [
    'required' =>  RequireRule::class,
    'alnum' =>  AlphaNumerical::class,
    'max' => MaxRule::class,
    'between' => BetweenRule::class,
    'email' => EmailRule::class,
    'confirmed' => ConfirmedRule::class
  ];
  public static function resolve(string $rule, $options) {
    return  new static::$rules_map[$rule](...$options);
  }
}