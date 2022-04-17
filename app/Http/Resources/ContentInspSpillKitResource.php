<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\MasterLocation;


class ContentInspSpillKitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
            [
                'id' => $this->id,
                'ins_sk_form_id' => $this->ins_sk_form_id,
                'ins_sk_location_id' => $this->ins_sk_location_id,
                'ins_sk_location_name' => MasterLocation::find($this->ins_sk_location_id)->loc_name,
                'ins_sk_box_condition' => $this->ins_sk_box_condition,
                'ins_sk_contents' => $this->ins_sk_contents,
                'ins_sk_documents' => $this->ins_sk_documents,
                'ins_sk_remark' => $this->ins_sk_remark,
                // '' => $this->,
                // '' => $this->,

            ];
    }
}
