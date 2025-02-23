<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterDepartment;
use App\Models\MasterLocation;
use App\Models\MasterEmployee;
use App\Http\Resources\FormWorkOrderResource;
use App\Http\Resources\EmployeeGroupResource;
use App\Http\Resources\LocationsResource;
use App\Http\Resources\EmployeeResource;
use Illuminate\Support\Facades\Mail;
use App\Models\FormEGateCheck;
use App\Models\TruckRent;
use App\Models\employee_has_groups;
use App\Mail\FormEGateCheckMail;

// use App\Mail\FormEGateCheck;
// use App\Models\MEmployeeGroup;
// use App\Models\MEmployeeTitle;
// use App\Models\MScoringWorkOrder;
// use App\Models\LocationPrevillege;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getLocations()
    {
        return response()->json([
            'code' => 200,
            'message' => 'Success Get All Locations',
            'data' => LocationsResource::collection(MasterLocation::all())
        ], 200);
    }

    public function getLocationsByLocModule(Request $request)
    {
        $locModule = $request->query('locModule');
        $locations = MasterLocation::where('loc_module', 'LIKE', "%" . $locModule)
            // ->where('wo_issuer_id',$user->id)->orderBy(($orderBy != '' || $orderBy != null) ? $orderBy : 'wo_form_status')
            ->get();
        return response()->json([
            'code' => 200,
            'message' => 'Success Get All Locations',
            'data' => LocationsResource::collection($locations)
        ], 200);
    }


    public function getDepartments()
    {
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



    public function testemail($id)
    {
        $data = FormEGateCheck::findOrFail($id);
        $transporter = TruckRent::findOrFail(1);
        $emailReceiver = array('yanedgroup@gmail.com');
        // input transporter email into array
        if ($transporter->tr_email_1) {
            $emailReceiver[] = $transporter->tr_email_1;
        }
        if ($transporter->tr_email_2) {
            $emailReceiver[] = $transporter->tr_email_2;
        }
        if ($transporter->tr_email_3) {
            $emailReceiver[] = $transporter->tr_email_3;
        }
        if ($transporter->tr_email_4) {
            $emailReceiver[] = $transporter->tr_email_4;
        }
        if ($transporter->tr_email_5) {
            $emailReceiver[] = $transporter->tr_email_5;
        }
        // get user who has "Gate check ditolak" role
        $userIsReceiver = employee_has_groups::where('role_id', 8)->get();
        $userIsReceiverArray = array();
        foreach ($userIsReceiver as $receiver) {
            $userIsReceiverArray[] = $receiver->model_id;
        }
        $userReceiverList = User::whereIn('id', $userIsReceiverArray)->get();
        foreach ($userReceiverList as $receiver) {
            if ($receiver->emp_email) {
                $emailReceiver[] = $receiver->emp_email;
            }
        }

        // dd($emailReceiver);
        // $data = array('name'=>'Arunkumar');
        // Mail::send('mail.gate_truck_ditolak', $data, function($message) {
        // $message->to([$emailReceiver])->subject('Form Truck Masuk Site Ditolak');
        // $message->to('yanedgroup@gmail.com', 'Transporter')->subject('Form Truck Masuk Site Ditolak');
        // $message->from('digitalform.basf@gmail.com','Transporter');
        // });
        Mail::to($emailReceiver)->send(new FormEGateCheckMail($data));
        echo ('email berhasil dikirim');
    }


    /// Test JWT
    public function profile()
    {
        //Tes profile department dan date
        $user = [Auth::user()];
        // $user = User::find(1);
        // $employee = User::find($user->id);
        // $department = $employee->department()->first();
        // $date = Carbon::now()->format('Y-m-d H:i:s');
        // $department = MasterDepartment::find(3);
        // $userSpv = $department->users()->where('emp_is_spv',1)->first();
        // $employee->removeRole('Super Admin Mobile');
        // $user->update([
        //     'emp_name' => 'aldi'
        // ]);

        // $department->users();


        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' =>  EmployeeResource::collection($user)
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



    public function allEmployee()
    {
        return response()->json([
            'code' => 200,
            'message' => 'Success Fetch All Employee',
            'data'  =>  EmployeeResource::collection(User::where("emp_is_active", 1)->get())
        ], 200);
    }

    public function singleUser($id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json([
                'code' => 200,
                'message' => 'Success Fetch An Employee',
                'data' => $user
            ], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'user not found!'], 404);
        }
    }
}
