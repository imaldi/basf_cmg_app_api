<?php

namespace App\Http\Controllers;

use App\Models\FormEGateCheck;
use App\Models\FormUnloadingStearicAcid;
use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class FormUnloadingStearicAcidController extends Controller
{
    public function viewAllFormUnloadingStearicAcid(){
        return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' =>
            FormUnloadingStearicAcid::all()
            ], 200);
    }
    public function createOrUpdateFormUnloadingStearicAcid(Request $request){
        $this->validate($request, [
            'form_id' => 'integer',
            'gate_id' => 'required|integer',
            'un5_persiapan_memakai_ppe' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_cek_hose_piping' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_safety_shower' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_operator_terima_dokumen' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_arahkan_truk_parkir' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_ganjal_roda' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_safety_cone' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_verifikasi_fisik' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_sopir_serahkan_kunci' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_sopir_kenek_leave_unloading' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_isotank_bersih' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_label_segel_terpasang' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_pasang_hose_steam' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_siapkan_botol_sample' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_check_fullbody_harness_desc' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_webbing' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_D_rings' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_buckles' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_carabiner' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_lanyard' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_shockabsorber_pack' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_fall_arrester' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_setelah_pemanasan_14jam' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_ambil_sample' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_ambil_hose_stearic_acid' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_periksa_level_storage' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_konfirmasi_ok' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_buka_segel' => ['integer', Rule::in(['0','1','2']),],
            'un5_persiapan_periksa_hose_tidak_bocor' => ['integer', Rule::in(['0','1','2']),],
            'un5_unloading_bottom_valve_dibuka_penuh' => ['integer', Rule::in(['0','1','2']),],
            'un5_unloading_cek_pipa_coupling_valve_tidak_bocor' => ['integer', Rule::in(['0','1','2']),],
            'un5_unloading_pastikan_unloading_aman' => ['integer', Rule::in(['0','1','2']),],
            'un5_selesai_unloading_selesai' => ['integer', Rule::in(['0','1','2']),],
            'un5_selesai_matikan_pompa' => ['integer', Rule::in(['0','1','2']),],
            'un5_selesai_buka_bottom_valve_storage' => ['integer', Rule::in(['0','1','2']),],
            'un5_selesai_tutup_valve' => ['integer', Rule::in(['0','1','2']),],
            'un5_selesai_pastikan_hose_liquid_kosong' => ['integer', Rule::in(['0','1','2']),],
            'un5_selesai_periksa_valve_ditutup' => ['integer', Rule::in(['0','1','2']),],
            'un5_selesai_panggil_sopir_kembali' => ['integer', Rule::in(['0','1','2']),],
            'un5_selesai_lepas_pengganjal_roda_safetycone' => ['integer', Rule::in(['0','1','2']),],
            'un5_selesai_pastikan_peralatan_tidak_terbawa_truk' => ['integer', Rule::in(['0','1','2']),],
            'un5_selesai_lakukan_timbang_akhir' => ['integer', Rule::in(['0','1','2']),],
            'un5_selesai_pastikan_qty_pas' => ['integer', Rule::in(['0','1','2']),],
            'un5_status' => ['integer', Rule::in(['0','1']),],
            'un5_operator_complete' => ['integer', Rule::in(['0','1','2']),],
            'un5_checker_complete' => ['integer', Rule::in(['0','1','2']),],
            'un5_cancel_load_unload' => ['integer', Rule::in(['0','1','2']),],

            'un5_report_code' => 'string|max:255',
            'un5_batch_no' => 'string|max:255',
            'un5_level_awal' => 'string|max:255',
            'un5_level_akhir' => 'string|max:255',
            'un5_jml_dimuat' => 'string|max:255',
            'un5_persiapan_memakai_ppe_desc' => 'string|max:255',
            'un5_persiapan_cek_hose_piping_desc' => 'string|max:255',
            'un5_persiapan_safety_shower_desc' => 'string|max:255',
            'un5_persiapan_operator_terima_dokumen_desc' => 'string|max:255',
            'un5_persiapan_arahkan_truk_parkir_desc' => 'string|max:255',
            'un5_persiapan_ganjal_roda_desc' => 'string|max:255',
            'un5_persiapan_safety_cone_desc' => 'string|max:255',
            'un5_persiapan_verifikasi_fisik_desc' => 'string|max:255',
            'un5_persiapan_sopir_serahkan_kunci_desc' => 'string|max:255',
            'un5_persiapan_sopir_kenek_leave_unloading_desc' => 'string|max:255',
            'un5_persiapan_isotank_bersih_desc' => 'string|max:255',
            'un5_persiapan_label_segel_terpasang_desc' => 'string|max:255',
            'un5_persiapan_pasang_hose_steam_desc' => 'string|max:255',
            'un5_persiapan_siapkan_botol_sample_desc' => 'string|max:255',
            'un5_persiapan_setelah_pemanasan_14jam_desc' => 'string|max:255',
            'un5_persiapan_ambil_sample_desc' => 'string|max:255',
            'un5_persiapan_ambil_hose_stearic_acid_desc' => 'string|max:255',
            'un5_persiapan_periksa_level_storage_desc' => 'string|max:255',
            'un5_persiapan_konfirmasi_ok_desc' => 'string|max:255',
            'un5_persiapan_buka_segel_desc' => 'string|max:255',
            'un5_persiapan_periksa_hose_tidak_bocor_desc' => 'string|max:255',
            'un5_unloading_bottom_valve_dibuka_penuh_desc' => 'string|max:255',
            'un5_unloading_cek_pipa_coupling_valve_tidak_bocor_desc' => 'string|max:255',
            'un5_unloading_pastikan_unloading_aman_desc' => 'string|max:255',
            'un5_selesai_unloading_selesai_desc' => 'string|max:255',
            'un5_selesai_matikan_pompa_desc' => 'string|max:255',
            'un5_selesai_buka_bottom_valve_storage_desc' => 'string|max:255',
            'un5_selesai_tutup_valve_desc' => 'string|max:255',
            'un5_selesai_pastikan_hose_liquid_kosong_desc' => 'string|max:255',
            'un5_selesai_periksa_valve_ditutup_desc' => 'string|max:255',
            'un5_selesai_panggil_sopir_kembali_desc' => 'string|max:255',
            'un5_selesai_lepas_pengganjal_roda_safetycone_desc' => 'string|max:255',
            'un5_selesai_pastikan_peralatan_tidak_terbawa_truk_desc' => 'string|max:255',
            'un5_selesai_lakukan_timbang_akhir_desc' => 'string|max:255',
            'un5_netto_disuratjalan' => 'string|max:255',
            'un5_netto_hasil_timbang' => 'string|max:255',
            'un5_pemeriksa' => 'string|max:255',
            'un5_signature_employee' => 'string|max:255',
            'un5_signature_checker' => 'string|max:255',
            'un5_delete_reason' => 'string|max:255',
            'un5_reason_cancel_load_unload' => 'string|max:255',
        ]);

        $employee = Auth::user();
        try{
            $formId = $request->input('form_id');
            $gate = FormEGateCheck::findOrFail($request->input('gate_id'));
            if( $formId != null || $formId != 0){
                $isCreate = "Update";

                try{
                    $formUnloadingStearicAcid = $employee->formUnloadingStearicAcid()->findOrFail($formId);


                } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
                    return response()->json([
                        'code' => 404,
                        'message' => 'Given FormUnloadingStearicAcid Form ID not found',
                        'data' => []
                        ], 404);
                }
            } else {
                $isCreate = "Create";

                $formUnloadingStearicAcid = FormUnloadingStearicAcid::create([
                    'un5_employee_id' => $employee->id,
                    'un5_report_kendaraan_id' => $gate->id,
                ]);
            }
            $formUnloadingStearicAcid->update([
                'un5_persiapan_memakai_ppe' => (int) $request->input('un5_persiapan_memakai_ppe'),
                'un5_persiapan_cek_hose_piping' => (int) $request->input('un5_persiapan_cek_hose_piping'),
                'un5_persiapan_safety_shower' => (int) $ewrequest->input('un5_persiapan_safety_shower'),
                'un5_persiapan_operator_terima_dokumen' => (int) $request->input('un5_persiapan_operator_terima_dokumen'),
                'un5_persiapan_arahkan_truk_parkir' => (int) $request->input('un5_persiapan_arahkan_truk_parkir'),
                'un5_persiapan_ganjal_roda' => (int) $request->input('un5_persiapan_ganjal_roda'),
                'un5_persiapan_safety_cone' => (int) $request->input('un5_persiapan_safety_cone'),
                'un5_persiapan_verifikasi_fisik' => (int) $request->input('un5_persiapan_verifikasi_fisik'),
                'un5_persiapan_sopir_serahkan_kunci' => (int) $request->input('un5_persiapan_sopir_serahkan_kunci'),
                'un5_persiapan_sopir_kenek_leave_unloading' => (int) $request->input('un5_persiapan_sopir_kenek_leave_unloading'),
                'un5_persiapan_isotank_bersih' => (int) $request->input('un5_persiapan_isotank_bersih'),
                'un5_persiapan_label_segel_terpasang' => (int) $ewrequest->input('un5_persiapan_label_segel_terpasang'),
                'un5_persiapan_pasang_hose_steam' => (int) $ewrequest->input('un5_persiapan_pasang_hose_steam'),
                'un5_persiapan_siapkan_botol_sample' => (int) $request->input('un5_persiapan_siapkan_botol_sample'),
                'un5_persiapan_check_fullbody_harness_desc' => (int) $request->input('un5_persiapan_check_fullbody_harness_desc'),
                'un5_persiapan_webbing' => (int) $request->input('un5_persiapan_webbing'),
                'un5_persiapan_D_rings' => (int) $request->input('un5_persiapan_D_rings'),
                'un5_persiapan_buckles' => (int) $request->input('un5_persiapan_buckles'),
                'un5_persiapan_carabiner' => (int) $ewrequest->input('un5_persiapan_carabiner'),
                'un5_persiapan_lanyard' => (int) $request->input('un5_persiapan_lanyard'),
                'un5_persiapan_shockabsorber_pack' => (int) $request->input('un5_persiapan_shockabsorber_pack'),
                'un5_persiapan_fall_arrester' => (int) $ewrequest->input('un5_persiapan_fall_arrester'),
                'un5_persiapan_setelah_pemanasan_14jam' => (int) $request->input('un5_persiapan_setelah_pemanasan_14jam'),
                'un5_persiapan_ambil_sample' => (int) $request->input('un5_persiapan_ambil_sample'),
                'un5_persiapan_ambil_hose_stearic_acid' => (int) $request->input('un5_persiapan_ambil_hose_stearic_acid'),
                'un5_persiapan_periksa_level_storage' => (int) $ewrequest->input('un5_persiapan_periksa_level_storage'),
                'un5_persiapan_konfirmasi_ok' => (int) $ewrequest->input('un5_persiapan_konfirmasi_ok'),
                'un5_persiapan_buka_segel' => (int) $request->input('un5_persiapan_buka_segel'),
                'un5_persiapan_periksa_hose_tidak_bocor' => (int) $request->input('un5_persiapan_periksa_hose_tidak_bocor'),
                'un5_unloading_bottom_valve_dibuka_penuh' => (int) $ewrequest->input('un5_unloading_bottom_valve_dibuka_penuh'),
                'un5_unloading_cek_pipa_coupling_valve_tidak_bocor' => (int) $request->input('un5_unloading_cek_pipa_coupling_valve_tidak_bocor'),
                'un5_unloading_pastikan_unloading_aman' => (int) $request->input('un5_unloading_pastikan_unloading_aman'),
                'un5_selesai_unloading_selesai' => (int) $request->input('un5_selesai_unloading_selesai'),
                'un5_selesai_matikan_pompa' => (int) $request->input('un5_selesai_matikan_pompa'),
                'un5_selesai_buka_bottom_valve_storage' => (int) $request->input('un5_selesai_buka_bottom_valve_storage'),
                'un5_selesai_tutup_valve' => (int) $ewrequest->input('un5_selesai_tutup_valve'),
                'un5_selesai_pastikan_hose_liquid_kosong' => (int) $ewrequest->input('un5_selesai_pastikan_hose_liquid_kosong'),
                'un5_selesai_periksa_valve_ditutup' => (int) $request->input('un5_selesai_periksa_valve_ditutup'),
                'un5_selesai_panggil_sopir_kembali' => (int) $request->input('un5_selesai_panggil_sopir_kembali'),
                'un5_selesai_lepas_pengganjal_roda_safetycone' => (int) $request->input('un5_selesai_lepas_pengganjal_roda_safetycone'),
                'un5_selesai_pastikan_peralatan_tidak_terbawa_truk' => (int) $request->input('un5_selesai_pastikan_peralatan_tidak_terbawa_truk'),
                'un5_selesai_lakukan_timbang_akhir' => (int) $request->input('un5_selesai_lakukan_timbang_akhir'),
                'un5_selesai_pastikan_qty_pas' => (int) $request->input('un5_selesai_pastikan_qty_pas'),
                'un5_status' => (int) $request->input('un5_status'),
                'un5_operator_complete' => (int) $request->input('un5_operator_complete'),
                'un5_checker_complete' => (int) $request->input('un5_checker_complete'),
                'un5_cancel_load_unload' => (int) $request->input('un5_cancel_load_unload'),

                'un5_report_code' => $request->input('un5_report_code'),
                'un5_batch_no' => $request->input('un5_batch_no'),
                'un5_level_awal' => $request->input('un5_level_awal'),
                'un5_level_akhir' => $request->input('un5_level_akhir'),
                'un5_jml_dimuat' => $request->input('un5_jml_dimuat'),
                'un5_persiapan_memakai_ppe_desc' => $request->input('un5_persiapan_memakai_ppe_desc'),
                'un5_persiapan_cek_hose_piping_desc' => $request->input('un5_persiapan_cek_hose_piping_desc'),
                'un5_persiapan_safety_shower_desc' => $request->input('un5_persiapan_safety_shower_desc'),
                'un5_persiapan_operator_terima_dokumen_desc' => $request->input('un5_persiapan_operator_terima_dokumen_desc'),
                'un5_persiapan_arahkan_truk_parkir_desc' => $request->input('un5_persiapan_arahkan_truk_parkir_desc'),
                'un5_persiapan_ganjal_roda_desc' => $request->input('un5_persiapan_ganjal_roda_desc'),
                'un5_persiapan_safety_cone_desc' => $request->input('un5_persiapan_safety_cone_desc'),
                'un5_persiapan_verifikasi_fisik_desc' => $request->input('un5_persiapan_verifikasi_fisik_desc'),
                'un5_persiapan_sopir_serahkan_kunci_desc' => $request->input('un5_persiapan_sopir_serahkan_kunci_desc'),
                'un5_persiapan_sopir_kenek_leave_unloading_desc' => $request->input('un5_persiapan_sopir_kenek_leave_unloading_desc'),
                'un5_persiapan_isotank_bersih_desc' => $request->input('un5_persiapan_isotank_bersih_desc'),
                'un5_persiapan_label_segel_terpasang_desc' => $request->input('un5_persiapan_label_segel_terpasang_desc'),
                'un5_persiapan_pasang_hose_steam_desc' => $request->input('un5_persiapan_pasang_hose_steam_desc'),
                'un5_persiapan_siapkan_botol_sample_desc' => $request->input('un5_persiapan_siapkan_botol_sample_desc'),
                'un5_persiapan_setelah_pemanasan_14jam_desc' => $request->input('un5_persiapan_setelah_pemanasan_14jam_desc'),
                'un5_persiapan_ambil_sample_desc' => $request->input('un5_persiapan_ambil_sample_desc'),
                'un5_persiapan_ambil_hose_stearic_acid_desc' => $request->input('un5_persiapan_ambil_hose_stearic_acid_desc'),
                'un5_persiapan_periksa_level_storage_desc' => $request->input('un5_persiapan_periksa_level_storage_desc'),
                'un5_persiapan_konfirmasi_ok_desc' => $request->input('un5_persiapan_konfirmasi_ok_desc'),
                'un5_persiapan_buka_segel_desc' => $request->input('un5_persiapan_buka_segel_desc'),
                'un5_persiapan_periksa_hose_tidak_bocor_desc' => $request->input('un5_persiapan_periksa_hose_tidak_bocor_desc'),
                'un5_unloading_bottom_valve_dibuka_penuh_desc' => $request->input('un5_unloading_bottom_valve_dibuka_penuh_desc'),
                'un5_unloading_cek_pipa_coupling_valve_tidak_bocor_desc' => $request->input('un5_unloading_cek_pipa_coupling_valve_tidak_bocor_desc'),
                'un5_unloading_pastikan_unloading_aman_desc' => $request->input('un5_unloading_pastikan_unloading_aman_desc'),
                'un5_selesai_unloading_selesai_desc' => $request->input('un5_selesai_unloading_selesai_desc'),
                'un5_selesai_matikan_pompa_desc' => $request->input('un5_selesai_matikan_pompa_desc'),
                'un5_selesai_buka_bottom_valve_storage_desc' => $request->input('un5_selesai_buka_bottom_valve_storage_desc'),
                'un5_selesai_tutup_valve_desc' => $request->input('un5_selesai_tutup_valve_desc'),
                'un5_selesai_pastikan_hose_liquid_kosong_desc' => $request->input('un5_selesai_pastikan_hose_liquid_kosong_desc'),
                'un5_selesai_periksa_valve_ditutup_desc' => $request->input('un5_selesai_periksa_valve_ditutup_desc'),
                'un5_selesai_panggil_sopir_kembali_desc' => $request->input('un5_selesai_panggil_sopir_kembali_desc'),
                'un5_selesai_lepas_pengganjal_roda_safetycone_desc' => $request->input('un5_selesai_lepas_pengganjal_roda_safetycone_desc'),
                'un5_selesai_pastikan_peralatan_tidak_terbawa_truk_desc' => $request->input('un5_selesai_pastikan_peralatan_tidak_terbawa_truk_desc'),
                'un5_selesai_lakukan_timbang_akhir_desc' => $request->input('un5_selesai_lakukan_timbang_akhir_desc'),
                'un5_netto_disuratjalan' => $request->input('un5_netto_disuratjalan'),
                'un5_netto_hasil_timbang' => $request->input('un5_netto_hasil_timbang'),
                'un5_pemeriksa' => $request->input('un5_pemeriksa'),
                'un5_signature_employee' => $request->input('un5_signature_employee'),
                'un5_signature_checker' => $request->input('un5_signature_checker'),
                'un5_delete_reason' => $request->input('un5_delete_reason'),
                'un5_reason_cancel_load_unload' => $request->input('un5_reason_cancel_load_unload'),
            ]);
            $gate->update([
                'gateable_id' => $formUnloadingStearicAcid->id,
                'gateable_type' => "App\Model\FormUnloadingStearicAcid"
                ]);
            return response()->json([
                'code' => 200,
                'message' => 'Success Update FormUnloadingStearicAcid Form',
                'data' => [
                    $formUnloadingStearicAcid]
                ], 200);


        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given E Gate Form ID not found',
                'data' => []
                ], 404);
        }
    }

    public function approveFormUnloadingStearicAcid(Request $request){
        $formId = $request->input('form_id');
        try{
            $formUnloadingStearicAcid = $employee->formUnloadingStearicAcid()->findOrFail($formId);
            $formUnloadingStearicAcid->update([
                'un5_status' => 2,
            ]);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given formUnloadingStearicAcid Form ID not found',
                'data' => []
                ], 404);
        }
    }
}
