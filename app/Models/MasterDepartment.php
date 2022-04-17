<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\MasterLocation;
class MasterDepartment extends Model
{
	protected $table = 'm_departments';


	public function users(){
		return $this->hasMany(User::class,'emp_employee_department_id');
	}

	public function areas(){
		return $this->hasMany(MasterLocation::class,'loc_department_id');
	}

	// public function location(){
	// 	return $this->hasOne(Location)
	// }
}

