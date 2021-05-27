<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ContentInspFumeHood;
use App\Models\ContentInspH2sCnct;
use App\Models\ContentInspSafetyHarnest;
use App\Models\ContentInspSafetyShower;
use App\Models\ContentInspSCBA;
use App\Models\ContentInspSpillKit;
use App\Models\FormsInspFumeHood;
use App\Models\FormsInspH2sConcent;
use App\Models\FormsInspLadder;
use App\Models\FormsInspSafetyHarnest;
use App\Models\FormsInspSafetyShower;
use App\Models\FormsInspSCBA;
use App\Models\FormsInspSpillKit;
use App\Http\Resources\FormsInspLadderResource;
use App\Http\Resources\FormsInspH2sConcentResource;
use App\Http\Resources\FormsInspFumeHoodResource;
use App\Http\Resources\FormsInspSpillKitResource;
use App\Http\Resources\FormsInspSafetyHarnestResource;
use App\Http\Resources\FormsInspSCBAResource;
use App\Http\Resources\FormsInspSafetyShowerResource;


class InspectionController extends Controller
{
    /// Get All \\\
    public function getAllLadder()
    {
        $user = Auth::user();
        $role = $user->hasRole('Inspection - Ladder - SPV') ? 'ins_la_inspector_id' : 'ins_la_inspector_spv_id';
        $forms= FormsInspLadder::where('ins_la_is_active',true)
            ->where($role,$user->id)->orderBy('ins_la_status')->get();
        return response()->json([
            'code' => 200,
            'message' => 'Success Get All Data',
            'data' =>
            FormsInspLadderResource::collection($forms)
        ]);
    }

    public function getAllH2s()
    {
        $user = Auth::user();
        $role = $user->hasRole('Inspection - H2S - SPV') ? 'ins_h2_inspector_id' : 'ins_h2_inspector_spv_id';
        $forms= FormsInspH2sConcent::where('ins_h2_is_active',true)
            ->where($role,$user->id)->orderBy('ins_h2_status')->get();
        return response()->json([
            'code' => 200,
            'message' => 'Success Get All Data',
            'data' =>
            FormsInspH2sConcentResource::collection($forms)
        ]);
    }

    public function getAllFumeHood()
    {
        $user = Auth::user();
        $role = $user->hasRole('Inspection - Fume Hood - SPV') ? 'ins_fh_inspector_id' : 'ins_fh_inspector_spv_id';
        $forms= FormsInspFumeHood::where('ins_fh_is_active',true)
            ->where($role,$user->id)->orderBy('ins_fh_status')->get();
        return response()->json([
            'code' => 200,
            'message' => 'Success Get All Data',
            'data' =>
            FormsInspFumeHoodResource::collection($forms)
        ]);
    }

    public function getAllSpillKit()
    {
        $user = Auth::user();
        $role = $user->hasRole('Inspection - Spill Kit - SPV') ? 'ins_sk_inspector_id' : 'ins_sk_inspector_spv_id';
        $forms= FormsInspSpillKit::where('ins_sk_is_active',true)
            ->where($role,$user->id)->orderBy('ins_sk_status')->get();
        return response()->json([
            'code' => 200,
            'message' => 'Success Get All Data',
            'data' =>
            FormsInspSpillKitResource::collection($forms)
        ]);
    }

    public function getAllSafetyHarness()
    {
        $user = Auth::user();
        $role = $user->hasRole('Inspection - Safety Harness - SPV') ? 'ins_sh_inspector_id' : 'ins_sh_inspector_spv_id';
        $forms= FormsInspSafetyHarnest::where('ins_sh_is_active',true)
            ->where($role,$user->id)->orderBy('ins_sh_status')->get();
        return response()->json([
            'code' => 200,
            'message' => 'Success Get All Data',
            'data' =>
            FormsInspSafetyHarnestResource::collection($forms)
        ]);
    }

