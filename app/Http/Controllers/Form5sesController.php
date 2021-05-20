<?php

namespace App\Http\Controllers;

use App\Models\Form5ses;
use App\Models\Form5sMaster;
use App\Models\MasterDepartment;
use App\Models\MasterLocation;
use Illuminate\Http\Request;

class Form5sesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Form5ses  $Form5ses
     * @return \Illuminate\Http\Response
     */
    public function show(Form5ses $Form5ses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Form5ses  $Form5ses
     * @return \Illuminate\Http\Response
     */
    public function edit(Form5ses $Form5ses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Form5ses  $Form5ses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form5ses $Form5ses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Form5ses  $Form5ses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form5ses $Form5ses)
    {
        //
    }

    public function getDepartments(){
        $masterDepartment = MasterDepartment::All();
        return response()->json([
            'code' => 200,
            'message' => 'Success Fetching All Department', 
            'data' =>  $masterDepartment,
            ], 200);
    }

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
