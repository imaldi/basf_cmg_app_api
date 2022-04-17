<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeGroupResource extends JsonResource
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
            'name' => $this->name,
            'e_group_is_active' =>$this->e_group_is_active,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
            // 'guard_name' => $this->guard_name,
        ];
    }
}
