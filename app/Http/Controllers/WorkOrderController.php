<?php

namespace App\Http\Controllers;

use App\Models\FormWorkOrder;
use App\Models\MasterDepartment;
use App\Models\MEmployeeGroup;
use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WorkOrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    protected $imageFormsWorkOrder = '/images/forms';
    // public $successStatus = 200;

    /// Test JWT
    public function profile()
    {
        //Tes profile department dan date
        $user = Auth::user();
        $employee = User::find($user->id);
        $department = $employee->department()->first();
        $date = Carbon::now()->format('Y-m-d H:i:s');
        // $department = MasterDepartment::find(3);
        $userSpv = $department->users()->where('emp_is_spv',1)->first();

        // $department->users();
        // return response()->json(['user' => $date], 200);
        // return response()->json(['user' => $employee], 200);

        //Tes Has Many Through dengan EmployeeGroup model
        $group = $user->group()->first();
        $forms = $group->workOrderForms()->get();
        $permissions = $group->permissions()->get()->where('id',13)->first();
        // return response()->json(['group_forms' => $forms], 200);
        return response()->json(['group_forms' => $permissions], 200);

    }

    public function allUsers()
    {
         return response()->json(['users' =>  User::all()], 200);
    }

    public function singleUser($id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json(['user' => $user], 200);

        } catch (\Exception $e) {

            return response()->json(['message' => 'user not found!'], 404);
        }

    }

    ///Test JWT Ends

    ///01. View All
    public function viewListWorkOrder()
    {
        //nanti buat provider untuk menyediakan group, permission dan lain lain
        // $view_permissions = 13;
        // $group_issuer = 2;
        $group_issuer_spv = 3;
        $user = Auth::user();
        // $group = $user->group()->first();
        $groups = $user->roles;
        $groupUserId = 0;
        foreach($groups as $group){
            if($group->permissions
            ->where('name','view work order')->first() != null){
                $groupUserId = $group->id;
            }
        }

        $groupUser = MEmployeeGroup::find($groupUserId);

        // $forms = $groupUser->workOrderForms()->get();
        //tambah is open = 1 nanti
        $formsOfSpv = $groupUser->workOrderFormsOfSpv()->get();
        return response(['spv_forms' => $formsOfSpv],200);

        // $permissions = 
        //     $group->permissions()->get()
        //     ->where('id',$view_permissions)->first();
        // try{
        //     // if($permissions->id == $view_permissions){
        //         if($user->hasRole('Work Order - Issuer')){
        //             return response()->json([
        //                 'code' => 200,
        //                 'message' => 'Success Get All Data', 
        //                 'data' =>  FormWorkOrder::where('wo_is_open', 1)
        //                 ->where('wo_issuer_id',$user->id)->get()
        //                 // ->where('emp_employee_group_id',$groupId)->get()
        //                 ], 200);
        //         } else if ($user->hasRole('Work Order - SPV')){
        //             $formsOfSpv = $groupUser->workOrderFormsOfSpv()->get();
        //             return response()->json([
        //                 'code' => 200,
        //                 'message' => 'Success Get All Data', 
        //                 'data' =>  $formsOfSpv
        //                 // ->where('emp_employee_group_id',$groupId)->get()
        //                 ], 200);
        //         }
        //         return response()->json([
        //             'code' => 401,
        //             'message' => "your group are not allowed"
        //         ]);
        //         // $error = \Illuminate\Auth\AuthenticationException::withMessages([
        //         //     'group_issuer' => ['Validation Message #1'],
        //         //     // 'field_name_2' => ['Validation Message #2'],
        //         //  ]);
        //         //  throw $error;
        //     // } else {
        //         // return response()->json([
        //         //     'code' => 401,
        //         //     'message' => 'Unauthenticated', 
        //         //     // 'data' =>  FormWorkOrder::where('wo_is_open', 1)->get()
        //         //     ], 401);\
        //         // $error = \Illuminate\Auth\AuthenticationException::withMessages([
        //         //     'group_issuer' => ['Validation Message #1'],
        //         //     // 'field_name_2' => ['Validation Message #2'],
        //         //  ]);
        //         //  throw $error;
        //     // }
             
        // } catch (\PDOException $e) {
        //     $statusCode = 404;
        //     $response = [
        //         'error' => true,
        //         'message' => 'view list form work order Gagal : '.$e->getMessage(),
        //     ];

        //     return $response; 
        // } 
    }

    // public function viewListWorkOrderByGroupId()
    // {
    //     $groupId = Route::current()->parameter('groupId');
    //     try{
    //          return response()->json([
    //             'code' => 200,
    //             'message' => 'Success Get All Data', 
    //             'data' =>  FormWorkOrder::where('wo_is_open', 1)
    //             ->where('emp_employee_group_id',$groupId)->get()
    //             ], 200);
    //     } catch (\PDOException $e) {
    //         $statusCode = 404;
    //         $response = [
    //             'error' => true,
    //             'message' => 'view list form work order Gagal',
    //         ];

    //         return $response; 
    //     } 
    // }

    ///02. Create
    public function createFormWorkOrder(Request $request)
    {     
        // $statusCode = 500;
        //     $response=[];
        try{
            //get employee
            $employee = Auth::user();
            // $employee = User::find($user->id);

            

            // $formWorkOrder= new FormWorkOrder;
            $date = Carbon::now()
            // ->format('Y-m-d H:i:s')
            ;
            $date->toDateTimeString();
            $department = $employee->department()->first();
            $departmentAbr = substr(strtoupper($department->dept_name),0,3);
            $formWorkOrder = FormWorkOrder::create([
                'wo_name' => 'GU/F/5033-1/'.$departmentAbr.'/'.$date->month.'/'.$date->year.'/'.'77',
                'wo_issuer_id' => $employee->id,
                'wo_spv_issuer_id' => 
                $employee->department()->first()->users()->where('emp_is_spv',1)->first()->id,
                'wo_date_issuer_submit' => $date,
                'wo_category' => $request->input('wo_category'),
                'wo_issuer_dept' => $request->input('emp_employee_department_id'),
                'wo_location_id' => $request->input('wo_location_id'),
                'wo_reffered_dept' => $department->id,
                'wo_reffered_division' => $request->input('wo_reffered_division'),
                'wo_description' => $request->input('wo_description'),
                // 1, 
                // $employee->department()->first()->location()->first()->id,
                'wo_location_detail' => $request->input('location_detail'),
                'wo_tag_no' => $request->input('wo_tag_no'),
                'wo_issuer_attachment' => $request->input('wo_issuer_attachment')
                //TODO upload file foto
            ]);
            return $formWorkOrder;
        } catch (\PDOException $e) {
            $statusCode = 404;
            $response = [
                'error' => true,
                'message' => $e->getMessage(),
            ];   
            return $response; 
        } 
        // finally {
        //     // $statusCode = 200;
        //     return response()->json([
        //         'statusCode' => $statusCode,
        //         'data' => $response
        //     ]);
        //     // return response($response,$statusCode)->header('Content-Type','application/json');
        // }
    }

    public function saveEditDraft(Request $request)
    {     
        try{
            $formWorkOrder= FormsWorkOrder::find($request->id_form);
            $formWorkOrder->id_issuer_submit= $request->id_issuer_submit;
            $formWorkOrder->id_dept_submitting= $request->id_dept_submitting;
            $formWorkOrder->id_location= $request->id_location;
            $formWorkOrder->w_order_category= $request->w_order_category;
            $formWorkOrder->w_order_location= $request->w_order_location;
            if($request->tag_number){
                $formWorkOrder->tag_number= $request->tag_number;
            }
            $formWorkOrder->w_order_desc= $request->w_order_desc;
            $formWorkOrder->w_o_priority_score= $request->w_o_priority_score;
            $formWorkOrder->reffered_division= $request->reffered_division;
            $formWorkOrder->id_emergency= $request->id_emergency;
            $formWorkOrder->id_ranking_customer= $request->id_ranking_customer;
            $formWorkOrder->id_equipment_criteria= $request->id_equipment_criteria;
            if ($request->hasFile('w_o_pict_before')) {
                if ($request->file('w_o_pict_before')->isValid()) {
                    $file_ext        = $request->file('w_o_pict_before')->getClientOriginalExtension();
                    $file_size       = filesize($request->file('w_o_pict_before'));
                    $allow_file_exts = array('jpeg', 'jpg', 'png');
                    $max_file_size   = 1024 * 1024 * 10;
                    if (in_array(strtolower($file_ext), $allow_file_exts) && ($file_size <= $max_file_size)) {
                        $dest_path     = base_path(). $this->imageFormsWorkOrder;
                        $file_name     = preg_replace('/\\.[^.\\s]{3,4}$/', '', $request->file('w_o_pict_before')->getClientOriginalName());
                        $file_name     = str_replace(' ', '-', $file_name);
                        $work_order_before_pict ="work-order ". $file_name  . '.' . $file_ext;
                        // move file to serve directory
                        $request->file('w_o_pict_before')->move($dest_path, $work_order_before_pict);

                        $formWorkOrder->w_o_pict_before= $work_order_before_pict;
                    }
                }
            }
            if($request->status_action === "Create Draft"){
                $formWorkOrder->is_active= null;
            } else if ( $request->status_action ==="Submit Form"){
                $formWorkOrder->is_active= 1;
                $formWorkOrder->w_order_status= "Waiting Spv Approval";
            }
            
            $formWorkOrder->saveOrFail($request->all());
            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => ' update draft form work order Berhasil',
            ];    
        } catch (\PDOException $e) {
            $statusCode = 404;
            $response = [
                'error' => true,
                'message' => 'update draft form work order Gagal',
            ];
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function updateFormWorkOrder(Request $request, $idFormWOrder)
    {     
        try{
            $formWorkOrder= FormsWorkOrder::find($idFormWOrder);
            $formWorkOrder->id_issuer_spv= $request->id_issuer_spv;
            $formWorkOrder->w_order_category= $request->w_order_category;
            $formWorkOrder->id_reffered_dept_spv= $request->id_reffered_dept_spv;
            $formWorkOrder->reffered_division= $request->reffered_division;
            $formWorkOrder->w_order_desc= $request->w_order_desc;
            $formWorkOrder->w_o_priority_score= $request->w_o_priority_score;
            $formWorkOrder->implement_date= $request->implement_date;
            $formWorkOrder->reschedule_date= $request->reschedule_date;
            $formWorkOrder->relevant_area= $request->relevant_area;
            $formWorkOrder->cost_classification= $request->cost_classification;
            if ($request->hasFile('w_o_pict_sign_issuer_spv')) {
                if ($request->file('w_o_pict_sign_issuer_spv')->isValid()) {
                    $file_ext        = $request->file('w_o_pict_sign_issuer_spv')->getClientOriginalExtension();
                    $file_size       = filesize($request->file('w_o_pict_sign_issuer_spv'));
                    $allow_file_exts = array('jpeg', 'jpg', 'png');
                    $max_file_size   = 1024 * 1024 * 10;
                    if (in_array(strtolower($file_ext), $allow_file_exts) && ($file_size <= $max_file_size)) {
                        $dest_path     = base_path().'/public' . $this->imageFormsWorkOrder;
                        $file_name     = preg_replace('/\\.[^.\\s]{3,4}$/', '', $request->file('w_o_pict_sign_issuer_spv')->getClientOriginalName());
                        $file_name     = str_replace(' ', '-', $file_name);
                        $w_o_pict_sign_issuer_spv ="work-order ". $file_name  . '.' . $file_ext;
                        // move file to serve directory
                        $request->file('w_o_pict_sign_issuer_spv')->move($dest_path, $w_o_pict_sign_issuer_spv);
                        $formWorkOrder->w_o_pict_sign_issuer_spv= $w_o_pict_sign_issuer_spv;
                    }
                }
            }
            $formWorkOrder->w_o_pict_sign_reff_spv= $request->w_o_pict_sign_reff_spv;
            $formWorkOrder->w_o_pict_sign_issuer_spv= $request->w_o_pict_sign_issuer_spv;
            $formWorkOrder->is_active= $request->is_active;
            $formWorkOrder->saveOrFail($request->all());
            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => ' update form work order Berhasil',
            ];    
        } catch (\PDOException $e) {
            $statusCode = 404;
            $response = [
                'error' => true,
                'message' => 'update form work order Gagal',
            ];
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    

    public function rejectWorkOrderSpvIssuer(Request $request)
    {     
        try{
            $workOrder=FormsWorkOrder::where('id','=',$request->id_work_order)->first();
            $workOrder->w_order_status= "Reject by Spv";
            $workOrder->id_issuer_spv= $request->id_issuer_spv;
            $workOrder->rejected_reason= $request->rejected_reason;
            $workOrder->saveOrFail();

            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => 'Penolakan oleh Spv Issuer Berhasil',
            ];    
        } catch (\PDOException $e) {
            $statusCode = 404;
            $response = [
                'error' => true,
                'message' => 'work order Gagal ditolak',
            ];
        } 
        finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function approveWorkOrderSpvIssuer(Request $request)
    {     
        try{
            $workOrder=FormsWorkOrder::where('id','=',$request->id_work_order)->first();
            $workOrder->id_issuer_spv= $request->id_issuer_spv;
            $workOrder->w_order_status= "Waiting Planner Approval";
            $workOrder->saveOrFail();

            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => 'approve oleh Spv Issuer Berhasil',
            ];    
        } catch (\PDOException $e) {
            $statusCode = 404;
            $response = [
                'error' => true,
                'message' => 'approve work order Gagal',
            ];
        } 
        finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function approveWorkOrderPlanner(Request $request)
    {     
        try{
            $workOrder=FormsWorkOrder::where('id','=',$request->id_work_order)->first();
            $workOrder->w_order_status= "Waiting PIC Action Plan";
            $workOrder->saveOrFail();

            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => 'approve oleh PLanner Berhasil',
            ];    
        } catch (\PDOException $e) {
            $statusCode = 404;
            $response = [
                'error' => true,
                'message' => 'approve work order Gagal',
            ];
        } 
        finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    

    public function rejectWorkOrderPlanner(Request $request)
    {     
        try{
            $workOrder=FormsWorkOrder::where('id','=',$request->id_work_order)->first();
            $workOrder->w_order_status= "Reject by Planner";
            $workOrder->rejected_reason= $request->rejected_reason;
            $workOrder->saveOrFail();

            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => 'Penolakan oleh Spv Issuer Berhasil',
            ];    
        } catch (\PDOException $e) {
            $statusCode = 404;
            $response = [
                'error' => true,
                'message' => 'work order Gagal ditolak',
            ];
        } 
        finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }
}
