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

$router->get('/', function () {
    return app('view')->make('layouts.app');
});

$router->get('/version', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function(){
    return \Illuminate\Support\Str::random(32);
});

$router->get('/login', 'AuthController@showLoginForm');
$router->post('/login', 'AuthController@login');

$router->get('/register', 'AuthController@showRegisterForm');
$router->post('/register', 'AuthController@registerSave');

$router->get('/logout', 'AuthController@logout');

// Protected routes
$router->group(['middleware' => 'web'], function () use ($router) {
    $router->get('/users', 'UserController@index');
});

$router->post('/update-user/{id}', 'AuthController@updateUser');

$router->delete('/users/{id}', 'UserController@destroy');

$router->get('/table-data', 'UserController@getTableData');