    public function getAllScba()
    {
        $user = Auth::user();
        $role = $user->hasRole('Inspection - SCBA - SPV') ? 'ins_sc_inspector_id' : 'ins_sc_checker_id';
        $forms= FormsInspSCBA::where('ins_sc_is_active',true)
            ->where($role,$user->id)->orderBy('ins_sc_status')->get();
        return response()->json([
            'code' => 200,
            'message' => 'Success Get All Data',
            'data' =>
            FormsInspSCBAResource::collection($forms)
        ]);
    }

    public function getAllSafetyShower()
    {
        $user = Auth::user();
        $role = $user->hasRole('Inspection - Ladder - SPV') ? 'id_checker' : 'id_inspector';
        $forms= FormsInspSafetyShower::where('is_active',true)
            ->where('id_checker',$user->id)->orderBy('form_status')->get();
        return response()->json([
            'code' => 200,
            'message' => 'Success Get All Data',
            'data' =>
            FormsInspSafetyShowerResource::collection($forms)
        ]);
    }


    /// Get One \\\

    public function getOneLadder($id)
    {
        $forms= [FormsInspLadder::find($id)];
        return response()->json([
            'code' => 200,
            'message' => 'Success Get Data',
            'data' =>
            FormsInspLadderResource::collection($forms)
        ]);
    }

    public function getOneH2s($id)
    {
        $forms= [FormsInspH2sConcent::find($id)];
        return response()->json([
            'code' => 200,
            'message' => 'Success Get Data',
            'data' =>
            FormsInspH2sConcentResource::collection($forms)
        ]);
    }

    public function getOneFumeHood($id)
    {
        $forms= [FormsInspFumeHood::find($id)];
        return response()->json([
            'code' => 200,
            'message' => 'Success Get Data',
            'data' =>
            FormsInspFumeHoodResource::collection($forms)
        ]);
    }

    public function getOneSpillKit($id)
    {
        $forms= [FormsInspSpillKit::find($id)];
        return response()->json([
            'code' => 200,
            'message' => 'Success Get Data',
            'data' =>
            FormsInspSpillKitResource::collection($forms)
        ]);
    }

    public function getOneSafetyHarness($id)
    {
        $forms= [FormsInspSafetyHarness::find($id)];
        return response()->json([
            'code' => 200,
            'message' => 'Success Get Data',
            'data' =>
            FormsInspSafetyHarnessResource::collection($forms)
        ]);
    }

    public function getOneScba($id)
    {
        $forms= [FormsInspSCBA::find($id)];
        return response()->json([
            'code' => 200,
            'message' => 'Success Get Data',
            'data' =>
            FormsInspSCBAResource::collection($forms)
        ]);
    }

    public function getOneSafetyShower($id)
    {
        $forms= [FormsInspSafetyShower::find($id)];
        return response()->json([
            'code' => 200,
            'message' => 'Success Get Data',
            'data' =>
            FormsInspSafetyShowerResource::collection($forms)
        ]);
    }

    /// Create \\\

    public function createLadder(Request $request)
    {

        $employee = Auth::user();

        $date = Carbon::now();
        $date->toDateTimeString();
        $department = $employee->department()->first();
        $departmentAbr = substr(strtoupper($department->dept_name),0,3);

        $formID = FormsInspLadder::max('id') + 1;
        $formIDFormatted = str_pad($formID, 2, '0', STR_PAD_LEFT);

        $form = FormsInspLadder::create(
            $request->except([
                'ins_la_name',
                'ins_la_approved_date',
            ])
            );
        $form->update([
            'ins_la_inspector_id' => Auth::user()->id,
            'ins_la_inspector_spv_id' => User::role('Inspection - Ladder - SPV')->first()->id,
            // 'ins_la_status' => 2,
            'ins_la_name' => 'GS-F-5003-2'.$departmentAbr.'/'.$date->month.'/'.$date->year.'/'.$formIDFormatted,
            'ins_la_submited_date' => Carbon::now()
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' =>
            // $form
            [new FormsInspLadderResource($form)]
        ]);
    }

