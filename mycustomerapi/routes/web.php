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

$router->get('/customers', 'CustomersController@index');
$router->post('/customer', 'CustomersController@create');
$router->get('/customer/{id}', 'CustomersController@show');
$router->get('/customer/search', 'CustomersController@search');
$router->put('/customer/{id}', 'CustomersController@update');
$router->delete('/customer/{id}', 'CustomersController@destroy');
