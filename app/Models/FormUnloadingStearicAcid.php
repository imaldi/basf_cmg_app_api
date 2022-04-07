<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormUnloadingStearicAcid extends Model
{
    protected $table = 'form_unloading_stearic_acid';

    protected $guarded = [];



    public function gate()
    {
        return $this->morphOne(FormEGateCheck::class, 'gateable');
    }
}
