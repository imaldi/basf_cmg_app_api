<?php

namespace App\Http\Controllers;

use App\Models\FormAttendance;
use App\Models\FormAttendancePeople;
use App\Models\FormAttendanceCategory;
use App\Models\MasterDepartment;
use App\Models\MasterLocation;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AttendanceController extends Controller
{
    public function getAttendanceCategories()
    {
        $attendanceCategories = FormAttendanceCategory::all();
        return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' => $attendanceCategories
            ], 200);
    }

    public function createEventAttandance(Request $request)
    {

        $employee = Auth::user();

        $department = $employee->department()->first();
        $departmentId = $employee->emp_employee_department_id;
        $employeeIds = $request->input('employee_ids');
        $subArray = substr($employeeIds, 1, -1);
        $idArray = explode(",",$subArray);

        $formAttandance = FormAttendance::create([
            'att_created_by_id' => $employee->id,
            'att_register_by_dept' => $departmentId,
            'att_topic1' => $request->input('att_topic1'),
            'att_topic2' => $request->input('att_topic2'),
            'att_reference' => $request->input('att_reference'),
            'att_date' => $request->input('att_date'),
            'att_place' => $request->input('att_place'),
            'att_pic' => $request->input('att_pic'),
            'att_category' => $request->input('att_category'),
            'att_with_test' => $request->input('att_with_test'),
            'att_is_active' => $request->input('att_is_active'),
            'att_additional_remark' => $request->input('att_additional_remark'),
            'att_jml_participant' => $request->input('att_jml_participant'),
            'att_total_hours' => $request->input('att_total_hours'),
            'att_total_manhours' => $request->input('att_total_manhours'),
            'att_place_others' => $request->input('att_place_others'),
            'att_category_others' => $request->input('att_category_others'),
            'att_trainer_signature' => $request->input('att_trainer_signature'),
        ]);

        try{
            if($request->file('att_signature')){
                $name = time().'att_signature'.$request->file('att_signature')->getClientOriginalName();
                $request->file('att_signature')->move('uploads/attendance/signatures',$name);
                $formAttandance->update(
                    [
                        'att_signature' => $name,
                    ]
                );
            }
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given Personal Attandance ID not found',
                'data' => []
                ], 404);
        }

        foreach($idArray as $id){
            FormAttendancePeople::create([
                'att_p_attendance_id' => $formAttandance->id,
                'att_p_employee_id' => $id,
                'att_p_department_id' => User::find($id)->emp_employee_department_id,
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' => $formAttandance
            ], 200);
    }

    public function getPersonalAttendance($id)
    {
        $formPeople = FormAttendancePeople::find($id);

        return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' => $formPeople
            ], 200);
    }

    public function fillPersonalAttendance(Request $request, $id)
    {

        try{
            $formPeople = FormAttendancePeople::findOrFail($id);
            if($request->file('att_p_signature')){
                $name = time().$request->file('att_p_signature')->getClientOriginalName();
                $request->file('att_p_signature')->move('uploads/attendance/signatures',$name);
                $formPeople->update(
                    [
                        'att_p_signature' => $name,
                    ]
                );
            }
            $formPeople->update([
                'att_p_remark' => $request->input('att_p_remark')
            ]);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given Personal Attandance ID not found',
                'data' => []
                ], 404);
        }
    }

    public function testFromArrayStringToPHPArray(Request $request){
        $arrayId = $request->input('array');
        $subArray = $dataList = substr($arrayId, 1, -1);
        $idArray = explode(",",$subArray);

        $attendance = FormAttendance::create([
            'att_topic1' => 'yess'
        ]);

        foreach($idArray as $id){
            FormAttendancePeople::create([
                'att_p_attendance_id' => $attendance->id,
                'att_p_employee_id' => $id,
                'att_p_department_id' => User::find($id)->emp_employee_department_id,
            ]);
        }



        // return $arrayId
        return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' => $attendance
            ], 200);
    }
}
