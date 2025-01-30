<?php

namespace src\validation;
use src\validation\rules\contract\Rule;

trait RulesResolver
{
  public static function makeRules($rules)
  {
    if(is_string($rules)) {
      $rules = str_contains($rules, '|') ? explode('|', $rules) : [$rules];
    }
    return array_map(function (string | array $rule) {
      if(is_string($rule)) {
        return static::getRuleFromString($rule);
      }
      return $rule;
    }, $rules);
  }
  
  public static function getRuleFromString($rule) 
  {
    $exploded = explode(':', $rule);
    $rule = $exploded[0];
    $options = explode(',',end($exploded));
    // yes PHP handel the options -properties- by this way
    return RuleMap::resolve($rule, $options);
  }


}