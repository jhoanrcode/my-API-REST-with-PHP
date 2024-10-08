<?php

$routes = [
  '/'                  => 'HomeService@index',

  '/users'             => 'UserService@list',
  '/users/list/{id}'   => 'UserService@listById',
  '/users/create'      => 'UserService@create',
  '/users/login'       => 'UserService@login',
  '/users/update'      => 'UserService@update',
  '/users/remove/{id}' => 'UserService@remove',
  
];
