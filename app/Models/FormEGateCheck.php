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
        return $this->morphTo(
            __FUNCTION__,"gateable_type","gateable_id"
        );
    }

    //tes public static function simple ya
    public static function returnDoubleStringABCDEF($str){
        return $str.$str;
    }

    public static function contains($str, array $arr)
        {
            foreach($arr as $a) {
                // if (str_contains($str,$a) !== false) return $a;
                //pakai regex
                if (preg_match($str,$a)) return $a;
            }
            // return false;
    }

    public static function returnIsEditable($operator, $checker, $cancel){
        if($cancel === 1) {
            return false;
        } else {
            if($operator === 1 && $checker === 1){
                return false;
            }
            return true;
        }
    }
}
