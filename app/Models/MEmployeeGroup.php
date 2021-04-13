<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;

class MEmployeeGroup extends Model
{
	protected $table = 'm_employee_group';

	public function employee(){
		return $this->belongsTo(User::class);
	}
}

