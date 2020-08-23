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

////////////// auth - Employee
$router->post('/mobile/login-employee', 'AuthController@login');
$router->put('/mobile/update-password-employee', 'AuthController@updatePassword');

///////////// employee controller
$router->post('/mobile/create-work-order', 'EmployeeController@createFormWorkOrder');
$router->put('/mobile/update-work-order', 'EmployeeController@updateFormWorkOrder');



