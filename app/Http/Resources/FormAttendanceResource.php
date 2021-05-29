<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\FormAttendancePersonalResource;
use App\User;
// use App\Models\MasterLocation;
use App\Models\FormAttendancePersonal;



class FormAttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $contents = FormAttendancePersonal::where('att_p_attendance_id',$this->id)->get();
        return [
            'id' => $this->id,
            'att_created_by_id' => $this->att_created_by_id,
            'att_created_by_name' => User::find($this->att_created_by_id)->emp_name,
            'att_register_by_dept' => $this->att_register_by_dept,
            'att_topic1' => $this->att_topic1,
            'att_topic2' => $this->att_topic2,
            'att_reference' => $this->att_reference,
            'att_date' => $this->att_date,
            'att_place' => $this->att_place,
            'att_pic' => $this->att_pic,
            'att_with_test' => $this->att_with_test,
            'att_signature' => $this->att_signature,
            'att_is_active' => $this->att_is_active,
            'att_additional_remark' => $this->att_additional_remark,
            'att_jml_participant' => $this->att_jml_participant,
            'att_total_hours' => $this->att_total_hours,
            'att_total_manhours' => $this->att_total_manhours,
            'att_place_others' => $this->att_place_others,
            'att_category' => $this->att_category,
            'att_category_others' => $this->att_category_others,
            'att_trainer_signature' => $this->att_trainer_signature,
            'att_created_at' => $this->created_at,
            'att_updated_at' => $this->updated_at,
            'contents' => FormAttendancePersonalResource::collection($contents)
        ];
    }
}
