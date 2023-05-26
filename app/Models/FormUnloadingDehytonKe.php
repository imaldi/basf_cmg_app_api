<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormUnloadingDehytonKe extends Model
{
    protected $table = 'form_unloading_dehyton_ke';

    protected $guarded = [];



    public function gate()
    {
        return $this->morphOne(FormEGateCheck::class, 'gateable');
    }
}
