<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\MasterDepartment;
use App\Models\FormWorkOrder;
use App\Models\MasterLocation;
use App\User;


class Form5sMasterResource extends JsonResource
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
        $PICIds = Form5sMaster::where('form_5s_m_area_id',$this->form_5s_m_area_id)->select(['form_5s_m_pic_id'])->get()
        ->map(function($model) {
            return $model->form_5s_m_pic_id;
        })->toArray();
        $PICs = User::whereIn('id',$PICIds)->get();
        return [
            'department_id' => $this->form_5s_m_dept_id,
            'department_name' => MasterDepartment::find($this->form_5s_m_dept_id);
            'location_id' => $this->form_5s_m_area_id,
            'location_name' => MasterLocation::find($this->form_5s_m_area_id),
            'pic' => $PICs,
            // 'pic_name' => $user$this->loc_name,
            //kemungkinan bermasalah
            // '5s_m_area_photo' => $this->5s_m_area_photo,
            ];
    }
}
