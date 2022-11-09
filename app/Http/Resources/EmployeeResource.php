<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\EmployeeGroupResource;
use App\Http\Resources\EmployeePermissionResource;
use App\Models\MasterDepartment;



class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $deptName = "";

        try{
            $deptName = MasterDepartment::find($this->emp_employee_department_id)->dept_name;
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            $deptName = "not found";
        }

        return [
            'emp_id' => $this->id,
            'emp_name' => $this->emp_name,
            'emp_username' => $this->emp_username,
            'emp_email' => $this->emp_email,
            'emp_nik' => $this->emp_nik,
            'emp_birth_date' => $this->emp_birth_date,
            'emp_phone_number' => $this->emp_phone_number,
            'emp_is_spv' => $this->emp_is_spv,
            'emp_employee_department_id' => $this->emp_employee_department_id,
            'emp_employee_department_name' => $deptName,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'emp_permissions' => EmployeePermissionResource::collection($this->getPermissionsViaRoles()->unique('name')),
            'emp_groups' => EmployeeGroupResource::collection($this->roles)
        ];
    }
}
