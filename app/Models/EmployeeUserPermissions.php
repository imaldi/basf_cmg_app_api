<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class EmployeeUserPermissions extends Permission implements \Spatie\Permission\Contracts\Permission
{
	protected $table = 'm_employee_permissions';

    protected $hidden = [
		'pivot'
	];

    
    public function group(){
        return $this->belongsToMany(MEmployeeGroup::class);
    }
}
