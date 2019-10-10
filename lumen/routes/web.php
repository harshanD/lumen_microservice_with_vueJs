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

$router->get('/test', function () use ($router) {
    return 'hello world';
});

$router->post('/product/create', 'ProductsController@create');
$router->post('/product/update', 'ProductsController@update');
$router->get('/product/view/{id}', 'ProductsController@view');
$router->get('/product/list', 'ProductsController@list');
$router->post('/product/delete', 'ProductsController@delete');
