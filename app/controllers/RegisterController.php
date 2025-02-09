<?php

namespace app\controllers;

use app\models\User;
use src\validation\Validator;

class RegisterController
{
  public function index() 
  {
    return view('auth.register');
  }
  public function store()
  {
    $v = new Validator;
    $v->setRules([
      'name' => 'required|alnum|between:8,32',
      'username' => 'required|alnum|between:8,32|unique:users,username',
      'email' => 'required|email|between:8,32|unique:users,email',
      'password' => 'required|between:8,32|alnum|confirmed',
      'password_confirmation' => 'required'
    ]);
    $v->setAliases([
      'password_confirmation' => 'password confirmation'
    ]);

    $v->make(request()->all());

    if(! $v->passes()) {
      app()->session->setFlash('errors', $v->errors());
      app()->session->setFlash('old', request()->all());

      return back();
    }

    User::create([
      'username' => request('username'),
      'name' => request('name'),
      'email' => request('email'),
      'password' => request('password'),
    ]);

    app()->session->setFlash('success', 'Register Succeeded');

    return back();
  }
}