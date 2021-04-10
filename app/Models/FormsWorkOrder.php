<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class FormsWorkOrder extends Model
{
	protected $table = 'forms_work_order';

	protected $fillable = [
		'wo_category',
		'wo_location_id',
		'wo_reffered_division',
		'wo_c_emergency',
		'wo_c_equipment_criteria',
		'wo_date_recomendation'
	];

	public function issuer(){
		return $this->belongsTo(Employees::class,'wo_issuer_id');
	}

	public function issuerSPV(){
		return $this->belongsTo(Employees::class, 'wo_spv_issuer_id');
	}

	public function planner(){
		return $this->belongsTo(Employees::class, 'wo_planner_id');
	}

	public function pic(){
		return $this->belongsTo(Employees::class, 'wo_pic_id');
	}

	public function picSPV(){
		return $this->belongsTo(Employees::class, 'wo_spv_pic_id');
	}
}

