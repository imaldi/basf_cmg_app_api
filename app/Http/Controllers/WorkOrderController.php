<?php

namespace App\Http\Controllers;

use App\Models\FormWorkOrder;
use App\Models\MasterDepartment;
use App\Models\MEmployeeGroup;
use App\Models\MasterLocation;
use App\Http\Resources\FormWorkOrderResource;
use App\Http\Resources\EmployeeGroupResource;
use App\Http\Resources\EmployeeResource;
use Auth;
use Config;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

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

    public function createFormWorkOrder(Request $request)
    {     
        try{
            //get employee
            $employee = Auth::user();
            $this->validate($request, [
                'wo_form_status' => [
                    'required',
                    'integer',
                    Rule::in(['1', '2']),
                ],
                'wo_c_emergency' => 'required|integer|between:1,4',
                'wo_c_ranking_cust'=> 'required|integer|between:1,4',
                'wo_c_equipment_criteria' => 'required|integer|between:1,4',
                'wo_image' => 'file'
            ]);

            
            
            $date = Carbon::now()
            // ->format('Y-m-d')
            ;
            $date->toDateTimeString();
            $department = $employee->department()->first();
            $departmentId = $employee->emp_employee_department_id;
            //Ini saring berdasarkan group(role)
            $wo_issuer_spv_id = User::role('Work Order - SPV')->where('emp_employee_department_id',$departmentId)->first()->id;
            $departmentAbr = substr(strtoupper($department->dept_name),0,3);
            $formStatus = (int)$request->input('wo_form_status');
            $emergency = (int)$request->input('wo_c_emergency');
            $ranking_cust = (int)$request->input('wo_c_ranking_cust');
            $equipment_criteria = (int)$request->input('wo_c_equipment_criteria');
            $recommendedDays = FormWorkOrder::recommendedDays($emergency,$ranking_cust,$equipment_criteria);
            
            // recommendedDays($emergency,$equipment_criteria,$equipment_criteria);
            $date_recommendation = date('Y-m-d', strtotime("+".$recommendedDays." days"));
            $formID = FormWorkOrder::max('id') + 1;
            $formIDFormatted = str_pad($formID, 4, '0', STR_PAD_LEFT);
                
            if($request->file('wo_image')){
                $name = time().$request->file('wo_image')->getClientOriginalName();
                $request->file('wo_image')->move('uploads/work_order',$name);
                $formWorkOrder = FormWorkOrder::create([
                    'wo_name' => 'GU/F/'.$formIDFormatted.'-1/'.$departmentAbr.'/'.$date->month.'/'.$date->year.'/'.'77',
                    'wo_issuer_id' => $employee->id,
                    'wo_spv_issuer_id' => 
                    $wo_issuer_spv_id,
                    //ini kalau mau saring berdasarkan field 'emp_is_spv'
                    // $employee->department()->first()->users()->where('emp_is_spv',1)->first()->id,
                    'wo_date_issuer_submit' => $date,
                    'wo_category' => $request->input('wo_category'),
                    'wo_issuer_dept' => 
                    $departmentId,
                    // $request->input('emp_employee_department_id'),
                    'wo_location_id' => $request->input('wo_location_id'),
                    'wo_reffered_dept' => $request->input('wo_reffered_dept'),
                    'wo_reffered_division' => $request->input('wo_reffered_division'),
                    'wo_description' => $request->input('wo_description'),
                    'wo_location_detail' => $request->input('location_detail'),
                    'wo_tag_no' => $request->input('wo_tag_no'),
                    'wo_issuer_attachment' => $request->input('wo_issuer_attachment'),
                    'wo_form_status' => $formStatus,
                    'wo_date_recomendation' => $date_recommendation,
                    'wo_is_open' => 1,
                    'wo_c_emergency' => $emergency,
                    'wo_c_ranking_cust' => $ranking_cust,
                    'wo_c_equipment_criteria' => $equipment_criteria,
                    'wo_image' => $name
                    //TODO upload file foto
                ]);
            } else {
                $formWorkOrder = FormWorkOrder::create([
                    'wo_name' => 'GU/F/'.$formIDFormatted.'-1/'.$departmentAbr.'/'.$date->month.'/'.$date->year.'/'.'77',
                    'wo_issuer_id' => $employee->id,
                    'wo_spv_issuer_id' => 
                    $wo_issuer_spv_id,
                    //ini kalau mau saring berdasarkan field 'emp_is_spv'
                    // $employee->department()->first()->users()->where('emp_is_spv',1)->first()->id,
                    'wo_date_issuer_submit' => $date,
                    'wo_category' => $request->input('wo_category'),
                    'wo_issuer_dept' => 
                    $departmentId,
                    // $request->input('emp_employee_department_id'),
                    'wo_location_id' => $request->input('wo_location_id'),
                    'wo_reffered_dept' => $request->input('wo_reffered_dept'),
                    'wo_reffered_division' => $request->input('wo_reffered_division'),
                    'wo_description' => $request->input('wo_description'),
                    'wo_location_detail' => $request->input('location_detail'),
                    'wo_tag_no' => $request->input('wo_tag_no'),
                    'wo_issuer_attachment' => $request->input('wo_issuer_attachment'),
                    'wo_form_status' => $formStatus,
                    'wo_date_recomendation' => $date_recommendation,
                    'wo_is_open' => 1,
                    'wo_c_emergency' => $emergency,
                    'wo_c_ranking_cust' => $ranking_cust,
                    'wo_c_equipment_criteria' => $equipment_criteria,
                    // 'wo_image' => $name
                    //TODO upload file foto
                ]);
            }
            
            return response()->json([
                'code' => 200,
                'message' => 'Success Create Data', 
                'data' => 
                $formWorkOrder
                
                ], 200);
        } catch (\PDOException $e) {
            $statusCode = 404;
            $response = [
                'error' => true,
                'message' => $e->getMessage(),
            ];   
            return $response; 
        } 
    }

    public function saveFormWorkOrderDraft(Request $request, $idFormWOrder){
        try{

            $response = null;

        
            //get employee
            $employee = Auth::user();
            $this->validate($request, [
                'wo_form_status' => [
                    'required',
                    'integer',
                    Rule::in(['1', '2', '3','7']),
                ],
                'wo_image' => 'file'
            ]);
            
            $date = Carbon::now()
            // ->format('Y-m-d H:i:s')
            ;
            $date->toDateTimeString();
            $emergency = (int)$request->input('wo_c_emergency');
            $ranking_cust = (int)$request->input('wo_c_ranking_cust');
            $equipment_criteria = (int)$request->input('wo_c_equipment_criteria');
            $recommendedDays = FormWorkOrder::recommendedDays($emergency,$ranking_cust,$equipment_criteria);
            
            // recommendedDays($emergency,$equipment_criteria,$equipment_criteria);
            $date_recommendation = date('Y-m-d', strtotime("+".$recommendedDays." days"));
            // $department = $employee->department()->first();
            // $departmentId = $employee->emp_employee_department_id;
            //Ini saring berdasarkan group(role)
            // $departmentAbr = substr(strtoupper($department->dept_name),0,3);
            // $formStatus = (int)$request->input('wo_form_status');
            // $emergency = (int)$request->input('wo_c_emergency');
            // $ranking_cust = (int)$request->input('wo_c_ranking_cust');
            // $equipment_criteria = (int)$request->input('wo_c_equipment_criteria');
            
            // $recommendedDays = recommendedDays($emergency,$equipment_criteria,$equipment_criteria);
            // $date_recommendation = date('Y-m-d', strtotime("+".$recommendedDays." days"));
                try{
                    $formWorkOrder = FormWorkOrder::findOrFail($idFormWOrder);
                    if($request->file('wo_image')){
                        $name = time().$request->file('wo_image')->getClientOriginalName();
                        $request->file('wo_image')->move('uploads/work_order',$name);
                        $formWorkOrder->update(
                            [
                                $request->except(['wo_image']),
                                'wo_image' => $name,
                                'wo_date_recomendation' => $date_recommendation,
                            ]
                        );
                        return response()->json([
                            'code' => 200,
                            'message' => 'Success Saving Form Update',
                            'data' => 
                            [
                            new FormWorkOrderResource($formWorkOrder),
                            'wo_date_recomendation' => $date_recommendation,
                            ]    
                        ], 200);
                    }
            $formWorkOrder->update(
                    $request->except(['wo_image']),
            );
            return response()->json([
                'code' => 200,
                'message' => 'Success Saving Form Update', 
                'data' => new FormWorkOrderResource($formWorkOrder),
                ], 200);
                } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
                    return response()->json([
                        'code' => 404,
                        'message' => 'Given Work Order Form ID not found', 
                        'data' => []
                        ], 404);
                }
            
        } catch (\PDOException $e) {
            $statusCode = 404;
            $response = [
                'error' => true,
                'message' => $e->getMessage(),
            ];   
            return $response; 
        } 
    }


    public function viewListWorkOrderAsIssuer(Request $request){
        $user = Auth::user();

        // try{
            $formWorkOrder = FormWorkOrder::where('wo_is_open', 1)
            ->where('wo_issuer_id',$user->id)->orderBy($request->query('orderBy'))->get();
            // ->orderBy("wo_form_status")->get()
            ;
            // if($request->input('orderBy') == 1){
            //     $formWorkOrder = 
            // } else if ($request->input('orderBy') == 2 ){
            //     $formWorkOrder = $formWorkOrder->orderBy("wo_date_issuer_submit")->get();
            // } else {
            //     $formWorkOrder = $formWorkOrder->orderBy("id")->get();
            // }

            

            return response()->json([
                'code' => 200,
                'message' => 'Success Get All Data',
                'data' => 
                FormWorkOrderResource::collection($formWorkOrder)
                ]);
        // }catch(){

        // }
    }

    public function viewListWorkOrderAsIssuerSPV(Request $request)
    {
        $user = Auth::user();
        // $isDesc = $request->query('isDesc');
        // $isDescOrderByParam = $isDesc ? "desc" : "asc"; 
        // $groupUser = MEmployeeGroup::where('name','Work Order - SPV')->firstOrFail();
        
        $forms = FormWorkOrder::where('wo_spv_issuer_id', $user->id)->where('wo_is_open', 1)->whereIn('wo_form_status',[1,2,9]);
        if($request->query('orderBy') == 'wo_form_status'){
            $forms = $forms->orderBy($request->query('orderBy'),'desc')->get();
        } else {
            $forms = $forms->orderBy($request->query('orderBy'))->get();
        }
        
        // $groupUser->workOrderFormsOfSpv()->where('wo_is_open', 1)->where('wo_form_status',2)
        // ->get();
        //Note : nanti perlu d sort berdasarkan wo_c_emergency, 
        //       wo_c_ranking_cust, dan wo_c_equipment_criteria => update, sort sesuai wo_date_recomendation
        return response()->json([
            'code' => 200,
            'message' => 'Success Get All Data', 
            'data' => 
                FormWorkOrderResource::collection($forms)
            ], 200);                    
    }

    public function viewListApprovedWorkOrderAsIssuerSPV(Request $request)
    {
        $user = Auth::user();

        // $groupUser = MEmployeeGroup::where('name','Work Order - SPV')->firstOrFail();
        $forms = FormWorkOrder::where('wo_spv_issuer_id', $user->id)->where('wo_is_open', 1)->where('wo_form_status',9)
        ->orderBy($request->query('orderBy'))->get();
        //Note : nanti perlu d sort berdasarkan wo_c_emergency, 
        //       wo_c_ranking_cust, dan wo_c_equipment_criteria => update, sort sesuai wo_date_recomendation
        return response()->json([
            'code' => 200,
            'message' => 'Success Get All Data', 
            'data' => 
                FormWorkOrderResource::collection($forms)
            ], 200); 
    }

    public function viewListWorkOrderAsPlanner(Request $request)
    {
        $user = Auth::user();

        // $groupUser = MEmployeeGroup::where('name','Work Order - Planner')->firstOrFail();
        $forms = FormWorkOrder::where('wo_planner_id', $user->id)->where('wo_is_open', 1)->where('wo_form_status',3)
        ->orderBy($request->query('orderBy'))->get();
        //Note : nanti perlu d sort berdasarkan wo_c_emergency, 
        //       wo_c_ranking_cust, dan wo_c_equipment_criteria => update, sort sesuai wo_date_recomendation
        return response()->json([
            'code' => 200,
            'message' => 'Success Get All Data', 
            'data' => 
                FormWorkOrderResource::collection($forms)
            ], 200);                    
    }

    public function viewListWorkOrderAsPic(Request $request)
    {
        $user = Auth::user();

        // $groupUser = MEmployeeGroup::where('name','Work Order - Planner')->firstOrFail();
        $forms = FormWorkOrder::where('wo_pic_id', $user->id)->where('wo_is_open', 1)->whereIn('wo_form_status',[6,8])
        ->orderBy($request->query('orderBy'))->get();
        //Note : nanti perlu d sort berdasarkan wo_c_emergency, 
        //       wo_c_ranking_cust, dan wo_c_equipment_criteria => update, sort sesuai wo_date_recomendation
        return response()->json([
            'code' => 200,
            'message' => 'Success Get All Data', 
            'data' => 
                FormWorkOrderResource::collection($forms)
            ], 200);                    
    }

    public function viewListApprovedWorkOrderAsPic(Request $request)
    {
        $user = Auth::user();

        // $groupUser = MEmployeeGroup::where('name','Work Order - SPV')->firstOrFail();
        $forms = FormWorkOrder::where('wo_pic_id', $user->id)->where('wo_is_open', 1)->where('wo_form_status',8)
        ->orderBy($request->query('orderBy'))->get();
        //Note : nanti perlu d sort berdasarkan wo_c_emergency, 
        //       wo_c_ranking_cust, dan wo_c_equipment_criteria => update, sort sesuai wo_date_recomendation
        return response()->json([
            'code' => 200,
            'message' => 'Success Get All Data', 
            'data' => 
                FormWorkOrderResource::collection($forms)
            ], 200);                    
    }

    public function viewListWorkOrderAsPicSPV(Request $request)
    {
        $user = Auth::user();

        // $groupUser = MEmployeeGroup::where('name','Work Order - PIC - SPV')->firstOrFail();
        // $formsOfSpv = $groupUser->workOrderFormsOfPicSpv()->where('wo_is_open', 1)
        $formsOfSpv = FormWorkOrder::where('wo_spv_pic_id', $user->id)->where('wo_is_open', 1)->where('wo_form_status',7)
        ->orderBy($request->query('orderBy'))->get();
        //Note : nanti perlu d sort berdasarkan wo_c_emergency, 
        //       wo_c_ranking_cust, dan wo_c_equipment_criteria => update, sort sesuai wo_date_recomendation
        return response()->json([
            'code' => 200,
            'message' => 'Success Get All Data', 
            'data' => 
                FormWorkOrderResource::collection($formsOfSpv)
            ], 200);                    
    }

    public function getOneWorkOrderForm($idFormWOrder){
        try{
            $forms = FormWorkOrder::where('id',$idFormWOrder)->firstOrFail();
        return response()->json([
            'code' => 200,
            'message' => 'Success Get All Data', 
            'data' => [
                new FormWorkOrderResource($forms)
            ]
            ], 200);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given Work Order Form ID not found', 
                'data' => []
                ], 404);
        }
    }

    public function rejectFormWorkOrderAsIssuerSpv(Request $request, $idFormWOrder){
    try{
        $formWorkOrder = FormWorkOrder::findOrFail($idFormWOrder);

        $formWorkOrder->update([
            'wo_reject_reason' => $request->input('wo_reject_reason'),
            'wo_form_status' => 4,
            'wo_is_open' => 0,
        
        ]);
        return response()->json([
            'code' => 200,
            'message' => 'Success Rejecting Form', 
            'data' =>  $formWorkOrder,
            ], 200);
    } catch (\PDOException $e) {
        $statusCode = 404;
        $response = [
            'error' => true,
            'message' => $e->getMessage(),
        ];   
        return $response; 
    } 
}

    public function rejectFormWorkOrderAsPlanner(Request $request, $idFormWOrder){
        try{
            $formWorkOrder = FormWorkOrder::findOrFail($idFormWOrder);

            $formWorkOrder->update([
                'wo_reject_reason' => $request->input('wo_reject_reason'),
                'wo_form_status' => 5,
                'wo_is_open' => 0,
            ]);
            return response()->json([
                'code' => 200,
                'message' => 'Success Rejecting Form', 
                'data' =>  [$formWorkOrder],
                ], 200);
        } catch (\PDOException $e) {
            $statusCode = 404;
            $response = [
                'code' => 404,
                // 'error' => true,
                'message' => $e->getMessage(),
                'data' => []

            ];   
            return $response; 
        } 
    }

    public function approveFormWorkOrderAsIssuerSPV(Request $request, $idFormWOrder){
        try{
            //get employee
            $employee = Auth::user();
            
            $date = Carbon::now();
            $date->toDateTimeString();
                
            $formWorkOrder = FormWorkOrder::findOrFail($idFormWOrder);

            $formWorkOrder->update([
                $request->except([
                    'wo_date_spv_issuer_approve',
                    'wo_form_status'    
                ]),
                'wo_date_spv_issuer_approve' => $date,
                'wo_form_status' => 3,
            ]);
            return response()->json([
                'code' => 200,
                'message' => 'Success Approving Form', 
                'data' =>  $formWorkOrder,
                ], 200);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given Work Order Form ID not found', 
                'data' => []
                ], 404);
        }
    }

    public function approveFormWorkOrderAsIssuerSPVHandOver($idFormWOrder){
        try{
            //get employee
            $employee = Auth::user();
            
            $date = Carbon::now();
            $date->toDateTimeString();
                
            $formWorkOrder = FormWorkOrder::findOrFail($idFormWOrder);

            $formWorkOrder->update([
                //Alasan ?
                'wo_form_status' => 10,
            ]);
            return response()->json([
                'code' => 200,
                'message' => 'Success Approving Form', 
                'data' =>  $formWorkOrder,
                ], 200);
        } catch (\PDOException $e) {
            $statusCode = 404;
            $response = [
                'error' => true,
                'message' => $e->getMessage(),
            ];   
            return $response; 
        } 
    }

    public function approveFormWorkOrderAsPlanner(Request $request, $idFormWOrder){
        try{
            //get employee
            $employee = Auth::user();
            
            $date = Carbon::now();
            $date->toDateTimeString();
                
            $formWorkOrder = FormWorkOrder::findOrFail($idFormWOrder);
            //Buat Validatore belum

            $formWorkOrder->update([
                'wo_date_planner_approve' => $date,
                'wo_pic_id' => $request->input('wo_pic_id'),
                'wo_form_status' => 6,
                'wo_c_cost' => $request->input('wo_c_cost'),
                'wo_date_revision' => $request->input('wo_date_revision'),
            ]);
            return response()->json([
                'code' => 200,
                'message' => 'Success Approving Form', 
                'data' =>  $formWorkOrder,
                ], 200);
        } catch (\PDOException $e) {
            $statusCode = 404;
            $response = [
                'error' => true,
                'message' => $e->getMessage(),
            ];   
            return $response; 
        } 
    }

    public function approveFormWorkOrderAsPic(Request $request, $idFormWOrder){
        try{
            //get employee
            $employee = Auth::user();
            
            $date = Carbon::now();
            $date->toDateTimeString();
                
            $formWorkOrder = FormWorkOrder::findOrFail($idFormWOrder);

            $formWorkOrder->update([
                'wo_date_pic_plan' => $date,
                'wo_form_status' => 7,
                'wo_pic_action_plan' => $request->input('wo_pic_action_plan'),
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Success Approving Form', 
                'data' =>  $formWorkOrder,
                ], 200);
        } catch (\PDOException $e) {
            $statusCode = 404;
            $response = [
                'error' => true,
                'message' => $e->getMessage(),
            ];   
            return $response; 
        } 
    }

    public function approveFormWorkOrderAsPicHandOver(Request $request, $idFormWOrder){
        try{
            //get employee
            $employee = Auth::user();
            
            $date = Carbon::now();
            $date->toDateTimeString();
                
            // $formWorkOrder = FormWorkOrder::findOrFail($idFormWOrder);

            // $formWorkOrder->update([
            //     'wo_date_pic_plan' => $date,
            //     'wo_form_status' => 9,
            //     //Tindakan ?
            //     //Jam Mulai ?
            //     //Jam Selesai ?
            //     'wo_pic_duration' => $request->input('wo_pic_duration'),
            //     'wo_pic_team' => $request->input('wo_pic_team'),
            // ]);
            
            // return response()->json([
            //     'code' => 200,
            //     'message' => 'Success Approving Form', 
            //     'data' =>  $formWorkOrder,
            //     ], 200);

            try{
                $formWorkOrder = FormWorkOrder::findOrFail($idFormWOrder);
                    if($request->file('wo_pic_image')){
                    $name = time().$request->file('wo_pic_image')->getClientOriginalName();
                    $request->file('wo_pic_image')->move('uploads/work_order',$name);
                    $formWorkOrder->update(
                        [
                            'wo_pic_image' => $name,
                        ]
                    );

                    if($request->file('wo_pic_attachment')){
                        $name = time().$request->file('wo_pic_attachment')->getClientOriginalName();
                        $request->file('wo_pic_attachment')->move('uploads/work_order/file',$name);
                        $formWorkOrder->update(
                            [
                                'wo_pic_attachment' => $name,
                            ]
                        );
                    }
                    
                    $formWorkOrder->update(
                        $request->except(['wo_pic_image','wo_pic_attachment']),);
                    return response()->json([
                        'code' => 200,
                        'message' => 'Success Saving Form Update',
                        'data' => 
                        [
                        new FormWorkOrderResource($formWorkOrder),
                        ]    
                    ], 200);
            }
            } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
                return response()->json([
                    'code' => 404,
                    'message' => 'Given Work Order Form ID not found', 
                    'data' => []
                    ], 404);
            }
        } catch (\PDOException $e) {
            $statusCode = 404;
            $response = [
                'error' => true,
                'message' => $e->getMessage(),
            ];   
            return $response; 
        } 
    }

    public function approveFormWorkOrderAsPicSpv($idFormWOrder){
        try{
            //get employee
            $employee = Auth::user();
                
            $formWorkOrder = FormWorkOrder::findOrFail($idFormWOrder);

            $formWorkOrder->update([
                'wo_form_status' => 8,
            ]);
            return response()->json([
                'code' => 200,
                'message' => 'Success Approving Form', 
                'data' =>  $formWorkOrder,
                ], 200);
        } catch (\PDOException $e) {
            $statusCode = 404;
            $response = [
                'error' => true,
                'message' => $e->getMessage(),
            ];   
            return $response; 
        } 
    }

    public function getLocations(){
        return response()->json([
            'code' => 200,
            'message' => 'Success Get All Locations', 
            'data' => MasterLocation::all()
        ], 200);
    }

    public function getDepartments(){
        return response()->json([
            'code' => 200,
            'message' => 'Success Get All Departments', 
            'data' => MasterDepartment::all()
        ], 200);

    }

    public function getAllPic()
    {
        $listPic = User::role('Work Order - PIC')->get();
        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => EmployeeResource::collection($listPic)
        // $user
        
        ], 200);
    }






    /// Test JWT
    public function profile()
    {
        //Tes profile department dan date
        $user = Auth::user();
        // $user = User::find(4);
        // $employee = User::find($user->id);
        // $department = $employee->department()->first();
        // $date = Carbon::now()->format('Y-m-d H:i:s');
        // $department = MasterDepartment::find(3);
        // $userSpv = $department->users()->where('emp_is_spv',1)->first();
        // $employee->removeRole('Super Admin Mobile');

        // $department->users();
        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => [new EmployeeResource($user)]
        // $user
        // [
        //     'emp_id' => $user->id,
        //     'emp_name' => $user->emp_name,
        //     'emp_username' => $user->emp_username,
        //     'emp_email' => $user->emp_email,
        //     'emp_nik' => $user->emp_nik,
        //     'emp_birth_date' => $user->emp_birth_date,
        //     'emp_phone_number' => $user->emp_phone_number,
        //     'emp_is_spv' => $user->emp_is_spv,
        //     'emp_employee_department_id' => $user->emp_employee_department_id,
        //     'emp_employee_department_name' => MasterDepartment::find($user->emp_employee_department_id)->dept_name,
        //     'created_at' => $user->created_at,
        //     'updated_at' => $user->updated_at,
        //     'emp_permissions' => $user->getPermissionsViaRoles()->unique('name'),
        //     'emp_groups' => EmployeeGroupResource::collection($user->roles)
        // ]
        ], 200);
        // return response()->json(['user' => Config::get('constants.groups.wo_issuer_spv')], 200);

        //Tes Has Many Through dengan EmployeeGroup model
        // $group = $user->group()->first();
        // $forms = $group->workOrderForms()->get();
        // $permissions = $group->permissions()->get()->where('id',13)->first();
        // // return response()->json(['group_forms' => $forms], 200);
        // return response()->json(['group_forms' => $permissions], 200);

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

}
