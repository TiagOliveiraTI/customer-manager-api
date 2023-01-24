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

$router->post('/customers', 'CreateCustomerController@handle');
$router->get('/customers', 'ListAllCustomersController@handle');
$router->get('/customers/{document}', 'ListCustomerByDocument@handle');
$router->put('/customers/{uuid}', 'UpdateCustomerController@handle');
$router->delete('/customers/{uuid}', 'DeleteACustomerController@handle');
