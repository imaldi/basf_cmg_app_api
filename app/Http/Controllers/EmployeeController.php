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
use App\User;
use Auth;



class EmployeeController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public $successStatus = 200;

    public function addGroupToUser(Request $request){
        $userId = $request->input('user_id');
        $groupId = $request->input('group_id');
        $group = MEmployeeGroup::find($groupId);

        $employee = User::find($userId);
        $employee->assignRole($group);
        // $employee->removeRole($group);
        return $employee->getRoleNames();
        // return $group;
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
