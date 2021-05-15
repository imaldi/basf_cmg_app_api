<?php

namespace App\Http\Controllers;

use Auth;
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
        $form = [FormsInspLadder::create(
            $request->except([
                'ins_la_approved_date',
            ])
        )->update([
            'ins_la_inspector_id' => Auth::user()->id,
            'ins_la_inspector_spv_id' => User::hasRole('Inspection - Ladder - SPV')->first(),
            'ins_la_status' => 2,
            'ins_la_submited_date' => Carbon::now()
        ])];

        return return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' => 
            new FormsInspLadderResource($form)
        ]);
    }

    public function createH2s(Request $request)
    {
        $form = [FormsInspH2sConcent::create(
            $request->except([
                'ins_h2_approved_date',
            ])
        )->update([
            'ins_h2_inspector_id' => Auth::user()->id,
            'ins_h2_inspector_spv_id' => User::hasRole('Inspection - H2S - SPV')->first(),
            'ins_h2_status' => 2,
            'ins_h2_submited_date' => Carbon::now()
        ])];

        return return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' => 
            new FormsInspH2sConcentResource($form)
        ]);
    }
    
    public function createFumeHood(Request $request)
    {
        $form = [FormsInspFumeHood::create(
            $request->except([
                'ins_fh_approved_date',
            ])
        )->update([
            'ins_fh_inspector_id' => Auth::user()->id,
            'ins_fh_inspector_spv_id' => User::hasRole('Inspection - Fume Hood - SPV')->first(),
            'ins_fh_status' => 2,
            'ins_fh_submited_date' => Carbon::now()
        ])];

        return return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' => 
            new FormsInspFumeHoodResource($form)
        ]);
    }
    
    public function createSpillKit(Request $request)
    {
        $form = [FormsInspSpillKit::create(
            $request->except([
                'ins_sk_approved_date',
            ])
        )->update([
            'ins_sk_inspector_id' => Auth::user()->id,
            'ins_sk_inspector_spv_id' => User::hasRole('Inspection - Spill Kit - SPV')->first(),
            'ins_sk_status' => 2,
            'ins_sk_submited_date' => Carbon::now()
        ])];

        return return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' => 
            new FormsInspSpillKitResource($form)
        ]);
    }
    
    public function createSafetyHarness(Request $request)
    {
        $form = [FormsInspSafetyHarnest::create(
            $request->except([
                'ins_sh_approved_date',
            ])
        )->update([
            'ins_sh_inspector_id' => Auth::user()->id,
            'ins_sh_inspector_spv_id' => User::hasRole('Inspection - Safety Harness - SPV')->first(),
            'ins_sh_status' => 2,
            'ins_sh_submited_date' => Carbon::now()
        ])];

        return return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' => 
            new FormInsSafetyHarnessResource($form)
        ]);
    }

    public function createScba(Request $request)
    {
        $form = [FormsInspSCBA::create(
            $request->except([
                'ins_sc_approved_date',
            ])
        )->update([
            'ins_sc_inspector_id' => Auth::user()->id,
            'ins_sc_inspector_spv_id' => User::hasRole('Inspection - Ladder - SPV')->first(),
            'ins_sc_status' => 2,
            'ins_sc_submited_date' => Carbon::now()
        ])];

        return return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' => 
            new FormsInsScbaResource($form)
        ]);
    }

    public function createSafetyShower(Request $request)
    {
        $form = [FormsInspSafetyShower::create(
            $request->except([
                'ins_ss_approved_date',
            ])
        )->update([
            'ins_ss_inspector_id' => Auth::user()->id,
            'ins_ss_inspector_spv_id' => User::hasRole('Inspection - Safety Shower - SPV')->first(),
            'ins_ss_status' => 2,
            'ins_ss_submited_date' => Carbon::now()
        ])];

        return return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' => 
            new FormInsSafetyShowerResource($form)
        ]);
    }

    /// Save Draft \\\
    public function saveDraftLadder(Request $request,$id)
    {
        $form = [FormsInspLadder::firstOrCreate(['id' => $id])->update(
            $request->except([
                'ins_la_inspector_id',
                'ins_la_inspector_spv_id',
                'ins_la_approved_date',
            ])
        )->update([
            'ins_la_status' => 1
        ])];

        return return response()->json([
            'code' => 200,
            'message' => 'Success Save Draft',
            'data' => 
            new FormsInspLadderResource($form)
        ]);
    }

    public function saveDraftH2s(Request $request)
    {
        return "yess";
    }
    
    public function saveDraftFumeHood(Request $request)
    {
        return "yess";
    }
    
    public function saveDraftSpillKit(Request $request)
    {
        return "yess";
    }
    
    public function saveDraftSafetyHarness(Request $request)
    {
        return "yess";
    }

    public function saveDraftScba(Request $request)
    {
        return "yess";
    }

    public function saveDraftSafetyShower(Request $request)
    {
        return "yess";
    }

    /// Approve \\\

    public function approveLadder($id)
    {
        $form = [FormsInspLadder::find($id)->update([
            'ins_la_status' => 3,
            'ins_la_approved_date' => Carbon::now(),
        ])];

        return return response()->json([
            'code' => 200,
            'message' => 'Success Save Draft',
            'data' => 
            new FormsInspLadderResource($form)
        ]);
    }

    public function approveH2s($id)
    {
        return "yess";
    }
    
    public function approveFumeHood($id)
    {
        return "yess";
    }
    
    public function approveSpillKit($id)
    {
        return "yess";
    }
    
    public function approveSafetyHarness($id)
    {
        return "yess";
    }

    public function approveScba($id)
    {
        return "yess";
    }

    public function approveSafetyShower($id)
    {
        return "yess";
    }
}
