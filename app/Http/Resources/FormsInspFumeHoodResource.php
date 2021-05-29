<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
use App\Models\MasterLocation;


class FormsInspFumeHoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // $contents = ContentInspFumeHood::where('id_insp_f_hood',$this->id)->get();
        return [
            'id' => $this->id,
            'ins_fh_name' => $this->ins_fh_name,
            'ins_fh_submited_date' => $this->ins_fh_submited_date,
            'ins_fh_inspector_id' => $this->ins_fh_inspector_id,
            'ins_fh_inspector_name' => User::find($this->ins_fh_inspector_id)->emp_name,
            'ins_fh_approved_date' => $this->ins_fh_approved_date,
            'ins_fh_inspector_spv_id' => $this->ins_fh_inspector_spv_id,
            'ins_fh_inspector_spv_name' => User::find($this->ins_fh_inspector_spv_id)->emp_name,
            'ins_fh_QC1_opening_height' => $this->ins_fh_QC1_opening_height,
            'ins_fh_QC1_a_f_standart' => $this->ins_fh_QC1_a_f_standart,
            'ins_fh_QC1_a_f_results' => $this->ins_fh_QC1_a_f_results,
            'ins_fh_QC1_remarks' => $this->ins_fh_QC1_remarks,
            'ins_fh_QC2_opening_height' => $this->ins_fh_QC2_opening_height,
            'ins_fh_QC2_a_f_standart' => $this->ins_fh_QC2_a_f_standart,
            'ins_fh_QC2_a_f_results' => $this->ins_fh_QC2_a_f_results,
            'ins_fh_QC2_remarks' => $this->ins_fh_QC2_remarks,
            'ins_fh_QC3_opening_height' => $this->ins_fh_QC3_opening_height,
            'ins_fh_QC3_a_f_standart' => $this->ins_fh_QC3_a_f_standart,
            'ins_fh_QC3_a_f_results' => $this->ins_fh_QC3_a_f_results,
            'ins_fh_QC3_remarks' => $this->ins_fh_QC3_remarks,
            'ins_fh_QC4_opening_height' => $this->ins_fh_QC4_opening_height,
            'ins_fh_QC4_a_f_standart' => $this->ins_fh_QC4_a_f_standart,
            'ins_fh_QC4_a_f_results' => $this->ins_fh_QC4_a_f_results,
            'ins_fh_QC4_remarks' => $this->ins_fh_QC4_remarks,
            'ins_fh_QC5_opening_height' => $this->ins_fh_QC5_opening_height,
            'ins_fh_QC5_a_f_standart' => $this->ins_fh_QC5_a_f_standart,
            'ins_fh_QC5_a_f_results' => $this->ins_fh_QC5_a_f_results,
            'ins_fh_QC5_remarks' => $this->ins_fh_QC5_remarks,
            'ins_fh_status' => $this->ins_fh_status,
            'ins_fh_is_active' => $this->ins_fh_is_active,
            // '' => $this->,
            'ins_created_at' => $this->created_at,
            'ins_updated_at' => $this->updated_at,
            // 'contents' => ContentInspFumeHoodResource::collection($contents);
        ];
    }
}
