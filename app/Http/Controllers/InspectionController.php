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
use App\Http\Resources\FormInsSafetyHarnessResource;
use App\Http\Resources\FormsInsScbaResource;
use App\Http\Resources\FormInsSafetyShowerResource;


class InspectionController extends Controller
{
    /// Get All \\\
    public function getAllLadder()
    {
        $user = Auth::user();
        $role = $user->hasRole('Inspection - Ladder - SPV') ? 'ins_la_inspector_id' : 'ins_la_inspector_spv_id';
        $forms= FormsInspLadder::where('ins_la_is_active',1)
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
        $forms= FormsInspH2sConcent::where('ins_h2_is_active',1)
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
        $forms= FormsInspFumeHood::where('ins_fh_is_active',1)
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
        $forms= FormsInspSpillKit::where('ins_sk_is_active',1)
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
        $forms= FormsInspSafetyHarnest::where('ins_sh_is_active',1)
            ->where($role,$user->id)->orderBy('ins_sh_status')->get();
        return response()->json([
            'code' => 200,
            'message' => 'Success Get All Data',
            'data' =>
            FormInsSafetyHarnessResource::collection($forms)
        ]);
    }

    public function getAllScba()
    {
        $user = Auth::user();
        $role = $user->hasRole('Inspection - SCBA - SPV') ? 'ins_sc_inspector_id' : 'ins_sc_checker_id';
        $forms= FormsInspSCBA::where('ins_sc_is_active',1)
            ->where($role,$user->id)->orderBy('ins_sc_status')->get();
        return response()->json([
            'code' => 200,
            'message' => 'Success Get All Data',
            'data' =>
            FormsInsScbaResource::collection($forms)
        ]);
    }

