<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class MasterEmployee extends Model
{
	protected $table = 'm_employees';
	
	protected $fillable = [
		'emp_name',
		'emp_username',
		'emp_email',
		'emp_nik',
		'emp_birth_date',
		'emp_phone_number',
		'emp_is_spv',
		'emp_employee_group_id',
		'emp_employee_department_id',
	];

	protected $hidden = [
		'emp_password',
		'api_token'
	];

	public function department(){
		return $this->hasOne(MasterDepartment::class);
	}

	public function group(){
		return $this->hasOne(EmployeeGroup::class);
	}
}

