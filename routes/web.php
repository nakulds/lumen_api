<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['middleware' => 'auth','prefix' => 'api'], function ($router) 
{
    $router->get('todo-list', 'AuthController@todoList');
    $router->get('todo-list-by-category/{id}', 'AuthController@todoListByCategory');
    $router->get('todo-list-by-status/{status}', 'AuthController@todoListByStatus');

    // Todo cured
    $router->post('todo/','TodoController@store');
	$router->get('todo/', 'TodoController@index');
	$router->get('todo/{id}/', 'TodoController@show');
	$router->put('todo/{id}/', 'TodoController@update');
	$router->delete('todo/{id}/', 'TodoController@destroy');

	// Category cured
    $router->post('category/','CategoryController@store');
	$router->get('category/', 'CategoryController@index');
	$router->get('category/{id}/', 'CategoryController@show');
	$router->put('category/{id}/', 'CategoryController@update');
	$router->delete('category/{id}/', 'CategoryController@destroy');
});

$router->group(['prefix' => 'api'], function () use ($router) 
{
   $router->post('register', 'AuthController@register');
   $router->post('login', 'AuthController@login');
});