    public function getAllSafetyShower()
    {
        $user = Auth::user();
        $role = $user->hasRole('Inspection - Safety Shower - SPV') ? 'ins_ss_checker_id' : 'ins_ss_inspector_id';
        $forms= FormsInspSafetyShower::where('ins_ss_is_active',1)
            ->where($role,$user->id)->orderBy('ins_ss_status')->get();
        return response()->json([
            'code' => 200,
            'message' => 'Success Get All Data',
            'data' =>
            FormInsSafetyShowerResource::collection($forms)
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

    //ready to test
    public function createH2s(Request $request)
    {
        $employee = Auth::user();

        $date = Carbon::now();
        $date->toDateTimeString();
        $department = $employee->department()->first();
        $departmentAbr = substr(strtoupper($department->dept_name),0,3);

        $formID = FormsInspH2sConcent::max('id') + 1;
        $formIDFormatted = str_pad($formID, 2, '0', STR_PAD_LEFT);

        //validation supaya bentuknya array
        $locationIds = $request->input('location_ids');
        $subArrayLocIds = substr($locationIds, 1, -1);
        $idLocArray = explode(",",$subArrayLocIds);

        $insH2Check05PercentageVal = $request->input('ins_h2_check_05_percentage_array');
        $subArrayCheck05PercentIds = substr($insH2Check05PercentageVal, 1, -1);
        $idCheck05PercentArray = explode(",",$subArrayCheck05PercentIds);

        $insH2Check10PercentageVal = $request->input('ins_h2_check_10_percentage_array');
        $subArrayCheck10PercentIds = substr($insH2Check10PercentageVal, 1, -1);
        $idCheck10PercentArray = explode(",",$subArrayCheck10PercentIds);

        $insH2CheckLelPercentageVal = $request->input('ins_h2_check_lel_percentage_array');
        $subArrayCheckLelPercentIds = substr($insH2CheckLelPercentageVal, 1, -1);
        $idCheckLelPercentArray = explode(",",$subArrayCheckLelPercentIds);

        $insH2RemarkVal = $request->input('ins_h2_remark_array');
        $subArrayRemarkVal = substr($insH2RemarkVal, 1, -1);
        $remarkValArray = explode(",",$subArrayRemarkVal);



        $form = FormsInspH2sConcent::create(
            $request->except([
                'ins_h2_approved_date',
                'location_ids',
                'ins_h2_check_05_percentage_array',
                'ins_h2_check_10_percentage_array',
                'ins_h2_check_lel_percentage_array',
                'ins_h2_remark_array'
            ])
            );
        $form->update([
            'ins_h2_inspector_id' => Auth::user()->id,
            'ins_h2_inspector_spv_id' => User::role('Inspection - H2S - SPV')->first()->id,
            'ins_h2_status' => 2,
            'ins_h2_is_active' => 1,
            'ins_h2_submited_date' => Carbon::now(),
            'ins_h2_name' => 'GS-F-5002-4/'.$departmentAbr.'/'.$date->month.'/'.$date->year.'/'.$formIDFormatted,
        ]);

        foreach($idLocArray as $key=>$id){
            ContentInspH2sCnct::create([
                'ins_h2_form_id' => $form->id,
                'ins_h2_location_id' => $id,
                'ins_h2_check_05_percentage' => $idCheck05PercentArray[$key],
                'ins_h2_check_10_percentage' => $idCheck10PercentArray[$key],
                'ins_h2_check_lel_percentage' => $idCheckLelPercentArray[$key],
                'ins_h2_remark' => $remarkValArray[$key]
            ]);
        }

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

        //validation supaya bentuknya array
        $locationIds = $request->input('location_ids');
        $subArrayLocIds = substr($locationIds, 1, -1);
        $idLocArray = explode(",",$subArrayLocIds);

        $insSKBoxCondition = $request->input('ins_sk_box_condition');
        $subArraySKBoxCondition = substr($insSKBoxCondition, 1, -1);
        $skBoxConditionArray = explode(",",$subArraySKBoxCondition);

        $insSKContents = $request->input('ins_sk_contents');
        $subArraySKContents = substr($insSKContents, 1, -1);
        $skContentsArray = explode(",",$subArraySKContents);

        $insSKDocuments = $request->input('ins_sk_documents');
        $subArraySKDocuments = substr($insSKDocuments, 1, -1);
        $skDocumentsArray = explode(",",$subArraySKDocuments);

        $insSKRemarkVal = $request->input('ins_sk_remark_array');
        $subArraySKRemarkVal = substr($insSKRemarkVal, 1, -1);
        $skRemarkValArray = explode(",",$subArraySKRemarkVal);

        $form = FormsInspSpillKit::create(
            $request->except([
                'ins_sk_approved_date',
                'location_ids',
                'ins_sk_box_condition',
                'ins_sk_contents',
                'ins_sk_documents',
                'ins_sk_remark_array'
                ])
        );
        $form->update([
            'ins_sk_inspector_id' => Auth::user()->id,
            'ins_sk_inspector_spv_id' => User::role('Inspection - Spill Kit - SPV')->first()->id,
            'ins_sk_status' => 2,
            'ins_sk_is_active' => 1,
            'ins_sk_submited_date' => Carbon::now(),
            'ins_sk_name' => 'GS-F-3014-2'.$departmentAbr.'/'.$date->month.'/'.$date->year.'/'.$formIDFormatted,
        ]);

        foreach($idLocArray as $key=>$id){
            ContentInspSpillKit::create([
                'ins_sk_form_id' => $form->id,
                'ins_sk_location_id' => $id,
                'ins_sk_box_condition' => $skBoxConditionArray[$key],
                'ins_sk_contents' => $skContentsArray[$key],
                'ins_sk_documents' => $skDocumentsArray[$key],
                'ins_sk_remark' => $skRemarkValArray[$key]
            ]);
        }

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

        //validation supaya bentuknya array
        $locationIds = $request->input('location_ids');
        $subArrayLocIds = substr($locationIds, 1, -1);
        $idLocArray = explode(",",$subArrayLocIds);

        $insSHWebbing = $request->input('ins_sh_webbing');
        $subArrayInsSHWebbing = substr($insSHWebbing, 1, -1);
        $insSHWebbingArray = explode(",",$subArrayInsSHWebbing);

        $insSHDRings = $request->input('ins_sh_d_rings');
        $subArraySHDRings = substr($insSHDRings, 1, -1);
        $shDRingsArray = explode(",",$subArraySHDRings);

        $insSHAttachmentBuckles = $request->input('ins_sh_attachment_buckles');
        $subArraySHAttachmentBuckles = substr($insSHAttachmentBuckles, 1, -1);
        $shAttachmentBucklesArray = explode(",",$subArraySHAttachmentBuckles);

        $insSHHookOrCarabiner = $request->input('ins_sh_hook_or_carabiner');
        $subArraySHHookOrCarabiner = substr($insSHHookOrCarabiner, 1, -1);
        $shHookOrCarabinerArray = explode(",",$subArraySHHookOrCarabiner);

        $insSHWebLanyard = $request->input('ins_sh_web_lanyard');
        $subArraySHWebLanyard = substr($insSHWebLanyard, 1, -1);
        $shWebLanyardArray = explode(",",$subArraySHWebLanyard);

        $insSHRopeLanyard = $request->input('ins_sh_rope_lanyard');
        $subArraySHRopeLanyard = substr($insSHRopeLanyard, 1, -1);
        $shRopeLanyardArray = explode(",",$subArraySHRopeLanyard);

        $insSHShockAbsorberPack = $request->input('ins_sh_shock_absorber_pack');
        $subArraySHShockAbsorberPack = substr($insSHShockAbsorberPack, 1, -1);
        $shShockAbsorberPackArray = explode(",",$subArraySHShockAbsorberPack);

        $insSHRemarkVal = $request->input('ins_sh_remark_array');
        $subArraySHRemarkVal = substr($insSHRemarkVal, 1, -1);
        $shRemarkValArray = explode(",",$subArraySHRemarkVal);

        $form = FormsInspSafetyHarnest::create(
            $request->except([
                'ins_sh_approved_date',
                'location_ids',
                'ins_sh_webbing',
                'ins_sh_d_rings',
                'ins_sh_attachment_buckles',
                'ins_sh_hook_or_carabiner',
                'ins_sh_web_lanyard',
                'ins_sh_rope_lanyard',
                'ins_sh_shock_absorber_pack',
                'ins_sh_remark_array',
            ])
        );
        $form->update([
            'ins_sh_inspector_id' => Auth::user()->id,
            'ins_sh_inspector_spv_id' => User::role('Inspection - Safety Harness - SPV')->first()->id,
            'ins_sh_status' => 2,
            'ins_sh_is_active' => 1,
            'ins_sh_submited_date' => Carbon::now(),
            'ins_sh_name' => 'GS-F-3014-2'.$departmentAbr.'/'.$date->month.'/'.$date->year.'/'.$formIDFormatted,
        ]);

        foreach($idLocArray as $key=>$id){
            ContentInspSafetyHarnest::create([
                'ins_sh_form_id' => $form->id,
                'ins_sh_location_id' => $id,
                'ins_sh_webbing' => $insSHWebbingArray[$key],
                'ins_sh_d_rings' => $shDRingsArray[$key],
                'ins_sh_attachment_buckles' => $shAttachmentBucklesArray[$key],
                'ins_sh_hook_or_carabiner' => $shHookOrCarabinerArray[$key],
                'ins_sh_web_lanyard' => $shWebLanyardArray[$key],
                'ins_sh_rope_lanyard' => $shRopeLanyardArray[$key],
                'ins_sh_shock_absorber_pack' => $shShockAbsorberPackArray[$key],
                'ins_sh_remark' => $shRemarkValArray[$key]
            ]);
        }

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

        //validation supaya bentuknya array
        $locationIds = $request->input('location_ids');
        $subArrayLocIds = substr($locationIds, 1, -1);
        $idLocArray = explode(",",$subArrayLocIds);

        $insScLeaka = $request->input('ins_sc_leaka');
        $subArrayInsScLeaka = substr($insScLeaka, 1, -1);
        $insScLeakaArray = explode(",",$subArrayInsScLeaka);

        $insSCPressureBar = $request->input('ins_sc_pressure_bar');
        $subArrayInsSCPressureBar = substr($insSCPressureBar, 1, -1);
        $insSCPressureBarArray = explode(",",$subArrayInsSCPressureBar);

        $insSCWalveOrSeal = $request->input('ins_sc_walve_or_seal');
        $subArrayInsSCWalveOrSeal = substr($insSCWalveOrSeal, 1, -1);
        $insSCWalveOrSealArray = explode(",",$subArrayInsSCWalveOrSeal);

        $insSCMaskerCondition = $request->input('ins_sc_masker_condition');
        $subArrayInsSCMaskerCondition = substr($insSCMaskerCondition, 1, -1);
        $insSCMaskerConditionArray = explode(",",$subArrayInsSCMaskerCondition);

        $insSCRemarkVal = $request->input('ins_sc_remark_array');
        $subArraySCRemarkVal = substr($insSCRemarkVal, 1, -1);
        $scRemarkValArray = explode(",",$subArraySCRemarkVal);


        $form = FormsInspSCBA::create(
            $request->except([
                'ins_sc_approved_date',
                'location_ids',
                'ins_sc_leaka',
                'ins_sc_pressure_bar',
                'ins_sc_walve_or_seal',
                'ins_sc_masker_condition',
                'ins_sc_remark_array',
            ])
        );
        $form->update([
            'ins_sc_inspector_id' => Auth::user()->id,
            'ins_sc_checker_id' => User::role('Inspection - SCBA - SPV')->first()->id,
            'ins_sc_status' => 2,
            'ins_sc_is_active' => 1,
            'ins_sc_submited_date' => Carbon::now()
        ]);

        foreach($idLocArray as $key=>$id){
            ContentInspSCBA::create([
                'ins_sc_form_id' => $form->id,
                'ins_sc_location_id' => $id,
                'ins_sc_leaka' => $insScLeakaArray[$key],
                'ins_sc_pressure_bar' => $insSCPressureBarArray[$key],
                'ins_sc_walve_or_seal' => $insSCWalveOrSealArray[$key],
                'ins_sc_masker_condition' => $insSCMaskerConditionArray[$key],
                'ins_sc_remark' => $scRemarkValArray[$key]
            ]);
        }

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

        //validation supaya bentuknya array
        $locationIds = $request->input('location_ids');
        $subArrayLocIds = substr($locationIds, 1, -1);
        $idLocArray = explode(",",$subArrayLocIds);

        $insSSLeaka = $request->input('ins_ss_leaka');
        $subArrayInsSSLeaka = substr($insSSLeaka, 1, -1);
        $insSSLeakaArray = explode(",",$subArrayInsSSLeaka);

        $insSSWaterShower = $request->input('ins_ss_water_shower');
        $subArrayInsSSWaterShower = substr($insSSWaterShower, 1, -1);
        $insSSWaterShowerArray = explode(",",$subArrayInsSSWaterShower);

        $insSSWaterEyeWash = $request->input('ins_ss_water_eye_wash');
        $subArrayInsSSWaterEyeWash = substr($insSSWaterEyeWash, 1, -1);
        $insSSWaterEyeWashArray = explode(",",$subArrayInsSSWaterEyeWash);

        $insSSValveOrSeal = $request->input('ins_ss_valve_or_seal');
        $subArrayInsSSValveOrSeal = substr($insSSValveOrSeal, 1, -1);
        $insSSValveOrSealArray = explode(",",$subArrayInsSSValveOrSeal);

        $insSSSignBoard = $request->input('ins_ss_sign_board');
        $subArrayInsSSSignBoard = substr($insSSSignBoard, 1, -1);
        $insSSSignBoardArray = explode(",",$subArrayInsSSSignBoard);

        $insSSCleanliness = $request->input('ins_ss_cleanliness');
        $subArrayInsSSCleanliness = substr($insSSCleanliness, 1, -1);
        $insSSCleanlinessArray = explode(",",$subArrayInsSSCleanliness);

        $insSSAlarmCondition = $request->input('ins_ss_alarm_condition');
        $subArrayInsSSAlarmCondition = substr($insSSAlarmCondition, 1, -1);
        $insSSAlarmConditionArray = explode(",",$subArrayInsSSAlarmCondition);

        $insSSRemarkVal = $request->input('ins_ss_remarks_array');
        $subArraySSRemarkVal = substr($insSSRemarkVal, 1, -1);
        $ssRemarkValArray = explode(",",$subArraySSRemarkVal);

        $form = FormsInspSafetyShower::create(
            $request->except([
                'ins_ss_approved_date',
                'location_ids',
                'ins_ss_leaka',
                'ins_ss_water_shower',
                'ins_ss_water_eye_wash',
                'ins_ss_valve_or_seal',
                'ins_ss_sign_board',
                'ins_ss_cleanliness',
                'ins_ss_alarm_condition',
                'ins_ss_remarks_array',
            ])
        );
        $form->update([
            'ins_ss_inspector_id' => Auth::user()->id,
            'ins_ss_checker_id' => User::role('Inspection - Safety Shower - SPV')->first()->id,
            'ins_ss_status' => 2,
            'ins_ss_is_active' => 1,
            'ins_ss_submited_date' => Carbon::now()
        ]);

        foreach($idLocArray as $key=>$id){
            ContentInspSafetyShower::create([
                'ins_ss_form_id' => $form->id,
                'ins_ss_location_id' => $id,
                'ins_ss_leaka' => $insSSLeakaArray[$key],
                'ins_ss_water_shower' => $insSSWaterShowerArray[$key],
                'ins_ss_water_eye_wash' => $insSSWaterEyeWashArray[$key],
                'ins_ss_valve_or_seal' => $insSSValveOrSealArray[$key],
                'ins_ss_sign_board' => $insSSSignBoardArray[$key],
                'ins_ss_cleanliness' => $insSSCleanlinessArray[$key],
                'ins_ss_alarm_condition' => $insSSAlarmConditionArray[$key],
                'ins_ss_remarks' => $ssRemarkValArray[$key]
            ]);
        }

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
