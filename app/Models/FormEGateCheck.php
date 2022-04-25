<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



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

    // public static function returnIsEditable($gateable, $operator, $checker, $cancel){
    public static function returnIsEditable(FormEGateCheck $gateForm){
        $arraysReturned = FormEGateCheck::getValueArrays($gateForm);
            $gateable =$arraysReturned["gateable"];
            $checker =$arraysReturned["checker"];
            $operator =$arraysReturned["operator"];
            $cancel =$arraysReturned["cancel"];

            // 0 = bisa diedit, 1 = tidak bisa di edit
            if($gateable == null){
                return 0;
            } else {
            if($cancel === 1) {
                    return 1;
            } else {
                if($operator === 1 && $checker === 1){
                    return 1;
                } else if($checker === 0 && $operator === 1) {
                    return 0;
                }
                    return 0;
                }
            }
    }

    // public static function returnEgateStatus($gateable, $operator, $checker, $cancel){
    public static function returnEgateStatus(FormEGateCheck $gateForm){
            $arraysReturned = FormEGateCheck::getValueArrays($gateForm);
            $gateable =$arraysReturned["gateable"];
            $checker =$arraysReturned["checker"];
            $operator =$arraysReturned["operator"];
            $cancel =$arraysReturned["cancel"];
        if($gateable == null){
            // status -
            return 0;
        } else {
            if($cancel === 1) {
                // status "Tidak Jadi Unloading"
                return 2;
            } else {
                if(($checker === 1 && $operator === 0) || ($checker === 1 && $operator === 1)){
                    // status "WH Complete"
                    return 4;
                } else if ($checker === 0 && $operator === 1){
                    // status "Operator Complete"
                    return 3;
                } else if($checker === 0 && $operator === 0) {
                    // status "draft"
                    return 1;
                }

            }
        }

    }

    public static function getValueArrays(FormEGateCheck $gateForm){
        // Getting is Editable
        // TODO 1 getting the gateable model with one to one polymorphic relationship // DONE
        $gateable = $gateForm->gateable;
        // TODO 2 Getting this model's table's name to get list of columns of its table // DONE
        $table_name = "";
        $columns = [];
        $operatorCompleteName = "";
        $checkerCompleteName = "";
        $cancelLoadUnloadName = "";
        $regexOperator = "/_operator_complete/";
        $regexChecker = "/_checker_complete/";
        $regexTidakJadiUnloading = "/_cancel_load_unload/";
        $operatorCompleteValue = 0;
        $checkerCompleteValue = 0;
        $cancelLoadUnloadValue = 0;
        $isEditable = true;
        if($gateable != null) {
            $table_name = $gateable->getTable();
            $columns = \Schema::getColumnListing($table_name);
        // TODO 3 Choose related column value by its names with LIKE clause and store those column names to an array/ 3 variables,
        // $operatorCompleteName
            $operatorCompleteName = FormEGateCheck::contains($regexOperator,$columns);
            $checkerCompleteName = FormEGateCheck::contains($regexChecker,$columns);
            $cancelLoadUnloadName = FormEGateCheck::contains($regexTidakJadiUnloading,$columns);
            $operatorCompleteValue = DB::table($table_name)->where('id', $gateForm->gateable_id)->value($operatorCompleteName);
            $checkerCompleteValue = DB::table($table_name)->where('id', $gateForm->gateable_id)->value($checkerCompleteName);
            $cancelLoadUnloadValue = DB::table($table_name)->where('id', $gateForm->gateable_id)->value($cancelLoadUnloadName);
        }

        return [
            "gateable" => $gateable,
            "operator" => $operatorCompleteValue,
            "checker" => $checkerCompleteValue,
            "cancel" => $cancelLoadUnloadValue,
        ];
    }

    public static function returnIsEditableGateable($gateable, $operator, $checker, $cancel){
            // $arraysReturned = FormEGateCheck::getValueArrays($gateForm);
                // $gateable =$arraysReturned["gateable"];
                // $checker =$arraysReturned["checker"];
                // $operator =$arraysReturned["operator"];
                // $cancel =$arraysReturned["cancel"];

        // 0 = bisa diedit, 1 = tidak bisa di edit
        if($gateable == null){
            return 0;
        } else {
        if($cancel === 1) {
                return 1;
        } else {
            if($operator === 1 && $checker === 1){
                return 1;
            }
                return 0;
            }
        }
    }

    public static function returnEgateStatusGateable($gateable, $operator, $checker, $cancel){
            // $arraysReturned = FormEGateCheck::getValueArrays($gateForm);
            // $gateable =$arraysReturned["gateable"];
            // $checker =$arraysReturned["checker"];
            // $operator =$arraysReturned["operator"];
            // $cancel =$arraysReturned["cancel"];
        if($gateable == null){
            // status -
            return 0;
        } else {
            if($cancel === 1) {
                // status "Tidak Jadi Unloading"
                return 2;
            } else {
                if($checker === 1){
                    // status "WH Complete"
                    return 4;
                } else {
                    if($operator === 1){
                        // status "Operator Complete"
                        return 3;
                    }
                }
                // status "draft"
                return 1;
            }
        }
    }

    public function operator()
    {
        return $this->hasOne(App/User::class, 'id', 'user_id');
    }

}
