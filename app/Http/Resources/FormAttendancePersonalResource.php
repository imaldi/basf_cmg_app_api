<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ContentInsSafetyShowerResource;
use App\User;
use App\Models\MasterLocation;
use App\Models\MasterDepartment;
use App\Models\ContentInspSafetyShower;



class FormAttendancePersonalResource extends JsonResource
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
            'att_p_employee_id' => (int)$this->att_p_employee_id,
            // 'att_p_employee_name' => User::find($this->att_p_employee_id)->emp_name,
            'att_p_department_id' => (int) $this->att_p_department_id,
            'att_p_department_name' => MasterDepartment::find($this->att_p_department_id)->dept_name ?? $this->att_p_department_name ?? null,
            'att_p_score' => (int)$this->att_p_score,
            'att_p_signature' => $this->att_p_signature,
            'att_p_date' => $this->att_p_date,
            'att_p_remark' => $this->att_p_remark,
            'att_p_attendance_id' => (int)$this->att_p_attendance_id,
            'att_p_person_type' => $this->att_p_person_type,
            // 'att_p_person_name' => $this->att_p_person_name,
            'att_p_person_name' => User::find($this->att_p_employee_id)->emp_name ?? $this->att_p_person_name ?? null,
            'att_p_created_at' => $this->created_at,
            'att_p_updated_at' => $this->updated_at,
        ];
    }
}
