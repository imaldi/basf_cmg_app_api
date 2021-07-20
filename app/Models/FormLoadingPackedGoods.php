<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormLoadingPackedGoods extends Model
{
    protected $table = 'form_loading_packed_goods';

    protected $guarded = [];



    public function gate()
    {
        return $this->morphOne(FormEGateCheck::class, 'gateable');
    }
}
