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

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->group(['prefix'=>'api/v1'], function() use($router){
    // Products
    $router->get('/products', 'ProductController@index');
    $router->post('/products', 'ProductController@create');
    $router->get('/products/{id}', 'ProductController@show');
    $router->put('/products/{id}', 'ProductController@update');
    $router->delete('/products/{id}', 'ProductController@destroy');

    $router->get('/products/{id}/categories', 'ProductController@showCategories');

    // Categories
    $router->get('/categories', 'CategoryController@index');
    $router->post('/categories', 'CategoryController@create');
    $router->get('/categories/{id}', 'CategoryController@show');
    $router->put('/categories/{id}', 'CategoryController@update');
    $router->delete('/categories/{id}', 'CategoryController@destroy'); 
    
    $router->get('/categories/{id}/products', 'CategoryController@showProducts'); 
    
    // Customers
    $router->get('/customers', 'CustomerController@index');
    $router->post('/customers', 'CustomerController@create');
    $router->get('/customers/{id}', 'CustomerController@show');
    $router->put('/customers/{id}', 'CustomerController@update');
    $router->delete('/customers/{id}', 'CustomerController@destroy');

    // Orders
    $router->get('/orders', 'OrderController@index');
    $router->post('/orders', 'OrderController@create');
    $router->get('/orders/{id}', 'OrderController@show');
    $router->put('/orders/{id}', 'OrderController@update');
    $router->delete('/orders/{id}', 'OrderController@destroy');

    $router->get('/orders/{id}/products', 'OrderController@showProducts');
    $router->post('/orders/{id}/products', 'OrderController@createProducts');
    $router->delete('/orders/{id}/products', 'OrderController@destroyProducts');
});