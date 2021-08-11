<?php

namespace App\Http\Controllers;

use App\Models\FormWorkOrder;
use App\Models\MasterDepartment;
use App\Models\MEmployeeGroup;
use App\Models\MasterLocation;
use App\Http\Resources\FormWorkOrderResource;
use App\Http\Resources\EmployeeGroupResource;
use App\Http\Resources\LocationsResource;
use App\Http\Resources\EmployeeResource;
use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class WorkOrderController extends Controller
{
    // protected $globalUser = Auth::user();


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
        // try{
            //get employee
            $employee = Auth::user();
            $this->validate($request, [
                'wo_form_status' => [
                    'required',
                    'integer',
                    Rule::in(['1', '2']),
                ],
                'wo_location_id' => 'required|integer',
                'wo_c_emergency' => 'required|integer|between:1,4',
                'wo_c_ranking_cust'=> 'required|integer|between:1,4',
                'wo_c_equipment_criteria' => 'required|integer|between:1,4',
                'wo_image' => 'file'
            ]);



            $date = Carbon::now();
            $date->toDateTimeString();
            $department = $employee->department()->first();
            $departmentId = $employee->emp_employee_department_id;

            $departmentAbr = substr(strtoupper($department->dept_name),0,3);
            $formStatus = (int)$request->input('wo_form_status');
            $emergency = (int)$request->input('wo_c_emergency');
            $ranking_cust = (int)$request->input('wo_c_ranking_cust');
            $equipment_criteria = (int)$request->input('wo_c_equipment_criteria');
            $recommendedDays = FormWorkOrder::recommendedDays($emergency,$ranking_cust,$equipment_criteria);

            // recommendedDays($emergency,$equipment_criteria,$equipment_criteria);
            $date_recommendation = date('Y-m-d', strtotime("+".$recommendedDays." days"));
            $formID = FormWorkOrder::max('id') + 1;
            $monthFormatted = str_pad($date->month, 2, '0', STR_PAD_LEFT);
            $formIDFormatted = str_pad($formID, 2, '0', STR_PAD_LEFT);


            $formWorkOrder = FormWorkOrder::create([
                'wo_issuer_id' => $employee->id,
                //ini diberikan ketika meng aprove, nanti edit

                //ini kalau mau saring berdasarkan field 'emp_is_spv'
                // $employee->department()->first()->users()->where('emp_is_spv',1)->first()->id,
                'wo_date_issuer_submit' => $date,
                'wo_category' => $request->input('wo_category'),
                'wo_issuer_dept' =>
                $departmentId,
                // $request->input('emp_employee_department_id'),
                'wo_location_id' => (int)$request->input('wo_location_id'),
                'wo_reffered_dept' => $request->input('wo_reffered_dept'),
                'wo_reffered_division' => $request->input('wo_reffered_division'),
                'wo_description' => $request->input('wo_description'),
                'wo_location_detail' => $request->input('wo_location_detail'),
                'wo_tag_no' => $request->input('wo_tag_no'),
                'wo_issuer_attachment' => $request->input('wo_issuer_attachment'),
                'wo_form_status' => $formStatus,
                'wo_date_recomendation' => $date_recommendation,
                'wo_is_open' => 1,
                'wo_c_emergency' => $emergency,
                'wo_c_ranking_cust' => $ranking_cust,
                'wo_c_equipment_criteria' => $equipment_criteria,
            ]);
            if($request->file('wo_image')){
                $name = time().$request->file('wo_image')->getClientOriginalName();
                $request->file('wo_image')->move('uploads/work_order',$name);
                $formWorkOrder->update([
                'wo_image' => $name
                ]);
            }

            $formWorkOrder->update([
                'wo_name' => 'GS/F/3002-4/' .$departmentAbr.'/'.$monthFormatted.'/'.$date->year.'/'.$formIDFormatted,
                ]);

            return response()->json([
                'code' => 200,
                'message' => 'Success Create Data',
                'data' =>[
                    new FormWorkOrderResource($formWorkOrder)
                ]
                ], 200);
    }

    public function saveFormWorkOrderDraft(Request $request, $idFormWOrder){
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

        $date = Carbon::now();
        $date->toDateTimeString();
        $emergency = (int)$request->input('wo_c_emergency');
        $ranking_cust = (int)$request->input('wo_c_ranking_cust');
        $equipment_criteria = (int)$request->input('wo_c_equipment_criteria');
        $recommendedDays = FormWorkOrder::recommendedDays($emergency,$ranking_cust,$equipment_criteria);

        $date_recommendation = date('Y-m-d', strtotime("+".$recommendedDays." days"));
        try{
            $formWorkOrder = FormWorkOrder::findOrFail($idFormWOrder);
            if($request->file('wo_image')){
                $file = 'uploads/work_order'.$formWorkOrder->wo_image;
                if(is_file($file)){
                    unlink(public_path($file));
                }
                $name = time().$request->file('wo_image')->getClientOriginalName();
                $request->file('wo_image')->move('uploads/work_order',$name);
                $formWorkOrder->update(
                    [
                        'wo_image' => $name,
                    ]
                );
            }
            $formWorkOrder->update([
                    'wo_location_id' => (int) $request->input('wo_location_id'),
                    'wo_c_emergency' => (int)$request->input('wo_c_emergency'),
                    'wo_c_ranking_cust' => (int)$request->input('wo_c_ranking_cust'),
                    'wo_c_equipment_criteria' => (int)$request->input('wo_c_equipment_criteria'),
                    'wo_form_status' => (int) $request->input('wo_form_status'),
                    'wo_reffered_dept' => $request->input('wo_reffered_dept'),
                    'wo_reffered_division' => $request->input('wo_reffered_division'),
                    'wo_description' => $request->input('wo_description'),
                    'wo_location_detail' => $request->input('wo_location_detail'),
                    'wo_tag_no' => $request->input('wo_tag_no'),
                    'wo_issuer_attachment' => $request->input('wo_issuer_attachment'),
                    'wo_date_recomendation' => $date_recommendation,


            ]
            );
            return response()->json([
                'code' => 200,
                'message' => 'Success Saving Form Update',
                'data' => [new FormWorkOrderResource($formWorkOrder)],
                ], 200);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given Work Order Form ID not found',
                'data' => []
                ], 404);
        }


    }


    public function viewListWorkOrderAsIssuer(Request $request){
        $user = Auth::user();

        // try{
            $orderBy = $request->query('orderBy');
            $formWorkOrder = FormWorkOrder::where('wo_is_open', 1)
            ->where('wo_issuer_id',$user->id)->orderBy(($orderBy != '' || $orderBy != null) ? $orderBy : 'wo_form_status')->get();
            // ->orderBy("wo_form_status")->get()
            ;



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

        $forms = FormWorkOrder::where(
            // 'wo_spv_issuer_id'
            'wo_issuer_dept'
            , $user->emp_employee_department_id)->where('wo_is_open', 1)
            // ->whereIn('wo_form_status',[1,2,9])
            ;
        if($request->query('orderBy') == 'wo_form_status'){
            $forms = $forms->orderBy($request->query('orderBy'),'desc')->get();
        } else {
            $forms = $forms->orderBy($request->query('orderBy'))->get();
        }

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
        $forms = FormWorkOrder::
            // where('wo_planner_id', $user->id)->
            where('wo_is_open', 1)
            // ->where('wo_form_status',3)
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
        $forms = FormWorkOrder::where('wo_pic_id', $user->id)->where('wo_is_open', 1)->whereIn('wo_form_status',[6,7,8,9])
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
            'data' =>  [
                new FormWorkOrderResource($formWorkOrder) ]
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
                'data' =>  [new FormWorkOrderResource($formWorkOrder)],
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
            $departmentId = $employee->emp_employee_department_id;
            //Ini saring berdasarkan group(role)
            $wo_issuer_spv_id = $employee->id;

            $wo_planner_id = User::role('Work Order - Planner')->where('emp_employee_department_id',$departmentId)->first()->id;

            $formWorkOrder = FormWorkOrder::findOrFail($idFormWOrder);

            $formWorkOrder->update([
                $request->except([
                    'wo_date_spv_issuer_approve',
                    'wo_form_status',
                    'wo_planner_id'
                ]),
                'wo_spv_issuer_id' =>
                $wo_issuer_spv_id,
                'wo_date_spv_issuer_approve' => $date,
                'wo_form_status' => 3,
                'wo_planner_id' => $wo_planner_id
            ]);
            return response()->json([
                'code' => 200,
                'message' => 'Success Approving Form',
                'data' =>  [
                new FormWorkOrderResource($formWorkOrder) ]
                ], 200);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given Work Order Form ID not found',
                'data' => []
                ], 404);
        }
    }

    public function approveFormWorkOrderAsIssuerSPVHandOver(Request $request, $idFormWOrder){
        try{
            //get employee
            $employee = Auth::user();

            $date = Carbon::now();
            $date->toDateTimeString();

            $formWorkOrder = FormWorkOrder::findOrFail($idFormWOrder);

            $formWorkOrder->update([
                'wo_hand_over_reason' => $request->input('wo_hand_over_reason'),
                'wo_form_status' => 10,
                'wo_is_open' =>  0,
            ]);
            return response()->json([
                'code' => 200,
                'message' => 'Success Approving Form',
                'data' =>  [
                new FormWorkOrderResource($formWorkOrder) ]
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
            $picId = User::find($request->input('wo_pic_id'))->id;
            //Buat Validatore belum

            $formWorkOrder->update([
                'wo_date_planner_approve' => $date,
                'wo_pic_id' => $picId,
                'wo_form_status' => 6,
                'wo_c_cost' => $request->input('wo_c_cost'),
                'wo_date_revision' => $request->input('wo_date_revision'),
            ]);
            return response()->json([
                'code' => 200,
                'message' => 'Success Approving Form',
                'data' =>  [
                new FormWorkOrderResource($formWorkOrder) ]
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
            $departmentId = $employee->emp_employee_department_id;
            $wo_pic_spv_id = User::role('Work Order - SPV PIC')->where('emp_employee_department_id',$departmentId)->first()->id;


            $formWorkOrder->update([
                'wo_date_pic_plan' => $date,
                'wo_form_status' => 7,
                'wo_spv_pic_id' => $wo_pic_spv_id,
                'wo_pic_action_plan' => $request->input('wo_pic_action_plan'),
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Success Approving Form',
                'data' =>  [
                new FormWorkOrderResource($formWorkOrder) ]
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
            $fileName = explode(' ',$employee->emp_name);
            $fileNameFinal = implode('_', $fileName);
            // $formStatus = (int)$request->input('wo_form_status');
            $formWorkOrder = FormWorkOrder::findOrFail($idFormWOrder);


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
            //     'data' =>  [
                // new FormWorkOrderResource($formWorkOrder) ]
            //     ], 200);

            try{
                    if($request->file('wo_pic_image')){
                        $file = 'uploads/work_order/'.$formWorkOrder->wo_pic_image;
                if(is_file($file)){
                    unlink(public_path($file));
                }
                    $name = time().$request->file('wo_pic_image')->getClientOriginalName();
                    // ?? ini aku tambahkan / d ujung
                    $request->file('wo_pic_image')->move('uploads/work_order/',$name);
                    $formWorkOrder->update(
                        [
                            'wo_pic_image' => $name,
                        ]
                    );
                }

                    if($request->file('wo_pic_attachment')){

                        $file = 'uploads/work_order/file'.$formWorkOrder->wo_pic_image;
                        if(is_file($file)){
                            unlink(public_path($file));
                        }


                        $fileExtension = $request->input('file_extension');
                        $decodedDocs = base64_decode($request->input('wo_pic_attachment'));
                        $name = time().'Basf-work-order'.$fileNameFinal;
                        // $decodedDocs->move('uploads/work_order/file',$name);
                        file_put_contents('uploads/work_order/file/'.$name.'.'.$fileExtension, $decodedDocs);
                        $formWorkOrder->update(
                            [
                                'wo_pic_attachment' => $name,
                            ]
                        );
                    }

                        // $formWorkOrder->update(
                        //     $request->except(['wo_pic_image','wo_pic_attachment','wo_form_status']),);
                        $formWorkOrder->update([
                            'wo_form_status' => 9,
                            'wo_pic_start_time' => $request->input('wo_pic_start_time'),
                            'wo_pic_finish_time' => $request->input('wo_pic_finish_time'),
                            'wo_pic_action' => $request->input('wo_pic_action'),
                                'wo_pic_team' => $request->input('wo_pic_team'),

                        ]);
                    return response()->json([
                        'code' => 200,
                        'message' => 'Success Approving Form',
                        'data' =>
                        [
                        new FormWorkOrderResource($formWorkOrder),
                        ]
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
                'data' =>  [
                new FormWorkOrderResource($formWorkOrder) ]
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

    //otw pindahkan ke generalcontroller


    ///Test JWT Ends

}