    public function createH2s(Request $request)
    {
        $employee = Auth::user();

        $date = Carbon::now();
        $date->toDateTimeString();
        $department = $employee->department()->first();
        $departmentAbr = substr(strtoupper($department->dept_name),0,3);

        $formID = FormsInspH2sConcent::max('id') + 1;
        $formIDFormatted = str_pad($formID, 2, '0', STR_PAD_LEFT);

        $form = FormsInspH2sConcent::create(
            $request->except([
                'ins_h2_approved_date',
            ])
            );
        $form->update([
            'ins_h2_inspector_id' => Auth::user()->id,
            'ins_h2_inspector_spv_id' => User::role('Inspection - H2S - SPV')->first()->id,
            'ins_h2_status' => 2,
            'ins_h2_submited_date' => Carbon::now(),
            'ins_h2_name' => 'GS-F-5002-4/'.$departmentAbr.'/'.$date->month.'/'.$date->year.'/'.$formIDFormatted,
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' =>
            [new FormsInspH2sConcentResource($form)]
        ]);
    }

    public function createFumeHood(Request $request)
    {
        $employee = Auth::user();

        $date = Carbon::now();
        $date->toDateTimeString();
        $department = $employee->department()->first();
        $departmentAbr = substr(strtoupper($department->dept_name),0,3);

        $formID = FormsInspFumeHood::max('id') + 1;
        $formIDFormatted = str_pad($formID, 2, '0', STR_PAD_LEFT);

        $form = FormsInspFumeHood::create(
            $request->except([
                'ins_fh_name',
                'ins_fh_approved_date',
            ])
        );
        $form->update([
            'ins_fh_inspector_id' =>  $employee->id,
            'ins_fh_inspector_spv_id' => User::role('Inspection - Fume Hood - SPV')->first()->id,
            'ins_fh_status' => 2,
            'ins_fh_submited_date' => Carbon::now(),
            'ins_fh_is_active' => 1,
            'ins_fh_name' => 'GS-F-5001-2'.$departmentAbr.'/'.$date->month.'/'.$date->year.'/'.$formIDFormatted,
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' =>
           [new FormsInspFumeHoodResource($form)]
        ]);
    }

    public function createSpillKit(Request $request)
    {
        $employee = Auth::user();

        $date = Carbon::now();
        $date->toDateTimeString();
        $department = $employee->department()->first();
        $departmentAbr = substr(strtoupper($department->dept_name),0,3);

        $formID = FormsInspSpillKit::max('id') + 1;
        $formIDFormatted = str_pad($formID, 2, '0', STR_PAD_LEFT);

        $form = FormsInspSpillKit::create(
            $request->except([
                'ins_sk_approved_date',
            ])
        );
        $form->update([
            'ins_sk_inspector_id' => Auth::user()->id,
            'ins_sk_inspector_spv_id' => User::role('Inspection - Spill Kit - SPV')->first()->id,
            'ins_sk_status' => 2,
            'ins_sk_submited_date' => Carbon::now(),
            'ins_sk_name' => 'GS-F-3014-2'.$departmentAbr.'/'.$date->month.'/'.$date->year.'/'.$formIDFormatted,
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' =>
           [new FormsInspSpillKitResource($form)]
        ]);
    }

    public function createSafetyHarness(Request $request)
    {
        $employee = Auth::user();

        $date = Carbon::now();
        $date->toDateTimeString();
        $department = $employee->department()->first();
        $departmentAbr = substr(strtoupper($department->dept_name),0,3);

        $formID = FormsInspSafetyHarnest::max('id') + 1;
        $formIDFormatted = str_pad($formID, 2, '0', STR_PAD_LEFT);

        $form = FormsInspSafetyHarnest::create(
            $request->except([
                'ins_sh_approved_date',
            ])
        );
        $form->update([
            'ins_sh_inspector_id' => Auth::user()->id,
            'ins_sh_inspector_spv_id' => User::role('Inspection - Safety Harness - SPV')->first()->id,
            'ins_sh_status' => 2,
            'ins_sh_submited_date' => Carbon::now(),
            'ins_sh_name' => 'GS-F-3014-2'.$departmentAbr.'/'.$date->month.'/'.$date->year.'/'.$formIDFormatted,
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' =>
           [new FormInsSafetyHarnessResource($form)]
        ]);
    }

