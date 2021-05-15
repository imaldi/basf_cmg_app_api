<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContentFormsInsScbaResource extends JsonResource
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
            'ins_sc_form_id' => $this->ins_sc_form_id,
            'ins_sc_location_id' => $this->ins_sc_location_id,
            'ins_sc_location_id' => $this->ins_sc_location_id,
            'ins_sc_leaka' => $this->ins_sc_leaka,
            'ins_sc_pressure_bar' => $this->ins_sc_pressure_bar,
            'ins_sc_walve_or_seal' => $this->ins_sc_walve_or_seal,
            'ins_sc_masker_condition' => $this->ins_sc_masker_condition,
            'ins_sc_remark' => $this->ins_sc_remark,
        ];
    }
}
