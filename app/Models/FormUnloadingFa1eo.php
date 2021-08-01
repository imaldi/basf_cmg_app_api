<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormUnloadingFa1eo extends Model
{
    protected $table = 'form_unloading_fa_c12';

    protected $guarded = [];



    public function gate()
    {
        return $this->morphOne(FormEGateCheck::class, 'gateable');
    }
}
