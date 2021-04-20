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
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\MEmployeeGroup;
use App\Models\EmployeeUserPermissions;

$router->get('/', function () use ($router) {
    Role::create(['name' => 'writer']);
    // $group = MEmployeeGroup::create(['name' => 'test spatie']);
    // $permissions = EmployeeUserPermissions::create(['name' => 'test spatie']);
    // Permission::create(['name' => 'edit articles']);
    $role = MEmployeeGroup::find(7);
    $permission = EmployeeUserPermissions::find(21);
    // $permissions = EmployeeUserPermissions::all();
    $role->givePermissionTo($permission);
    return $router->app->version();
    // return response(['permissions' => $permissions],200);
});


$router->post('login', 'AuthController@login');
$router->get('failMiddleware/{middlewareName}', 'AuthController@failPermission');


$router->group(['prefix' => 'api','middleware' => ['json.response']], function () use ($router) {
    ////////////// auth - Employee
    //  Tes assign permission ke role
    $router->get('assignPermissionToRole',function() use ($router) {
        $role = MEmployeeGroup::find(7);
        $permission = EmployeeUserPermissions::find(21);
        // $permissions = EmployeeUserPermissions::all();
        $role->givePermissionTo($permission);
        return $router->app->version();
    });

    // Matches "/api/register
    // $router->post('register', 'AuthController@register');

      // Matches "/api/login
    $router->post('register', 'AuthController@register');
    //// Test jwt
     // Matches "/api/profile
    $router->get('profile', 'WorkOrderController@profile');

    // Matches "/api/user 
    //get one user by id
    $router->get('users/{id}', 'WorkOrderController@singleUser');

    // Matches "/api/users
    $router->get('users', 'WorkOrderController@allUsers');
    // $router->post('login-employee', 'AuthController@login');
    // $router->post('update-password-employee', 'AuthController@updatePassword');


    /// employee controller
    /// work order
    //TODO buat provider untuk menyediakan group/permission yang diperlukan untuk middleware
    $router->group(['prefix' => 'work-order'], function () use ($router) {
        $router->get('get-all',
        [
            // 'middleware' => 'permission:"view work order"',
            // 'middleware' => 'group:1,2,3,4',
        'uses' => 'WorkOrderController@viewListWorkOrder']);
        // $router->get('get-all[/{groupId}]',  [
        //     'middleware' => 'group:1,2,3,4',
        //     'as'   => 'get-all',
        //     'uses' => 'WorkOrderController@viewListWorkOrder'
        // ]);
        // 'WorkOrderController@viewListWorkOrder')->middleware('group:1,2,3,4');
        
        // $router->get('get-all/{groupId}', 
        // [
        //     'middleware' => 'group:1,2,3,4',
        // 'uses' => 'WorkOrderController@viewListWorkOrderByGroupId']);

        // 'WorkOrderController@viewListWorkOrderByGroupId')->middleware('group');
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

    $router->get('assign-group-to-user','TestGroupsAndPermissionsController@testAssignGroupToUser');

});

$router->group(['prefix' => 'api'],function() use ($router){
    $router->get('get-all-permission','TestGroupsAndPermissionsController@getAllPermissions');
    $router->get('create-group/{groupArg}','TestGroupsAndPermissionsController@testCreateAGroup');
    $router->get('create-permission/{permissionArg}','TestGroupsAndPermissionsController@testCreateAPermission');
    $router->get('assign-permission-to-group','TestGroupsAndPermissionsController@testAssignPermissionToGroup');
    // $router->get('assign-group-to-user','TestGroupsAndPermissionsController@testAssignGroupToUser');
    $router->get('is-user-has-groups','TestGroupsAndPermissionsController@isUserHasGroup');
    $router->get('get-group','TestGroupsAndPermissionsController@testDapatkanGroupUserDenganForEach');
    
});




