<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FormsWorkOrder;
use App\Models\MasterDepartment;
use App\Models\MasterEmployee;

class EmployeeController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public $successStatus = 200;
    protected $imageFormsWorkOrder = '/images/forms';
    
    public function getDataDepartment()
    {     
        try{
            $statusCode = 200;
            $getDataDepartment=MasterDepartment::where('is_active ', 1)->get();
            $response = [
                'data' => $getDataDepartment
            ];    
        } catch (Exception $ex) {
            $statusCode = 404;
            $response['message'] = 'Server Error';
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function createFormWorkOrder(Request $request)
    {     
        try{
            $formWorkOrder= new FormsWorkOrder();
            $formWorkOrder->id_issuer_submit= $request->id_issuer_submit;
            // $formWorkOrder->id_issuer_spv= $request->id_issuer_spv;
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
            // $formWorkOrder->implement_date= $request->implement_date;
            // $formWorkOrder->reschedule_date= $request->reschedule_date;
            // $formWorkOrder->relevant_area= $request->relevant_area;
            // $formWorkOrder->cost_classification= $request->cost_classification;
            if ($request->hasFile('w_o_pict_before')) {
                if ($request->file('w_o_pict_before')->isValid()) {
                    $file_ext        = $request->file('w_o_pict_before')->getClientOriginalExtension();
                    $file_size       = filesize($request->file('w_o_pict_before'));
                    $allow_file_exts = array('jpeg', 'jpg', 'png');
                    $max_file_size   = 1024 * 1024 * 10;
                    if (in_array(strtolower($file_ext), $allow_file_exts) && ($file_size <= $max_file_size)) {
                        $dest_path     = base_path().'/public' . $this->imageFormsWorkOrder;
                        $file_name     = preg_replace('/\\.[^.\\s]{3,4}$/', '', $request->file('w_o_pict_before')->getClientOriginalName());
                        $file_name     = str_replace(' ', '-', $file_name);
                        $work_order_before_pict ="work-order ". $file_name  . '.' . $file_ext;
                        // move file to serve directory
                        $request->file('w_o_pict_before')->move($dest_path, $work_order_before_pict);
                        $formWorkOrder->w_o_pict_before= $work_order_before_pict;
                    }
                }
            }
            // $formWorkOrder->w_o_pict_sign_issuer_spv= $request->w_o_pict_sign_issuer_spv;
            // $formWorkOrder->w_o_pict_sign_reff_spv= $request->w_o_pict_sign_reff_spv;
            $formWorkOrder->is_active= 1;
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

    public function viewListWorkOrder(Request $request)
    {
        try{
            $statusCode = 200;
            $workOrders= FormsWorkOrder::where('is_active',1)->get();
            if($workOrders){
                $response = [
                    'error' => false,
                    'message' => ' seluruh data work order',
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

    public function getProfileEmployee($idEmployee)
    {
        try{
            $dataEmployee= MasterEmployee::find($idEmployee);

            if($dataEmployee){
                $statusCode = 200;
                $response = [
                    'message' => ' tampilkan data Berhasil',
                    'dataProfilEmployee' => $dataEmployee,
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

    public function viewAllEmployee(Request $request)
    {
        try{
            $allEmployee= MasterEmployee::where('is_active',1)->get();
            $statusCode = 200;
            if($allEmployee){
                $response = [
                    'message' => ' tampilkan data seluru karyawan',
                    'dataAllEmployee' => $allEmployee,
                ];
            }else{
                $response = [
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