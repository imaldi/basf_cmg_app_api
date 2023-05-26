<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\MasterDepartment;
use App\Models\FormWorkOrder;
use App\Models\MasterLocation;
use App\User;


class LocationsIdsResource extends JsonResource
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
            'loc_name' => $this->loc_name,
            'loc_desc' => $this->loc_desc,
            'loc_is_active' => $this->loc_is_active,
            'loc_department_id' => $this->loc_department_id,
            ];
    }
}
