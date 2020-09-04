<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterDepartment;
use App\Models\MasterLocation;
use App\Models\MasterEmployee;
use App\Models\MEmployeeGroup;
use App\Models\MEmployeeTitle;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

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

    public function viewAllEmployee(Request $request)
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

    public function viewAllLocation(Request $request)
    {
        try{
            $allLocation= MasterLocation::where('is_active',1)->get();
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