<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ContentInspLadderResource;
use App\User;
use App\Models\MasterLocation;


class FormsInspLadderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'ins_la_name' => $this->ins_la_name,
            'ins_la_brand' => $this->ins_la_brand,
            'ins_la_specification' => $this->ins_la_specification,
            'ins_la_ladder_no' => $this->ins_la_ladder_no,
            'ins_la_inspection_date' => $this->ins_la_inspection_date,
            'ins_la_upper_condition' => $this->ins_la_upper_condition,
            'ins_la_bottom_condition' => $this->ins_la_bottom_condition,
            'ins_la_bottom_condition_desc' => $this->ins_la_bottom_condition_desc,
            'ins_la_fastener_condition' => $this->ins_la_fastener_condition,
            'ins_la_fastener_condition_desc' => $this->ins_la_fastener_condition_desc,
            'ins_la_construction_condition' => $this->ins_la_construction_condition,
            'ins_la_construction_condition_desc' => $this->ins_la_construction_condition_desc,
            'ins_la_stairs_condition' => $this->ins_la_stairs_condition,
            'ins_la_stairs_condition_desc' => $this->ins_la_stairs_condition_desc,
            'ins_la_inspector_id' => $this->ins_la_inspector_id,
            'ins_la_inspector_name' => User::find($this->ins_la_inspector_id)->emp_name,
            'ins_la_submited_date' => $this->ins_la_submited_date,
            'ins_la_inspector_spv_id' => $this->ins_la_inspector_spv_id,
            'ins_la_inspector_spv_name' => User::find($this->ins_la_inspector_spv_id)->emp_name,
            'ins_la_approved_date' => $this->ins_la_approved_date,
            'ins_la_status' => $this->ins_la_status,
            'ins_la_status_detail' => FormsInspLadder::getStatusDetail($this->ins_la_status),
            'ins_la_is_active' => $this->ins_la_is_active,
            'ins_created_at' => $this->createdAt,
            'ins_updated_at' => $this->updatedAt,            
        ];
    }
}
