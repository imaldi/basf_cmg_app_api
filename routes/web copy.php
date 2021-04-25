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
    return $router->app->version();
});

$router->post('login', 'AuthController@login');

$router->get('failMiddleware/{middlewareName}', 'AuthController@failPermission');


$router->group(['prefix' => 'api','middleware' => ['json.response']], function () use ($router) {
    
    

    /// work order
    //TODO buat provider untuk menyediakan group/permission yang diperlukan untuk middleware
    $router->group(['prefix' => 'work-order'], function () use ($router) {

        $issuer = 
        //get forms per groups
        //not yet done, still a few groups
        // $router->get('get-all',
        // [
        //     'middleware' => ['permission_check:view-work-order','group_check:'],
        //     'uses' => 'WorkOrderController@viewListWorkOrder'
        // ]);
        
        // //get forms by id per groups
        // //not yet done, still a few groups
        // $router->get('get/{idFormWOrder}',
        // [
        //     'middleware' => 'permission_check:view-work-order',
        //     'uses' => 'WorkOrderController@getOneWorkOrderForm'
        // ]);

        $router->post('create', 'WorkOrderController@createFormWorkOrder');
            //  HTTP Params : 
            // -tanggal(autofill) | created_at
            // -kategori(dropdown) | wo_category
            // -lokasi(dropdown) | wo_location_id
            // -tag no(freetext) | wo_tag_no
            // -ditujukan ke bagian(dropdown) | wo_reffered_division
            // -deskripsi(freetext) | wo_description
            // -upload photo/file | ??? perlu d tanyakan
            // -kedaruratan(dropdown) | wo_c_emergency
            // -ranking customer(dropdown) | wo_c_ranking_cust
            // -Kriteria Peralatan (EC) (dropdown) | wo_c_equipment_criteria
            // -detail lokasi | wo_location_detail
            // -status form | wo_form_status
            // -catatan issuer | wo_issuer_attachment

            //Controller fill : 
            // -nama form (increment) | wo_name
            // -dept peminta pekerjaan(auto fill) | wo_reffered_dept
            // -issuer spv id | wo_spv_issuer_id
            // -tanggal issuer submit form work order | wo_date_issuer_submit
            // -wo_is_open => wo_form_status == 1 ? 0 : 1
            
    
    
            $router->group(['prefix' => 'view','middleware' => 'permission_check:view-work-order',], function () use ($router) {
                $router->group(['prefix' => 'as-issuer'], function () use ($router) {
                    $router->get('get-all',
                    [
                        'middleware' => 'group_check:Work-Order-Issuer',
                        'uses' => 'WorkOrderController@viewListWorkOrderAsIssuer'
                    ]);
                    
                    //get forms by id per groups
                    //not yet done, still a few groups
                    $router->get('get/{idFormWOrder}',
                    [
                        'middleware' => 'group_check:Work-Order-Issuer',
                        'uses' => 'WorkOrderController@getOneWorkOrderFormAsIssuer'
                    ]);
                });
                
                $router->group(['prefix' => 'as-issuer-spv'], function () use ($router) {
                    $router->get('get-all',
                    [
                        'middleware' => 'group_check:Work-Order-Issuer-SPV',
                        'uses' => 'WorkOrderController@viewListWorkOrderAsIssuerSPV'
                    ]);

                    $router->get('get-all-approved',
                    [
                        'middleware' => 'group_check:Work-Order-Issuer-SPV',
                        'uses' => 'WorkOrderController@viewListApprovedWorkOrderAsIssuerSPV'
                    ]);
                    
                    //get forms by id per groups
                    //not yet done, still a few groups
                    $router->get('get/{idFormWOrder}',
                    [
                        'middleware' => 'group_check:Work-Order-Issuer-SPV',
                        'uses' => 'WorkOrderController@getOneWorkOrderFormAsIssuerSPV'
                    ]);
                });

                $router->group(['prefix' => 'as-planner'], function () use ($router) {
                    $router->get('get-all',
                    [
                        'middleware' => 'group_check:Planner',
                        'uses' => 'WorkOrderController@viewListWorkOrderAsPlanner'
                    ]);
                    
                    //get forms by id per groups
                    //not yet done, still a few groups
                    $router->get('get/{idFormWOrder}',
                    [
                        'middleware' => 'group_check:Planner',
                        'uses' => 'WorkOrderController@getOneWorkOrderFormAsPlanner'
                    ]);
                });
                $router->group(['prefix' => 'as-pic'], function () use ($router) {
                    $router->get('get-all',
                    [
                        'middleware' => 'group_check:PIC',
                        'uses' => 'WorkOrderController@viewListWorkOrderAsPic'
                    ]);

                    $router->get('get-all-approved',
                    [
                        'middleware' => 'group_check:PIC',
                        'uses' => 'WorkOrderController@viewListApprovedWorkOrderAsPic'
                    ]);
                    
                    //get forms by id per groups
                    //not yet done, still a few groups
                    $router->get('get/{idFormWOrder}',
                    [
                        'middleware' => 'group_check:PIC',
                        'uses' => 'WorkOrderController@getOneWorkOrderFormAsPic'
                    ]);
                });
                $router->group(['prefix' => 'as-pic-spv'], function () use ($router) {
                    $router->get('get-all',
                    [
                        'middleware' => 'group_check:PIC-SPV',
                        'uses' => 'WorkOrderController@viewListWorkOrderAsPicSPV'
                    ]);
                    
                    //get forms by id per groups
                    //not yet done, still a few groups
                    $router->get('get/{idFormWOrder}',
                    [
                        'middleware' => 'group_check:PIC-SPV',
                        'uses' => 'WorkOrderController@getOneWorkOrderFormPicSPV'
                    ]);
                });
            });

            $router->group(['prefix' => 'update','middleware' => 'permission_check:edit-work-order',], function () use ($router) {
                $router->post('save-draft', 
                    [
                        'middleware' => [
                            'group_check:Work-Order-Issuer,Work-Order-Issuer-SPV'
                        ],
                        'uses' => 'WorkOrderController@saveFormWorkOrderDraft'
                    ]);
                // $router->post('save-draft', 'WorkOrderController@saveFormWorkOrderDraft');


            });

            $router->group(['prefix' => 'reject','middleware' => 'permission_check:edit-work-order',], function () use ($router) {
                $router->post('as-issuer-spv', 
                [
                    'middleware' => [
                        'group_check:Work-Order-Issuer-SPV'
                    ],
                    'uses' => 'WorkOrderController@rejectFormWorkOrderAsIssuerSpv'
                ]);
                    //HTTP Params : wo_reject_reason

                    //Controller fill : wo_form_status (update) => 4.Rejected by Spv, wo_is_open => 0


                $router->post('as-planner', 
                [
                    'middleware' => [
                        'group_check:Planner'
                    ],
                    'uses' => 'WorkOrderController@rejectFormWorkOrderAsPlanner'
                ]);
                    //HTTP Params : wo_reject_reason

                    //Controller fill : wo_form_status (update) => 5.Rejected by Planner, wo_is_open => 0

                    
            });

            $router->group(['prefix' => 'approve','middleware' => 'permission_check:edit-work-order',], function () use ($router) {
                
                $router->post('as-issuer-spv', 
                [
                    'middleware' => [
                        'group_check:Work-Order-Issuer-SPV'
                    ],
                    'uses' => 'WorkOrderController@approveFormWorkOrderAsIssuerSPV'
                ]);
                    //Controller fill : wo_form_status (update) =>  3.Waiting Planner Approval

                
                    $router->post('as-issuer-spv-hand-over', 
                    [
                        'middleware' => [
                            'group_check:Work-Order-Issuer-SPV'
                        ],
                        'uses' => 'WorkOrderController@approveFormWorkOrderAsIssuerSPVHandOver'
                    ]);
                        //Controller fill : wo_form_status (update) =>  3.Waiting Planner Approval


                $router->post('as-planner', 
                [
                    'middleware' => [
                        'group_check:Planner'
                    ],
                    'uses' => 'WorkOrderController@approveFormWorkOrderAsPlanner'
                ]);
                    //HTTP Params :
                    // -date | wo_date_planner_approve
                    // -PIC (dropdown) | wo_pic_id
                    // -estimation finish (date) | 	wo_date_recomendation
                    // -Alokasi Biaya (dropdown) | wo_c_cost

                    //Controller fill : wo_form_status (update) =>  6. Waiting PIC Action Plan

                $router->post('as-pic', 
                [
                    'middleware' => [
                        'group_check:PIC'
                    ],
                    'uses' => 'WorkOrderController@approveFormWorkOrderAsPic'
                ]);
                    //HTTP Params:
                    //	wo_pic_action_plan
                    //Controller fill : wo_form_status (update) =>  7. Waitng SPV PIC Approve | 9. Hand Over to User

                    $router->post('as-pic-hand-over', 
                    [
                        'middleware' => [
                            'group_check:PIC'
                        ],
                        'uses' => 'WorkOrderController@approveFormWorkOrderAsPicHandOver'
                    ]);
                        //Controller fill : wo_form_status (update) =>   9. Hand Over to User

                $router->post('as-pic-spv', 
                [
                    'middleware' => [
                        'group_check:PIC-SPV'
                    ],
                    'uses' => 'WorkOrderController@approveFormWorkOrderAsPicSpv'
                ]);
                    //Controller fill : wo_form_status (update) =>  8. In Progress
            });


    });

});




