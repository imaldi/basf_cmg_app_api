<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ContentInspH2sConcentResource;
use App\User;
use App\Models\MasterLocation;
use App\Models\ContentInspH2sCnct;



class FormsInspH2sConcentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $contents = ContentInspH2sCnct::where('ins_h2_form_id',$this->id)->get();
        return [
            'id' => $this->id,
            'ins_h2_name' => $this->ins_h2_name,
            'ins_h2_submited_date' => $this->ins_h2_submited_date,
            'ins_h2_inspector_id' => $this->ins_h2_inspector_id,
            'ins_h2_inspector_name' => User::find($this->ins_h2_inspector_id)->emp_name,
            'ins_h2_approved_date' => $this->ins_h2_approved_date,
            'ins_h2_inspector_spv_id' => $this->ins_h2_inspector_spv_id,
            'ins_h2_inspector_spv_name' => User::find($this->ins_h2_inspector_spv_id)->emp_name,
            'ins_h2_notes' => $this->ins_h2_notes,
            'ins_h2_status' => (int)$this->ins_h2_status,
            'ins_h2_is_active' => $this->ins_h2_is_active,
            'ins_created_at' => $this->created_at,
            'ins_updated_at' => $this->updated_at,
            // '' => $this->,
            'contents' => ContentInspH2sConcentResource::collection($contents)
        ];
    }
}