    public function createScba(Request $request)
    {
        $employee = Auth::user();

        $date = Carbon::now();
        $date->toDateTimeString();
        $department = $employee->department()->first();
        $departmentAbr = substr(strtoupper($department->dept_name),0,3);

        $formID = FormsInspSCBA::max('id') + 1;
        $formIDFormatted = str_pad($formID, 2, '0', STR_PAD_LEFT);

        $form = FormsInspSCBA::create(
            $request->except([
                'ins_sc_approved_date',
            ])
        );
        $form->update([
            'ins_sc_inspector_id' => Auth::user()->id,
            'ins_sc_inspector_spv_id' => User::role('Inspection - SCBA - SPV')->first()->id,
            'ins_sc_status' => 2,
            'ins_sc_submited_date' => Carbon::now()
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' =>
           [new FormsInsScbaResource($form)]
        ]);
    }

    public function createSafetyShower(Request $request)
    {
        $employee = Auth::user();

        $date = Carbon::now();
        $date->toDateTimeString();
        $department = $employee->department()->first();
        $departmentAbr = substr(strtoupper($department->dept_name),0,3);

        $formID = FormsInspSafetyShower::max('id') + 1;
        $formIDFormatted = str_pad($formID, 2, '0', STR_PAD_LEFT);

        $form = FormsInspSafetyShower::create(
            $request->except([
                'ins_ss_approved_date',
            ])
        );
        $form->update([
            'ins_ss_inspector_id' => Auth::user()->id,
            'ins_ss_inspector_spv_id' => User::role('Inspection - Safety Shower - SPV')->first()->id,
            'ins_ss_status' => 2,
            'ins_ss_submited_date' => Carbon::now()
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' =>
           [new FormInsSafetyShowerResource($form)]
        ]);
    }

    /// Save Draft \\\
    public function saveDraftLadder(Request $request,$id)
    {
        $form = FormsInspLadder::firstOrFail(['id' => $id]);
        $form->update(
            $request->except([
                'ins_la_inspector_id',
                'ins_la_inspector_spv_id',
                'ins_la_approved_date',
            ])
        )->update([
            'ins_la_status' => 1
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success Save Draft',
            'data' =>
           [new FormsInspLadderResource($form)]
        ]);
    }

    public function saveDraftH2s(Request $request)
    {
        $form = FormsInspH2sConcent::firstOrFail(['id' => $id]);
        $form->update(
            $request->except([
                'ins_h2_inspector_id',
                'ins_h2_inspector_spv_id',
                'ins_h2_approved_date',
            ])
        )->update([
            'ins_h2_status' => 1
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success Save Draft',
            'data' =>
           [new FormsInspH2sConcent($form)]
        ]);
    }

    public function saveDraftFumeHood(Request $request)
    {
        $form = FormsInspFumeHood::firstOrFail(['id' => $id]);
        $form->update(
            $request->except([
                'ins_fh_inspector_id',
                'ins_fh_inspector_spv_id',
                'ins_fh_approved_date',
            ])
        )->update([
            'ins_fh_status' => 1
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success Save Draft',
            'data' =>
           [new FormsInspFumeHoodResource($form)]
        ]);
    }

    public function saveDraftSpillKit(Request $request)
    {
        $form = FormsInspLadder::firstOrFail(['id' => $id]);
        $form->update(
            $request->except([
                'ins_sk_inspector_id',
                'ins_sk_inspector_spv_id',
                'ins_sk_approved_date',
            ])
        )->update([
            'ins_sk_status' => 1
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success Save Draft',
            'data' =>
            [new FormsInspLadderResource($form)]
        ]);
    }

