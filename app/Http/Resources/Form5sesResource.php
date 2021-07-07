<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\MasterDepartment;
use App\Models\MasterLocation;
use App\Models\Form5ses;
use App\User;


class Form5sesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //yang di return oleh resource adalah collection dari 5sMaster dengan pic id tertentu (whereIn)
        //dan unique, nanti ketika di resource baru deh d beri tambahan array pic dari relasi
        // $PICIds = Form5sMaster::where('form_5s_m_area_id',$this->form_5s_m_area_id)->select(['form_5s_m_pic_id'])->get()
        // ->map(function($model) {
        //     return $model->form_5s_m_pic_id;
        // })->toArray();
        // $PICs = User::whereIn('id',$PICIds)->get();
        return [
            "id" => $this->id,
            "form_5s_name" => $this->form_5s_name,
            "form_5s_submit_date" => $this->form_5s_submit_date,
            "form_5s_auditor_id" => $this->form_5s_auditor_id,
            "form_5s_auditor_name" => User::find($this->form_5s_auditor_id)->emp_name,
            "form_5s_dept_id" => (int)$this->form_5s_dept_id,
            "form_5s_area_id" => (int)$this->form_5s_area_id,
            "form_5s_concise_score" => (int)$this->form_5s_concise_score,
            "form_5s_consice_desc" => $this->form_5s_consice_desc,
            "form_5s_consice_photo" => $this->form_5s_consice_photo,
            "form_5s_neat_score" => (int)$this->form_5s_neat_score,
            "form_5s_neat_desc" => $this->form_5s_neat_desc,
            "form_5s_neat_photo" => $this->form_5s_neat_photo,
            "form_5s_clean_score" => (int)$this->form_5s_clean_score,
            "form_5s_clean_desc" => $this->form_5s_clean_desc,
            "form_5s_clean_photo" => $this->form_5s_clean_photo,
            "form_5s_care_score" => (int)$this->form_5s_care_score,
            "form_5s_care_desc" => $this->form_5s_care_desc,
            "form_5s_care_photo" => $this->form_5s_care_photo,
            "form_5s_diligent_score" => (int)$this->form_5s_diligent_score,
            "form_5s_diligent_desc" => $this->form_5s_diligent_desc,
            "form_5s_diligent_photo" => $this->form_5s_diligent_photo,
            "form_5s_total_score" => (int)$this->form_5s_total_score,
            "form_5s_status" => $this->form_5s_status,
            "form_5s_status_detail" => Form5ses::getStatusDetail($this->form_5s_status),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
