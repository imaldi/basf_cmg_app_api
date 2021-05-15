<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContentInspH2sConcentResource extends JsonResource
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
            'ins_h2_form_id' => $this->,
            'ins_h2_location_id' => $this->ins_h2_location_id,
            'ins_h2_check_05_percentage' => $this->ins_h2_check_05_percentage,
            'ins_h2_check_10_percentage' => $this->ins_h2_check_10_percentage,
            'ins_h2_check_lel_percentage' => $this->ins_h2_check_lel_percentage,
            'ins_h2_remark' => $this->ins_h2_remark,
            // '' => $this->,

        ];
    }
}
