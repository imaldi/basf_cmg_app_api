<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;
use Spatie\Permission\Models\Role;

class MEmployeeGroup extends Role implements \Spatie\Permission\Contracts\Role
{
	protected $table = 'm_employee_groups';

	protected $hidden = [
		'pivot'
	];

	// protected $guard = '';

	// public function users(){
	// 	return $this->hasMany(User::class,'emp_employee_department_id');
	// }

	// public function forms(){
	// 	return $this->hasMany(FormWorkOrder::class, User::class, 'emp_employee_department_id');
	// }

	// public function getNameAttribute()
	// {
	// 	return $this->e_group_name;
	// }

	// public function setNameAttribute($value)
	// {
	// 	$this->attributes['name'] = strtolower($value);
	// }



	// public function workOrderForms(){
	// 	return $this->hasManyThrough(FormWorkOrder::class, User::class, 'emp_employee_group_id', 'wo_issuer_id');
	// }

	// //harus diusahakan dalam departement yang sama nanti
	// public function workOrderFormsOfSpv(){
	// 	return $this->hasManyThrough(FormWorkOrder::class, User::class, 'emp_employee_group_id', 'wo_spv_issuer_id');
	// }

	// //harus diusahakan dalam departement yang sama nanti
	// public function workOrderFormsOfPlanner(){
	// 	return $this->hasManyThrough(FormWorkOrder::class, User::class, 'emp_employee_group_id', '	wo_planner_id');
	// }

	// //harus diusahakan dalam departement yang sama nanti
	// public function workOrderFormsOfPic(){
	// 	return $this->hasManyThrough(FormWorkOrder::class, User::class, 'emp_employee_group_id', '	wo_pic_id');
	// }

	// //harus diusahakan dalam departement yang sama nanti
	// public function workOrderFormsOfPicSPV(){
	// 	return $this->hasManyThrough(FormWorkOrder::class, User::class, 'emp_employee_group_id', '	wo_spv_pic_id');
	// }

	// public function permissions(){
	// 	return $this->belongsToMany(EmployeeUserPermissions::class, 'm_employee_privileges', 'e_privilege_group_id', 'e_privilege_permission_id');
	// }
}

