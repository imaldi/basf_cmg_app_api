<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterDepartment;
use App\Models\MasterLocation;
use App\Models\MasterEmployee;
use App\Models\MEmployeeGroup;
use App\Models\MEmployeeTitle;
use App\Models\MScoringWorkOrder;
use App\Models\LocationPrevillege;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function getLocationByDepartment(Request $request)
    {     
        try{
            $listLocationByDepartment=MasterLocation::where('id_department', $request->id_department)->get();
            $newLocationDepartment = array();
            foreach($listLocationByDepartment as $location){
                if(in_array($request->category_department, json_decode($location->location_description))){
                    array_push($newLocationDepartment, $location);
                }
            }
            $statusCode = 200;
            $response = [
                'listLocationByDepartment' => $newLocationDepartment
            ];    
        } catch (Exception $ex) {
            $statusCode = 404;
            $response['message'] = 'Server Error';
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function getDepartements(Request $request)
    {     
        try{
            $getLocationPrevillege = LocationPrevillege::where('previllage_name', '=', $request->previllage_name)->first();
            if($getLocationPrevillege){
                $arrayIdLocation = json_decode($getLocationPrevillege->array_id_location);
                $dataLocations = array();
                $dataDepartment = array();
                $arrayidDepartment = array();
                foreach($arrayIdLocation as $idLocation){
                    $getDataLocation = MasterLocation::find($idLocation);
                    if($getDataLocation->id_department != null){
                        array_push($arrayidDepartment, $getDataLocation->id_department);
                    }
                    array_push($dataLocations, $getDataLocation);
                }
                if(sizeof($arrayidDepartment) > 0){
                    foreach(array_unique($arrayidDepartment) as $idDepartment){
                        $getDataDepartment = MasterDepartment::find($idDepartment);
                        array_push($dataDepartment, $getDataDepartment);
                    }
                }
                $statusCode = 200;
                $response = [
                    "listDepartment"=>$dataDepartment,
                    "listLocations"=>$dataLocations
                ];    
            } else {
                $statusCode = 200;
                $response = [
                    'message' => "Data Not Found"
                ];    
            }
        } catch (Exception $ex) {
            $statusCode = 404;
            $response['message'] = 'Server Error';
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function getLocationByCategory(Request $request)
    {     
        try{
            $dataLocationByCategeroy=MasterLocation::where('location_category', '=', $request->location_category)->get();
            $statusCode = 200;
            $response = [
                'dataLocationByCategeroy' => $dataLocationByCategeroy
            ];    
        } catch (Exception $ex) {
            $statusCode = 404;
            $response['message'] = 'Server Error';
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function getScoringWorkOrder()
    {     
        try{
            $getScoringWorkOrder=MScoringWorkOrder::get();
            $statusCode = 200;
            $response = [
                'dataScoringWorkOrder' => $getScoringWorkOrder
            ];    
        } catch (Exception $ex) {
            $statusCode = 404;
            $response['message'] = 'Server Error';
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function getDataDepartment()
    {     
        try{
            $getDataDepartment=MasterDepartment::where('is_active', 1)->get();
            $statusCode = 200;
            $response = [
                'dataAllDepartment' => $getDataDepartment
            ];    
        } catch (Exception $ex) {
            $statusCode = 404;
            $response['message'] = 'Server Error';
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function viewAllEmployee()
    {
        try{
            $allEmployee= MasterEmployee::where('is_active',1)->get();
            if($allEmployee){
                $statusCode = 200;
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
                'message' => 'tampilkan data karyawan Gagal',
            ];
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function viewAllLocation()
    {
        try{
            $allLocation= MasterLocation::get();
            if($allLocation){
                $statusCode = 200;
                $response = [
                    'message' => ' tampilkan data seluruh lokasi',
                    'dataAllLocation' => $allLocation,
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
                'message' => 'tampilkan data lokasi Gagal',
            ];
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function viewAllEmployeeGroup(Request $request)
    {
        try{
            $allEmployeeGroup= MEmployeeGroup::where('is_active',1)->get();
            if($allEmployeeGroup){
                $statusCode = 200;
                $response = [
                    'message' => ' tampilkan data grup karyawan',
                    'dataEmployeeGroup' => $allEmployeeGroup,
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
                'message' => 'tampilkan data grup karyawan Gagal',
            ];
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

    public function viewAllEmployeeTitle(Request $request)
    {
        try{
            $allEmployeeTitle= MEmployeeTitle::get();
            if($allEmployeeTitle){
                $statusCode = 200;
                $response = [
                    'message' => ' tampilkan data jabatan karyawan',
                    'dataEmployeeTitle' => $allEmployeeTitle,
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
                'message' => 'tampilkan data jabatan karyawan Gagal',
            ];
        } finally {
            return response($response,$statusCode)->header('Content-Type','application/json');
        }
    }

}