    public function saveDraftSafetyHarness(Request $request)
    {
        $form = FormsInspSafetyHarness::firstOrFail(['id' => $id]);
        $form->update(
            $request->except([
                'ins_sh_inspector_id',
                'ins_sh_inspector_spv_id',
                'ins_sh_approved_date',
            ])
        )->update([
            'ins_sh_status' => 1
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success Save Draft',
            'data' =>
            [new FormsInspSafetyHarnessResource($form)]
        ]);
    }

    public function saveDraftScba(Request $request)
    {
        $form = FormsInspSCBA::firstOrFail(['id' => $id]);
        $form->update(
            $request->except([
                'ins_sc_inspector_id',
                'ins_sc_inspector_spv_id',
                'ins_sc_approved_date',
            ])
        )->update([
            'ins_sc_status' => 1
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success Save Draft',
            'data' =>
            [new FormsInsScbaResource($form)]
        ]);
    }

    public function saveDraftSafetyShower(Request $request)
    {
        $form = FormsInspSafetyShower::firstOrFail(['id' => $id]);
        $form->update(
            $request->except([
                'ins_sh_inspector_id',
                'ins_sh_inspector_spv_id',
                'ins_sh_approved_date',
            ])
        )->update([
            'ins_sh_status' => 1
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success Save Draft',
            'data' =>
            [new FormsInspSafetyShowerResource($form)]
        ]);
    }

    // public function saveDraftScba(Request $request)
    // {
    //     $form = FormsInspSCBA::firstOrFail(['id' => $id])->update(
    //         $request->except([
    //             'ins_sc_inspector_id',
    //             'ins_sc_inspector_spv_id',
    //             'ins_sc_approved_date',
    //         ])
    //     )->update([
    //         'ins_sc_status' => 1
    //     ]);

    //     return response()->json([
    //         'code' => 200,
    //         'message' => 'Success Save Draft',
    //         'data' =>
    //        [new FormsInsScbaResource($form)
    //     ]);
    // }

    /// Approve \\\

    public function approveLadder($id)
    {
        $form = FormsInspLadder::find($id);
        $form->update([
            'ins_la_status' => 3,
            'ins_la_approved_date' => Carbon::now(),
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success Save Draft',
            'data' =>
            [new FormsInspLadderResource($form)]
        ]);
    }

    public function approveH2s($id)
    {
        $form = FormsInspH2sConcent::find($id);
        $form->update([
            'ins_h2_status' => 3,
            'ins_h2_approved_date' => Carbon::now(),
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success Save Draft',
            'data' =>
            [new FormsInspH2sConcentResource($form)]
        ]);
    }

    public function approveFumeHood($id)
    {
        $form = FormsInspFumeHood::find($id);
        $form->update([
            'ins_fh_status' => 3,
            'ins_fh_approved_date' => Carbon::now(),
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success Save Draft',
            'data' =>
            [new FormsInspFumeHoodResource($form)]
        ]);
    }

    public function approveSpillKit($id)
    {
        $form = FormsInspLadder::find($id);
        $form->update([
            'ins_sk_status' => 3,
            'ins_sk_approved_date' => Carbon::now(),
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success Save Draft',
            'data' =>
            [new FormsInspSpillKitResource($form)]
        ]);
    }

    public function approveSafetyHarness($id)
    {
        $form = FormsInspSafetyHarness::find($id);
        $form->update([
            'ins_sh_status' => 3,
            'ins_sh_approved_date' => Carbon::now(),
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success Save Draft',
            'data' =>
            [new FormsInspSafetyHarnessResource($form)]
        ]);
    }

    public function approveScba($id)
    {
        $form = FormsInspSCBA::find($id);
        $form->update([
            'ins_sc_status' => 3,
            'ins_sc_approved_date' => Carbon::now(),
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success Save Draft',
            'data' =>
            [new FormsInsScbaResource($form)]
        ]);
    }

    public function approveSafetyShower($id)
    {
        $form = FormsInspSafetyShower::find($id);
        $form->update([
            'ins_ss_status' => 3,
            'ins_ss_approved_date' => Carbon::now(),
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success Save Draft',
            'data' =>
            [new FormsInspSafetyShowerResource($form)]
        ]);
    }
}
