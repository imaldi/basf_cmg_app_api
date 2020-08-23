<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterEmployee;
use App\Models\FormsWorkOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class EmployeeController extends Controller{

    public function createFormWorkOrder(Request $request)
    {     
        try{
            // $employee=DB::table('m_employee')->where('nik','=',$request->nik)->first();

            $formWorkOrder= new FormsWorkOrder();
            $formWorkOrder->id_issuer_submit= $request->id_issuer_submit;
            $formWorkOrder->id_issuer_spv= $request->id_issuer_spv;
            $formWorkOrder->id_reffered_dept_spv= $request->id_reffered_dept_spv;
            $formWorkOrder->id_dept_submitting= $request->id_dept_submitting;
            $formWorkOrder->id_location= $request->id_location;
            $formWorkOrder->w_order_category= $request->w_order_category;
            $formWorkOrder->reffered_division= $request->reffered_division;
            $formWorkOrder->w_order_location= $request->w_order_location;
            $formWorkOrder->tag_number= $request->tag_number;
            $formWorkOrder->w_order_desc= $request->w_order_desc;
            $formWorkOrder->w_order_status= $request->w_order_status;
            $formWorkOrder->w_o_priority_score= $request->w_o_priority_score;
            $formWorkOrder->implement_date= $request->implement_date;
            $formWorkOrder->reschedule_date= $request->reschedule_date;
            $formWorkOrder->relevant_area= $request->relevant_area;
            $formWorkOrder->cost_classification= $request->cost_classification;
            $formWorkOrder->w_o_pict_before= $request->w_o_pict_before;
            $formWorkOrder->w_o_pict_sign_issuer_spv= $request->w_o_pict_sign_issuer_spv;
            $formWorkOrder->w_o_pict_sign_reff_spv= $request->w_o_pict_sign_reff_spv;
            $formWorkOrder->is_active= $request->is_active;
            $formWorkOrder->saveOrFail($request->all());
            $statusCode = 200;
            $response = [
                'error' => false,
                'message' => ' tambah form work order Berhasil',
            ];    
        } catch (Exception $ex) {
            $statusCode = 404;
            $response = [
                'error' => true,
                'message' => 'tambah form work order Gagal',
            ];
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function updateFormWorkOrder(Request $request, $idFormWOrder)
    {     
        try{
            $formWorkOrder= FormsWorkOrder::find('id',$idFormWOrder);
            $formWorkOrder->id_issuer_spv= $request->id_issuer_spv;
            $formWorkOrder->id_dept_submitting= $request->id_dept_submitting;
            $formWorkOrder->id_location= $request->id_location;
            $formWorkOrder->w_order_category= $request->w_order_category;
            $formWorkOrder->reffered_division= $request->reffered_division;
            $formWorkOrder->w_order_location= $request->w_order_location;
            $formWorkOrder->tag_number= $request->tag_number;
            $formWorkOrder->w_order_desc= $request->w_order_desc;
            $formWorkOrder->w_order_status= $request->w_order_status;
            $formWorkOrder->w_o_priority_score= $request->w_o_priority_score;
            $formWorkOrder->implement_date= $request->implement_date;
            $formWorkOrder->reschedule_date= $request->reschedule_date;
            $formWorkOrder->relevant_area= $request->relevant_area;
            $formWorkOrder->cost_classification= $request->cost_classification;
            $formWorkOrder->w_o_pict_sign_issuer_spv= $request->w_o_pict_sign_issuer_spv;
            $formWorkOrder->w_o_pict_sign_reff_spv= $request->w_o_pict_sign_reff_spv;
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

    public function viewListWorkOrder(Request $request)
    {
        try{
                $statusCode = 200;
                $workOrders= FormsWorkOrder::where('is_active',1)->get();
                if($workOrders){
                    $response = [
                        'error' => false,
                        'message' => ' update form work order Berhasil',
                        'dataListWorkOrder' => $workOrders,
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

}