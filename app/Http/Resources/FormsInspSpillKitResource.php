<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ContentInspSpillKitResource;
use App\User;
use App\Models\MasterLocation;
use App\Models\ContentInspSpillKit;



class FormsInspSpillKitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $contents = ContentInspSpillKit::where('ins_sk_form_id',$this->id)->get();
        return [
            'id' => $this->id,
            'ins_sk_name' => $this->ins_sk_name,
            'ins_sk_submited_date' => $this->ins_sk_submited_date,
            'ins_sk_inspector_id' => $this->ins_sk_inspector_id,
            'ins_sk_inspector_id' => User::find($this->ins_sk_inspector_id)->emp_name,
            'ins_sk_approved_date' => $this->ins_sk_approved_date,
            'ins_sk_inspector_spv_id' => $this->ins_sk_inspector_spv_id,
            'ins_sk_inspector_spv_id' => User::find($this->ins_sk_inspector_spv_id)->emp_name,
            'ins_sk_cp_actions' => $this->ins_sk_cp_actions,
            'ins_sk_status' => $this->ins_sk_status,
            'ins_sk_is_active' => $this->ins_sk_is_active,
            // '' => $this->,
            'ins_created_at' => $this->createdAt,
            'ins_updated_at' => $this->updatedAt,

            'contents' => ContentInspSpillKitResource::collection($contents)
        ];
    }
}
