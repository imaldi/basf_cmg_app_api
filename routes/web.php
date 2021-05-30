<?php


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\MEmployeeGroup;
use App\Models\EmployeeUserPermissions;
// use Config;


$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('failMiddleware/{middlewareName}', 'AuthController@failMiddleware');



$router->post('login', 'AuthController@login');



$router->group(['prefix' => 'api','middleware' => ['json.response']], function () use ($router) {
    $router->post('register', 'AuthController@register');
    //// Test jwt
     // Matches "/api/profile
    $router->get('profile', 'WorkOrderController@profile');
    $router->get('get-all-pic', 'WorkOrderController@getAllPic');
    $router->post('profile', 'EmployeeController@addGroupToUser');

    // Matches "/api/user
    //get one user by id
    $router->get('users/{id}', 'WorkOrderController@singleUser');

    // Matches "/api/users
    $router->get('users', 'WorkOrderController@allUsers');
    $router->get('locations', 'WorkOrderController@getLocations');
    $router->get('departments', 'WorkOrderController@getDepartments');
    // $router->post('login-employee', 'AuthController@login');
    // $router->post('update-password-employee', 'AuthController@updatePassword');


    /// employee controller
    //TODO buat provider untuk menyediakan group/permission yang diperlukan untuk middleware
    /// work order
    $router->group(['prefix' => 'work-order'], function () use ($router) {

        $router->post('create', [
            'middleware' => [
                'permission_check:create work order',
                'group_check:Work Order - Issuer'
            ],
            'uses' => 'WorkOrderController@createFormWorkOrder']);


        $router->group(['prefix' => 'view','middleware' => 'permission_check:view work order',], function () use ($router) {
            $router->get('get/{idFormWOrder}',
                [
                    // 'middleware' => 'group_check:Work Order - Issuer',
                    'uses' => 'WorkOrderController@getOneWorkOrderForm'
                ]);
            $router->group(['prefix' => 'as-issuer'], function () use ($router) {
                $router->get('get-all',
                [
                    'middleware' => 'group_check:Work Order - Issuer',
                    'uses' => 'WorkOrderController@viewListWorkOrderAsIssuer'
                ]);

                //get forms by id per groups
                //not yet done, still a few groups

            });

            $router->group(['prefix' => 'as-issuer-spv'], function () use ($router) {
                $router->get('get-all',
                [
                    'middleware' => 'group_check:Work Order - SPV Issuer',
                    'uses' => 'WorkOrderController@viewListWorkOrderAsIssuerSPV'
                ]);

                $router->get('get-all-approved',
                [
                    'middleware' => 'group_check:Work Order - SPV Issuer',
                    'uses' => 'WorkOrderController@viewListApprovedWorkOrderAsIssuerSPV'
                ]);
            });

            $router->group(['prefix' => 'as-planner'], function () use ($router) {
                $router->get('get-all',
                [
                    'middleware' => 'group_check:Work Order - Planner',
                    'uses' => 'WorkOrderController@viewListWorkOrderAsPlanner'
                ]);
            });
            $router->group(['prefix' => 'as-pic'], function () use ($router) {
                $router->get('get-all',
                [
                    'middleware' => 'group_check:Work Order - PIC',
                    'uses' => 'WorkOrderController@viewListWorkOrderAsPic'
                ]);

                $router->get('get-all-approved',
                [
                    'middleware' => 'group_check:Work Order - PIC',
                    'uses' => 'WorkOrderController@viewListApprovedWorkOrderAsPic'
                ]);
            });
            $router->group(['prefix' => 'as-pic-spv'], function () use ($router) {
                $router->get('get-all',
                [
                    'middleware' => 'group_check:Work Order - PIC - SPV',
                    'uses' => 'WorkOrderController@viewListWorkOrderAsPicSPV'
                ]);
            });
        });

        $router->group(['prefix' => 'update','middleware' => 'permission_check:edit work order',], function () use ($router) {
            $router->post('save-draft/{idFormWOrder}',
                [
                    'middleware' => [
                        'group_check:Work Order - Issuer,Work Order - SPV Issuer'
                    ],
                    'uses' => 'WorkOrderController@saveFormWorkOrderDraft'
                ]);
        });

        $router->group(['prefix' => 'reject','middleware' => 'permission_check:edit work order',], function () use ($router) {
            $router->post('as-issuer-spv/{idFormWOrder}',
            [
                'middleware' => [
                    'group_check:Work Order - SPV Issuer'
                ],
                'uses' => 'WorkOrderController@rejectFormWorkOrderAsIssuerSpv'
            ]);
                //HTTP Params : wo_reject_reason

                //Controller fill : wo_form_status (update) => 4.Rejected by Spv, wo_is_open => 0


            $router->post('as-planner/{idFormWOrder}',
            [
                'middleware' => [
                    'group_check:Work Order - Planner'
                ],
                'uses' => 'WorkOrderController@rejectFormWorkOrderAsPlanner'
            ]);
                //HTTP Params : wo_reject_reason

                //Controller fill : wo_form_status (update) => 5.Rejected by Work Order - Planner, wo_is_open => 0


        });

        $router->group(['prefix' => 'approve','middleware' => 'permission_check:edit work order',], function () use ($router) {

            $router->post('as-issuer-spv/{idFormWOrder}',
            [
                'middleware' => [
                    'group_check:Work Order - SPV Issuer'
                ],
                'uses' => 'WorkOrderController@approveFormWorkOrderAsIssuerSPV'
            ]);
                //Controller fill : wo_form_status (update) =>  3.Waiting Work Order - Planner Approval


                $router->post('as-issuer-spv-hand-over/{idFormWOrder}',
                [
                    'middleware' => [
                        'group_check:Work Order - SPV Issuer'
                    ],
                    'uses' => 'WorkOrderController@approveFormWorkOrderAsIssuerSPVHandOver'
                ]);
                    //Controller fill : wo_form_status (update) =>  3.Waiting Work Order - Planner Approval


            $router->post('as-planner/{idFormWOrder}',
            [
                'middleware' => [
                    'group_check:Work Order - Planner'
                ],
                'uses' => 'WorkOrderController@approveFormWorkOrderAsPlanner'
            ]);
                //HTTP Params :
                // -date | wo_date_planner_approve
                // -PIC (dropdown) | wo_pic_id
                // -estimation finish (date) | 	wo_date_recomendation
                // -Alokasi Biaya (dropdown) | wo_c_cost

                //Controller fill : wo_form_status (update) =>  6. Waiting PIC Action Plan

            $router->post('as-pic/{idFormWOrder}',
            [
                'middleware' => [
                    'group_check:Work Order - PIC'
                ],
                'uses' => 'WorkOrderController@approveFormWorkOrderAsPic'
            ]);
            $router->post('as-pic/hand-over/{idFormWOrder}',
            [
                'middleware' => [
                    'group_check:Work Order - PIC'
                ],
                'uses' => 'WorkOrderController@approveFormWorkOrderAsPicHandOver'
            ]);
                //Controller fill : wo_form_status (update) =>  7. Waitng SPV PIC Approve | 9. Hand Over to User

            $router->post('as-pic-spv/{idFormWOrder}',
            [
                'middleware' => [
                    'group_check:Work Order - PIC - SPV'
                ],
                'uses' => 'WorkOrderController@approveFormWorkOrderAsPicSpv'
            ]);
                //Controller fill : wo_form_status (update) =>  8. In Progress
        });
    });

    $router->group(['prefix' => 'inspection'], function () use ($router){
        $router->group([
            'prefix' => 'ladder',
            'middleware' => ['group_check:Inspection - Ladder,Inspection - Ladder - SPV']], function () use ($router){
                $router->get('all',[
                    'uses' => 'InspectionController@getAllLadder',
                    'middleware' => 'permission_check:view inspection form']);
                $router->get('get/{id}',[
                    'uses' => 'InspectionController@getOneLadder',
                    'middleware' => 'permission_check:view inspection form']);
                $router->post('create',[
                    'uses' => 'InspectionController@createOrSaveDraftLadder',
                    'middleware' => 'permission_check:create inspection form']);
                $router->post('save-draft',[
                    'uses' => 'InspectionController@createOrSaveDraftLadder',
                    'middleware' => 'permission_check:update inspection form']);
                $router->get('approve/{id}',[
                    'uses' => 'InspectionController@approveLadder',
                    'middleware' => 'permission_check:approve inspection form']);
        });
        $router->group([
            'prefix' => 'h2s',
            'middleware' => 'group_check:Inspection - H2S,Inspection - H2S - SPV'], function () use ($router){
                $router->get('all',[
                    'uses' => 'InspectionController@getAllH2s',
                    'middleware' => 'permission_check:view inspection form']);
                $router->get('get/{id}',[
                    'uses' => 'InspectionController@getOneH2s',
                    'middleware' => 'permission_check:view inspection form']);
                $router->post('create',[
                    'uses' => 'InspectionController@createOrSaveDraftH2s',
                    'middleware' => 'permission_check:create inspection form']);
                $router->post('save-draft',[
                    'uses' => 'InspectionController@createOrSaveDraftH2s',
                    'middleware' => 'permission_check:update inspection form']);
                $router->get('approve/{id}',[
                    'uses' => 'InspectionController@approveH2s',
                    'middleware' => 'permission_check:approve inspection form']);
        });
        $router->group([
            'prefix' => 'fume-hood',
            'middleware' => ['group_check:Inspection - Fume Hood,Inspection - Fume Hood - SPV']], function () use ($router){
                $router->get('all',[
                    'uses' => 'InspectionController@getAllFumeHood',
                    'middleware' => 'permission_check:view inspection form']);
                $router->get('get/{id}',[
                    'uses' => 'InspectionController@getOneFumeHood',
                    'middleware' => 'permission_check:view inspection form']);
                $router->post('create',[
                    'uses' => 'InspectionController@createOrSaveDraftFumeHood',
                    'middleware' => 'permission_check:create inspection form']);
                $router->post('save-draft',[
                    'uses' => 'InspectionController@createOrSaveDraftFumeHood',
                    'middleware' => 'permission_check:update inspection form']);
                $router->get('approve/{id}',[
                    'uses' => 'InspectionController@approveFumeHood',
                    'middleware' => 'permission_check:approve inspection form']);
        });
        $router->group([
            'prefix' => 'spill-kit',
            'middleware' => 'group_check:Inspection - Spill Kit,Inspection - Spill Kit - SPV'], function () use ($router){
                $router->get('all',[
                    'uses' => 'InspectionController@getAllSpillKit',
                    'middleware' => 'permission_check:view inspection form']);
                $router->get('get/{id}',[
                    'uses' => 'InspectionController@getOneSpillKit',
                    'middleware' => 'permission_check:view inspection form']);
                $router->post('create',[
                    'uses' => 'InspectionController@createOrSaveDraftSpillKit',
                    'middleware' => 'permission_check:create inspection form']);
                $router->post('save-draft',[
                    'uses' => 'InspectionController@createOrSaveDraftSpillKit',
                    'middleware' => 'permission_check:update inspection form']);
                $router->get('approve/{id}',[
                    'uses' => 'InspectionController@approveSpillKit',
                    'middleware' => 'permission_check:approve inspection form']);
        });
        $router->group([
            'prefix' => 'safety-harness',
            'middleware' => 'group_check:Inspection - Safety Harness,Inspection - Safety Harness - SPV'], function () use ($router){
                $router->get('all',[
                    'uses' => 'InspectionController@getAllSafetyHarness',
                    'middleware' => 'permission_check:view inspection form']);
                $router->get('get/{id}',[
                    'uses' => 'InspectionController@getOneSafetyHarness',
                    'middleware' => 'permission_check:view inspection form']);
                $router->post('create',[
                    'uses' => 'InspectionController@createOrSaveDraftSafetyHarness',
                    'middleware' => 'permission_check:create inspection form']);
                $router->post('save-draft',[
                    'uses' => 'InspectionController@createOrSaveDraftSafetyHarness',
                    'middleware' => 'permission_check:update inspection form']);
                $router->get('approve/{id}',[
                    'uses' => 'InspectionController@approveSafetyHarness',
                    'middleware' => 'permission_check:approve inspection form']);
        });
        $router->group([
            'prefix' => 'scba',
            'middleware' => 'group_check:Inspection - SCBA,Inspection - SCBA - SPV'], function () use ($router){
                $router->get('all',[
                    'uses' => 'InspectionController@getAllScba',
                    'middleware' => 'permission_check:view inspection form']);
                $router->get('get/{id}',[
                    'uses' => 'InspectionController@getOneScba',
                    'middleware' => 'permission_check:view inspection form']);
                $router->post('create',[
                    'uses' => 'InspectionController@createOrSaveDraftScba',
                    'middleware' => 'permission_check:create inspection form']);
                $router->post('save-draft',[
                    'uses' => 'InspectionController@createOrSaveDraftScba',
                    'middleware' => 'permission_check:update inspection form']);
                $router->get('approve/{id}',[
                    'uses' => 'InspectionController@approveScba',
                    'middleware' => 'permission_check:approve inspection form']);
        });
        $router->group([
            'prefix' => 'safety-shower',
            'middleware' => 'group_check:Inspection - Safety Shower,Inspection - Safety Shower - SPV'], function () use ($router){
                $router->get('all',[
                    'uses' => 'InspectionController@getAllSafetyShower',
                    'middleware' => 'permission_check:view inspection form']);
                $router->get('get/{id}',[
                    'uses' => 'InspectionController@getOneSafetyShower',
                    'middleware' => 'permission_check:view inspection form']);
                $router->post('create',[
                    'uses' => 'InspectionController@createOrSaveDraftSafetyShower',
                    'middleware' => 'permission_check:create inspection form']);
                $router->post('save-draft',[
                    'uses' => 'InspectionController@createOrSaveDraftSafetyShower',
                    'middleware' => 'permission_check:update inspection form']);
                $router->get('approve/{id}',[
                    'uses' => 'InspectionController@approveSafetyShower',
                    'middleware' => 'permission_check:approve inspection form']);
        });

    });

    $router->group([
        'prefix' => 'form5s'], function () use ($router){
            $router->get('all',[
                'uses' => 'Form5sesController@getAll5s',
                'middleware' => 'permission_check:view 5s form']);
            $router->get('get/{id}',[
                'uses' => 'Form5sesController@getOne5s']);
            $router->post('create',[
                'uses' => 'Form5sesController@createOrUpdateForm5s',
                'middleware' => 'permission_check:create 5s form']);
            $router->post('save-draft',[
                'uses' => 'Form5sesController@createOrUpdateForm5s',
                'middleware' => 'permission_check:update 5s form']);
            $router->post('approve',[
                'uses' => 'Form5sesController@approveForm5s',
                'middleware' => 'permission_check:approve 5s form']);
    });

    $router->group([
        'prefix' => 'attendance',
        // 'middleware' => 'group_check:Attendance Admin'
    ], function () use ($router){
            // $router->post('array',['uses' => 'AttendanceController@testFromArrayStringToPHPArray']);
            $router->post('create-attendance-event',[
                'uses' => 'AttendanceController@createOrEditEventAttandance']);
            $router->post('fill-personal-attendance/{id}',[
                'uses' => 'AttendanceController@createOrUpdatePersonalAttendance']);
            $router->get('get/{id}',[
                'uses' => 'AttendanceController@getPersonalAttendance',
                // 'middleware' => 'permission_check:view 5s form'
            ]);
            $router->get('get-one/{id}',[
                'uses' => 'AttendanceController@getAttendance',
                // 'middleware' => 'permission_check:view 5s form'
            ]);
            $router->get('all',[
                'uses' => 'AttendanceController@getAllAttendance',
                // 'middleware' => 'permission_check:view 5s form'
                ]);
    });


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

    $router->post('assign-group-to-user','TestGroupsAndPermissionsController@testAssignGroupToUser');
    $router->post('remove-group-from-user','TestGroupsAndPermissionsController@tesRemovenGroupFromUser');

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




