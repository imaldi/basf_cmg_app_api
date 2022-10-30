<?php

namespace App\Http\Controllers;

use App\Models\FormAttendance;
use App\Models\FormAttendancePersonal;
use App\Models\FormAttendanceCategory;
use App\Models\FormAttendanceMaster;
use App\Models\MasterDepartment;
use App\Models\MasterLocation;
// use App\Models\FormAttendanceCategory;
use App\Http\Resources\FormAttendanceResource;
use App\Http\Resources\FormAttendancePersonalResource;
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
            'message' => 'Success Fetch All Data',
            'data' => $attendanceCategories
            ], 200);
    }

    public function getAttendanceMasterBasedOnGivenCategoryIdAndDepartmentId(Request $request){
        $idCategory = $request->input('category_id');
        $deptCategory = $request->input('department_id');
        return 
        response()->json([
            'code' => 200,
            'message' => 'Success Fetch All Data',
            'data' => FormAttendanceMaster::where('category_training',$idCategory)->where('registered_by_dept',$deptCategory)->get()
            ], 200);
    }

    public function createOrEditEventAttandance(Request $request)
    {

        // $this->validate($request, [
        //     'att_place' => 'integer|required'
        // ]);
        $employee = Auth::user();

        $department = $employee->department()->first();
        $departmentId = $employee->emp_employee_department_id;
        $subArray = substr($departmentId, 1, -1);
        $idArray = explode(",",$subArray);


        $idForm = $request->input('form_id');
        if($idForm == 0 || $idForm == null){
            $formAttandance = FormAttendance::create([
                'att_created_by_id' => $employee->id,
                'att_register_by_dept' => $departmentId,
                'att_topic1' => $request->input('att_topic1'),
                'att_topic2' => $request->input('att_topic2'),
                'att_reference' => $request->input('att_reference'),
                'att_date' => $request->input('att_date'),
                'att_place' => MasterLocation::find((int) $request->input('att_place'))->id ?? null,
                // 'att_pic' => $request->input('att_pic'),
                'att_pic' => User::find((int) $request->input('att_pic'))->id,
                // 'att_category' => $request->input('att_category'),
                'att_category' => FormAttendanceCategory::find(1)->id,
                'att_with_test' => $request->input('att_with_test'),
                'att_is_active' => $request->input('att_is_active'),
                'att_additional_remark' => $request->input('att_additional_remark'),
                'att_jml_participant' => $request->input('att_jml_participant'),
                'att_total_hours' => $request->input('att_total_hours'),
                'att_total_manhours' => $request->input('att_total_manhours'),
                'att_place_others' => $request->input('att_place_others'),
                'att_category_others' => $request->input('att_category_others'),
                // 'att_trainer_signature' => $request->input('att_trainer_signature'),
            ]);

            // if($request->file('att_trainer_signature')){
            //     $name = time().'att_signature'.$request->file('att_signature')->getClientOriginalName();
            //     $request->file('att_signature')->move('uploads/attendance/signatures',$name);
            //     $formAttandance->update(
            //         [
            //             'att_signature' => $name,
            //         ]
            //     );
            // }

            if($request->input('att_trainer_signature')){
                // $file = 'uploads/attendance/signatures/'.$form->att_trainer_signature;

                // if (is_file($file)) {
                //     unlink(public_path($file));
                // }
                $decodedDocs = base64_decode($request->input('att_trainer_signature'));


                // $name = time().$request->file('att_p_signature')->getClientOriginalName();
                $name = time()."_att_trainer_signature.png";
                file_put_contents('uploads/attendance/signatures/'.$name, $decodedDocs);


                $formAttandance->update(
                    [
                        'att_trainer_signature' => $name,
                        ]
                    );

            }
            // if($request->file('att_trainer_signature')){
            //     $name = time().'att_trainer_signature.pdf';
            //     $request->file('att_trainer_signature')->move('uploads/attendance/signatures',$name);
            //     $formAttandance->update(
            //         [
            //             'att_trainer_signature' => $name,
            //         ]
            //     );
            // }


            // foreach($idArray as $id){
            //     FormAttendancePersonal::create([
            //         'att_p_attendance_id' => $formAttandance->id,
            //         'att_p_employee_id' => $id,
            //         'att_p_department_id' => User::find($id)->emp_employee_department_id,
            //     ]);
            // }

            return response()->json([
                'code' => 200,
                'message' => 'Success Create Data',
                'data' => [new FormAttendanceResource($formAttandance)]
                ], 200);
        }else {
            try {
                $form = FormAttendance::findOrFail($idForm);

                $form->update([
                    'att_created_by_id' => $employee->id,
                    'att_register_by_dept' => $departmentId,
                    'att_topic1' => $request->input('att_topic1'),
                    'att_topic2' => $request->input('att_topic2'),
                    'att_reference' => $request->input('att_reference'),
                    'att_date' => $request->input('att_date'),
                    'att_place' => MasterLocation::find((int) $request->input('att_place'))->id ?? null,
                    'att_pic' => User::find((int) $request->input('att_pic'))->id,
                    // 'att_pic' => $request->input('att_pic'),
                    // 'att_category' => $request->input('att_category'),
                    'att_category' => FormAttendanceCategory::find(1)->id,
                    'att_with_test' => $request->input('att_with_test'),
                    'att_is_active' => $request->input('att_is_active'),
                    'att_additional_remark' => $request->input('att_additional_remark'),
                    'att_jml_participant' => $request->input('att_jml_participant'),
                    'att_total_hours' => $request->input('att_total_hours'),
                    'att_total_manhours' => $request->input('att_total_manhours'),
                    'att_place_others' => $request->input('att_place_others'),
                    'att_category_others' => $request->input('att_category_others'),
                    // 'att_trainer_signature' => $request->input('att_trainer_signature'),
                ]);


                if($request->input('att_trainer_signature')){
                    $file = 'uploads/attendance/signatures/'.$form->att_trainer_signature;

                    if (is_file($file)) {
                        unlink(public_path($file));
                    }
                    $decodedDocs = base64_decode($request->input('att_trainer_signature'));


                    // $name = time().$request->file('att_p_signature')->getClientOriginalName();
                    $name = time()."_att_trainer_signature.png";
                    file_put_contents('uploads/attendance/signatures/'.$name, $decodedDocs);


                    $form->update(
                        [
                            'att_trainer_signature' => $name,
                            ]
                        );

                }


                // if($request->input('att_place') != null){
                //     try{
                //         $placeId = MasterLocation::findOrFail($request->input('att_place'));

                //     $form->update([
                //         'att_place' => $placeId]);}
                //         catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
                //             return response()->json([
                //                 'code' => 404,
                //                 'message' => 'Given Location ID not found',
                //                 'data' => []
                //                 ], 404);
                //         }
                // }


                return response()->json([
                    'code' => 200,
                    'message' => 'Success Update Data',
                    'data' => [new FormAttendanceResource($form)]
                    ], 200);

            } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
                return response()->json([
                    'code' => 404,
                    'message' => 'Given Personal Attandance ID not found',
                    'data' => []
                    ], 404);
            }
        }
    }

    public function getPersonalAttendance($id)
    {
        try{
        $formPeople = FormAttendancePersonal::findOrFail($id);

        return response()->json([
            'code' => 200,
            'message' => 'Success Get Data',
            'data' => [new FormAttendancePersonalResource($formPeople)]
            ], 200);}
            catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
                return response()->json([
                    'code' => 404,
                    'message' => 'Given Department Form ID not found',
                    'data' => []
                    ], 404);
            }
        }

    public function getAttendance($id)
    {
        try{
        $formPeople = FormAttendance::findOrFail($id);

        return response()->json([
            'code' => 200,
            'message' => 'Success Get Data',
            'data' => [new FormAttendanceResource($formPeople)]
            ], 200);
        }  catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given Department Form ID not found',
                'data' => []
                ], 404);
        }
    }

    public function setAttendanceInactive($id)
    {
        try{
        $formAttandance = FormAttendance::findOrFail($id);
        $formAttandance->update([
            "att_is_active" => 0]);

        return response()->json([
            'code' => 200,
            'message' => 'Success Update Data',
            'data' => [new FormAttendanceResource($formAttandance)]
            ], 200);
        }  catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given Attendance Form ID not found',
                'data' => []
                ], 404);
        }
    }

    public function getAllAttendance(Request $request)
    {
        $formAttandance = FormAttendance::
            orderBy($request->query('orderBy'),'desc')->get();
            // ->paginate(15);
        // $request->query('orderBy')

        return response()->json([
            'code' => 200,
            'message' => 'Success Fetch All Data',
            'data' => FormAttendanceResource::collection($formAttandance)
        ], 200);
    }

    public function createOrUpdatePersonalAttendance(Request $request, $id)
    {
        $this->validate($request, [
            'att_p_attendance_id' => 'integer|required',
            'att_p_score' => 'integer'
        ]);
        try{
            $formEvent = FormAttendance::findOrFail($request->input('att_p_attendance_id'));

            // // $formEvent = FormAttendance::findOrFail(1);



        if($id == 0 || $id == null){
            // $formPeople = FormAttendancePersonal::create($request->except(['att_p_signature']));

            if($request->input('att_p_employee_id') != null){
                $employee = User::find($request->input('att_p_employee_id'));
                $formPeople = FormAttendancePersonal::create([
                    'att_p_attendance_id' => $formEvent->id,
                    'att_p_employee_id' => $employee->id ?? null,
                    'att_p_department_id' => $employee->emp_employee_department_id ?? null,
                ]);
            } else{
                $formPeople = FormAttendancePersonal::create([
                    'att_p_attendance_id' => $formEvent->id,
                    'att_p_person_type' => $request->input('att_p_person_type'),
                ]);
            }
            $formPeople->update([
                'att_p_score' => (int) $request->input('att_p_score'),
                'att_p_remark' => $request->input('att_p_remark'),
                'att_p_person_name' => $request->input('att_p_person_name'),
            ]);
            if($request->input('att_p_signature') != null){
                // $name = time().$request->file('att_p_signature')->getClientOriginalName();
                // $request->file('att_p_signature')->move('uploads/attendance/signatures/',$name);


                $decodedDocs = base64_decode($request->input('att_p_signature'));


                // $name = time().$request->file('att_p_signature')->getClientOriginalName();
                $name = rand()."_att_p_signature.png";
                file_put_contents('uploads/attendance/signatures/'.$name, $decodedDocs);


                $formPeople->update(
                    [
                        'att_p_signature' => $name,
                        ]
                    );
                }









            return response()->json([
                'code' => 200,
                'message' => 'Success Create Data',
                'data' =>
                // MasterDepartment::find($employee->emp_employee_department_id)->id
                // $formPeople->att_p_department_id
                [new FormAttendancePersonalResource($formPeople)]
                ], 200);
        }else{
        try{
            $formPeople = FormAttendancePersonal::findOrFail($id);

            if($request->input('att_p_signature') != null){
                $file = 'uploads/attendance/signatures/'.$formPeople->att_p_signature;

                if(is_file($file)){
                    unlink(public_path($file));
                }
                $decodedDocs = base64_decode($request->input('att_p_signature'));


                // $name = time().$request->file('att_p_signature')->getClientOriginalName();
                $name = time()."_att_p_signature.png";
                file_put_contents('uploads/attendance/signatures/'.$name, $decodedDocs);

                // $request->file('att_p_signature')->move('uploads/attendance/signatures/',$name);
                $formPeople->update(
                    [
                        'att_p_signature' => $name,
                    ]
                );
            }
            $formPeople->update(
                [
                'att_p_attendance_id' => $formEvent->id,
                    'att_p_score' => $request->input('att_p_score'),
                    'att_p_remark' => $request->input('att_p_remark'),
                ]
            );

            return response()->json([
                'code' => 200,
                'message' => 'Success Update Data',
                'data' => [new FormAttendancePersonalResource($formPeople)]
                ], 200);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given Personal Attandance ID not found',
                'data' => []
                ], 404);
        }}
    }  catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
        return response()->json([
            'code' => 404,
            'message' => 'Given Attendance Event Form ID not found ('.FormAttendance::findOrFail($request->input('att_p_attendance_id')).')',
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
            FormAttendancePersonal::create([
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
