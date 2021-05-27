<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsInspFumeHood extends Model
{
	protected $table = 'form_ins_fume_hoods';

    protected $guarded = [];

	public function getStatusDetail($idInspLadder)
	{
		if($idInspLadder == 1){
			return 'in progress';
		}else if($idInspLadder == 2){
			return 'waiting spv approve';
		} else if($idInspLadder == 3){
			return 'completed';
		} else {
			return 'invalid inspection ladder status value';
		}
	}
}
