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
		'wo_form_status',
		'wo_date_recomendation',
		'wo_date_revision',
		'wo_c_emergency',
		'wo_is_open',
		'wo_reject_reason',
		'wo_c_ranking_cust',
		'wo_c_equipment_criteria'
		// 'wo_date_pic_plan',
	];

	public function issuer(){
		return $this->belongsTo(User::class,'wo_issuer_id');
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

	public static function recommendedDays(int $emergency, int $ranking_cust, int $equipment_criteria){
        $total = $emergency*$ranking_cust*$equipment_criteria;
        if($total <= 64 && $total > 32){
            return 30;
        } else if($total <= 32 && $total > 18){
            return 15;
        } else if( $total <= 18 && $total > 6){
            return 5;
        } else {
            return 2;
        }
    }

	//OTO -> One To One;
	//OTM -> One To Many; 
	//HM -> Has Many; 
	//HMT -> Has Many Through;

	//TODO belongsTo Category - MTO buat tabel dan model Category

	//TODO belongsTo Location - MTO dengan lokasi

	//TODO belongsTo dengan Reffered Division - MTO dengan divisi yang dituju

	//TODO belongsTo dengan Kedaruratan - MTO dengan kedaruratan
	
	//TODO belongsTo dengan Ranking Customer - MTO dengan tabel/model (baru) RankingCustomer

	//TODO belongsTo dengan Kriteria Peralatan - MTO dengan tabel/model (baru) Kriteria Peralatan
}

