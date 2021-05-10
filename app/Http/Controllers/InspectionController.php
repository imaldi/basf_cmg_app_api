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

class InspectionController extends Controller
{
    /// Get All \\\
    public function getAllLadder()
    {
        $user = Auth::user();
        $role = $user->hasRole('Inspection - Ladder - SPV') ? 'id_checker' : 'id_inspector';
        $forms= FormsInspLadder::where('is_active',true)
            ->where($role,$user->id)->orderBy('form_status')->get();
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
        $role = $user->hasRole('Inspection - H2S - SPV') ? 'id_checker' : 'id_inspector';
        $forms= FormsInspH2sConcent::where('is_active',true)
            ->where($role,$user->id)->orderBy('form_status')->get();
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
        $role = $user->hasRole('Inspection - Fume Hood - SPV') ? 'id_checker' : 'id_inspector';
        $forms= FormsInspFumeHood::where('is_active',true)
            ->where($role,$user->id)->orderBy('form_status')->get();
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
        $role = $user->hasRole('Inspection - Spill Kit - SPV') ? 'id_checker' : 'id_inspector';
        $forms= FormsInspSpillKit::where('is_active',true)
            ->where($role,$user->id)->orderBy('form_status')->get();
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
        $role = $user->hasRole('Inspection - Ladder - SPV') ? 'id_checker' : 'id_inspector';
        $forms= FormsInspSafetyHarnest::where('is_active',true)
            ->where('id_checker',$user->id)->orderBy('form_status')->get();
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
        $role = $user->hasRole('Inspection - Ladder - SPV') ? 'id_checker' : 'id_inspector';
        $forms= FormsInspSCBA::where('is_active',true)
            ->where('id_checker',$user->id)->orderBy('form_status')->get();
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
        return "yess";
    }

    public function getOneH2s($id)
    {
        return "yess";
    }
    
    public function getOneFumeHood($id)
    {
        return "yess";
    }
    
    public function getOneSpillKit($id)
    {
        return "yess";
    }
    
    public function getOneSafetyHarness($id)
    {
        return "yess";
    }

    public function getOneScba($id)
    {
        return "yess";
    }

    public function getOneSafetyShower($id)
    {
        return "yess";
    }

    /// Create \\\

    public function createLadder(Request $request)
    {
        return "yess";
    }

    public function createH2s(Request $request)
    {
        return "yess";
    }
    
    public function createFumeHood(Request $request)
    {
        return "yess";
    }
    
    public function createSpillKit(Request $request)
    {
        return "yess";
    }
    
    public function createSafetyHarness(Request $request)
    {
        return "yess";
    }

    public function createScba(Request $request)
    {
        return "yess";
    }

    public function createSafetyShower(Request $request)
    {
        return "yess";
    }

    /// Save Draft \\\
    public function saveDraftLadder(Request $request)
    {
        return "yess";
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
        return "yess";
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
