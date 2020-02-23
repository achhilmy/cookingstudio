<?php

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
$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');
$router->get('user/{id}', 'UserController@show');


$router->get('/receipe', 'ReceipeController@index');
$router->get('/receipe/{id}','ReceipeController@show');
$router->post('/receipe','ReceipeController@store');
$router->put('/receipe/{id}', 'ReceipeController@update');
$router->delete('/receipe/{id}', 'ReceipeController@destroy');
