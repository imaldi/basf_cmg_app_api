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

$router->group(['prefix' => 'mobile'], function () use ($router) {
    ////////////// auth - Employee
    $router->get('login-employee', 'AuthController@login');
    $router->post('update-password-employee', 'AuthController@updatePassword');


    /// employee controller
    /// work order
    $router->group(['prefix' => 'work-order'], function () use ($router) {
        $router->get('get-all', 'WorkOrderController@viewListWorkOrder');
        $router->post('save-edit-draft', 'WorkOrderController@saveEditDraft');
        $router->post('update/{idFormWOrder}', 'WorkOrderController@updateFormWorkOrder');
        $router->post('create', 'WorkOrderController@createFormWorkOrder');
        $router->post('approve-wo-spv-issuer', 'WorkOrderController@approveWorkOrderSpvIssuer');
        $router->post('approve-wo-planner', 'WorkOrderController@approveWorkOrderPlanner');
        $router->post('reject-wo-spv-issuer', 'WorkOrderController@rejectWorkOrderSpvIssuer');
        $router->post('reject-wo-planner', 'WorkOrderController@rejectWorkOrderPlanner');
    });

    ///// Others
    $router->post('create-response-work-order', 'EmployeeController@createFormsResponseWorkOrder');
    $router->post('approve-form-safety-harnest', 'EmployeeController@approveFormSafetyHarnest');
    $router->get('location-answer-safety-harnest/{idForm}', 'EmployeeController@locationAnswerSafetyHarnest');
    $router->post('save-edit-ins-safety-harnest', 'EmployeeController@saveEditDraftSafetyHarnest');
    $router->get('get-all-safety-harnest', 'EmployeeController@getAllSafetyHarnest');
    $router->post('create-draft-ins-safety-harnest', 'EmployeeController@createDraftInsSafetyHarnest');
    $router->post('approve-form-fume-hood', 'EmployeeController@approveFormFumeHood');
    $router->get('location-answer-fume-hood/{idForm}', 'EmployeeController@locationAnswerFumeHood');
    $router->get('location-answer/{idForm}', 'EmployeeController@locationAnswerH2s');
    $router->get('get-all-fume-hood', 'EmployeeController@getAllFumeHood');
    $router->post('save-edit-ins-fume-hood', 'EmployeeController@saveEditInsFumeHood');
    $router->post('create-draft-ins-fume-hood', 'EmployeeController@createDraftInsFumeHood');
    $router->post('approve-form-ladder', 'EmployeeController@approveLadder');
    $router->get('get-all-ladder', 'EmployeeController@getAllLadder');
    $router->post('edit-draft-ins-ladder', 'EmployeeController@saveEditInsLadder');
    $router->post('create-draft-ins-ladder', 'EmployeeController@createDraftLadder');
    $router->get('get-all-h2s', 'EmployeeController@getAllH2s');
    $router->post('approve-form-h2s', 'EmployeeController@approveFormH2s');
    $router->post('save-edit-ins-h2s', 'EmployeeController@saveEditInsH2s');
    $router->post('create-draft-ins-h2s', 'EmployeeController@createDraftInsH2s');
    $router->get('get-profile-employee/{idEmployee}', 'EmployeeController@getProfileEmployee');
    $router->post('update-profile-employee/{idEmployee}', 'EmployeeController@updateProfileEmployee');

    ///////////// home controller
    $router->get('get-data-department', 'HomeController@getDataDepartment');//akan tidak dipakai
    $router->get('get-departments', 'HomeController@getDepartements');
    $router->get('get-locations-by-department', 'HomeController@getLocationByDepartment');

    $router->get('get-all-employee', 'HomeController@viewAllEmployee');
    $router->get('get-all-location', 'HomeController@viewAllLocation');
    $router->get('get-employee-group', 'HomeController@viewAllEmployeeGroup');
    $router->get('get-employee-title', 'HomeController@viewAllEmployeeTitle');
    $router->get('get-scoring-work-order', 'HomeController@getScoringWorkOrder');
    $router->get('get-location-by-category', 'HomeController@getLocationByCategory');
});





