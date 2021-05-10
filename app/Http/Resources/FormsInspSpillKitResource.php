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
        $contents = ContentInspLadderResource::where('id_insp_h2s_cnct',$this->id)->get();
        return [
            'id' => $this->id,
            'id_supervisor' => $this->id_supervisor,
            'supervisor_name' => User::find($this->id_supervisor),
            'id_checker' => $this->id_checker,
            'checker_name' => User::find($this->id_checker),
            'id_location' => $this->id_location,
            'location_name' => MasterLocation::find($this->id_location),
            'brand' => $this->brand,
            'specification' => $this->specification,
            'inspection_date' => $this->inspection_date,
            'upper_condition' => $this->upper_condition,
            'bottom_condition' => $this->bottom_condition,
            'fastener_condition' => $this->fastener_condition,
            'construction_condition' => $this->construction_condition,
            'stairs_condition' => $this->stairs_condition,
            'upper_condition_desc' => $this->upper_condition_desc,
            'bottom_condition_desc' => $this->bottom_condition_desc,
            'fastener_condition_desc' => $this->fastener_condition_desc,
            'construction_condition_desc' => $this->construction_condition_desc,
            'stairs_condition_desc' => $this->stairs_condition_desc,
            'notes' => $this->notes,
            'ladder_category' => $this->ladder_category,
            'supervisor_sign_pict' => $this->supervisor_sign_pict,
            'checker_sign_pict' => $this->checker_sign_pict,
            'is_active' => $this->is_active,
            'contents' => ContentInspLadderResource::collection($contents);
        ];
    }
}
