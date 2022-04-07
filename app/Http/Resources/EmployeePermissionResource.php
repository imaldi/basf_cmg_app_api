<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeePermissionResource extends JsonResource
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
            'e_permission_desc' =>$this->e_permission_desc,
            'e_permission_category' =>$this->e_permission_category,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
            // 'guard_name' => $this->guard_name,
        ];
    }
}
