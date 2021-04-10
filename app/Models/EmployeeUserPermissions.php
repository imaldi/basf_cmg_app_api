<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeUserPermissions extends Model
{
	protected $table = 'm_employee_permissions';

    
    public function group(){
        return $this->belongsToMany(EmployeeGroup::class);
    }
}
