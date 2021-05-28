<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContentFormInsSafetyHarnessResource extends JsonResource
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
            'ins_sh_form_id' => $this->ins_sh_form_id,
            'ins_sh_location_id' => $this->ins_sh_location_id,
            'ins_sh_location_name' => MasterLocation::find($this->ins_sh_location_id)->loc_name,
            'ins_sh_webbing' => $this->ins_sh_webbing,
            'ins_sh_d_rings' => $this->ins_sh_d_rings,
            'ins_sh_attachment_buckles' => $this->ins_sh_attachment_buckles,
            'ins_sh_hook_or_carabiner' => $this->ins_sh_hook_or_carabiner,
            'ins_sh_web_lanyard' => $this->ins_sh_web_lanyard,
            'ins_sh_rope_lanyard' => $this->ins_sh_rope_lanyard,
            'ins_sh_shock_absorber_pack' => $this->ins_sh_shock_absorber_pack,
            'ins_sh_remark' => $this->ins_sh_remark,

        ];
    }
}
