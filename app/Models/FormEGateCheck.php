<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormEGateCheck extends Model
{
    protected $table = 'form_gate_check';

    protected $guarded = [];



    public function gateable()
    {
        return $this->morphTo(__FUNCTION__,"gateable_type","gateable_id");
    }
}
