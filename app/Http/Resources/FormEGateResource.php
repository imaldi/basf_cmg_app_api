<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\MasterDepartment;
use App\Models\MasterLocation;
use App\Models\FormEGateCheck;
use App\User;
use Illuminate\Support\Facades\DB;
use Auth;



class FormEGateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $employee = Auth::user();



        // Getting is Editable
        // TODO 1 getting the gateable model with one to one polymorphic relationship // DONE
        $gateable = $this->gateable;
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
            $operatorCompleteValue = DB::table($table_name)->where('id', $this->gateable_id)->value($operatorCompleteName);
            $checkerCompleteValue = DB::table($table_name)->where('id', $this->gateable_id)->value($checkerCompleteName);
            $cancelLoadUnloadValue = DB::table($table_name)->where('id', $this->gateable_id)->value($cancelLoadUnloadName);
        }

        $isEditable =
            FormEGateCheck::
                returnIsEditable(
                    $operatorCompleteValue,
                    $checkerCompleteValue,
                    $cancelLoadUnloadValue
                );
        $gateStatus =

            FormEGateCheck::
            returnEgateStatus(
                $gateable,
                $operatorCompleteValue,
                $checkerCompleteValue,
                $cancelLoadUnloadValue
            );



        // TODO 4 Make a simple 'if else' control flow to return boolean editable field to put in response based on that fields.
        // TODO 5 Commit, Push, and update on the mobile side

        // $forms =
        //     FormEGateCheck::where('gate_is_in',1)->where('gate_report_status',0)
        //         ->where(function ($query) use ($gateableType) {
        //             $query->where('gateable_type', 'LIKE', '%' .$gateableType. '%')
        //                   ->orWhere('gateable_type', '=', null);})
        //                   ->orderBy('gateable_type')->orderBy('id','DESC')->get();
            // $functionVal = FormEGateCheck::returnDoubleStringABCDEF("yeya_");

        return [
            "id" => (int) $this->id,
            // Cuma untuk dev
            // "operator_complete" => $operatorCompleteName,
            // "operator_value" => $operatorCompleteValue,
            // "checker_value" => $checkerCompleteValue,
            // "cancel_value" => $cancelLoadUnloadValue,
            // "geteable" => $gateable,
            // "table_name" => $table_name,
            // "gate_columns" => $columns,
            "gate_status" => $gateStatus,

            // Real Used Fields
            "user_id" => (int) $employee->id,
            'gate_report_status' => (int) $this->gate_report_status,
            'gate_is_in' => (int) $this->gate_is_in,
            'gate_is_out' => (int) $this->gate_is_out,
            'gate_formulir_sopir_telp_darurat' => (int) $this->gate_formulir_sopir_telp_darurat,
            'gate_kondisi_cukup_istirahat' => (int) $this->gate_kondisi_cukup_istirahat,
            'gate_kondisi_tidak_pengaruh_obat_alkohol' => (int) $this->gate_kondisi_tidak_pengaruh_obat_alkohol,
            'gate_APD' => (int) $this->gate_APD,
            'gate_traffic_tool' => (int) $this->gate_traffic_tool,
            'gate_senter' => (int) $this->gate_senter,
            'gate_kotak_p3k' => (int) $this->gate_kotak_p3k,
            'gate_pemadam_kebakaran' => (int) $this->gate_pemadam_kebakaran,
            'gate_spill_kit' => (int) $this->gate_spill_kit,
            'gate_b_sarung_tangan' => (int) $this->gate_b_sarung_tangan,
            'gate_b_respirator' => (int) $this->gate_b_respirator,
            'gate_b_plakat_tanda_bahaya' => (int) $this->gate_b_plakat_tanda_bahaya,
            'gate_b_battery_breaker' => (int) $this->gate_b_battery_breaker,
            'gate_b_hazard' => (int) $this->gate_b_hazard,
            'gate_kend_kemudi_rem_berfungsi' => (int) $this->gate_kend_kemudi_rem_berfungsi,
            'gate_kend_sabuk_pengaman_berfungsi' => (int) $this->gate_kend_sabuk_pengaman_berfungsi,
            'gate_kend_lampu_nyala' => (int) $this->gate_kend_lampu_nyala,
            'gate_kend_kaca' => (int) $this->gate_kend_kaca,
            'gate_kend_ban' => (int) $this->gate_kend_ban,
            'gate_kend_ban_not_vulkanisir' => (int) $this->gate_kend_ban_not_vulkanisir,
            'gate_kend_dongkrak_toolkit' => (int) $this->gate_kend_dongkrak_toolkit,
            'gate_kend_tutup_tangki' => (int) $this->gate_kend_tutup_tangki,
            'gate_kend_chasis' => (int) $this->gate_kend_chasis,
            'gate_kend_tutup_cairan_aki' => (int) $this->gate_kend_tutup_cairan_aki,
            'gate_kend_twist_lock' => (int) $this->gate_kend_twist_lock,
            'gate_kend_landing_leg' => (int) $this->gate_kend_landing_leg,
            'gate_kend_kontainer' => (int) $this->gate_kend_kontainer,
            'gate_kend_valve' => (int) $this->gate_kend_valve,
            'gate_kend_cleanliness_certificate' => (int) $this->gate_kend_cleanliness_certificate,
            'gate_kend_oli_tidak_bocor' => (int) $this->gate_kend_oli_tidak_bocor,
            'gate_kend_tachograph' => (int) $this->gate_kend_tachograph,
            'gate_pintu_kanan' => (int) $this->gate_pintu_kanan,
            'gate_pintu_kiri' => (int) $this->gate_pintu_kiri,
            'gate_tdk_ada_benda_asing_laci_dashboard' => (int) $this->gate_tdk_ada_benda_asing_laci_dashboard,
            'gate_tdk_ada_benda_asing_diatas_dashboard' => (int) $this->gate_tdk_ada_benda_asing_diatas_dashboard,
            'gate_tdk_ada_benda_asing_dicelah_kursi' => (int) $this->gate_tdk_ada_benda_asing_dicelah_kursi,
            'gate_tdk_ada_benda_asing_dibawah_kursi' => (int) $this->gate_tdk_ada_benda_asing_dibawah_kursi,
            'gate_tdk_ada_benda_asing_dibelakang_kursi' => (int) $this->gate_tdk_ada_benda_asing_dibelakang_kursi,
            'gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu' => (int) $this->gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu,
            'gate_bagian_atap_rapi_tdk_ada_benda_asing' => (int) $this->gate_bagian_atap_rapi_tdk_ada_benda_asing,
            'gate_is_approve' => (int) $this->gate_is_approve,
            'gate_email_sent' => (int) $this->gate_email_sent,
            'gate_exit_dokumen_pengantar_barang_lengkap' => (int) $this->gate_exit_dokumen_pengantar_barang_lengkap,
            'gate_exit_muatan_disegel' => (int) $this->gate_exit_muatan_disegel,
            'gate_exit_tidak_tercecer' => (int) $this->gate_exit_tidak_tercecer,
            'gate_exit_petunjuk_darurat_transportasi' => (int) $this->gate_exit_petunjuk_darurat_transportasi,
            'gate_tipe_pelanggan' => (int) $this->gate_tipe_pelanggan,
            'gate_exit_plakat_tanda_bahaya_terpasang' => (int) $this->gate_exit_plakat_tanda_bahaya_terpasang,
            'gate_loading_status' => (int) $this->gate_loading_status,
            'gate_pengganjal_roda' => (int) $this->gate_pengganjal_roda,
            'gateable_id' => (int) $this->gateable_id,


            'gate_report_code' => $this->gate_report_code,
            'gate_pengganjal_roda_desc' => $this->gate_pengganjal_roda_desc,
            'gate_formulir_sopir_telp_darurat_desc' => $this->gate_formulir_sopir_telp_darurat_desc,
            'gate_kondisi_cukup_istirahat_desc' => $this->gate_kondisi_cukup_istirahat_desc,
            'gate_kondisi_tidak_pengaruh_obat_alkohol_desc' => $this->gate_kondisi_tidak_pengaruh_obat_alkohol_desc,
            'gate_APD_desc' => $this->gate_APD_desc,
            'gate_traffic_tool_desc' => $this->gate_traffic_tool_desc,
            'gate_senter_desc' => $this->gate_senter_desc,
            'gate_kotak_p3k_desc' => $this->gate_kotak_p3k_desc,
            'gate_pemadam_kebakaran_desc' => $this->gate_pemadam_kebakaran_desc,
            'gate_spill_kit_desc' => $this->gate_spill_kit_desc,
            'gate_sarung_tangan_desc' => $this->gate_sarung_tangan_desc,
            'gate_respirator_desc' => $this->gate_respirator_desc,
            'gate_plakat_tanda_bahaya_desc' => $this->gate_plakat_tanda_bahaya_desc,
            'gate_battery_breaker_desc' => $this->gate_battery_breaker_desc,
            'gate_hazard_desc' => $this->gate_hazard_desc,
            'gate_kend_kemudi_rem_berfungsi_desc' => $this->gate_kend_kemudi_rem_berfungsi_desc,
            'gate_kend_sabuk_pengaman_berfungsi_desc' => $this->gate_kend_sabuk_pengaman_berfungsi_desc,
            'gate_kend_lampu_nyala_desc' => $this->gate_kend_lampu_nyala_desc,
            'gate_kend_kaca_desc' => $this->gate_kend_kaca_desc,
            'gate_kend_ban_desc' => $this->gate_kend_ban_desc,
            'gate_kend_dongkrak_toolkit_desc' => $this->gate_kend_dongkrak_toolkit_desc,
            'gate_kend_tutup_tangki_desc' => $this->gate_kend_tutup_tangki_desc,
            'gate_kend_tutup_cairan_aki_desc' => $this->gate_kend_tutup_cairan_aki_desc,
            'gate_kend_chasis_desc' => $this->gate_kend_chasis_desc,
            'gate_kend_twist_lock_desc' => $this->gate_kend_twist_lock_desc,
            'gate_kend_landing_leg_desc' => $this->gate_kend_landing_leg_desc,
            'gate_kend_kontainer_desc' => $this->gate_kend_kontainer_desc,
            'gate_kend_valve_desc' => $this->gate_kend_valve_desc,
            'gate_kend_cleanliness_certificate_desc' => $this->gate_kend_cleanliness_certificate_desc,
            'gate_kend_oli_tidak_bocor_desc' => $this->gate_kend_oli_tidak_bocor_desc,
            'gate_kend_tachograph_desc' => $this->gate_kend_tachograph_desc,
            'gate_pintu_kanan_desc' => $this->gate_pintu_kanan_desc,
            'gate_pintu_kiri_desc' => $this->gate_pintu_kiri_desc,
            'gate_tdk_ada_benda_asing_laci_dashboard_desc' => $this->gate_tdk_ada_benda_asing_laci_dashboard_desc,
            'gate_tdk_ada_benda_asing_diatas_dashboard_desc' => $this->gate_tdk_ada_benda_asing_diatas_dashboard_desc,
            'gate_tdk_ada_benda_asing_dicelah_kursi_desc' => $this->gate_tdk_ada_benda_asing_dicelah_kursi_desc,
            'gate_tdk_ada_benda_asing_dibawah_kursi_desc' => $this->gate_tdk_ada_benda_asing_dibawah_kursi_desc,
            'gate_tdk_ada_benda_asing_dibelakang_kursi_desc' => $this->gate_tdk_ada_benda_asing_dibelakang_kursi_desc,
            'gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu_desc' => $this->gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu_desc,
            'gate_bagian_atap_rapi_tdk_ada_benda_asing_desc' => $this->gate_bagian_atap_rapi_tdk_ada_benda_asing_desc,
            'gate_not_approve_reason' => $this->gate_not_approve_reason,
            'gate_exit_dokumen_pengantar_barang_lengkap_desc' => $this->gate_exit_dokumen_pengantar_barang_lengkap_desc,
            'gate_exit_muatan_disegel_desc' => $this->gate_exit_muatan_disegel_desc,
            'gate_exit_tidak_tercecer_desc' => $this->gate_exit_tidak_tercecer_desc,
            'gate_exit_petunjuk_darurat_transportasi_desc' => $this->gate_exit_petunjuk_darurat_transportasi_desc,
            'gate_exit_plakat_tanda_bahaya_terpasang_desc' => $this->gate_exit_plakat_tanda_bahaya_terpasang_desc,
            'gate_exit_date' => $this->gate_exit_date,
            'gate_check_out_employee_id_mobile' => (int) $this->gate_check_out_employee_id_mobile,
            'gate_delete_reason' => $this->gate_delete_reason,
            'gate_approve_admin_message' => $this->gate_approve_admin_message,
            'gate_signature_employee_check_in' => $this->gate_signature_employee_check_in,
            'gate_signature_driver_check_in' => $this->gate_signature_driver_check_in,
            'gate_signature_employee_check_out' => $this->gate_signature_employee_check_out,
            'gate_signature_driver_check_out' => $this->gate_signature_driver_check_out,
            'gate_nama_angkutan' => $this->gate_nama_angkutan,
            'gate_nomor_plat' => $this->gate_nomor_plat,
            'gate_nomor_tangki' => $this->gate_nomor_tangki,
            'gate_nomor_JO_DO' => $this->gate_nomor_JO_DO,
            'gate_nama_driver' => $this->gate_nama_driver,
            'gate_nomor_telp' => $this->gate_nomor_telp,
            'gate_jenis_sim' => $this->gate_jenis_sim,
            'gate_nomor_sim' => $this->gate_nomor_sim,
            'gate_nama_produk' => $this->gate_nama_produk,
            'gate_nama_perusahaan' =>$this->gate_nama_perusahaan,
            'gate_jenis_kendaraan' => $this->gate_jenis_kendaraan,
            'gate_loading_type' => $this->gate_loading_type,
            'rk_masa_berlaku_SIM' => $this->rk_masa_berlaku_SIM,
            'rk_masa_berlaku_STNK' => $this->rk_masa_berlaku_STNK,
            'gate_masa_berlaku_kir' => $this->gate_masa_berlaku_kir,
            'gate_loading_date' => $this->gate_loading_date,
            'gateable_type' => $this->gateable_type,
            'gate_kesimpulan' => $this->gate_kesimpulan,
            'gate_pic_1' => $this->gate_pic_1,
            'gate_pic_2' => $this->gate_pic_2,
            'gate_pic_3' => $this->gate_pic_3,
            'gate_pic_4' => $this->gate_pic_4,
            'gate_pic_5' => $this->gate_pic_5,
            "is_editable" => $isEditable,

            // 'created_at'  => $this->created_at,
            // 'updated_at'  => $this->updated_at,

        ];
    }
}
