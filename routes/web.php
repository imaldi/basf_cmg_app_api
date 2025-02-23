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



$router->group(['prefix' => 'api', 'middleware' => ['json.response']], function () use ($router) {
    $router->post('register', [
        // 'middleware' => [
        //     'permission_check:create user',
        //     // 'group_check:Admin'
        // ],
        'uses' => 'AuthController@register'
    ]);
    $router->post('edit-user', [
        'middleware' => [
            // 'permission_check:edit user',
            // 'group_check:Admin'
        ],
        'uses' => 'AuthController@editUser'
    ]);
    //// Test jwt
    // Matches "/api/profile
    $router->get('profile', 'HomeController@profile');
    $router->get('test-email/{id}', 'HomeController@testemail');
    $router->get('get-all-pic', 'HomeController@getAllPic');
    $router->post('profile', 'EmployeeController@addGroupToUser');

    // Matches "/api/user
    //get one user by id
    $router->get('users/{id}', 'WorkOrderController@singleUser');

    // Matches "/api/users
    $router->get('employee/all', 'HomeController@allEmployee');
    $router->get('locations', 'HomeController@getLocations');
    $router->get('departments/all', 'HomeController@getDepartments');
    $router->get('departments_locations', 'HomeController@getLocationsByLocModule');
    // $router->post('login-employee', 'AuthController@login');
    // $router->post('update-password-employee', 'AuthController@updatePassword');


    /// employee controller
    //TODO buat provider untuk menyediakan group/permission yang diperlukan untuk middleware
    /// work order
    $router->group(['prefix' => 'work-order'], function () use ($router) {

        $router->post('create', [
            'middleware' => [
                'permission_check:create work order',
                // 'group_check:Work Order - Issuer'
            ],
            'uses' => 'WorkOrderController@createFormWorkOrder'
        ]);


        $router->group(['prefix' => 'view', 'middleware' => 'permission_check:view work order',], function () use ($router) {
            $router->get(
                'get/{idFormWOrder}',
                [
                    // 'middleware' => 'group_check:Work Order - Issuer',
                    'uses' => 'WorkOrderController@getOneWorkOrderForm'
                ]
            );
            $router->group(['prefix' => 'as-issuer'], function () use ($router) {
                $router->get(
                    'get-all',
                    [
                        // 'middleware' => 'group_check:Work Order - Issuer',
                        'middleware' => 'permission_check:view work order',
                        'uses' => 'WorkOrderController@viewListWorkOrderAsIssuer'
                    ]
                );

                //get forms by id per groups
                //not yet done, still a few groups

            });

            $router->group(['prefix' => 'as-issuer-spv'], function () use ($router) {
                $router->get(
                    'get-all',
                    [
                        'middleware' => 'permission_check:spv issuer work order',
                        'uses' => 'WorkOrderController@viewListWorkOrderAsIssuerSPV'
                    ]
                );

                $router->get(
                    'get-all-approved',
                    [
                        'middleware' => 'permission_check:spv issuer work order',
                        'uses' => 'WorkOrderController@viewListApprovedWorkOrderAsIssuerSPV'
                    ]
                );
            });

            $router->group(['prefix' => 'as-planner'], function () use ($router) {
                $router->get(
                    'get-all',
                    [
                        'middleware' => 'permission_check:planner work order',
                        'uses' => 'WorkOrderController@viewListWorkOrderAsPlanner'
                    ]
                );
            });
            $router->group(['prefix' => 'as-pic'], function () use ($router) {
                $router->get(
                    'get-all',
                    [
                        'middleware' => 'permission_check:pic work order',
                        'uses' => 'WorkOrderController@viewListWorkOrderAsPic'
                    ]
                );

                $router->get(
                    'get-all-approved',
                    [
                        'middleware' => 'permission_check:pic work order',
                        'uses' => 'WorkOrderController@viewListApprovedWorkOrderAsPic'
                    ]
                );
            });
            $router->group(['prefix' => 'as-pic-spv'], function () use ($router) {
                $router->get(
                    'get-all',
                    [
                        'middleware' => 'permission_check:spv pic work order',
                        'uses' => 'WorkOrderController@viewListWorkOrderAsPicSPV'
                    ]
                );
            });
        });

        $router->group(['prefix' => 'update', 'middleware' => 'permission_check:edit work order',], function () use ($router) {
            $router->post(
                'save-draft/{idFormWOrder}',
                [
                    // tidak perlu pakai permission, yg penting id user sama id issuer sama dan bisa edit work order
                    // 'middleware' => [
                    //     'group_check:Work Order - Issuer,Work Order - SPV Issuer,Work Order - Planner'
                    // ],
                    'uses' => 'WorkOrderController@saveFormWorkOrderDraft'
                ]
            );
        });

        $router->group(['prefix' => 'reject', 'middleware' => 'permission_check:edit work order',], function () use ($router) {
            $router->post(
                'as-issuer-spv/{idFormWOrder}',
                [
                    'middleware' => [
                        'permission_check:spv issuer work order'
                    ],
                    'uses' => 'WorkOrderController@rejectFormWorkOrderAsIssuerSpv'
                ]
            );
            //HTTP Params : wo_reject_reason

            //Controller fill : wo_form_status (update) => 4.Rejected by Spv, wo_is_open => 0


            $router->post(
                'as-planner/{idFormWOrder}',
                [
                    'middleware' => [
                        'permission_check:planner work order'
                    ],
                    'uses' => 'WorkOrderController@rejectFormWorkOrderAsPlanner'
                ]
            );
            //HTTP Params : wo_reject_reason

            //Controller fill : wo_form_status (update) => 5.Rejected by Work Order - Planner, wo_is_open => 0


        });

        $router->group(['prefix' => 'approve', 'middleware' => 'permission_check:edit work order',], function () use ($router) {

            $router->get(
                'as-issuer-spv/{idFormWOrder}',
                [
                    'middleware' => [
                        'permission_check:spv issuer work order'
                    ],
                    'uses' => 'WorkOrderController@approveFormWorkOrderAsIssuerSPV'
                ]
            );
            //Controller fill : wo_form_status (update) =>  3.Waiting Work Order - Planner Approval


            $router->post(
                'as-issuer-spv-hand-over/{idFormWOrder}',
                [
                    'middleware' => [
                        'permission_check:spv issuer work order'
                    ],
                    'uses' => 'WorkOrderController@approveFormWorkOrderAsIssuerSPVHandOver'
                ]
            );
            //Controller fill : wo_form_status (update) =>  3.Waiting Work Order - Planner Approval


            $router->post(
                'as-planner/{idFormWOrder}',
                [
                    'middleware' => [
                        'permission_check:planner work order'
                    ],
                    'uses' => 'WorkOrderController@approveFormWorkOrderAsPlanner'
                ]
            );
            //HTTP Params :
            // -date | wo_date_planner_approve
            // -PIC (dropdown) | wo_pic_id
            // -estimation finish (date) | 	wo_date_recomendation
            // -Alokasi Biaya (dropdown) | wo_c_cost

            //Controller fill : wo_form_status (update) =>  6. Waiting PIC Action Plan

            $router->post(
                'as-pic/{idFormWOrder}',
                [
                    'middleware' => [
                        'permission_check:pic work order'
                    ],
                    'uses' => 'WorkOrderController@approveFormWorkOrderAsPic'
                ]
            );
            $router->post(
                'as-pic/hand-over/{idFormWOrder}',
                [
                    'middleware' => [
                        'permission_check:pic work order'
                    ],
                    'uses' => 'WorkOrderController@approveFormWorkOrderAsPicHandOver'
                ]
            );
            //Controller fill : wo_form_status (update) =>  7. Waitng SPV PIC Approve | 9. Hand Over to User

            $router->get(
                'as-pic-spv/{idFormWOrder}',
                [
                    'middleware' => [
                        'permission_check:spv pic work order'
                    ],
                    'uses' => 'WorkOrderController@approveFormWorkOrderAsPicSpv'
                ]
            );
            //Controller fill : wo_form_status (update) =>  8. In Progress
        });
    });

    $router->group(['prefix' => 'inspection'], function () use ($router) {
        $router->group([
            'prefix' => 'ladder',
            // 'middleware' => ['group_check:Inspection - Ladder,Inspection - Ladder - SPV']
        ], function () use ($router) {
            $router->get('all', [
                'uses' => 'InspectionController@getAllLadder',
                'middleware' => 'permission_check:view inspection form'
            ]);
            $router->get('get/{id}', [
                'uses' => 'InspectionController@getOneLadder',
                'middleware' => 'permission_check:view inspection form'
            ]);
            $router->post('create', [
                'uses' => 'InspectionController@createOrSaveDraftLadder',
                'middleware' => 'permission_check:create inspection form'
            ]);
            $router->post('save-draft', [
                'uses' => 'InspectionController@createOrSaveDraftLadder',
                'middleware' => 'permission_check:update inspection form'
            ]);
            $router->get('approve/{id}', [
                'uses' => 'InspectionController@approveLadder',
                'middleware' => 'permission_check:approve inspection form'
            ]);
        });
        $router->group([
            'prefix' => 'h2s',
            // 'middleware' => 'group_check:Inspection - H2S,Inspection - H2S - SPV'
        ], function () use ($router) {
            $router->get('all', [
                'uses' => 'InspectionController@getAllH2s',
                'middleware' => 'permission_check:view inspection form'
            ]);
            $router->get('get/{id}', [
                'uses' => 'InspectionController@getOneH2s',
                'middleware' => 'permission_check:view inspection form'
            ]);
            $router->post('create', [
                'uses' => 'InspectionController@createOrSaveDraftH2s',
                'middleware' => 'permission_check:create inspection form'
            ]);
            $router->post('save-draft', [
                'uses' => 'InspectionController@createOrSaveDraftH2s',
                'middleware' => 'permission_check:update inspection form'
            ]);
            $router->get('approve/{id}', [
                'uses' => 'InspectionController@approveH2s',
                'middleware' => 'permission_check:approve inspection form'
            ]);
        });
        $router->group([
            'prefix' => 'fume-hood',
            // 'middleware' => ['group_check:Inspection - Fume Hood,Inspection - Fume Hood - SPV']
        ], function () use ($router) {
            $router->get('all', [
                'uses' => 'InspectionController@getAllFumeHood',
                'middleware' => 'permission_check:view inspection form'
            ]);
            $router->get('get/{id}', [
                'uses' => 'InspectionController@getOneFumeHood',
                'middleware' => 'permission_check:view inspection form'
            ]);
            $router->post('create', [
                'uses' => 'InspectionController@createOrSaveDraftFumeHood',
                'middleware' => 'permission_check:create inspection form'
            ]);
            $router->post('save-draft', [
                'uses' => 'InspectionController@createOrSaveDraftFumeHood',
                'middleware' => 'permission_check:update inspection form'
            ]);
            $router->get('approve/{id}', [
                'uses' => 'InspectionController@approveFumeHood',
                'middleware' => 'permission_check:approve inspection form'
            ]);
        });
        $router->group([
            'prefix' => 'spill-kit',
            // 'middleware' => 'group_check:Inspection - Spill Kit,Inspection - Spill Kit - SPV'
        ], function () use ($router) {
            $router->get('all', [
                'uses' => 'InspectionController@getAllSpillKit',
                'middleware' => 'permission_check:view inspection form'
            ]);
            $router->get('get/{id}', [
                'uses' => 'InspectionController@getOneSpillKit',
                'middleware' => 'permission_check:view inspection form'
            ]);
            $router->post('create', [
                'uses' => 'InspectionController@createOrSaveDraftSpillKit',
                'middleware' => 'permission_check:create inspection form'
            ]);
            $router->post('save-draft', [
                'uses' => 'InspectionController@createOrSaveDraftSpillKit',
                'middleware' => 'permission_check:update inspection form'
            ]);
            $router->get('approve/{id}', [
                'uses' => 'InspectionController@approveSpillKit',
                'middleware' => 'permission_check:approve inspection form'
            ]);
        });
        $router->group([
            'prefix' => 'safety-harness',
            // 'middleware' => 'group_check:Inspection - Safety Harness,Inspection - Safety Harness - SPV'
        ], function () use ($router) {
            $router->get('all', [
                'uses' => 'InspectionController@getAllSafetyHarness',
                'middleware' => 'permission_check:view inspection form'
            ]);
            $router->get('get/{id}', [
                'uses' => 'InspectionController@getOneSafetyHarness',
                'middleware' => 'permission_check:view inspection form'
            ]);
            $router->post('create', [
                'uses' => 'InspectionController@createOrSaveDraftSafetyHarness',
                'middleware' => 'permission_check:create inspection form'
            ]);
            $router->post('save-draft', [
                'uses' => 'InspectionController@createOrSaveDraftSafetyHarness',
                'middleware' => 'permission_check:update inspection form'
            ]);
            $router->get('approve/{id}', [
                'uses' => 'InspectionController@approveSafetyHarness',
                'middleware' => 'permission_check:approve inspection form'
            ]);
        });
        $router->group([
            'prefix' => 'scba',
            // 'middleware' => 'group_check:Inspection - SCBA,Inspection - SCBA - SPV'
        ], function () use ($router) {
            $router->get('all', [
                'uses' => 'InspectionController@getAllScba',
                'middleware' => 'permission_check:view inspection form'
            ]);
            $router->get('get/{id}', [
                'uses' => 'InspectionController@getOneScba',
                'middleware' => 'permission_check:view inspection form'
            ]);
            $router->post('create', [
                'uses' => 'InspectionController@createOrSaveDraftScba',
                'middleware' => 'permission_check:create inspection form'
            ]);
            $router->post('save-draft', [
                'uses' => 'InspectionController@createOrSaveDraftScba',
                'middleware' => 'permission_check:update inspection form'
            ]);
            $router->get('approve/{id}', [
                'uses' => 'InspectionController@approveScba',
                'middleware' => 'permission_check:approve inspection form'
            ]);
        });
        $router->group([
            'prefix' => 'safety-shower',
            // 'middleware' => 'group_check:Inspection - Safety Shower,Inspection - Safety Shower - SPV'
        ], function () use ($router) {
            $router->get('all', [
                'uses' => 'InspectionController@getAllSafetyShower',
                'middleware' => 'permission_check:view inspection form'
            ]);
            $router->get('get/{id}', [
                'uses' => 'InspectionController@getOneSafetyShower',
                'middleware' => 'permission_check:view inspection form'
            ]);
            $router->post('create', [
                'uses' => 'InspectionController@createOrSaveDraftSafetyShower',
                'middleware' => 'permission_check:create inspection form'
            ]);
            $router->post('save-draft', [
                'uses' => 'InspectionController@createOrSaveDraftSafetyShower',
                'middleware' => 'permission_check:update inspection form'
            ]);
            $router->get('approve/{id}', [
                'uses' => 'InspectionController@approveSafetyShower',
                'middleware' => 'permission_check:approve inspection form'
            ]);
        });
    });

    $router->group([
        'prefix' => 'form5s'
    ], function () use ($router) {
        $router->get('all', [
            'uses' => 'Form5sesController@getAll5s',
            'middleware' => 'permission_check:view 5s form'
        ]);
        $router->get('get/{id}', [
            'uses' => 'Form5sesController@getOne5s'
        ]);
        $router->get('departments', [
            'uses' => 'Form5sesController@getDepartments'
        ]);
        $router->get('locations-of-department/{id}', [
            'uses' => 'Form5sesController@getAllLocationsOfDepartment'
        ]);
        $router->post('create-or-update', [
            'uses' => 'Form5sesController@createOrUpdateForm5s',
            'middleware' => 'permission_check:create 5s form'
        ]);
        $router->post('save-draft', [
            'uses' => 'Form5sesController@createOrUpdateForm5s',
            'middleware' => 'permission_check:update 5s form'
        ]);
        $router->post('approve', [
            'uses' => 'Form5sesController@approveForm5s',
            'middleware' => 'permission_check:approve 5s form'
        ]);
    });

    $router->group([
        'prefix' => 'attendance',
        // 'middleware' => 'group_check:Attendance Admin'
    ], function () use ($router) {
        // $router->post('array',['uses' => 'AttendanceController@testFromArrayStringToPHPArray']);
        $router->post('create-attendance-event', [
            'uses' => 'AttendanceController@createOrEditEventAttandance',
            'middleware' => 'permission_check:create attendance form'
        ]);
        $router->post('fill-personal-attendance/{id}', [
            'uses' => 'AttendanceController@createOrUpdatePersonalAttendance',
            'middleware' => 'permission_check:create attendance form'
        ]);
        $router->get('get/{id}', [
            'uses' => 'AttendanceController@getPersonalAttendance',
            'middleware' => 'permission_check:view attendance form'
        ]);
        $router->get('get-one/{id}', [
            'uses' => 'AttendanceController@getAttendance',
            'middleware' => 'permission_check:view attendance form'
        ]);
        $router->get('delete-event/{id}', [
            'uses' => 'AttendanceController@setAttendanceInactive',
            'middleware' => 'permission_check:update attendance form'
        ]);
        $router->get('all', [
            'uses' => 'AttendanceController@getAllAttendance',
            'middleware' => 'permission_check:view attendance form'
        ]);
        $router->get('get-categories',[
            'uses' => 'AttendanceController@getAttendanceCategories',
            'middleware' => 'permission_check:create attendance form'
        ]);
        $router->get('get-master',[
            'uses' => 'AttendanceController@getAttendanceMasterBasedOnGivenCategoryIdAndDepartmentId',
            'middleware' => 'permission_check:create attendance form'
        ]);
    });

    $router->group(['prefix' => 'e-gate',], function () use ($router) {
        $router->get('all', [
            'uses' => 'FormEGateCheckController@viewAllEgateForm',
            'middleware' => 'permission_check:view e gate form'
        ]);
        $router->get('all-loading', [
            'uses' => 'FormEGateCheckController@viewAllEgateForm',
            'middleware' => 'permission_check:view loading form'
        ]);
        $router->get('all-unloading', [
            'uses' => 'FormEGateCheckController@viewAllEgateForm',
            'middleware' => 'permission_check:view unloading form'
        ]);
        $router->get('angkutan-list', [
            'uses' => 'FormEGateCheckController@getDaftarNamaAngkutanEgateForm',
            'middleware' => 'permission_check:view e gate form'
        ]);
        $router->get('angkutan-list-loading', [
            'uses' => 'FormEGateCheckController@getDaftarNamaAngkutanEgateForm',
            'middleware' => 'permission_check:view loading form'
        ]);
        $router->get('angkutan-list-unloading', [
            'uses' => 'FormEGateCheckController@getDaftarNamaAngkutanEgateForm',
            'middleware' => 'permission_check:view unloading form'
        ]);

        // $router->get('all/no-gateable',[
        //     'uses' => 'FormEGateCheckController@viewAllEgateFormWithEmptyGateable',
        //     'middleware' => 'permission_check:view e gate form'
        //     ]);

        $router->get('get/{id}', [
            'uses' => 'FormEGateCheckController@getOneEgateForm',
            'middleware' => 'permission_check:view e gate form'
        ]);
        $router->get('get-loading/{id}', [
            'uses' => 'FormEGateCheckController@getOneEgateForm',
            'middleware' => 'permission_check:view loading form'
        ]);
        $router->get('get-unloading/{id}', [
            'uses' => 'FormEGateCheckController@getOneEgateForm',
            'middleware' => 'permission_check:view unloading form'
        ]);
        $router->post('create-or-update', [
            'uses' => 'FormEGateCheckController@createOrUpdateEgateForm',
            'middleware' => 'permission_check:create e gate form'

            // 'middleware' => 'permission_check:create 5s form'
        ]);
        $router->get('approve/{idForm}', [
            'uses' => 'FormEGateCheckController@approveEgateForm',
            'middleware' => 'permission_check:approve e gate form'

        ]);

        $router->get('delete/{id}', [
            'uses' => 'FormEGateCheckController@deleteEgateForm',
            'middleware' => 'permission_check:create e gate form'
        ]);

        $router->get('delete-gateable/{id}', [
            'uses' => 'FormEGateCheckController@deleteEgateFormGateable',
            'middleware' => 'permission_check:update e gate form'
        ]);
    });

    $router->group(['prefix' => 'loading',], function () use ($router) {
        $router->group(['prefix' => 'form-loading-tex-n701s',], function () use ($router) {
            $router->get('all', [
                'uses' => 'FormLoadingTexN701SController@viewAll',
                'middleware' => 'permission_check:view loading form'
            ]);

            $router->get('get/{formId}', [
                'uses' => 'FormLoadingTexN701SController@getOne',
                'middleware' => 'permission_check:view loading form'
            ]);
            $router->post('create-or-update', [
                'uses' => 'FormLoadingTexN701SController@createOrUpdate',
                'middleware' => 'permission_check:create loading form'
            ]);
            $router->get('approve/{formId}', [
                'uses' => 'FormLoadingTexN701SController@approve',
                'middleware' => 'permission_check:approve loading form'
            ]);
        });

        $router->group(['prefix' => 'form-loading-packed-goods',], function () use ($router) {
            $router->get('all', [
                'uses' => 'FormLoadingPackedGoodsController@viewAll',
                'middleware' => 'permission_check:view loading form'
            ]);
            $router->get('get/{formId}', [
                'uses' => 'FormLoadingPackedGoodsController@getOne',
                'middleware' => 'permission_check:view loading form',
            ]);
            $router->post('create-or-update', [
                'uses' => 'FormLoadingPackedGoodsController@createOrUpdate',
                'middleware' => 'permission_check:create loading form',
            ]);
            $router->post('approve/{formId}', [
                'uses' => 'FormLoadingPackedGoodsController@approve',
                'middleware' => 'permission_check:approve loading form'
            ]);
        });
    });

    $router->group(['prefix' => 'unloading',], function () use ($router) {

        $router->group(['prefix' => 'unloading_fa_c12',], function () use ($router) {
            $router->get('all', [
                'uses' => 'FormUnloadingFaC12Controller@viewAll',
                'middleware' => 'permission_check:view unloading form'
            ]);
            $router->get('get/{formId}', [
                'uses' => 'FormUnloadingFaC12Controller@getOne',
                'middleware' => 'permission_check:view unloading form'
            ]);
            $router->post('create-or-update', [
                'uses' => 'FormUnloadingFaC12Controller@createOrUpdate',
                'middleware' => 'permission_check:create unloading form'
            ]);
            // $router->post('update',[
            //     'uses' => 'FormUnloadingFaC12Controller@createOrUpdate',
            //     'middleware' => 'permission_check:create unloading form'
            // ]);
            $router->post('approve', [
                'uses' => 'FormUnloadingFaC12Controller@approve',
                'middleware' => 'permission_check:approve unloading form'
            ]);
        });

        $router->group(['prefix' => 'form_unloading_fa_1eo',], function () use ($router) {
            $router->get('all', [
                'uses' => 'FormUnloadingFa1eoController@viewAll',
                'middleware' => 'permission_check:view unloading form'
            ]);
            $router->get('get/{formId}', [
                'uses' => 'FormUnloadingFa1eoController@getOne',
                'middleware' => 'permission_check:view unloading form'
            ]);
            $router->post('create-or-update', [
                'uses' => 'FormUnloadingFa1eoController@createOrUpdate',
                'middleware' => 'permission_check:create unloading form'
            ]);
            // $router->post('update',[
            //     'uses' => 'FormUnloadingFa1eoController@createOrUpdate',
            //     'middleware' => 'permission_check:update unloading form'
            // ]);
            $router->post('approve', [
                'uses' => 'FormUnloadingFa1eoController@approve',
                'middleware' => 'permission_check:approve unloading form'
            ]);
        });

        $router->group(['prefix' => 'form_unloading_pac',], function () use ($router) {
            $router->get('all', [
                'uses' => 'FormUnloadingPacController@viewAll',
                'middleware' => 'permission_check:view unloading form'
            ]);
            $router->get('get/{formId}', [
                'uses' => 'FormUnloadingPacController@getOne',
                'middleware' => 'permission_check:view unloading form'
            ]);
            $router->post('create-or-update', [
                'uses' => 'FormUnloadingPacController@createOrUpdate',
                'middleware' => 'permission_check:create unloading form'
            ]);
            // $router->post('update',[
            //     'uses' => 'FormUnloadingPacController@createOrUpdate',
            //     'middleware' => 'permission_check:create unloading form'
            // ]);
            $router->post('approve', [
                'uses' => 'FormUnloadingPacController@approve',
                'middleware' => 'permission_check:approve unloading form'
            ]);
        });

        $router->group(['prefix' => 'form_unloading_naoh',], function () use ($router) {
            $router->get('all', [
                'uses' => 'FormUnloadingNaohController@viewAll',
                'middleware' => 'permission_check:view unloading form'
            ]);
            $router->get('get/{formId}', [
                'uses' => 'FormUnloadingNaohController@getOne',
                'middleware' => 'permission_check:view unloading form'
            ]);
            $router->post('create-or-update', [
                'uses' => 'FormUnloadingNaohController@createOrUpdate',
                'middleware' => 'permission_check:create unloading form'
            ]);
            // $router->post('update',[
            //     'uses' => 'FormUnloadingNaohController@createOrUpdate',
            //     'middleware' => 'permission_check:create unloading form'
            // ]);
            $router->post('approve', [
                'uses' => 'FormUnloadingNaohController@approve',
                'middleware' => 'permission_check:approve unloading form'
            ]);
        });

        $router->group(['prefix' => 'form_unloading_stearic_acid',], function () use ($router) {
            $router->get('all', [
                'uses' => 'FormUnloadingStearicAcidController@viewAll',
                'middleware' => 'permission_check:view unloading form'
            ]);
            $router->get('get/{formId}', [
                'uses' => 'FormUnloadingStearicAcidController@getOne',
                'middleware' => 'permission_check:view unloading form'
            ]);
            $router->post('create-or-update', [
                'uses' => 'FormUnloadingStearicAcidController@createOrUpdate',
                'middleware' => 'permission_check:create unloading form'
            ]);
            // $router->post('update',[
            //     'uses' => 'FormUnloadingStearicAcidController@createOrUpdate',
            //     'middleware' => 'permission_check:create unloading form'
            // ]);
            $router->post('approve', [
                'uses' => 'FormUnloadingStearicAcidController@approve',
                'middleware' => 'permission_check:approve unloading form'
            ]);
        });

        $router->group(['prefix' => 'form_unloading_sulphur_liquid',], function () use ($router) {
            $router->get('all', [
                'uses' => 'FormUnloadingSulphurLiquidController@viewAll',
                'middleware' => 'permission_check:view unloading form'
            ]);
            $router->get('get/{formId}', [
                'uses' => 'FormUnloadingSulphurLiquidController@getOne',
                'middleware' => 'permission_check:view unloading form'
            ]);
            $router->post('create-or-update', [
                'uses' => 'FormUnloadingSulphurLiquidController@createOrUpdate',
                'middleware' => 'permission_check:create unloading form'
            ]);
            // $router->post('update',[
            //     'uses' => 'FormUnloadingSulphurLiquidController@createOrUpdate',
            //     'middleware' => 'permission_check:create unloading form'
            // ]);
            $router->post('approve', [
                'uses' => 'FormUnloadingSulphurLiquidController@approve',
                'middleware' => 'permission_check:approve unloading form'
            ]);
        });


        $router->group(['prefix' => 'form_unloading_diesel_oil',], function () use ($router) {
            $router->get('all', [
                'uses' => 'FormUnloadingDieselOilController@viewAll',
                'middleware' => 'permission_check:view unloading form'
            ]);
            $router->get('get/{formId}', [
                'uses' => 'FormUnloadingDieselOilController@getOne',
                'middleware' => 'permission_check:view unloading form'
            ]);
            $router->post('create-or-update', [
                'uses' => 'FormUnloadingDieselOilController@createOrUpdate',
                'middleware' => 'permission_check:create unloading form'
            ]);
            // $router->post('update',[
            //     'uses' => 'FormUnloadingDieselOilController@createOrUpdate',
            //     'middleware' => 'permission_check:create unloading form'
            // ]);
            $router->post('approve', [
                'uses' => 'FormUnloadingDieselOilController@approve',
                'middleware' => 'permission_check:approve unloading form'
            ]);
        });

        $router->group(['prefix' => 'form_unloading_dehyton_ke',], function () use ($router) {
            $router->get('all', [
                'uses' => 'FormUnloadingDehytonKeController@viewAll',
                'middleware' => 'permission_check:view unloading form'
            ]);
            $router->get('get/{formId}', [
                'uses' => 'FormUnloadingDehytonKeController@getOne',
                'middleware' => 'permission_check:view unloading form'
            ]);
            $router->post('create-or-update', [
                'uses' => 'FormUnloadingDehytonKeController@createOrUpdate',
                'middleware' => 'permission_check:create unloading form'
            ]);
            // $router->post('update',[
            //     'uses' => 'FormUnloadingDehytonKeController@createOrUpdate',
            //     'middleware' => 'permission_check:create unloading form'
            // ]);
            $router->post('approve', [
                'uses' => 'FormUnloadingDehytonKeController@approve',
                'middleware' => 'permission_check:approve unloading form'
            ]);
        });


        $router->group(['prefix' => 'form_unloading_citric_acid',], function () use ($router) {
            $router->get('all', [
                'uses' => 'FormUnloadingCitricAcidController@viewAll',
                'middleware' => 'permission_check:view unloading form'
            ]);
            $router->get('get/{formId}', [
                'uses' => 'FormUnloadingCitricAcidController@getOne',
                'middleware' => 'permission_check:view unloading form'
            ]);
            $router->post('create-or-update', [
                'uses' => 'FormUnloadingCitricAcidController@createOrUpdate',
                'middleware' => 'permission_check:create unloading form'
            ]);
            // $router->post('update',[
            //     'uses' => 'FormUnloadingCitricAcidController@createOrUpdate',
            //     'middleware' => 'permission_check:create unloading form'
            // ]);
            $router->post('approve', [
                'uses' => 'FormUnloadingCitricAcidController@approve',
                'middleware' => 'permission_check:approve unloading form'
            ]);
        });

        $router->group(['prefix' => 'form_unloading_packed_good',], function () use ($router) {
            $router->get('all', [
                'uses' => 'FormUnloadingPackedGoodController@viewAll',
                'middleware' => 'permission_check:view unloading form'
            ]);
            $router->get('get/{formId}', [
                'uses' => 'FormUnloadingPackedGoodController@getOne',
                'middleware' => 'permission_check:view unloading form'
            ]);
            $router->post('create-or-update', [
                'uses' => 'FormUnloadingPackedGoodController@createOrUpdate',
                'middleware' => 'permission_check:create unloading form'
            ]);
            // $router->post('update',[
            //     'uses' => 'FormUnloadingPackedGoodController@createOrUpdate',
            //     // 'middleware' => 'permission_check:create unloading form'
            // ]);
            $router->post('approve', [
                'uses' => 'FormUnloadingPackedGoodController@approve',
                'middleware' => 'permission_check:create unloading form'
            ]);
        });
    });
    $router->post('assign-group-to-user', 'TestGroupsAndPermissionsController@testAssignGroupToUser');
    $router->post('remove-group-from-user', 'TestGroupsAndPermissionsController@tesRemovenGroupFromUser');
});

$router->group(['prefix' => 'api'], function () use ($router) {
    // todo ini nanti dihapus, disable, atau di kasih middleware di prod
    $router->get('get-all-permission', 'TestGroupsAndPermissionsController@getAllPermissions');
    $router->get('create-group/{groupArg}', 'TestGroupsAndPermissionsController@testCreateAGroup');
    $router->get('create-permission/{permissionArg}', 'TestGroupsAndPermissionsController@testCreateAPermission');
    $router->post('assign-permission-to-group', 'TestGroupsAndPermissionsController@testAssignPermissionToGroup');
    $router->post('assign-permission-to-user', 'TestGroupsAndPermissionsController@assignPermissionToUser');
    // $router->get('assign-group-to-user','TestGroupsAndPermissionsController@testAssignGroupToUser');
    $router->get('is-user-has-groups', 'TestGroupsAndPermissionsController@isUserHasGroup');
    $router->get('get-group', 'TestGroupsAndPermissionsController@testDapatkanGroupUserDenganForEach');
});
