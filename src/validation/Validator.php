<?php

namespace src\validation;

use src\validation\rules\contract\Rule;

class Validator
{
  protected array $data = [];
  protected array $aliases = [];
  protected array $entity_rules = [];
  protected ErrorBag $errorBag;  

  public function make($data) 
  {
    $this->data = $data;
    $this->errorBag = new ErrorBag();
    $this->validate();
  }

  protected function validate()
  {
    foreach($this->entity_rules as $field => $rules) {
      foreach(RulesResolver::makeRules($rules) as $rule) {
        $this->applyRule($field, $rule);
      }
    }
  }


  protected function applyRule($field, Rule $rule)
  {
    if(!$rule->apply($field, $this->getFieldValue($field), $this->data)){
      $this->errorBag->add($field, Message::generate($rule,$this->alias($field)));
    }
  }
  public function getFieldValue($filed)
  {
    return $this->data[$filed] ?? null;
  }

  public function setRules($rules) 
  {
    $this->entity_rules = $rules;
  }

  public function passes()
  {
    return empty($this->errors());
  }
  
  public function errors($key = null)
  {
    return $key ? $this->errorBag->errors[$key] : $this->errorBag->errors;
  }
  
  public function alias($field)
  {
    return $this->aliases[$field] ?? $field;
  }
  
  public function setAliases($aliases)
  {
    $this->aliases = $aliases;
  }
}