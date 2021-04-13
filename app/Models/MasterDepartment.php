<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
class MasterDepartment extends Model
{
	protected $table = 'm_department';


	public function user(){
		return $this->hasMany(User::class);
	}
}

