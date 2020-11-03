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
$router->post('/mobile/approve-form-fume-hood', 'EmployeeController@approveFormFumeHood');
$router->get('/mobile/location-answer-fume-hood/{idForm}', 'EmployeeController@locationAnswerFumeHood');
$router->get('/mobile/location-answer/{idForm}', 'EmployeeController@locationAnswerH2s');
$router->get('/mobile/get-all-fume-hood', 'EmployeeController@getAllFumeHood');
$router->post('/mobile/save-edit-ins-fume-hood', 'EmployeeController@saveEditInsFumeHood');
$router->post('/mobile/create-draft-ins-fume-hood', 'EmployeeController@createDraftInsFumeHood');
$router->post('/mobile/approve-form-ladder', 'EmployeeController@approveLadder');
$router->get('/mobile/get-all-ladder', 'EmployeeController@getAllLadder');
$router->post('/mobile/edit-draft-ins-ladder', 'EmployeeController@saveEditInsLadder');
$router->post('/mobile/create-draft-ins-ladder', 'EmployeeController@createDraftLadder');
$router->get('/mobile/get-all-h2s', 'EmployeeController@getAllH2s');
$router->post('/mobile/approve-form-h2s', 'EmployeeController@approveFormH2s');
$router->post('/mobile/save-edit-ins-h2s', 'EmployeeController@saveEditInsH2s');
$router->post('/mobile/create-draft-ins-h2s', 'EmployeeController@createDraftInsH2s');
$router->post('/mobile/create-work-order', 'EmployeeController@createFormWorkOrder');
$router->post('/mobile/save-edit-draft-work-order', 'EmployeeController@saveEditDraft');
$router->post('/mobile/update-work-order/{idFormWOrder}', 'EmployeeController@updateFormWorkOrder');
$router->get('/mobile/get-profile-employee/{idEmployee}', 'EmployeeController@getProfileEmployee');
$router->get('/mobile/get-all-work-orders', 'EmployeeController@viewListWorkOrder');
$router->post('/mobile/update-profile-employee/{idEmployee}', 'EmployeeController@updateProfileEmployee');
$router->post('/mobile/approve-wo-spv-issuer', 'EmployeeController@approveWorkOrderSpvIssuer');
$router->post('/mobile/approve-wo-planner', 'EmployeeController@approveWorkOrderPlanner');
$router->post('/mobile/reject-wo-spv-issuer', 'EmployeeController@rejectWorkOrderSpvIssuer');
$router->post('/mobile/reject-wo-planner', 'EmployeeController@rejectWorkOrderPlanner');

///////////// home controller
$router->get('/mobile/get-data-department', 'HomeController@getDataDepartment');//akan tidak dipakai
$router->get('/mobile/get-departments', 'HomeController@getDepartements');
$router->get('/mobile/get-locations-by-department', 'HomeController@getLocationByDepartment');

$router->get('/mobile/get-all-employee', 'HomeController@viewAllEmployee');
$router->get('/mobile/get-all-location', 'HomeController@viewAllLocation');
$router->get('/mobile/get-employee-group', 'HomeController@viewAllEmployeeGroup');
$router->get('/mobile/get-employee-title', 'HomeController@viewAllEmployeeTitle');
$router->get('/mobile/get-scoring-work-order', 'HomeController@getScoringWorkOrder');
$router->get('/mobile/get-location-by-category', 'HomeController@getLocationByCategory');

