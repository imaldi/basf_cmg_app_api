<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
class MasterDepartment extends Model
{
	protected $table = 'm_departments';


	public function users(){
		return $this->hasMany(User::class,'emp_employee_department_id');
	}

	// public function location(){
	// 	return $this->hasOne(Location)
	// }
}

