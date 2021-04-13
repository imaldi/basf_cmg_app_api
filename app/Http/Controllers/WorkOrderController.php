<?php

namespace App\Http\Controllers;

use App\Models\FormWorkOrder;
use App\Models\MasterDepartment;
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

    public function profile()
    {
        $employee = Auth::user();
        return response()->json(['user' => $employee], 200);
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



    public function createFormWorkOrder(Request $request)
    {     
        // $statusCode = 500;
        //     $response=[];
        try{
            //get employee
            $employee = Auth::user();
            // $employee = User::find($user->id);

            

            // $formWorkOrder= new FormWorkOrder;
            $date = Carbon::now();
            $date->toDateTimeString();
            $formWorkOrder = FormWorkOrder::create([
                'wo_name' => 'test nama wo',
                'wo_issuer_id' => $employee->id,
                'wo_spv_issuer_id' => 
                1, 
                // $employee->department()->user()->where('is_spv',1)->first(),
                'wo_date_issuer_submit' => $date,
                'wo_category' => $request->input('wo_category'),
                'wo_issuer_dept' => $request->input('emp_employee_department_id'),
                'wo_location_id' => 1, 
                // $employee->department()->location()->get(),
                'wo_location_detail' => $request->input('location_detail'),
                'wo_tag_no' => $request->input('wo_tag_no'),
                'wo_issuer_attachment' => $request->input('wo_issuer_attachment')
            ]);

            // dd($formWorkOrder);
            // $formWorkOrder->id_issuer_id= $employee->id;
            //SPV Issuer => Cari user dengan departement yang = user ini, yang mana memiliki group id spv work order
            
            // $formWorkOrder->id_dept_submitting= $request->id_dept_submitting;
            // $formWorkOrder->id_location= $request->id_location;
            // $formWorkOrder->w_order_category= $request->w_order_category;
            // $formWorkOrder->w_order_location= $request->w_order_location;
            // if($request->tag_number){
            //     $formWorkOrder->tag_number= $request->tag_number;
            // }
            // if($request->w_order_desc){
            //     $formWorkOrder->w_order_desc= $request->w_order_desc;
            // }
            // $formWorkOrder->w_o_priority_score= $request->w_o_priority_score;
            // $formWorkOrder->reffered_division= $request->reffered_division;
            // $formWorkOrder->id_emergency= $request->id_emergency;
            // $formWorkOrder->id_ranking_customer= $request->id_ranking_customer;
            // $formWorkOrder->id_equipment_criteria= $request->id_equipment_criteria;
            // if ($request->hasFile('w_o_pict_before')) {
            //     if ($request->file('w_o_pict_before')->isValid()) {
            //         $file_ext        = $request->file('w_o_pict_before')->getClientOriginalExtension();
            //         $file_size       = filesize($request->file('w_o_pict_before'));
            //         $allow_file_exts = array('jpeg', 'jpg', 'png');
            //         $max_file_size   = 1024 * 1024 * 10;
            //         if (in_array(strtolower($file_ext), $allow_file_exts) && ($file_size <= $max_file_size)) {
            //             $dest_path     = base_path(). $this->imageFormsWorkOrder;
            //             $file_name     = preg_replace('/\\.[^.\\s]{3,4}$/', '', $request->file('w_o_pict_before')->getClientOriginalName());
            //             $file_name     = str_replace(' ', '-', $file_name);
            //             $work_order_before_pict ="work-order ". $file_name  . '.' . $file_ext;
            //             // move file to serve directory
            //             $request->file('w_o_pict_before')->move($dest_path, $work_order_before_pict);

            //             $formWorkOrder->w_o_pict_before= $work_order_before_pict;
            //         }
            //     }
            // }

            // if($request->status_action === "Create Draft"){
            //     $formWorkOrder->is_active= null;
            // } else if ( $request->status_action ==="Submit Form"){
            //     $formWorkOrder->is_active= 1;
            //     $formWorkOrder->w_order_status= "Waiting Spv Approval";
            // }
            // // $formWorkOrder->id_issuer_spv= $request->id_issuer_spv;
            // // $formWorkOrder->id_reffered_dept_spv= $request->id_reffered_dept_spv;
            // // $formWorkOrder->implement_date= $request->implement_date;
            // // $formWorkOrder->reschedule_date= $request->reschedule_date;
            // // $formWorkOrder->relevant_area= $request->relevant_area;
            // // $formWorkOrder->cost_classification= $request->cost_classification;
            // // $formWorkOrder->w_o_pict_sign_issuer_spv= $request->w_o_pict_sign_issuer_spv;
            // // $formWorkOrder->w_o_pict_sign_reff_spv= $request->w_o_pict_sign_reff_spv;
            
            // $formWorkOrder->saveOrFail($request->all());

            // $statusCode = 200;
            // $response = [
            //     'error' => false,
            //     'message' => ' tambah form work order Berhasil',
            //     'form_content' => $formWorkOrder
            // ];    
            // return response()->json([
            //             'statusCode' => $statusCode,
            //             'data' => $response
            //         ]);
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

    public function viewListWorkOrder()
    {
        try{
            $listWorkOrder= array();
            $workOrders= FormsWorkOrder::join('m_employee','m_employee.id','forms_work_order.id_issuer_submit')
            ->select('m_employee.employee_name','forms_work_order.id', 'forms_work_order.id_issuer_submit', 'forms_work_order.id_issuer_spv', 'forms_work_order.id_reffered_dept_spv', 'forms_work_order.id_dept_submitting', 'forms_work_order.id_location',
                     'forms_work_order.id_emergency', 'forms_work_order.id_ranking_customer', 'forms_work_order.id_equipment_criteria', 'forms_work_order.w_order_category', 'forms_work_order.reffered_division', 'forms_work_order.w_order_location', 'forms_work_order.tag_number', 
                     'forms_work_order.w_order_desc', 'forms_work_order.w_order_status', 'forms_work_order.w_o_priority_score', 'forms_work_order.implement_date', 'forms_work_order.reschedule_date', 'forms_work_order.relevant_area', 'forms_work_order.cost_classification',
                     'forms_work_order.w_o_pict_before', 'forms_work_order.w_o_pict_sign_issuer_spv', 'forms_work_order.w_o_pict_sign_reff_spv', 'forms_work_order.is_active', 'forms_work_order.created_at')
            ->where(function($q) {
                $q->where('forms_work_order.is_active', 1)
                    ->orWhereNull('forms_work_order.is_active');
                })
            ->get();
            
            if($workOrders){
                foreach($workOrders as $workOrder){
                    $departmenSubmitter= MasterDepartment::where('id',$workOrder->id_dept_submitting)->first();
                    $locationWorkOrder= MasterLocation::where('id',$workOrder->id_location)->first();
                    $emergency= MScoringWorkOrder::where('id',$workOrder->id_emergency)->first();
                    $rankingCustomer= MScoringWorkOrder::where('id',$workOrder->id_ranking_customer)->first();
                    $equipmentCriteria= MScoringWorkOrder::where('id',$workOrder->id_equipment_criteria)->first();
    
                    if($emergency){
                        $workOrder->emergency = $emergency->priority_variable;
                    }else{
                        $workOrder->emergency = null;
                    }

                    if($rankingCustomer){
                        $workOrder->ranking_customer = $rankingCustomer->priority_variable;
                    }else{
                        $workOrder->ranking_customer = null;
                    }
                    
                    if($equipmentCriteria){
                        $workOrder->equipment_criteria = $equipmentCriteria->priority_variable;
                    }else{
                        $workOrder->equipment_criteria = null;
                    }

                    if($departmenSubmitter){
                        $workOrder->dept_submitter = $departmenSubmitter->dept_name;
                    }else{
                        $workOrder->dept_submitter = null;
                    }
                    if($locationWorkOrder){
                        $workOrder->location_work_order = $locationWorkOrder->location_name;
                    }
                    else{
                        $workOrder->location_work_order = null;
                    }
                    array_push($listWorkOrder,$workOrder);
                }
                $statusCode = 200;
                $response = [
                    'error' => false,
                    'message' => ' seluruh data work order',
                    'dataListWorkOrder' => $listWorkOrder,
                ];
            }else{
                $response = [
                'error' => false,
                'message' => ' data kosong',
                ];
            }
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
