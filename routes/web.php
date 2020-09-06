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
$router->get('/mobile/login-employee', 'AuthController@login');
$router->post('/mobile/update-password-employee', 'AuthController@updatePassword');

///////////// employee controller
$router->post('/mobile/create-work-order', 'EmployeeController@createFormWorkOrder');
$router->post('/mobile/save-edit-draft-work-order', 'EmployeeController@saveEditDraft');
$router->post('/mobile/update-work-order/{idFormWOrder}', 'EmployeeController@updateFormWorkOrder');
$router->get('/mobile/get-profile-employee/{idEmployee}', 'EmployeeController@getProfileEmployee');
$router->get('/mobile/get-all-work-orders', 'EmployeeController@viewListWorkOrder');
$router->post('/mobile/update-profile-employee/{idEmployee}', 'EmployeeController@updateProfileEmployee');

///////////// home controller
$router->get('/mobile/get-data-department', 'HomeController@getDataDepartment');
$router->get('/mobile/get-all-employee', 'HomeController@viewAllEmployee');
$router->get('/mobile/get-all-location', 'HomeController@viewAllLocation');
$router->get('/mobile/get-employee-group', 'HomeController@viewAllEmployeeGroup');
$router->get('/mobile/get-employee-title', 'HomeController@viewAllEmployeeTitle');
$router->get('/mobile/get-scoring-work-order', 'HomeController@getScoringWorkOrder');

