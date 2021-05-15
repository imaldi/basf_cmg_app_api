<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ContentInsSafetyShowerResource;
use App\User;
use App\Models\MasterLocation;


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
        $contents = ContentInsSafetyShowerResource::where('id_insp_h2s_cnct',$this->id)->get();
        return [
            'id' => $this->id,
            'ins_ss_name' => $this->id,
            'ins_ss_submited_date' => $this->id,
            'ins_ss_inspector_id' => $this->ins_ss_inspector_id,
            'ins_ss_inspector_name' => $this->ins_ss_inspector_id,
            'ins_ss_approved_date' => $this->id,
            'ins_ss_checker_id' => $this->ins_ss_checker_id,
            'ins_ss_checker_name' => $this->ins_ss_checker_id,
            'ins_ss_cp_actions' => $this->id,
            'ins_ss_status' => $this->id,
            'ins_ss_is_active' => $this->id,
            'ins_created_at' => $this->createdAt,
            'ins_updated_at' => $this->updatedAt,
            'contents' => ContentInsSafetyShowerResource::collection($contents);
        ];
    }
}
