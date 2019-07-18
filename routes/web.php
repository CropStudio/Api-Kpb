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

$router->group([
//    'middleware' => 'auth',
    'prefix' => 'api'
], function () use ($router) {
    //USER
    $router->get('/user/profile', 'UsersController@profile');
    $router->get('/user/{id}', 'UsersController@show');
    $router->put('/user/massdelete', 'UsersController@massdelete');
    $router->get('/user', 'UsersController@index');
    $router->delete('/user/{id}', 'UsersController@delete');
    $router->put('/user/{id}', 'UsersController@update');
    $router->post('/user', 'UsersController@insert');
    //PETANI
    $router->get('/petani/{id}', 'PetaniController@show');
    $router->put('/petani/massdelete', 'PetaniController@massdelete');
    $router->get('/petani', 'PetaniController@index');
    $router->delete('/petani/{id}', 'PetaniController@delete');
    $router->put('/petani/{id}', 'PetaniController@update');
    $router->post('/petani', 'PetaniController@insert');
});
