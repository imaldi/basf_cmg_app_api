<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContentInsSafetyShowerResource
 extends JsonResource
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
            'id' => $this->,
            'ins_ss_form_id' => $this->,
            'ins_ss_location_id' => $this->ins_ss_location_id,
            'ins_ss_location_name' => $this->ins_ss_location_id,
            'ins_ss_leaka' => $this->ins_ss_leaka,
            'ins_ss_water_shower' => $this->ins_ss_water_shower,
            'ins_ss_water_eye_wash' => $this->ins_ss_water_eye_wash,
            'ins_ss_valve_or_seal' => $this->ins_ss_valve_or_seal,
            'ins_ss_sign_board' => $this->ins_ss_sign_board,
            'ins_ss_cleanliness' => $this->ins_ss_cleanliness,
            'ins_ss_alarm_condition' => $this->ins_ss_alarm_condition,
            'ins_ss_remarks' => $this->ins_ss_remarks,
        ];
    }
}
