<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ContentInsSafetyShowerResource;
use App\User;
use App\Models\MasterLocation;
use App\Models\ContentInspSafetyShower;



class FormInsSafetyShowerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $contents = ContentInspSafetyShower::where('ins_ss_form_id',$this->id)->get();
        return [
            'id' => $this->id,
            'ins_ss_name' => $this->id,
            'ins_ss_submited_date' => $this->ins_ss_submited_date,
            'ins_ss_inspector_id' => $this->ins_ss_inspector_id,
            'ins_ss_inspector_name' => User::find($this->ins_ss_inspector_id)->emp_name,
            'ins_ss_approved_date' => $this->ins_ss_approved_date,
            'ins_ss_checker_id' => $this->ins_ss_checker_id,
            'ins_ss_checker_name' => $this->ins_ss_checker_id,
            'ins_ss_cp_actions' => $this->ins_ss_cp_actions,
            'ins_ss_status' => $this->ins_ss_status,
            'ins_ss_is_active' => $this->ins_ss_is_active,
            'ins_created_at' => $this->created_at,
            'ins_updated_at' => $this->updated_at,
            'contents' => ContentInsSafetyShowerResource::collection($contents)
        ];
    }
}
