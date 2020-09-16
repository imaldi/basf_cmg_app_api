<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FormsWorkOrder;
use App\Models\MasterDepartment;
use App\Models\MasterLocation;
use App\Models\MScoringWorkOrder;
use App\Models\FormsResponseWorkOrder;
use App\Models\EmployeePrivilege;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public $successStatus = 200;
    protected $imageFormsWorkOrder = '/images/forms';

    public function createFormWorkOrder(Request $request)
    {     
        try{
            $formWorkOrder= new FormsWorkOrder();
            $formWorkOrder->id_issuer_submit= $request->id_issuer_submit;
            $formWorkOrder->id_dept_submitting= $request->id_dept_submitting;
            $formWorkOrder->id_location= $request->id_location;
            $formWorkOrder->w_order_category= $request->w_order_category;
            $formWorkOrder->w_order_location= $request->w_order_location;
            $formWorkOrder->tag_number= $request->tag_number;
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
            // $formWorkOrder->id_issuer_spv= $request->id_issuer_spv;
            // $formWorkOrder->id_reffered_dept_spv= $request->id_reffered_dept_spv;
            // $formWorkOrder->implement_date= $request->implement_date;
            // $formWorkOrder->reschedule_date= $request->reschedule_date;
            // $formWorkOrder->relevant_area= $request->relevant_area;
            // $formWorkOrder->cost_classification= $request->cost_classification;
            // $formWorkOrder->w_o_pict_sign_issuer_spv= $request->w_o_pict_sign_issuer_spv;
            // $formWorkOrder->w_o_pict_sign_reff_spv= $request->w_o_pict_sign_reff_spv;
            
            $formWorkOrder->saveOrFail($request->all());

            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => ' tambah form work order Berhasil',
            ];    
        } catch (\PDOException $e) {
            $statusCode = 404;
            $response = [
                'error' => true,
                'message' => $e->getMessage(),
            ];    
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
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
            $formWorkOrder->tag_number= $request->tag_number;
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
        } catch (Exception $ex) {
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
        } catch (Exception $ex) {
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
        } catch (Exception $ex) {
            $statusCode = 404;
            $response = [
                'error' => true,
                'message' => 'update form work order Gagal',
            ];
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function getProfileEmployee($idEmployee)
    {
        try{
            $dataEmployee= DB::table('m_employee')
                        ->join('m_employee_group','m_employee_group.id','m_employee.id_employee_group')
                        ->select('m_employee.id as id','m_employee_group.e_group_name','m_employee.employee_name','m_employee.nik',
                                'm_employee.email','m_employee.phone_number','m_employee.is_active', 'm_employee_group.id as id_employee_group')
                        ->where('m_employee.id',$idEmployee)
                        ->first();
            
            if($dataEmployee){
                $dataEmployeePrivilege = EmployeePrivilege::join('employee_user_permission','employee_user_permission.id','m_employee_privilege.id_e_u_permission')
                ->select('m_employee_privilege.id_employee_group', 'employee_user_permission.name as permission_name')
                ->where('m_employee_privilege.id_employee_group', $dataEmployee->id_employee_group)->get();
                $dataEmployee->employee_permissions = $dataEmployeePrivilege;
                $statusCode = 200;
                $response = [
                    'message' => ' tampilkan data Berhasil',
                    'dataProfilEmployee' => [$dataEmployee],
                ];
            }else{
                $statusCode = 404;
                $response = [
                'message' => ' data kosong',
                ];
            }

        }catch (Exception $ex) {
            $statusCode = 404;
            $response = [
                'error' => true,
                'message' => 'update form work order Gagal',
            ];
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function updateProfileEmployee(Request $request, $idEmployee)
    {     
        try{
            $employee=MasterEmployee::where('id','=',$idEmployee)->first();
            $employee->employee_name= $request->employee_name;
            $employee->username= $request->username;
            $employee->email= $request->email;
            $employee->nik= $request->nik;
            $employee->birth_date= $request->birth_date;
            $employee->phone_number= $request->phone_number;
            $employee->id_department= $request->id_department;
            $employee->saveOrFail($request->all());

            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => 'update profil Berhasil',
            ];    
        } catch (Exception $ex) {
            $statusCode = 404;
            $response = [
                'error' => true,
                'message' => 'update profil Gagal',
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
        } catch (Exception $ex) {
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
        } catch (Exception $ex) {
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
        } catch (Exception $ex) {
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
        } catch (Exception $ex) {
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

    public function createFormsResponseWorkOrder(Request $request)
    {     
        try{
            $responseFormWorkOrder= new FormsResponseWorkOrder();
            $responseFormWorkOrder->id_work_order= $request->id_work_order;
            $responseFormWorkOrder->id_allocated_worker= $request->id_allocated_worker;
            $responseFormWorkOrder->id_work_checker= $request->id_work_checker;
            $responseFormWorkOrder->id_work_tester= $request->id_work_tester;
            $responseFormWorkOrder->id_tester_dept= $request->id_tester_dept;
            $responseFormWorkOrder->id_user_confirm= $request->id_user_confirm;
            $responseFormWorkOrder->tag_number= $request->tag_number;
            $responseFormWorkOrder->worker_action= $request->worker_action;
            $responseFormWorkOrder->start_time= $request->start_time;
            $responseFormWorkOrder->finish_time= $request->finish_time;
            $responseFormWorkOrder->work_duration= $request->work_duration;
            if ($request->hasFile('worker_sign')) {
                if ($request->file('worker_sign')->isValid()) {
                    $file_ext        = $request->file('worker_sign')->getClientOriginalExtension();
                    $file_size       = filesize($request->file('worker_sign'));
                    $allow_file_exts = array('jpeg', 'jpg', 'png');
                    $max_file_size   = 1024 * 1024 * 10;
                    if (in_array(strtolower($file_ext), $allow_file_exts) && ($file_size <= $max_file_size)) {
                        $dest_path     = base_path(). $this->imageFormsWorkOrder;
                        $file_name     = preg_replace('/\\.[^.\\s]{3,4}$/', '', $request->file('worker_sign')->getClientOriginalName());
                        $file_name     = str_replace(' ', '-', $file_name);
                        $work_order_before_pict ="response-work-order ". $file_name  . '.' . $file_ext;
                        // move file to serve directory
                        $request->file('worker_sign')->move($dest_path, $work_order_before_pict);

                        $responseFormWorkOrder->worker_sign= $work_order_before_pict;
                    }
                }
            }

            $responseFormWorkOrder->saveOrFail($request->all());

            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => ' tambah form work order Berhasil',
            ];    
        } catch (\PDOException $e) {
            $statusCode = 404;
            $response = [
                'error' => true,
                'message' => $e->getMessage(),
            ];    
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }


}