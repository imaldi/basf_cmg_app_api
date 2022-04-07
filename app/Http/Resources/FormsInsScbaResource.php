<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ContentFormsInsScbaResource;
use App\User;
use App\Models\MasterLocation;
use App\Models\ContentInspSCBA;


class FormsInsScbaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $contents = ContentInspSCBA::where('ins_sc_form_id',$this->id)->get();
        return [
            'id' => $this->id,
            'ins_sc_name' => $this->ins_sc_name,
            'ins_sc_submited_date' => $this->ins_sc_submited_date,
            'ins_sc_inspector_id' => $this->ins_sc_inspector_id,
            'ins_sc_inspector_name' => User::find($this->ins_sc_inspector_id)->emp_name,
            'ins_sc_approved_date' => $this->ins_sc_approved_date,
            'ins_sc_checker_id' => $this->ins_sc_checker_id,
            'ins_sc_checker_name' => User::find($this->ins_sc_checker_id)->emp_name,
            'ins_sc_cp_actions' => $this->ins_sc_cp_actions,
            'ins_sc_status' => (int) $this->ins_sc_status,
            'ins_sc_is_active' => $this->ins_sc_is_active,
            'ins_created_at' => $this->created_at,
            'ins_updated_at' => $this->updated_at,
            'contents' => ContentFormsInsScbaResource::collection($contents)
        ];
    }
}
