<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ContentFormInsSafetyHarnessResource;
use App\User;
use App\Models\MasterLocation;
use App\Models\ContentInspSafetyHarnest;



class FormInsSafetyHarnessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $contents = ContentInspSafetyHarnest::where('ins_sh_form_id',$this->id)->get();
        return [
            'id' => $this->id,
            'ins_sh_name' => $this->ins_sh_name,
            'ins_sh_submited_date' => $this->ins_sh_submited_date,
            'ins_sh_inspector_id' => $this->ins_sh_inspector_id,
            'ins_sh_inspector_name' => User::find($this->ins_sh_inspector_id)->emp_name,
            'ins_sh_approved_date' => $this->ins_sh_approved_date,
            'ins_sh_inspector_spv_id' => $this->ins_sh_inspector_spv_id,
            'ins_sh_inspector_spv_name' => User::find($this->ins_sh_inspector_spv_id)->emp_name,
            'ins_sh_cp_actions' => $this->ins_sh_cp_actions,
            'ins_sh_status' => $this->ins_sh_status,
            'ins_sh_is_active' => $this->ins_sh_is_active,
            'ins_created_at' => $this->created_at,
            'ins_updated_at' => $this->updated_at,
            'contents' => ContentFormInsSafetyHarnessResource::collection($contents)
        ];
    }
}
