<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterLocation;
use App\Models\MEmployeeGroup;
use App\Models\EmployeePrivilege;
use App\Models\FormsInspH2sConcent;
use App\Models\ContentInspH2sCnct;
use App\Models\MasterEmployee;
use App\Models\FormsInspLadder;
use App\Models\FormsInspFumeHood;
use App\Models\ContentInspFumeHood;
use App\Models\ContentInspSafetyHarnest;
use App\Models\FormsInspSafetyHarnest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmployeeController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public $successStatus = 200;
    
    public function approveFormSafetyHarnest(Request $request)
    {
        try{
            $dt = new Carbon();
            $dt->timezone = 'Asia/Jakarta';
            $approveFormsInspSafetyHarnest = FormsInspSafetyHarnest::find($request->id_form);
            $approveFormsInspSafetyHarnest->id_checker= $request->id_checker;
            $approveFormsInspSafetyHarnest->checker_sign_date= $dt->format('Y-m-d H:i:s');;
            $approveFormsInspSafetyHarnest->saveOrFail();
            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => ' Approve Successfull'
            ];
        }catch (\PDOException $e) {
                $statusCode = 404;
                $response = [
                    'error' => true,
                    'message' => 'apprive form safety harnest Gagal',
                ];
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function saveEditDraftSafetyHarnest(Request $request)
    {     
        try{
            $editFormsInspSafetyHarnest= FormsInspSafetyHarnest::find($request->id_form);
            $editFormsInspSafetyHarnest->description= $request->description;

            if($request->status_action === "Update Draft"){
                $editFormsInspSafetyHarnest->is_active= null;
            } else if ( $request->status_action ==="Submit Form"){
                $editFormsInspSafetyHarnest->is_active= 1;
            }
            $editFormsInspSafetyHarnest->saveOrFail();

            $locationValue = json_decode($request->location);
            foreach($locationValue as $value){
                $editContentInspSafetyHarnest= ContentInspSafetyHarnest::find($value->id);
                $editContentInspSafetyHarnest->id_location= $value->id_location;
                $editContentInspSafetyHarnest->box_condition= $value->box_condition;
                $editContentInspSafetyHarnest->content= $value->content;
                $editContentInspSafetyHarnest->document= $value->document;
                $editContentInspSafetyHarnest->hook_or_carabiner= $value->hook_or_carabiner;
                $editContentInspSafetyHarnest->web_lanyard= $value->web_lanyard;
                $editContentInspSafetyHarnest->rope_lanyard= $value->rope_lanyard;
                $editContentInspSafetyHarnest->shock_absorber_pack= $value->shock_absorber_pack;
                $editContentInspSafetyHarnest->remarks= $value->remarks;
                $editContentInspSafetyHarnest->saveOrFail($request->all());
            }
            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => ' edit form inspection safety harnest Berhasil',
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
    
    public function locationAnswerSafetyHarnest($idForm)
    {
        try{
            $newData = array();
            $dataContentInspSafetyH = ContentInspSafetyHarnest::where('id_insp_sh', $idForm)->get();
            foreach($dataContentInspSafetyH as $safetH){
                $masterLocation = MasterLocation::find($safetH->id_location);
                $safetH->location_name = $masterLocation->location_name;
                array_push($newData, $safetH);
            }
            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => ' seluruh data Safety Harnest',
                'dataContentInspSafetyH' => $newData,
            ];
        }catch (\PDOException $e) {
                $statusCode = 404;
                $response = [
                    'error' => true,
                    'message' => 'update form work order Gagal',
                ];
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function getAllSafetyHarnest()
    {
        try{
            $listDataSafetyHarnest= array();
            $dataSafetyHarnest= FormsInspSafetyHarnest::join('m_employee','m_employee.id','forms_insp_safety_h.id_inspector')
            ->join('m_department','m_department.id','forms_insp_safety_h.id_department')
            ->select('forms_insp_safety_h.checker_sign_pict', 'forms_insp_safety_h.created_at', 'forms_insp_safety_h.description', 'forms_insp_safety_h.id_checker', 'forms_insp_safety_h.id_inspector', 
                     'forms_insp_safety_h.id_department', 'm_employee.employee_name as inspector_name', 'forms_insp_safety_h.id as id_form', 'm_department.dept_name', 'forms_insp_safety_h.is_active')
            ->where(function($q) {
                $q->where('forms_insp_safety_h.is_active', 1)
                    ->orWhereNull('forms_insp_safety_h.is_active');
                })
            ->get();
            
            if($dataSafetyHarnest){
                foreach($dataSafetyHarnest as $safetyHarnest){
                    if($safetyHarnest->id_checker != null){
                        $dataChecker = MasterEmployee::find($safetyHarnest->id_checker);
                        $safetyHarnest->checker_name = $dataChecker->employee_name;
                    } else {
                        $safetyHarnest->checker_name = null;
                    } 

                    array_push($listDataSafetyHarnest, $safetyHarnest);
                }
                $statusCode = 200;
                $response = [
                    'error' => false,
                    'message' => ' seluruh data SafetyHarnest',
                    'dataListSafetyHarnest' => $listDataSafetyHarnest,
                ];
            }else{
                $statusCode = 404;
                $response = [
                'error' => false,
                'message' => 'data kosong',
                ];
            }
        } catch (\PDOException $e) {
            $statusCode = 404;
            $response = [
                'error' => true,
                'message' => 'Gagal mengambil data',
            ];
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function createDraftInsSafetyHarnest(Request $request)
    {     
        try{
            $createFormsInspSafetyHarnest= new FormsInspSafetyHarnest();
            $createFormsInspSafetyHarnest->id_inspector= $request->id_inspector;
            $createFormsInspSafetyHarnest->id_department= $request->id_department;
            if($request->description){
                $createFormsInspSafetyHarnest->description= $request->description;
            }
            if($request->status_action === "Create Draft"){
                $createFormsInspSafetyHarnest->is_active= null;
            } else if ( $request->status_action ==="Submit Form"){
                $createFormsInspSafetyHarnest->is_active= 1;
            }
            $createFormsInspSafetyHarnest->saveOrFail($request->all());

            $locationValue = json_decode($request->location);
            foreach($locationValue as $value){
                $createContentInspSafetyHarnest= new ContentInspSafetyHarnest();
                $createContentInspSafetyHarnest->id_insp_sh= $createFormsInspSafetyHarnest->id;
                $createContentInspSafetyHarnest->id_location= $value->id_location;
                $createContentInspSafetyHarnest->box_condition= $value->box_condition;
                $createContentInspSafetyHarnest->content= $value->content;
                $createContentInspSafetyHarnest->document= $value->document;
                $createContentInspSafetyHarnest->hook_or_carabiner= $value->hook_or_carabiner;
                $createContentInspSafetyHarnest->web_lanyard= $value->web_lanyard;
                $createContentInspSafetyHarnest->rope_lanyard= $value->rope_lanyard;
                $createContentInspSafetyHarnest->shock_absorber_pack= $value->shock_absorber_pack;
                $createContentInspSafetyHarnest->remarks= $value->remarks;
                $createContentInspSafetyHarnest->saveOrFail($request->all());
            }
            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => ' tambah form inspection safety harnest Berhasil',
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

    public function approveFormFumeHood(Request $request)
    {
        try{
            $dt = new Carbon();
            $dt->timezone = 'Asia/Jakarta';
            $approveFormsInspFumeHood = FormsInspFumeHood::find($request->id_form);
            $approveFormsInspFumeHood->id_checker= $request->id_checker;
            $approveFormsInspFumeHood->checker_sign_date= $dt->format('Y-m-d H:i:s');;
            $approveFormsInspFumeHood->saveOrFail();
            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => ' Approve Successfull'
            ];
        }catch (\PDOException $e) {
                $statusCode = 404;
                $response = [
                    'error' => true,
                    'message' => 'update form work order Gagal',
                ];
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function getAllFumeHood()
    {
        try{
            $dataFumeHood= FormsInspFumeHood::join('m_employee','m_employee.id','forms_insp_fume_hood.id_inspector')
            ->join('m_department','m_department.id','m_employee.id_department')
            ->select('m_department.dept_name', 'm_employee.employee_name as inspected_name', 'forms_insp_fume_hood.id as id_form', 'forms_insp_fume_hood.checker_sign_date', 'forms_insp_fume_hood.created_at', 
            'forms_insp_fume_hood.id_checker', 'forms_insp_fume_hood.id_inspector', 
            'forms_insp_fume_hood.is_active', 'forms_insp_fume_hood.description')
            ->where(function($q) {
                $q->where('forms_insp_fume_hood.is_active', 1)
                    ->orWhereNull('forms_insp_fume_hood.is_active');
                })
            ->get();
            
            if($dataFumeHood){
                $statusCode = 200;
                $response = [
                    'error' => false,
                    'message' => ' seluruh data Fume Hood',
                    'listFumeHood' => $dataFumeHood,
                ];
            }else{
                $statusCode = 404;
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

    public function saveEditInsFumeHood(Request $request)
    {     
        try{
            $editFormsInspFumeHood= FormsInspFumeHood::find($request->id_form);
            $editFormsInspFumeHood->id_inspector= $request->id_inspector;
            $editFormsInspFumeHood->description= $request->description;
            if($request->status_action === "Create Draft"){
                $editFormsInspFumeHood->is_active= null;
            } else if ( $request->status_action ==="Submit Form"){
                $editFormsInspFumeHood->is_active= 1;
            }
            $editFormsInspFumeHood->saveOrFail($request->all());

            $locationValue = json_decode($request->location);
            foreach($locationValue as $value){
                $editContentInspFumeHood= ContentInspFumeHood::find($value->id_location_answer_fume_hood);
                $editContentInspFumeHood->id_location= $value->id_location;
                $editContentInspFumeHood->opening_height= $value->opening_height;
                $editContentInspFumeHood->a_f_standart= $value->a_f_standart;
                $editContentInspFumeHood->a_f_results= $value->a_f_results;
                $editContentInspFumeHood->remarks= $value->remarks;
                $editContentInspFumeHood->saveOrFail($request->all());
            }
            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => ' edit form inspection fume hood Berhasil',
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

    public function createDraftInsFumeHood(Request $request)
    {     
        try{
            $createFormsInspFumeHood= new FormsInspFumeHood();
            $createFormsInspFumeHood->id_inspector= $request->id_inspector;
            if($request->description){
                $createFormsInspFumeHood->description= $request->description;
            }
            if($request->status_action === "Create Draft"){
                $createFormsInspFumeHood->is_active= null;
            } else if ( $request->status_action ==="Submit Form"){
                $createFormsInspFumeHood->is_active= 1;
            }
            $createFormsInspFumeHood->saveOrFail($request->all());

            $locationValue = json_decode($request->location);
            foreach($locationValue as $value){
                $createContentInspFumeHood= new ContentInspFumeHood();
                $createContentInspFumeHood->id_insp_f_hood= $createFormsInspFumeHood->id;
                $createContentInspFumeHood->id_location= $value->id_location;
                $createContentInspFumeHood->opening_height= $value->opening_height;
                $createContentInspFumeHood->a_f_standart= $value->a_f_standart;
                $createContentInspFumeHood->a_f_results= $value->a_f_results;
                $createContentInspFumeHood->remarks= $value->remarks;
                $createContentInspFumeHood->saveOrFail($request->all());
            }
            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => ' tambah form inspection fume hood Berhasil',
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

    public function getAllLadder()
    {
        try{
            $dataLadder= FormsInspLadder::join('m_employee','m_employee.id','forms_insp_ladder.id_supervisor')
            ->join('m_department','m_department.id','m_employee.id_department')
            ->join('m_location','m_location.id','forms_insp_ladder.id_location')
            ->select('m_employee.employee_name as inspected_name', 'forms_insp_ladder.id as id_form', 'forms_insp_ladder.checker_sign_pict', 'forms_insp_ladder.created_at', 
            'forms_insp_ladder.id_checker', 'm_location.location_name', 'forms_insp_ladder.brand', 'forms_insp_ladder.specification', 'forms_insp_ladder.id_supervisor', 
            'forms_insp_ladder.is_active', 'forms_insp_ladder.id_location', 'forms_insp_ladder.upper_condition', 'forms_insp_ladder.bottom_condition', 'forms_insp_ladder.fastener_condition', 'forms_insp_ladder.construction_condition'
            , 'forms_insp_ladder.stairs_condition', 'forms_insp_ladder.upper_condition_desc', 'forms_insp_ladder.bottom_condition_desc', 'forms_insp_ladder.fastener_condition_desc', 'forms_insp_ladder.construction_condition_desc', 'forms_insp_ladder.stairs_condition_desc'
            , 'forms_insp_ladder.notes')
            ->where(function($q) {
                $q->where('forms_insp_ladder.is_active', 1)
                    ->orWhereNull('forms_insp_ladder.is_active');
                })
            ->get();
            
            if($dataLadder){
                $statusCode = 200;
                $response = [
                    'error' => false,
                    'message' => ' seluruh data Ladder',
                    'listLadder' => $dataLadder,
                ];
            }else{
                $statusCode = 404;
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

    public function saveEditInsLadder(Request $request)
    {     
        try{
            $editFormsInspLadder= FormsInspLadder::find($request->id_form);
            $editFormsInspLadder->id_supervisor= $request->id_supervisor;
            $editFormsInspLadder->id_location= $request->id_location;
            $editFormsInspLadder->brand= $request->brand;
            $editFormsInspLadder->specification= $request->specification;
            $editFormsInspLadder->upper_condition= $request->upper_condition;
            $editFormsInspLadder->bottom_condition= $request->bottom_condition;
            $editFormsInspLadder->fastener_condition= $request->fastener_condition;
            $editFormsInspLadder->construction_condition= $request->construction_condition;
            $editFormsInspLadder->stairs_condition= $request->stairs_condition;
            $editFormsInspLadder->notes= $request->notes;

            if($request->status_action === "Create Draft"){
                $editFormsInspLadder->is_active= null;
            } else if ( $request->status_action ==="Submit Form"){
                $editFormsInspLadder->is_active= 1;
            }

            if($request->upper_condition_desc){
                $editFormsInspLadder->upper_condition_desc= $request->upper_condition_desc;
            }
            if($request->bottom_condition_desc){
                $editFormsInspLadder->bottom_condition_desc= $request->bottom_condition_desc;
            }
            if($request->fastener_condition_desc){
                $editFormsInspLadder->fastener_condition_desc= $request->fastener_condition_desc;
            }
            if($request->construction_condition_desc){
                $editFormsInspLadder->construction_condition_desc= $request->construction_condition_desc;
            }
            if($request->stairs_condition_desc){
                $editFormsInspLadder->stairs_condition_desc= $request->stairs_condition_desc;
            }

            $editFormsInspLadder->saveOrFail($request->all());

            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => ' tambah form inspection h2s Berhasil',
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

    public function createDraftLadder(Request $request)
    {     
        try{
            $createFormsInspLadder= new FormsInspLadder();
            $createFormsInspLadder->id_supervisor= $request->id_supervisor;
            $createFormsInspLadder->id_location= $request->id_location;
            if($request->brand){
                $createFormsInspLadder->brand= $request->brand;
            }
            if($request->specification){
                $createFormsInspLadder->specification= $request->specification;
            }
            $createFormsInspLadder->upper_condition= $request->upper_condition;
            $createFormsInspLadder->bottom_condition= $request->bottom_condition;
            $createFormsInspLadder->fastener_condition= $request->fastener_condition;
            $createFormsInspLadder->construction_condition= $request->construction_condition;
            $createFormsInspLadder->stairs_condition= $request->stairs_condition;
            if($request->notes){
                $createFormsInspLadder->notes= $request->notes;
            }

            if($request->status_action === "Create Draft"){
                $createFormsInspLadder->is_active= null;
            } else if ( $request->status_action ==="Submit Form"){
                $createFormsInspLadder->is_active= 1;
            }

            if($request->upper_condition_desc){
                $createFormsInspLadder->upper_condition_desc= $request->upper_condition_desc;
            }
            if($request->bottom_condition_desc){
                $createFormsInspLadder->bottom_condition_desc= $request->bottom_condition_desc;
            }
            if($request->fastener_condition_desc){
                $createFormsInspLadder->fastener_condition_desc= $request->fastener_condition_desc;
            }
            if($request->construction_condition_desc){
                $createFormsInspLadder->construction_condition_desc= $request->construction_condition_desc;
            }
            if($request->stairs_condition_desc){
                $createFormsInspLadder->stairs_condition_desc= $request->stairs_condition_desc;
            }

            $createFormsInspLadder->saveOrFail($request->all());

            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => ' tambah form inspection h2s Berhasil',
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

    public function approveLadder(Request $request)
    {
        try{
            $dt = new Carbon();
            $dt->timezone = 'Asia/Jakarta';
            $approveFormsInspLadder = FormsInspLadder::find($request->id_form);
            $approveFormsInspLadder->id_checker= $request->id_checker;
            $approveFormsInspLadder->saveOrFail();
            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => ' Approve Successfull'
            ];
        }catch (\PDOException $e) {
                $statusCode = 404;
                $response = [
                    'error' => true,
                    'message' => 'update form work order Gagal',
                ];
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function approveFormH2s(Request $request)
    {
        try{
            $dt = new Carbon();
            $dt->timezone = 'Asia/Jakarta';
            $approveFormsInspH2sConcent = FormsInspH2sConcent::find($request->id_form);
            $approveFormsInspH2sConcent->id_checker= $request->id_checker;
            $approveFormsInspH2sConcent->checker_sign_date= $dt->format('Y-m-d H:i:s');;
            $approveFormsInspH2sConcent->saveOrFail();
            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => ' Approve Successfull'
            ];
        }catch (\PDOException $e) {
                $statusCode = 404;
                $response = [
                    'error' => true,
                    'message' => 'update form work order Gagal',
                ];
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }
    
    public function saveEditInsH2s(Request $request)
    {     
        try{
            $editFormsInspH2sConcent= FormsInspH2sConcent::find($request->id_form);
            $editFormsInspH2sConcent->description= $request->description;

            if($request->status_action === "Update Draft"){
                $editFormsInspH2sConcent->is_active= null;
            } else if ( $request->status_action ==="Submit Form"){
                $editFormsInspH2sConcent->is_active= 1;
            }
            $editFormsInspH2sConcent->saveOrFail();

            $locationValue = json_decode($request->location);
            foreach($locationValue as $value){
                $editContentInspH2sCnct= ContentInspH2sCnct::find($value->id_location_answer_h2s);
                $editContentInspH2sCnct->check_05_h2s_percentage= $value->check_05_h2s_percentage;
                $editContentInspH2sCnct->check_10_h2s_percentage= $value->check_10_h2s_percentage;
                $editContentInspH2sCnct->check_lel_percentage= $value->check_lel_percentage;
                $editContentInspH2sCnct->remarks= $value->remarks;
                $editContentInspH2sCnct->saveOrFail();
            }
            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => ' tambah form inspection h2s Berhasil',
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

    public function locationAnswerFumeHood($idForm)
    {
        try{
            $dataLocationAnswerFumeHood = ContentInspFumeHood::join('m_location','m_location.id','content_insp_fume_hood.id_location')
            ->select('m_location.location_name', 'content_insp_fume_hood.id as id_location_answer_fume_hood', 'content_insp_fume_hood.id_location', 'content_insp_fume_hood.opening_height', 'content_insp_fume_hood.a_f_standart', 'content_insp_fume_hood.a_f_results'
                    , 'content_insp_fume_hood.remarks')
            ->where('content_insp_fume_hood.id_insp_f_hood', $idForm)->get();
            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => ' seluruh data H2S',
                'dataLocationAnswerFumeHood' => $dataLocationAnswerFumeHood,
            ];
        }catch (\PDOException $e) {
                $statusCode = 404;
                $response = [
                    'error' => true,
                    'message' => 'update form work order Gagal',
                ];
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function locationAnswerH2s($idForm)
    {
        try{
            $dataContentInspH2sCnct = ContentInspH2sCnct::join('m_location','m_location.id','content_insp_h2s_cnct.id_location')
            ->select('m_location.location_name', 'content_insp_h2s_cnct.id as id_location_answer_h2s', 'content_insp_h2s_cnct.id_location', 'content_insp_h2s_cnct.check_05_h2s_percentage', 'content_insp_h2s_cnct.id_insp_h2s_cnct', 'content_insp_h2s_cnct.check_10_h2s_percentage'
                    , 'content_insp_h2s_cnct.check_lel_percentage', 'content_insp_h2s_cnct.remarks')
            ->where('content_insp_h2s_cnct.id_insp_h2s_cnct', $idForm)->get();
            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => ' seluruh data H2S',
                'dataLocationAnswerH2s' => $dataContentInspH2sCnct,
            ];
        }catch (\PDOException $e) {
                $statusCode = 404;
                $response = [
                    'error' => true,
                    'message' => 'update form work order Gagal',
                ];
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function getAllH2s()
    {
        try{
            $listDataH2s= array();
            $dataH2s= FormsInspH2sConcent::join('m_employee','m_employee.id','forms_insp_h2s_concent.id_inspector')
            ->join('m_department','m_department.id','m_employee.id_department')
            ->select('forms_insp_h2s_concent.checker_sign_pict', 'forms_insp_h2s_concent.created_at', 'forms_insp_h2s_concent.description', 'forms_insp_h2s_concent.id_checker', 'forms_insp_h2s_concent.id_inspector', 'm_employee.employee_name as inspector_name','forms_insp_h2s_concent.id as id_form', 'm_department.dept_name', 'forms_insp_h2s_concent.is_active')
            ->where(function($q) {
                $q->where('forms_insp_h2s_concent.is_active', 1)
                    ->orWhereNull('forms_insp_h2s_concent.is_active');
                })
            ->get();
            
            if($dataH2s){
                foreach($dataH2s as $h2s){
                    if($h2s->id_checker != null){
                        $dataChecker = MasterEmployee::find($h2s->id_checker);
                        $h2s->checker_name = $dataChecker->employee_name;
                    } else {
                        $h2s->checker_name = null;
                    }
                    array_push($listDataH2s, $h2s);
                }
                $statusCode = 200;
                $response = [
                    'error' => false,
                    'message' => ' seluruh data H2S',
                    'dataListH2s' => $listDataH2s,
                ];
            }else{
                $statusCode = 404;
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

    public function createDraftInsH2s(Request $request)
    {     
        try{
            $createFormsInspH2sConcent= new FormsInspH2sConcent();
            $createFormsInspH2sConcent->id_inspector= $request->id_inspector;
            if($request->description){
                $createFormsInspH2sConcent->description= $request->description;
            }
            if($request->status_action === "Create Draft"){
                $createFormsInspH2sConcent->is_active= null;
            } else if ( $request->status_action ==="Submit Form"){
                $createFormsInspH2sConcent->is_active= 1;
            }
            $createFormsInspH2sConcent->saveOrFail($request->all());

            $locationValue = json_decode($request->location);
            foreach($locationValue as $value){
                $createContentInspH2sCnct= new ContentInspH2sCnct();
                $createContentInspH2sCnct->id_insp_h2s_cnct= $createFormsInspH2sConcent->id;
                $createContentInspH2sCnct->id_location= $value->id_location;
                $createContentInspH2sCnct->check_05_h2s_percentage= $value->check_05_h2s_percentage;
                $createContentInspH2sCnct->check_10_h2s_percentage= $value->check_10_h2s_percentage;
                $createContentInspH2sCnct->check_lel_percentage= $value->check_lel_percentage;
                $createContentInspH2sCnct->remarks= $value->remarks;
                $createContentInspH2sCnct->saveOrFail($request->all());
            }
            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => ' tambah form inspection h2s Berhasil',
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

    

    // public function getProfileEmployee($idEmployee)
    // {
    //     try{
    //         $dataEmployee= DB::table('m_employee')
    //                     ->join('m_employee_group','m_employee_group.id','m_employee.id_employee_group')
    //                     ->join('m_department','m_department.id','m_employee.id_department')
    //                     ->select('m_employee.id as id','m_employee_group.e_group_name','m_employee.employee_name','m_employee.nik',
    //                             'm_department.dept_name', 'm_employee.id_department', 'm_employee.email','m_employee.phone_number','m_employee.is_active', 'm_employee_group.id as id_employee_group')
    //                     ->where('m_employee.id',$idEmployee)
    //                     ->first();
            
    //         if($dataEmployee){
    //             $dataEmployeePrivilege = EmployeePrivilege::join('employee_user_permission','employee_user_permission.id','m_employee_privilege.id_e_u_permission')
    //             ->select('m_employee_privilege.id_employee_group', 'employee_user_permission.name as permission_name')
    //             ->where('m_employee_privilege.id_employee_group', $dataEmployee->id_employee_group)->get();
    //             $dataEmployee->employee_permissions = $dataEmployeePrivilege;
    //             $statusCode = 200;
    //             $response = [
    //                 'message' => ' tampilkan data Berhasil',
    //                 'dataProfilEmployee' => [$dataEmployee],
    //             ];
    //         }else{
    //             $statusCode = 404;
    //             $response = [
    //             'message' => ' data kosong',
    //             ];
    //         }

    //     }catch (\PDOException $e) {
    //         $statusCode = 404;
    //         $response = [
    //             'error' => true,
    //             'message' => 'update form work order Gagal',
    //         ];
    //     } finally {
    //         return response($response,$statusCode)->header('Content-Type','application/json');
    //     }
    // }

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
        } catch (\PDOException $e) {
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

}