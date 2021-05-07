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
		'wo_c_equipment_criteria',
		'wo_reffered_dept',
		'wo_reffered_division',
		'wo_description',
		'wo_image'
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

	public static function emergency(int $value){
		if($value == 4){
			return 'Keadaan darurat';
		} else if($value == 3){
			return 'Downtime';
		} else if($value == 2){
			return 'Preventive Maintenance';
		} else if($value == 1){
			return 'Kosmetik';
		} else  {
			return 'Invalid Emergency Id';
		}
	}

	public static function category(int $value){
		if($value == 1){
			return 'Breakdown Production Equipment';
		} else if($value == 2){
			return 'Baru';
		} else if($value == 3){
			return 'Perbaikan';
		} else if($value == 4){
			return 'Modifikasi';
		} else  {
			return 'Invalid Category Id';
		}
	}

	public static function rankingCust(int $value){
		if($value == 4){
			return 'Top Management';
		} else if($value == 3){
			return 'Jalur produksi';
		} else if($value == 2){
			return 'Middle Management';
		} else if($value == 1){
			return 'Fasilitas Lain lain';
		} else  {
			return 'Invalid Ranking Customer Id';
		}
	}
	public static function equipmentCriteria(int $value){
		if($value == 4){
			return 'Utilitas dan sistem keselamatan dengan efek luas';
		} else if($value == 3){
			return 'Peralatan atau fasilitas utama tanpa cadangan';
		} else if($value == 2){
			return 'Sebagian besar berdampak pada moral dan produktivitas';
		} else if($value == 1){
			return 'Penggunaan rendah atau sedikit efek pada output';
		} else  {
			return 'Invalid Equipment Criteria';
		}
	}


	public static function formStatusDetail(int $id){
		if($id == 1){
			return 'Draft';
		} else if($id == 2){
			return 'Waiting SPV Approval';
		} else if($id == 3){
			return 'Waiting Planner Approval';
		} else if($id == 4){
			return 'Rejected by Spv';
		} else if($id == 5){
			return 'Rejected by Planner';
		} else if($id == 6){
			return 'Waiting PIC Action Plan';
		} else if($id == 7){
			return 'Waitng SPV PIC Approve';
		} else if($id == 8){
			return 'In Progress';
		} else if($id == 9){
			return 'Hand Over to User';
		} else if($id == 10){
			return 'Completed';
		} else {
			return 'Invalid Form Status';
		}
	}


	// public function setWoImageAttribute(String $name){
	// 	return time().$request->file('wo_image')->getClientOriginalName();
	// 	// return MasterDepartment::find($id)->firstOrFail()->dept_name;
	// }

	// public function getWoCEmergencyAttribute(int $value){
	// 	if($value == 1){
	// 		return 'Keadaan darurat';
	// 	} else if($value == 2){
	// 		return 'Downtime';
	// 	} else if($value == 3){
	// 		return 'Preventive Maintenance';
	// 	} else if($value == 4){
	// 		return 'Kosmetik';
	// 	} else  {
	// 		return 'Invalid Emergency Id';
	// 	}
	// }

	// public static function getWoCRankingCustAttribute(int $value){
	// 	if($value == 1){
	// 		return 'Top Management';
	// 	} else if($value == 2){
	// 		return 'Jalur produksi';
	// 	} else if($value == 3){
	// 		return 'Middle Management';
	// 	} else if($value == 4){
	// 		return 'Fasilitas Lain lain';
	// 	} else  {
	// 		return 'Invalid Ranking Customer Id';
	// 	}
	// }
	// public static function getWoCEquipmentCriteriaAttribute(int $value){
	// 	if($value == 1){
	// 		return 'Utilitas dan sistem keselamatan dengan efek luas';
	// 	} else if($value == 2){
	// 		return 'Peralatan atau fasilitas utama tanpa cadangan';
	// 	} else if($value == 3){
	// 		return 'Sebagian besar berdampak pada moral dan produktivitas';
	// 	} else if($value == 4){
	// 		return 'Penggunaan rendah atau sedikit efek pada output';
	// 	} else  {
	// 		return 'Invalid Equipment Criteria';
	// 	}
	// }

	//OTO -> One To One;
	//OTM -> One To Many; 
	//HM -> Has Many; 
	//HMT -> Has Many Through;

	//TODO belongsTo Category - MTO buat tabel dan model Category

	//TODO belongsTo Location - MTO dengan lokasi

	//TODO belongsTo dengan Reffered Division - MTO dengan divisi yang dituju
}

