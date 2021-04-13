<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class FormWorkOrder extends Model
{
	protected $table = 'form_work_orders';

	protected $fillable = [
		'wo_name',
		'wo_issuer_id',
		'wo_spv_issuer_id',
		'wo_date_issuer_submit',
		'wo_category',
		'wo_issuer_dept',
		'wo_location_id',
		'wo_location_detail',
		'wo_tag_no',
		'wo_issuer_attachment',
		// 'wo_date_pic_plan',
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

