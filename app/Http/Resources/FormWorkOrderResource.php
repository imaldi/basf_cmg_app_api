<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\MasterDepartment;
use App\Models\FormWorkOrder;
use App\Models\MasterLocation;
use App\User;


class FormWorkOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $departmentName = MasterDepartment::find($this->wo_issuer_dept)->first()->dept_name;
        // $refferedDeptName = MasterDepartment::find($this->wo_reffered_dept)->first()->dept_name;
        $locationDetail = MasterLocation::find($this->wo_location_id)->first()->loc_name;

        return [
            'id' => $this->id,
            'wo_name' => $this->wo_name,
            'wo_issuer_id' => $this->wo_issuer_id,
            'wo_issuer_name' => User::find($this->wo_issuer_id)->emp_name,
            'wo_spv_issuer_id' => $this->wo_spv_issuer_id,
            'wo_date_issuer_submit' => $this->wo_date_issuer_submit,
            'wo_category' => $this->wo_category,
            'wo_category_detail' => FormWorkOrder::category($this->wo_category),
            'wo_issuer_dept' => $this->wo_issuer_dept,
            'wo_issuer_dept_name' => $departmentName,
            'wo_location_id' => $this->wo_location_id,
            'wo_reffered_dept' => $this->wo_reffered_dept,
            // 'wo_reffered_dept_name' => $refferedDeptName,
            'wo_reffered_division' => $this->wo_reffered_division,
            'wo_description' => $this->wo_description,
            'wo_location_detail' => $locationDetail,
            'wo_tag_no' => $this->wo_tag_no,
            'wo_issuer_attachment' => $this->wo_issuer_attachment,
            'wo_form_status_id' => (int) $this->wo_form_status,
            'wo_form_status' => FormWorkOrder::formStatusDetail($this->wo_form_status),
            'wo_date_recomendation' => $this->wo_date_recomendation,
            'wo_is_open' => $this->wo_is_open,
            'wo_c_emergency' => (int) $this->wo_c_emergency,
            'wo_c_emergency_detail' => FormWorkOrder::emergency($this->wo_c_emergency),
            'wo_c_ranking_cust' => (int) $this->wo_c_ranking_cust,
            'wo_c_ranking_cust_detail' => FormWorkOrder::rankingCust($this->wo_c_ranking_cust),
            'wo_c_equipment_criteria' => (int) $this->wo_c_equipment_criteria,
            'wo_c_equipment_criteria_detail' => FormWorkOrder::equipmentCriteria($this->wo_c_equipment_criteria),
            'wo_image' => $this->wo_image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            ];
    }
}
