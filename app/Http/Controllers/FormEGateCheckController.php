<?php

namespace App\Http\Controllers;

use App\Models\FormEGateCheck;
use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class FormEGateCheckController extends Controller
{
    public function viewAllEgateForm(){
        return response()->json([
            'code' => 200,
            'message' => 'Success Fetch Data',
            'data' =>
                FormEGateCheck::all()
            ], 200);
    }

    public function getOneEgateForm($id){
        try{
            $gateForm = FormEGateCheck::findOrFail($id);


            return response()->json([
                'code' => 200,
                'message' => 'Success Fetch Data',
                'data' =>
                    [$gateForm]
                ], 200);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given E Gate Form ID not found',
                'data' => []
                ], 404);
        }

    }
    public function createOrUpdateEgateForm(Request $request)
    {
        $this->validate($request, [
            'form_id' => 'integer',
            'gate_report_status' => ['integer',Rule::in(['0','1']),],
            'gate_is_in' => ['integer',Rule::in(['0','1','2']),],
            'gate_is_out' => ['integer',Rule::in(['0','1','2']),],
            'gate_formulir_sopir_telp_darurat' => ['integer',Rule::in(['0','1','2']),],
            'gate_kondisi_cukup_istirahat' => ['integer',Rule::in(['0','1','2']),],
            'gate_kondisi_tidak_pengaruh_obat_alkohol' => ['integer',Rule::in(['0','1','2']),],
            'gate_APD' => ['integer',Rule::in(['0','1','2']),],
            'gate_traffic_tool' => ['integer',Rule::in(['0','1','2']),],
            'gate_senter' => ['integer',Rule::in(['0','1','2']),],
            'gate_kotak_p3k' => ['integer',Rule::in(['0','1','2']),],
            'gate_pemadam_kebakaran' => ['integer',Rule::in(['0','1','2']),],
            'gate_spill_kit' => ['integer',Rule::in(['0','1','2']),],
            'gate_b_sarung_tangan' => ['integer',Rule::in(['0','1','2']),],
            'gate_b_respirator' => ['integer',Rule::in(['0','1','2']),],
            'gate_b_plakat_tanda_bahaya' => ['integer',Rule::in(['0','1','2']),],
            'gate_b_battery_breaker' => ['integer',Rule::in(['0','1','2']),],
            'gate_b_hazard' => ['integer',Rule::in(['0','1','2']),],
            'gate_kend_kemudi_rem_berfungsi' => ['integer',Rule::in(['0','1','2']),],
            'gate_kend_sabuk_pengaman_berfungsi' => ['integer',Rule::in(['0','1','2']),],
            'gate_kend_lampu_nyala' => ['integer',Rule::in(['0','1','2']),],
            'gate_kend_kaca' => ['integer',Rule::in(['0','1','2']),],
            'gate_kend_ban' => ['integer',Rule::in(['0','1','2']),],
            'gate_kend_ban_not_vulkanisir' => ['integer',Rule::in(['0','1','2']),],
            'gate_kend_dongkrak_toolkit' => ['integer',Rule::in(['0','1','2']),],
            'gate_kend_tutup_tangki' => ['integer',Rule::in(['0','1','2']),],
            'gate_kend_chasis' => ['integer',Rule::in(['0','1','2']),],
            'gate_kend_tutup_cairan_aki' => ['integer',Rule::in(['0','1','2']),],
            'gate_kend_twist_lock' => ['integer',Rule::in(['0','1','2']),],
            'gate_kend_landing_leg' => ['integer',Rule::in(['0','1','2']),],
            'gate_kend_kontainer' => ['integer',Rule::in(['0','1','2']),],
            'gate_kend_valve' => ['integer',Rule::in(['0','1','2']),],
            'gate_kend_cleanliness_certificate' => ['integer',Rule::in(['0','1','2']),],
            'gate_kend_oli_tidak_bocor' => ['integer',Rule::in(['0','1','2']),],
            'gate_kend_tachograph' => ['integer',Rule::in(['0','1','2']),],
            'gate_pintu_kanan' => ['integer',Rule::in(['0','1','2']),],
            'gate_pintu_kiri' => ['integer',Rule::in(['0','1','2']),],
            'gate_tdk_ada_benda_asing_laci_dashboard' => ['integer',Rule::in(['0','1','2']),],
            'gate_tdk_ada_benda_asing_diatas_dashboard' => ['integer',Rule::in(['0','1','2']),],
            'gate_tdk_ada_benda_asing_dicelah_kursi' => ['integer',Rule::in(['0','1','2']),],
            'gate_tdk_ada_benda_asing_dibawah_kursi' => ['integer',Rule::in(['0','1','2']),],
            'gate_tdk_ada_benda_asing_dibelakang_kursi' => ['integer',Rule::in(['0','1','2']),],
            'gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu' => ['integer',Rule::in(['0','1','2']),],
            'gate_bagian_atap_rapi_tdk_ada_benda_asing' => ['integer',Rule::in(['0','1','2']),],
            'gate_is_approve' => ['integer',Rule::in(['0','1','2']),],
            'gate_email_sent' => ['integer',Rule::in(['0','1','2']),],
            'gate_exit_dokumen_pengantar_barang_lengkap' => ['integer',Rule::in(['0','1','2']),],
            'gate_exit_muatan_disegel' => ['integer',Rule::in(['0','1','2']),],
            'gate_exit_tidak_tercecer' => ['integer',Rule::in(['0','1','2']),],
            'gate_exit_petunjuk_darurat_transportasi' => ['integer',Rule::in(['0','1','2']),],
            'gate_report_code' => 'string',
            'gate_formulir_sopir_telp_darurat_desc' => 'string',
            'gate_kondisi_cukup_istirahat_desc' => 'string',
            'gate_kondisi_tidak_pengaruh_obat_alkohol_desc' => 'string',
            'gate_APD_desc' => 'string',
            'gate_traffic_tool_desc' => 'string',
            'gate_senter_desc' => 'string',
            'gate_kotak_p3k_desc' => 'string',
            'gate_pemadam_kebakaran_desc' => 'string',
            'gate_spill_kit_desc' => 'string',
            'gate_sarung_tangan_desc' => 'string',
            'gate_respirator_desc' => 'string',
            'gate_plakat_tanda_bahaya_desc' => 'string',
            'gate_battery_breaker_desc' => 'string',
            'gate_hazard_desc' => 'string',
            'gate_kend_kemudi_rem_berfungsi_desc' => 'string',
            'gate_kend_sabuk_pengaman_berfungsi_desc' => 'string',
            'gate_kend_lampu_nyala_desc' => 'string',
            'gate_kend_kaca_desc' => 'string',
            'gate_kend_ban_desc' => 'string',
            'gate_kend_dongkrak_toolkit_desc' => 'string',
            'gate_kend_tutup_tangki_desc' => 'string',
            'gate_kend_tutup_cairan_aki_desc' => 'string',
            'gate_kend_chasis_desc' => 'string',
            'gate_kend_twist_lock_desc' => 'string',
            'gate_kend_landing_leg_desc' => 'string',
            'gate_kend_kontainer_desc' => 'string',
            'gate_kend_valve_desc' => 'string',
            'gate_kend_cleanliness_certificate_desc' => 'string',
            'gate_kend_oli_tidak_bocor_desc' => 'string',
            'gate_kend_tachograph_desc' => 'string',
            'gate_pintu_kanan_desc' => 'string',
            'gate_pintu_kiri_desc' => 'string',
            'gate_tdk_ada_benda_asing_laci_dashboard_desc' => 'string',
            'gate_tdk_ada_benda_asing_diatas_dashboard_desc' => 'string',
            'gate_tdk_ada_benda_asing_dicelah_kursi_desc' => 'string',
            'gate_tdk_ada_benda_asing_dibawah_kursi_desc' => 'string',
            'gate_tdk_ada_benda_asing_dibelakang_kursi_desc' => 'string',
            'gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu_desc' => 'string',
            'gate_bagian_atap_rapi_tdk_ada_benda_asing_desc' => 'string',
            'gate_not_approve_reason' => 'string',
            'gate_exit_dokumen_pengantar_barang_lengkap_desc' => 'string',
            'gate_exit_muatan_disegel_desc' => 'string',
            'gate_exit_tidak_tercecer_desc' => 'string',
            'gate_exit_petunjuk_darurat_transportasi_desc' => 'string',
            'gate_exit_plakat_tanda_bahaya_terpasang_desc' => 'string',
            'gate_signature_employee_check_in' => 'string',
            'gate_delete_reason' => 'string',
            'gate_approve_admin_message' => 'string',
            'gate_signature_driver_check_in' => 'string',
            'gate_signature_employee_check_out' => 'string',
            'gate_signature_driver_check_out' => 'string',
            // 'gateable_type' => 'string',
        ]);
        if($request->input('form_id') != null || $request->input('form_id') != 0){
            try{
                $formEGate = FormEGateCheck::findOrFail($idForm);

                $formEGate->update([
                    'gate_report_status' => (int) $request->input('gate_report_status'),
                    'gate_is_in' => (int) $request->input('gate_is_in'),
                    'gate_is_out' => (int) $request->input('gate_is_out'),
                    'gate_formulir_sopir_telp_darurat' => (int) $request->input('gate_formulir_sopir_telp_darurat'),
                    'gate_kondisi_cukup_istirahat' => (int) $request->input('gate_kondisi_cukup_istirahat'),
                    'gate_kondisi_tidak_pengaruh_obat_alkohol' => (int) $request->input('gate_kondisi_tidak_pengaruh_obat_alkohol'),
                    'gate_APD' => (int) $request->input('gate_APD'),
                    'gate_traffic_tool' => (int) $request->input('gate_traffic_tool'),
                    'gate_senter' => (int) $request->input('gate_senter'),
                    'gate_kotak_p3k' => (int) $request->input('gate_kotak_p3k'),
                    'gate_pemadam_kebakaran' => (int) $request->input('gate_pemadam_kebakaran'),
                    'gate_spill_kit' => (int) $request->input('gate_spill_kit'),
                    'gate_b_sarung_tangan' => (int) $request->input('gate_b_sarung_tangan'),
                    'gate_b_respirator' => (int) $request->input('gate_b_respirator'),
                    'gate_b_plakat_tanda_bahaya' => (int) $request->input('gate_b_plakat_tanda_bahaya'),
                    'gate_b_battery_breaker' => (int) $request->input('gate_b_battery_breaker'),
                    'gate_b_hazard' => (int) $request->input('gate_b_hazard'),
                    'gate_kend_kemudi_rem_berfungsi' => (int) $request->input('gate_kend_kemudi_rem_berfungsi'),
                    'gate_kend_sabuk_pengaman_berfungsi' => (int) $request->input('gate_kend_sabuk_pengaman_berfungsi'),
                    'gate_kend_lampu_nyala' => (int) $request->input('gate_kend_lampu_nyala'),
                    'gate_kend_kaca' => (int) $request->input('gate_kend_kaca'),
                    'gate_kend_ban' => (int) $request->input('gate_kend_ban'),
                    'gate_kend_ban_not_vulkanisir' => (int) $request->input('gate_kend_ban_not_vulkanisir'),
                    'gate_kend_dongkrak_toolkit' => (int) $request->input('gate_kend_dongkrak_toolkit'),
                    'gate_kend_tutup_tangki' => (int) $request->input('gate_kend_tutup_tangki'),
                    'gate_kend_chasis' => (int) $request->input('gate_kend_chasis'),
                    'gate_kend_tutup_cairan_aki' => (int) $request->input('gate_kend_tutup_cairan_aki'),
                    'gate_kend_twist_lock' => (int) $request->input('gate_kend_twist_lock'),
                    'gate_kend_landing_leg' => (int) $request->input('gate_kend_landing_leg'),
                    'gate_kend_kontainer' => (int) $request->input('gate_kend_kontainer'),
                    'gate_kend_valve' => (int) $request->input('gate_kend_valve'),
                    'gate_kend_cleanliness_certificate' => (int) $request->input('gate_kend_cleanliness_certificate'),
                    'gate_kend_oli_tidak_bocor' => (int) $request->input('gate_kend_oli_tidak_bocor'),
                    'gate_kend_tachograph' => (int) $request->input('gate_kend_tachograph'),
                    'gate_pintu_kanan' => (int) $request->input('gate_pintu_kanan'),
                    'gate_pintu_kiri' => (int) $request->input('gate_pintu_kiri'),
                    'gate_tdk_ada_benda_asing_laci_dashboard' => (int) $request->input('gate_tdk_ada_benda_asing_laci_dashboard'),
                    'gate_tdk_ada_benda_asing_diatas_dashboard' => (int) $request->input('gate_tdk_ada_benda_asing_diatas_dashboard'),
                    'gate_tdk_ada_benda_asing_dicelah_kursi' => (int) $request->input('gate_tdk_ada_benda_asing_dicelah_kursi'),
                    'gate_tdk_ada_benda_asing_dibawah_kursi' => (int) $request->input('gate_tdk_ada_benda_asing_dibawah_kursi'),
                    'gate_tdk_ada_benda_asing_dibelakang_kursi' => (int) $request->input('gate_tdk_ada_benda_asing_dibelakang_kursi'),
                    'gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu' => (int) $request->input('gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu'),
                    'gate_bagian_atap_rapi_tdk_ada_benda_asing' => (int) $request->input('gate_bagian_atap_rapi_tdk_ada_benda_asing'),
                    'gate_is_approve' => (int) $request->input('gate_is_approve'),
                    'gate_email_sent' => (int) $request->input('gate_email_sent'),
                    'gate_exit_dokumen_pengantar_barang_lengkap' => (int) $request->input('gate_exit_dokumen_pengantar_barang_lengkap'),
                    'gate_exit_muatan_disegel' => (int) $request->input('gate_exit_muatan_disegel'),
                    'gate_exit_tidak_tercecer' => (int) $request->input('gate_exit_tidak_tercecer'),
                    'gate_exit_petunjuk_darurat_transportasi' => (int) $request->input('gate_exit_petunjuk_darurat_transportasi'),


                    'gate_report_code' => $request->input('gate_report_code'),
                    'gate_formulir_sopir_telp_darurat_desc' => $request->input('gate_formulir_sopir_telp_darurat_desc'),
                    'gate_kondisi_cukup_istirahat_desc' => $request->input('gate_kondisi_cukup_istirahat_desc'),
                    'gate_kondisi_tidak_pengaruh_obat_alkohol_desc' => $request->input('gate_kondisi_tidak_pengaruh_obat_alkohol_desc'),
                    'gate_APD_desc' => $request->input('gate_APD_desc'),
                    'gate_traffic_tool_desc' => $request->input('gate_traffic_tool_desc'),
                    'gate_senter_desc' => $request->input('gate_senter_desc'),
                    'gate_kotak_p3k_desc' => $request->input('gate_kotak_p3k_desc'),
                    'gate_pemadam_kebakaran_desc' => $request->input('gate_pemadam_kebakaran_desc'),
                    'gate_spill_kit_desc' => $request->input('gate_spill_kit_desc'),
                    'gate_sarung_tangan_desc' => $request->input('gate_sarung_tangan_desc'),
                    'gate_respirator_desc' => $request->input('gate_respirator_desc'),
                    'gate_plakat_tanda_bahaya_desc' => $request->input('gate_plakat_tanda_bahaya_desc'),
                    'gate_battery_breaker_desc' => $request->input('gate_battery_breaker_desc'),
                    'gate_hazard_desc' => $request->input('gate_hazard_desc'),
                    'gate_kend_kemudi_rem_berfungsi_desc' => $request->input('gate_kend_kemudi_rem_berfungsi_desc'),
                    'gate_kend_sabuk_pengaman_berfungsi_desc' => $request->input('gate_kend_sabuk_pengaman_berfungsi_desc'),
                    'gate_kend_lampu_nyala_desc' => $request->input('gate_kend_lampu_nyala_desc'),
                    'gate_kend_kaca_desc' => $request->input('gate_kend_kaca_desc'),
                    'gate_kend_ban_desc' => $request->input('gate_kend_ban_desc'),
                    'gate_kend_dongkrak_toolkit_desc' => $request->input('gate_kend_dongkrak_toolkit_desc'),
                    'gate_kend_tutup_tangki_desc' => $request->input('gate_kend_tutup_tangki_desc'),
                    'gate_kend_tutup_cairan_aki_desc' => $request->input('gate_kend_tutup_cairan_aki_desc'),
                    'gate_kend_chasis_desc' => $request->input('gate_kend_chasis_desc'),
                    'gate_kend_twist_lock_desc' => $request->input('gate_kend_twist_lock_desc'),
                    'gate_kend_landing_leg_desc' => $request->input('gate_kend_landing_leg_desc'),
                    'gate_kend_kontainer_desc' => $request->input('gate_kend_kontainer_desc'),
                    'gate_kend_valve_desc' => $request->input('gate_kend_valve_desc'),
                    'gate_kend_cleanliness_certificate_desc' => $request->input('gate_kend_cleanliness_certificate_desc'),
                    'gate_kend_oli_tidak_bocor_desc' => $request->input('gate_kend_oli_tidak_bocor_desc'),
                    'gate_kend_tachograph_desc' => $request->input('gate_kend_tachograph_desc'),
                    'gate_pintu_kanan_desc' => $request->input('gate_pintu_kanan_desc'),
                    'gate_pintu_kiri_desc' => $request->input('gate_pintu_kiri_desc'),
                    'gate_tdk_ada_benda_asing_laci_dashboard_desc' => $request->input('gate_tdk_ada_benda_asing_laci_dashboard_desc'),
                    'gate_tdk_ada_benda_asing_diatas_dashboard_desc' => $request->input('gate_tdk_ada_benda_asing_diatas_dashboard_desc'),
                    'gate_tdk_ada_benda_asing_dicelah_kursi_desc' => $request->input('gate_tdk_ada_benda_asing_dicelah_kursi_desc'),
                    'gate_tdk_ada_benda_asing_dibawah_kursi_desc' => $request->input('gate_tdk_ada_benda_asing_dibawah_kursi_desc'),
                    'gate_tdk_ada_benda_asing_dibelakang_kursi_desc' => $request->input('gate_tdk_ada_benda_asing_dibelakang_kursi_desc'),
                    'gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu_desc' => $request->input('gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu_desc'),
                    'gate_bagian_atap_rapi_tdk_ada_benda_asing_desc' => $request->input('gate_bagian_atap_rapi_tdk_ada_benda_asing_desc'),
                    'gate_not_approve_reason' => $request->input('gate_not_approve_reason'),
                    'gate_exit_dokumen_pengantar_barang_lengkap_desc' => $request->input('gate_exit_dokumen_pengantar_barang_lengkap_desc'),
                    'gate_exit_muatan_disegel_desc' => $request->input('gate_exit_muatan_disegel_desc'),
                    'gate_exit_tidak_tercecer_desc' => $request->input('gate_exit_tidak_tercecer_desc'),
                    'gate_exit_petunjuk_darurat_transportasi_desc' => $request->input('gate_exit_petunjuk_darurat_transportasi_desc'),
                    'gate_exit_plakat_tanda_bahaya_terpasang_desc' => $request->input('gate_exit_plakat_tanda_bahaya_terpasang_desc'),
                    'gate_signature_employee_check_in' => $request->input('gate_signature_employee_check_in'),
                    'gate_delete_reason' => $request->input('gate_delete_reason'),
                    'gate_approve_admin_message' => $request->input('gate_approve_admin_message'),
                    'gate_signature_driver_check_in' => $request->input('gate_signature_driver_check_in'),
                    'gate_signature_employee_check_out' => $request->input('gate_signature_employee_check_out'),
                    'gate_signature_driver_check_out' => $request->input('gate_signature_driver_check_out'),
                ]);
                response()->json([
                    'code' => 200,
                    'message' => 'Success Create Data',
                    'data' =>
                        [$formEGate]
                    ], 200);

            } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
                return response()->json([
                    'code' => 404,
                    'message' => 'Given E Gate Form ID not found',
                    'data' => []
                    ], 404);
            }
        } else {
            $employee = Auth::user();

            $formEGate = FormEGateCheck::create(
                [
                    'user_id' => $employee->id,
                    'gate_report_status' => (int) $request->input('gate_report_status'),
                    'gate_is_in' => (int) $request->input('gate_is_in'),
                    'gate_is_out' => (int) $request->input('gate_is_out'),
                    'gate_formulir_sopir_telp_darurat' => (int) $request->input('gate_formulir_sopir_telp_darurat'),
                    'gate_kondisi_cukup_istirahat' => (int) $request->input('gate_kondisi_cukup_istirahat'),
                    'gate_kondisi_tidak_pengaruh_obat_alkohol' => (int) $request->input('gate_kondisi_tidak_pengaruh_obat_alkohol'),
                    'gate_APD' => (int) $request->input('gate_APD'),
                    'gate_traffic_tool' => (int) $request->input('gate_traffic_tool'),
                    'gate_senter' => (int) $request->input('gate_senter'),
                    'gate_kotak_p3k' => (int) $request->input('gate_kotak_p3k'),
                    'gate_pemadam_kebakaran' => (int) $request->input('gate_pemadam_kebakaran'),
                    'gate_spill_kit' => (int) $request->input('gate_spill_kit'),
                    'gate_b_sarung_tangan' => (int) $request->input('gate_b_sarung_tangan'),
                    'gate_b_respirator' => (int) $request->input('gate_b_respirator'),
                    'gate_b_plakat_tanda_bahaya' => (int) $request->input('gate_b_plakat_tanda_bahaya'),
                    'gate_b_battery_breaker' => (int) $request->input('gate_b_battery_breaker'),
                    'gate_b_hazard' => (int) $request->input('gate_b_hazard'),
                    'gate_kend_kemudi_rem_berfungsi' => (int) $request->input('gate_kend_kemudi_rem_berfungsi'),
                    'gate_kend_sabuk_pengaman_berfungsi' => (int) $request->input('gate_kend_sabuk_pengaman_berfungsi'),
                    'gate_kend_lampu_nyala' => (int) $request->input('gate_kend_lampu_nyala'),
                    'gate_kend_kaca' => (int) $request->input('gate_kend_kaca'),
                    'gate_kend_ban' => (int) $request->input('gate_kend_ban'),
                    'gate_kend_ban_not_vulkanisir' => (int) $request->input('gate_kend_ban_not_vulkanisir'),
                    'gate_kend_dongkrak_toolkit' => (int) $request->input('gate_kend_dongkrak_toolkit'),
                    'gate_kend_tutup_tangki' => (int) $request->input('gate_kend_tutup_tangki'),
                    'gate_kend_chasis' => (int) $request->input('gate_kend_chasis'),
                    'gate_kend_tutup_cairan_aki' => (int) $request->input('gate_kend_tutup_cairan_aki'),
                    'gate_kend_twist_lock' => (int) $request->input('gate_kend_twist_lock'),
                    'gate_kend_landing_leg' => (int) $request->input('gate_kend_landing_leg'),
                    'gate_kend_kontainer' => (int) $request->input('gate_kend_kontainer'),
                    'gate_kend_valve' => (int) $request->input('gate_kend_valve'),
                    'gate_kend_cleanliness_certificate' => (int) $request->input('gate_kend_cleanliness_certificate'),
                    'gate_kend_oli_tidak_bocor' => (int) $request->input('gate_kend_oli_tidak_bocor'),
                    'gate_kend_tachograph' => (int) $request->input('gate_kend_tachograph'),
                    'gate_pintu_kanan' => (int) $request->input('gate_pintu_kanan'),
                    'gate_pintu_kiri' => (int) $request->input('gate_pintu_kiri'),
                    'gate_tdk_ada_benda_asing_laci_dashboard' => (int) $request->input('gate_tdk_ada_benda_asing_laci_dashboard'),
                    'gate_tdk_ada_benda_asing_diatas_dashboard' => (int) $request->input('gate_tdk_ada_benda_asing_diatas_dashboard'),
                    'gate_tdk_ada_benda_asing_dicelah_kursi' => (int) $request->input('gate_tdk_ada_benda_asing_dicelah_kursi'),
                    'gate_tdk_ada_benda_asing_dibawah_kursi' => (int) $request->input('gate_tdk_ada_benda_asing_dibawah_kursi'),
                    'gate_tdk_ada_benda_asing_dibelakang_kursi' => (int) $request->input('gate_tdk_ada_benda_asing_dibelakang_kursi'),
                    'gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu' => (int) $request->input('gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu'),
                    'gate_bagian_atap_rapi_tdk_ada_benda_asing' => (int) $request->input('gate_bagian_atap_rapi_tdk_ada_benda_asing'),
                    'gate_is_approve' => (int) $request->input('gate_is_approve'),
                    'gate_email_sent' => (int) $request->input('gate_email_sent'),
                    'gate_exit_dokumen_pengantar_barang_lengkap' => (int) $request->input('gate_exit_dokumen_pengantar_barang_lengkap'),
                    'gate_exit_muatan_disegel' => (int) $request->input('gate_exit_muatan_disegel'),
                    'gate_exit_tidak_tercecer' => (int) $request->input('gate_exit_tidak_tercecer'),
                    'gate_exit_petunjuk_darurat_transportasi' => (int) $request->input('gate_exit_petunjuk_darurat_transportasi'),

                    'gate_report_code' => $request->input('gate_report_code'),
                    'gate_formulir_sopir_telp_darurat_desc' => $request->input('gate_formulir_sopir_telp_darurat_desc'),
                    'gate_kondisi_cukup_istirahat_desc' => $request->input('gate_kondisi_cukup_istirahat_desc'),
                    'gate_kondisi_tidak_pengaruh_obat_alkohol_desc' => $request->input('gate_kondisi_tidak_pengaruh_obat_alkohol_desc'),
                    'gate_APD_desc' => $request->input('gate_APD_desc'),
                    'gate_traffic_tool_desc' => $request->input('gate_traffic_tool_desc'),
                    'gate_senter_desc' => $request->input('gate_senter_desc'),
                    'gate_kotak_p3k_desc' => $request->input('gate_kotak_p3k_desc'),
                    'gate_pemadam_kebakaran_desc' => $request->input('gate_pemadam_kebakaran_desc'),
                    'gate_spill_kit_desc' => $request->input('gate_spill_kit_desc'),
                    'gate_sarung_tangan_desc' => $request->input('gate_sarung_tangan_desc'),
                    'gate_respirator_desc' => $request->input('gate_respirator_desc'),
                    'gate_plakat_tanda_bahaya_desc' => $request->input('gate_plakat_tanda_bahaya_desc'),
                    'gate_battery_breaker_desc' => $request->input('gate_battery_breaker_desc'),
                    'gate_hazard_desc' => $request->input('gate_hazard_desc'),
                    'gate_kend_kemudi_rem_berfungsi_desc' => $request->input('gate_kend_kemudi_rem_berfungsi_desc'),
                    'gate_kend_sabuk_pengaman_berfungsi_desc' => $request->input('gate_kend_sabuk_pengaman_berfungsi_desc'),
                    'gate_kend_lampu_nyala_desc' => $request->input('gate_kend_lampu_nyala_desc'),
                    'gate_kend_kaca_desc' => $request->input('gate_kend_kaca_desc'),
                    'gate_kend_ban_desc' => $request->input('gate_kend_ban_desc'),
                    'gate_kend_dongkrak_toolkit_desc' => $request->input('gate_kend_dongkrak_toolkit_desc'),
                    'gate_kend_tutup_tangki_desc' => $request->input('gate_kend_tutup_tangki_desc'),
                    'gate_kend_tutup_cairan_aki_desc' => $request->input('gate_kend_tutup_cairan_aki_desc'),
                    'gate_kend_chasis_desc' => $request->input('gate_kend_chasis_desc'),
                    'gate_kend_twist_lock_desc' => $request->input('gate_kend_twist_lock_desc'),
                    'gate_kend_landing_leg_desc' => $request->input('gate_kend_landing_leg_desc'),
                    'gate_kend_kontainer_desc' => $request->input('gate_kend_kontainer_desc'),
                    'gate_kend_valve_desc' => $request->input('gate_kend_valve_desc'),
                    'gate_kend_cleanliness_certificate_desc' => $request->input('gate_kend_cleanliness_certificate_desc'),
                    'gate_kend_oli_tidak_bocor_desc' => $request->input('gate_kend_oli_tidak_bocor_desc'),
                    'gate_kend_tachograph_desc' => $request->input('gate_kend_tachograph_desc'),
                    'gate_pintu_kanan_desc' => $request->input('gate_pintu_kanan_desc'),
                    'gate_pintu_kiri_desc' => $request->input('gate_pintu_kiri_desc'),
                    'gate_tdk_ada_benda_asing_laci_dashboard_desc' => $request->input('gate_tdk_ada_benda_asing_laci_dashboard_desc'),
                    'gate_tdk_ada_benda_asing_diatas_dashboard_desc' => $request->input('gate_tdk_ada_benda_asing_diatas_dashboard_desc'),
                    'gate_tdk_ada_benda_asing_dicelah_kursi_desc' => $request->input('gate_tdk_ada_benda_asing_dicelah_kursi_desc'),
                    'gate_tdk_ada_benda_asing_dibawah_kursi_desc' => $request->input('gate_tdk_ada_benda_asing_dibawah_kursi_desc'),
                    'gate_tdk_ada_benda_asing_dibelakang_kursi_desc' => $request->input('gate_tdk_ada_benda_asing_dibelakang_kursi_desc'),
                    'gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu_desc' => $request->input('gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu_desc'),
                    'gate_bagian_atap_rapi_tdk_ada_benda_asing_desc' => $request->input('gate_bagian_atap_rapi_tdk_ada_benda_asing_desc'),
                    'gate_not_approve_reason' => $request->input('gate_not_approve_reason'),
                    'gate_exit_dokumen_pengantar_barang_lengkap_desc' => $request->input('gate_exit_dokumen_pengantar_barang_lengkap_desc'),
                    'gate_exit_muatan_disegel_desc' => $request->input('gate_exit_muatan_disegel_desc'),
                    'gate_exit_tidak_tercecer_desc' => $request->input('gate_exit_tidak_tercecer_desc'),
                    'gate_exit_petunjuk_darurat_transportasi_desc' => $request->input('gate_exit_petunjuk_darurat_transportasi_desc'),
                    'gate_exit_plakat_tanda_bahaya_terpasang_desc' => $request->input('gate_exit_plakat_tanda_bahaya_terpasang_desc'),
                    'gate_signature_employee_check_in' => $request->input('gate_signature_employee_check_in'),
                    'gate_delete_reason' => $request->input('gate_delete_reason'),
                    'gate_approve_admin_message' => $request->input('gate_approve_admin_message'),
                    'gate_signature_driver_check_in' => $request->input('gate_signature_driver_check_in'),
                    'gate_signature_employee_check_out' => $request->input('gate_signature_employee_check_out'),
                    'gate_signature_driver_check_out' => $request->input('gate_signature_driver_check_out'),
                ]
            );
            return response()->json([
                'code' => 200,
                'message' => 'Success Create Data',
                'data' =>
                    [$formEGate]
                ], 200);
        }
    }

    public function deleteEgateForm($id){
        try{
            $gateForm = FormEGateCheck::findOrFail($id);
            $gateable = $gateForm->gateable;
            if($gateable != null){
                $gateable->delete();
            }
            $gateForm->delete();

            return response()->json([
                'code' => 200,
                'message' => 'Success Delete Data',
                'data' =>
                    [$gateForm]
                ], 200);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given E Gate Form ID not found',
                'data' => []
                ], 404);
        }


    }

    public function deleteEgateFormGateable($id){
        try{
            $gateForm = FormEGateCheck::findOrFail($id);
            $gateable_id = $gateForm->gateable_id;
            $gateable_type = $gateForm->gateable_type;
            if($gateable_id != null && $gateable_type != null){
                $gateForm->update([
                    'gateable_id' => null,
                    'gateable_type' => null,
                ]);
            }

            return response()->json([
                'code' => 200,
                'message' => 'Success Delete Gateable of E Gate Form',
                'data' =>
                    [$gateForm]
                ], 200);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given E Gate Form ID not found',
                'data' => []
                ], 404);
        }


    }

    public function approveEgateForm($idForm){
        try{
            $employee = Auth::user();

            // $formEGate = FormEGateCheck::findOrFail($idForm);
            $formEGate = $employee->formEGateCheck()->findOrFail($idForm);

            $formEGate->update([
                'gate_approve_admin' => $employee->id,
                'gate_approve_admin_date' => Carbon::now(),
                'gate_report_status' => 2,
                'gate_is_approve' => 1,
            ]);
            return response()->json([
                'code' => 200,
                'message' => 'Success Approve Data',
                'data' =>
                    [$formEGate]
                ], 200);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given E Gate Form ID not found',
                'data' => []
                ], 404);
        }
    }
}
