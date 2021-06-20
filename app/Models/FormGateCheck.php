<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FormEGateCheck extends Model
{
    protected $table = 'form_gate_check';

    protected $guarded = [];



    public function gateable()
    {
        return $this->morphTo();
    }
    // /**
    //  * @return HasOne|void
    //  */
    // public function getLoadingOrUnloading()
    // {
    //     if($this->gate_model_type == "form_unloading_fa_1eo"){
    //         return $this->hasOne("");
    //     }
    // }
}
