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
                'permission_check:create-work-order',
                'group_check:Work_Order_-_Issuer'
            ],
            'uses' => 'WorkOrderController@createFormWorkOrder']);


        $router->group(['prefix' => 'view','middleware' => 'permission_check:view-work-order',], function () use ($router) {
            $router->get('get/{idFormWOrder}',
                [
                    // 'middleware' => 'group_check:Work_Order_-_Issuer',
                    'uses' => 'WorkOrderController@getOneWorkOrderForm'
                ]);
            $router->group(['prefix' => 'as-issuer'], function () use ($router) {
                $router->get('get-all',
                [
                    'middleware' => 'group_check:Work_Order_-_Issuer',
                    'uses' => 'WorkOrderController@viewListWorkOrderAsIssuer'
                ]);

                //get forms by id per groups
                //not yet done, still a few groups

            });

            $router->group(['prefix' => 'as-issuer-spv'], function () use ($router) {
                $router->get('get-all',
                [
                    'middleware' => 'group_check:Work_Order_-_SPV_Issuer',
                    'uses' => 'WorkOrderController@viewListWorkOrderAsIssuerSPV'
                ]);

                $router->get('get-all-approved',
                [
                    'middleware' => 'group_check:Work-Order-Issuer-SPV',
                    'uses' => 'WorkOrderController@viewListApprovedWorkOrderAsIssuerSPV'
                ]);
            });

            $router->group(['prefix' => 'as-planner'], function () use ($router) {
                $router->get('get-all',
                [
                    'middleware' => 'group_check:Work_Order_-_Planner',
                    'uses' => 'WorkOrderController@viewListWorkOrderAsPlanner'
                ]);
            });
            $router->group(['prefix' => 'as-pic'], function () use ($router) {
                $router->get('get-all',
                [
                    'middleware' => 'group_check:Work_Order_-_PIC',
                    'uses' => 'WorkOrderController@viewListWorkOrderAsPic'
                ]);

                $router->get('get-all-approved',
                [
                    'middleware' => 'group_check:Work_Order_-_PIC',
                    'uses' => 'WorkOrderController@viewListApprovedWorkOrderAsPic'
                ]);
            });
            $router->group(['prefix' => 'as-pic-spv'], function () use ($router) {
                $router->get('get-all',
                [
                    'middleware' => 'group_check:Work_Order_-_PIC_-_SPV',
                    'uses' => 'WorkOrderController@viewListWorkOrderAsPicSPV'
                ]);
            });
        });

        $router->group(['prefix' => 'update','middleware' => 'permission_check:edit-work-order',], function () use ($router) {
            $router->post('save-draft/{idFormWOrder}',
                [
                    'middleware' => [
                        'group_check:Work_Order_-_Issuer,Work_Order_-_SPV_Issuer'
                    ],
                    'uses' => 'WorkOrderController@saveFormWorkOrderDraft'
                ]);
        });

        $router->group(['prefix' => 'reject','middleware' => 'permission_check:edit-work-order',], function () use ($router) {
            $router->post('as-issuer-spv/{idFormWOrder}',
            [
                'middleware' => [
                    'group_check:Work_Order_-_SPV_Issuer'
                ],
                'uses' => 'WorkOrderController@rejectFormWorkOrderAsIssuerSpv'
            ]);
                //HTTP Params : wo_reject_reason

                //Controller fill : wo_form_status (update) => 4.Rejected by Spv, wo_is_open => 0


            $router->post('as-planner/{idFormWOrder}',
            [
                'middleware' => [
                    'group_check:Work_Order_-_Planner'
                ],
                'uses' => 'WorkOrderController@rejectFormWorkOrderAsPlanner'
            ]);
                //HTTP Params : wo_reject_reason

                //Controller fill : wo_form_status (update) => 5.Rejected by Work_Order_-_Planner, wo_is_open => 0


        });

        $router->group(['prefix' => 'approve','middleware' => 'permission_check:edit-work-order',], function () use ($router) {

            $router->post('as-issuer-spv/{idFormWOrder}',
            [
                'middleware' => [
                    'group_check:Work_Order_-_SPV_Issuer'
                ],
                'uses' => 'WorkOrderController@approveFormWorkOrderAsIssuerSPV'
            ]);
                //Controller fill : wo_form_status (update) =>  3.Waiting Work_Order_-_Planner Approval


                $router->post('as-issuer-spv-hand-over/{idFormWOrder}',
                [
                    'middleware' => [
                        'group_check:Work_Order_-_SPV_Issuer'
                    ],
                    'uses' => 'WorkOrderController@approveFormWorkOrderAsIssuerSPVHandOver'
                ]);
                    //Controller fill : wo_form_status (update) =>  3.Waiting Work_Order_-_Planner Approval


            $router->post('as-planner/{idFormWOrder}',
            [
                'middleware' => [
                    'group_check:Work_Order_-_Planner'
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
                    'group_check:Work_Order_-_PIC'
                ],
                'uses' => 'WorkOrderController@approveFormWorkOrderAsPic'
            ]);
            $router->post('as-pic/hand-over/{idFormWOrder}',
            [
                'middleware' => [
                    'group_check:Work_Order_-_PIC'
                ],
                'uses' => 'WorkOrderController@approveFormWorkOrderAsPicHandOver'
            ]);
                //Controller fill : wo_form_status (update) =>  7. Waitng SPV PIC Approve | 9. Hand Over to User

            $router->post('as-pic-spv/{idFormWOrder}',
            [
                'middleware' => [
                    'group_check:Work_Order_-_PIC_-_SPV'
                ],
                'uses' => 'WorkOrderController@approveFormWorkOrderAsPicSpv'
            ]);
                //Controller fill : wo_form_status (update) =>  8. In Progress
        });
    });

    $router->group(['prefix' => 'inspection'], function () use ($router){
        $router->group(['prefix' => 'ladder'
        ,'middleware' => ['group_check:Inspection_-_Ladder,Inspection_-_Ladder_-_SPV']
    ], function () use ($router){
            $router->get('all',['uses' => 'InspectionController@getAllLadder',
            //  'middleware' => 'permission_check=view_Inspection_form'
             ]
            );
            $router->get('get/{$id}',['uses' => 'InspectionController@getOneLadder','middleware' => 'permission_check=view_Inspection_form']);
            $router->post('create',['uses' => 'InspectionController@createLadder',
            // 'middleware' => 'permission_check=create_Inspection_form'
            ]);
            $router->post('save-draft/{$id}',['uses' => 'InspectionController@saveDraftLadder','middleware' => 'permission_check=update_Inspection_form']);
            $router->get('approve/{$id}',['uses' => 'InspectionController@approveLadder','middleware' => 'permission_check=approve_Inspection_form']);
        });
        $router->group(['prefix' => 'h2s','middleware' => 'group_check:Inspection_-_H2S,Inspection_-_H2S_-_SPV'], function () use ($router){
            $router->get('all',['uses' => 'InspectionController@getAllH2s', 'middleware' => 'permission_check=view_Inspection_form']);
            $router->get('get/{$id}',['uses' => 'InspectionController@getOneH2s','middleware' => 'permission_check=view_Inspection_form']);
            $router->post('create',['uses' => 'InspectionController@createH2s','middleware' => 'permission_check=create_Inspection_form']);
            $router->post('save-draft/{$id}',['uses' => 'InspectionController@saveDraftH2s','middleware' => 'permission_check=update_Inspection_form']);
            $router->get('approve/{$id}',['uses' => 'InspectionController@approveH2s','middleware' => 'permission_check=approve_Inspection_form']);
        });
        $router->group(['prefix' => 'fume-hood'
        ,'middleware' => ['group_check:Inspection_-_Fume_Hood,Inspection_-_Fume_Hood_-_SPV']
        ], function () use ($router){
            $router->get('all',['uses' => 'InspectionController@getAllFumeHood',
                // 'middleware' => ['permission_check=view_Inspection_form']
                ]);
            $router->get('get/{$id}',['uses' => 'InspectionController@getOneFumeHood','middleware' => 'permission_check=view_Inspection_form']);
            $router->post('create',['uses' => 'InspectionController@createFumeHood'
                // ,'middleware' => 'permission_check=create_Inspection_form']
            ]);
            $router->post('save-draft/{$id}',['uses' => 'InspectionController@saveDraftFumeHood','middleware' => 'permission_check=update_Inspection_form']);
            $router->get('approve/{$id}',['uses' => 'InspectionController@approveFumeHood','middleware' => 'permission_check=approve_Inspection_form']);
        });
        $router->group(['prefix' => 'spill-kit','middleware' => 'group_check:Inspection_-_Spill_Kit,Inspection_-_Spill_Kit_-_SPV'], function () use ($router){
            $router->get('all',['uses' => 'InspectionController@getAllSpillKit', 'middleware' => 'permission_check=view_Inspection_form']);
            $router->get('get/{$id}',['uses' => 'InspectionController@getOneSpillKit','middleware' => 'permission_check=view_Inspection_form']);
            $router->post('create',['uses' => 'InspectionController@createSpillKit','middleware' => 'permission_check=create_Inspection_form']);
            $router->post('save-draft/{$id}',['uses' => 'InspectionController@saveDraftSpillKit','middleware' => 'permission_check=update_Inspection_form']);
            $router->get('approve/{$id}',['uses' => 'InspectionController@approveSpillKit','middleware' => 'permission_check=approve_Inspection_form']);
        });
        $router->group(['prefix' => 'safety-harness','middleware' => 'group_check:Inspection_-_Safety_Harness,Inspection_-_Safety_Harness_-_SPV'], function () use ($router){
            $router->get('all',['uses' => 'InspectionController@getAllSafetyHarness', 'middleware' => 'permission_check=view_Inspection_form']);
            $router->get('get/{$id}',['uses' => 'InspectionController@getOneSafetyHarness','middleware' => 'permission_check=view_Inspection_form']);
            $router->post('create',['uses' => 'InspectionController@createSafetyHarness','middleware' => 'permission_check=create_Inspection_form']);
            $router->post('save-draft/{$id}',['uses' => 'InspectionController@saveDraftSafetyHarness','middleware' => 'permission_check=update_Inspection_form']);
            $router->get('approve/{$id}',['uses' => 'InspectionController@approveSafetyHarness','middleware' => 'permission_check=approve_Inspection_form']);
        });
        $router->group(['prefix' => 'scba','middleware' => 'group_check:Inspection_-_SCBA,Inspection_-_SCBA_-_SPV'], function () use ($router){
            $router->get('all',['uses' => 'InspectionController@getAllScba', 'middleware' => 'permission_check=view_Inspection_form']);
            $router->get('get/{$id}',['uses' => 'InspectionController@getOneScba','middleware' => 'permission_check=view_Inspection_form']);
            $router->post('create',['uses' => 'InspectionController@createScba','middleware' => 'permission_check=create_Inspection_form']);
            $router->post('save-draft/{$id}',['uses' => 'InspectionController@saveDraftScba','middleware' => 'permission_check=update_Inspection_form']);
            $router->get('approve/{$id}',['uses' => 'InspectionController@approveScba','middleware' => 'permission_check=approve_Inspection_form']);
        });
        $router->group(['prefix' => 'safety-shower','middleware' => 'group_check:Inspection_-_Safety_Shower,Inspection_-_Safety_Shower_-_SPV'], function () use ($router){
            $router->get('all',['uses' => 'InspectionController@getAllSafetyShower', 'middleware' => 'permission_check=view_Inspection_form']);
            $router->get('get/{$id}',['uses' => 'InspectionController@getOneSafetyShower','middleware' => 'permission_check=view_Inspection_form']);
            $router->post('create',['uses' => 'InspectionController@createSafetyShower','middleware' => 'permission_check=create_Inspection_form']);
            $router->post('save-draft/{$id}',['uses' => 'InspectionController@saveDraftSafetyShower','middleware' => 'permission_check=update_Inspection_form']);
            $router->get('approve/{$id}',['uses' => 'InspectionController@approveSafetyShower','middleware' => 'permission_check=approve_Inspection_form']);
        });

    });

    $router->group(['prefix' => 'form5s'], function () use ($router){
        $router->get('all',['uses' => 'InspectionController@getAllLadder', 'middleware' => 'permission_check=view_Inspection_form']);
        $router->get('location-pics/{id}',['uses' => 'Form5sesController@getAllLocationsOfDepartment']);

    });

    $router->group(['prefix' => 'attendance'], function () use ($router){
        $router->post('array',['uses' => 'AttendanceController@testFromArrayStringToPHPArray']);
        $router->post('create-attendance-event',['uses' => 'AttendanceController@createEventAttandance']);

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




