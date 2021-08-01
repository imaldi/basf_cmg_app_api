<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormUnloadingNaoh extends Model
{
    protected $table = 'form_unloading_naoh';

    protected $guarded = [];



    public function gate()
    {
        return $this->morphOne(FormEGateCheck::class, 'gateable');
    }
}
