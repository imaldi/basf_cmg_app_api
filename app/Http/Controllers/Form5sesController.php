<?php

namespace App\Http\Controllers;

use App\Models\Form5ses;
use App\Models\Form5sMaster;
use App\Models\MasterDepartment;
use App\Models\MasterLocation;
use App\Http\Resources\Form5sMasterResource;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class Form5sesController extends Controller
{
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createForm5s(Request $request)
    {
        $employee = Auth::user();

        if ($employee === null) {
            return response()->json([
                'code' => 401,
                'message' => 'Auth',
                ], 401);
        }

        $date = Carbon::now();
        $date->toDateTimeString();
        $department = $employee->department()->first();
        $departmentId = $employee->emp_employee_department_id;
        $departmentAbr = substr(strtoupper($department->dept_name),0,3);

        $form_5s_concise_score = $request->input('form_5s_concise_score');
        $form_5s_neat_score = $request->input('form_5s_neat_score');
        $form_5s_clean_score = $request->input('form_5s_clean_score');
        $form_5s_care_score = $request->input('form_5s_care_score');
        $form_5s_diligent_score = $request->input('form_5s_diligent_score');

        $totalScore =
            (
                $form_5s_concise_score +
                $form_5s_neat_score +
                $form_5s_clean_score +
                $form_5s_care_score +
                $form_5s_diligent_score
            )/5;

        $form5s = Form5ses::create([
            'form_5s_name' => 'XXX',
            'form_5s_submit_date' => Carbon::now(),
            'form_5s_auditor_id' => Auth::user()->id,
            'form_5s_dept_id' => $request->input('dept_id'),
            'form_5s_area_id' => $request->input('area_id'),
            'form_5s_concise_score' => $form_5s_concise_score,
            'form_5s_consice_desc' => $request->input('form_5s_consice_desc'),
            'form_5s_neat_score' => $form_5s_neat_score,
            'form_5s_neat_desc' => $request->input('form_5s_neat_desc'),
            'form_5s_clean_score' => $form_5s_clean_score,
            'form_5s_clean_desc' => $request->input('form_5s_clean_desc'),
            'form_5s_care_score' => $form_5s_care_score,
            'form_5s_care_desc' => $request->input('form_5s_care_desc'),
            'form_5s_diligent_score' => $form_5s_diligent_score,
            'form_5s_diligent_desc' => $request->input('form_5s_diligent_desc'),
            'form_5s_total_score' => $totalScore,
            'form_5s_status' => 2,
        ])->update(
            [
                'form_5s_name' => 'GS-F-0011-1'.$departmentAbr.$date->month.$date->year.$this->id,
            ]
        );
        return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' => $form5s
            ], 200);
    }

    public function updateDraft(Request $request)
    {
        $form5s = Form5ses::firstOrCreate($request->input('form_5s_id'));
        $form_5s_concise_score = $request->input('form_5s_concise_score');
        $form_5s_neat_score = $request->input('form_5s_neat_score');
        $form_5s_clean_score = $request->input('form_5s_clean_score');
        $form_5s_care_score = $request->input('form_5s_care_score');
        $form_5s_diligent_score = $request->input('form_5s_diligent_score');

        $totalScore =
            (
                $form_5s_concise_score +
                $form_5s_neat_score +
                $form_5s_clean_score +
                $form_5s_care_score +
                $form_5s_diligent_score
            )/5;

        $form5s->update([
            'form_5s_submit_date' => Carbon::now(),
            'form_5s_auditor_id' => Auth::user()->id,
            'form_5s_dept_id' => $request->input('dept_id'),
            'form_5s_area_id' => $request->input('area_id'),
            'form_5s_concise_score' => $form_5s_concise_score,
            'form_5s_consice_desc' => $request->input('form_5s_consice_desc'),
            'form_5s_neat_score' => $form_5s_neat_score,
            'form_5s_neat_desc' => $request->input('form_5s_neat_desc'),
            'form_5s_clean_score' => $form_5s_clean_score,
            'form_5s_clean_desc' => $request->input('form_5s_clean_desc'),
            'form_5s_care_score' => $form_5s_care_score,
            'form_5s_care_desc' => $request->input('form_5s_care_desc'),
            'form_5s_diligent_score' => $form_5s_diligent_score,
            'form_5s_diligent_desc' => $request->input('form_5s_diligent_desc'),
            'form_5s_total_score' => $totalScore,
            'form_5s_status' => $request->input('form_5s_status'),
        ]);
        return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' => $form5s
            ], 200);
    }


    public function approveForm5s(Request $request)
    {
        $form5s = Form5ses::firstOrFail($request->input('form_5s_id'));
        try{
            if($request->file('form_5s_consice_photo')){
                $name = time().$request->file('form_5s_consice_photo')->getClientOriginalName();
                $request->file('form_5s_consice_photo')->move('uploads/form5s',$name);
                $form5s->update(
                    [
                        $request->except(['form_5s_consice_photo']),
                        'form_5s_consice_photo' => $name,
                    ]
                );
            }
            if($request->file('form_5s_neat_photo')){
                $name = time().$request->file('form_5s_neat_photo')->getClientOriginalName();
                $request->file('form_5s_neat_photo')->move('uploads/form5s',$name);
                $form5s->update(
                    [
                        $request->except(['form_5s_neat_photo']),
                        'form_5s_neat_photo' => $name,
                    ]
                );
            }
            if($request->file('form_5s_clean_photo')){
                $name = time().$request->file('form_5s_clean_photo')->getClientOriginalName();
                $request->file('form_5s_clean_photo')->move('uploads/form5s',$name);
                $form5s->update(
                    [
                        $request->except(['form_5s_clean_photo']),
                        'form_5s_clean_photo' => $name,
                    ]
                );
            }
            if($request->file('form_5s_care_photo')){
                $name = time().$request->file('form_5s_care_photo')->getClientOriginalName();
                $request->file('form_5s_care_photo')->move('uploads/form5s',$name);
                $form5s->update(
                    [
                        $request->except(['form_5s_care_photo']),
                        'form_5s_care_photo' => $name,
                    ]
                );
            }
            if($request->file('form_5s_diligent_photo')){
                $name = time().$request->file('form_5s_diligent_photo')->getClientOriginalName();
                $request->file('form_5s_diligent_photo')->move('uploads/form5s',$name);
                $form5s->update(
                    [
                        $request->except(['form_5s_diligent_photo']),
                        'form_5s_diligent_photo' => $name,
                    ]
                );
            }

            $form5s->update(
                [
                    'form_5s_status' => 3
                ]
            );

            return response()->json([
                'code' => 200,
                'message' => 'Success Create Data',
                'data' => $form5s
                ], 200);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given Work Order Form ID not found',
                'data' => []
                ], 404);
        }

    }

    public function getDepartments(){
        $masterDepartment = MasterDepartment::All();
        return response()->json([
            'code' => 200,
            'message' => 'Success Fetching All Department',
            'data' =>  $masterDepartment,
            ], 200);
    }

    //data belum ada untuk bukti berhasil tapi request berhasil
    public function getAllLocationsOfDepartment($id){
        $masterLocations = MasterDepartment::find($id)->areas()->select(['id'])->get()
        ->map(function($model) {
            return $model->id;
        })->toArray();
        // $masterLocations->form5sMasterPic()->get();
        $PICList = Form5sMaster::whereIn('form_5s_m_area_id',$masterLocations)->get()->unique('form_5s_m_area_id');
        return response()->json([
            'code' => 200,
            'message' => 'Success Fetching All Department',
            // 'data' =>  $PICList,
            'data' =>  Form5sMasterResource::collection($PICList),
            ], 200);
    }
}
