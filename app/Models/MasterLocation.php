<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\MasterDepartment;


class MasterLocation extends Model
{
	protected $table = 'm_locations';

	public function department(){
		return $this->belongsTo(MasterDepartment::class, 'id');
	}
	public function form5sMasterPic(){
		return $this->belongsToMany('App\User', 'form_5s_masters', 'id', 'id');
	}
}

