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
    $router->post('/registrasipetani', 'UsersController@registerPetani');
    $router->post('/loginpetani', 'UsersController@loginPetani');
    $router->post('/potopropil/{id}', 'UsersController@uploadPotopropil');
    //PETANI
    $router->get('/petani/{id}', 'PetaniController@show');
    $router->put('/petani/massdelete', 'PetaniController@massdelete');
    $router->get('/petani', 'PetaniController@index');
    $router->delete('/petani/{id}', 'PetaniController@delete');
    $router->put('/petani/{id}', 'PetaniController@update');
    $router->post('/petani', 'PetaniController@insert');
    //JATAH
    $router->get('/jatah/{id}', 'JatahController@show');
    $router->put('/jatah/massdelete', 'JatahController@massdelete');
    $router->get('/jatah', 'JatahController@index');
    $router->delete('/jatah/{id}', 'JatahController@delete');
    $router->put('/jatah/{id}', 'JatahController@update');
    $router->post('/jatah', 'JatahController@insert');
    //POKTAN
    $router->get('/poktan/{id}', 'PoktanController@show');
    $router->put('/poktan/massdelete', 'PoktanController@massdelete');
    $router->get('/poktan', 'PoktanController@index');
    $router->delete('/poktan/{id}', 'PoktanController@delete');
    $router->put('/poktan/{id}', 'PoktanController@update');
    $router->post('/poktan', 'PoktanController@insert');
    $router->put('/poktans/upload', 'PoktanController@upload');
    //ANAK
    $router->get('/anak/{id}', 'AnakController@show');
    $router->put('/anak/massdelete', 'AnakController@massdelete');
    $router->get('/anak', 'AnakController@index');
    $router->delete('/anak/{id}', 'AnakController@delete');
    $router->put('/anak/{id}', 'AnakController@update');
    $router->post('/anak', 'AnakController@insert');
    $router->get('/cekanak/{id}', 'AnakController@cekAnak');
    //PUPUK
    $router->get('/pupuk/{id}', 'PupukController@show');
    $router->put('/pupuk/massdelete', 'PupukController@massdelete');
    $router->get('/pupuk', 'PupukController@index');
    $router->delete('/pupuk/{id}', 'PupukController@delete');
    $router->put('/pupuk/{id}', 'PupukController@update');
    $router->post('/pupuk', 'PupukController@insert');
});
