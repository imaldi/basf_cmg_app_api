<?php

namespace App\Http\Controllers;

use App\Models\FormEGateCheck;
use App\Models\FormUnloadingCitricAcid;
use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class FormUnloadingCitricAcidController extends Controller
{
    public function viewAllFormUnloadingCitricAcid(){
        return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' =>
            [FormUnloadingCitricAcid::all()]
            ], 200);
    }
    public function createOrUpdateFormUnloadingCitricAcid(Request $request){
        $this->validate($request, [
            'form_id' => 'integer',
            'gate_id' => 'required|integer',


            'un9_persiapan_memakai_ppe' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_cek_hose_piping' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_safety_shower' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_operator_terima_dokumen' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_arahkan_truk_parkir' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_ganjal_roda' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_safety_cone' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_verifikasi_fisik' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_sopir_serahkan_kunci' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_sopir_kenek_leave_unloading' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_isotank_bersih' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_label_segel_terpasang' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_kenakan_ppe_tambahan' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_pasang_wadah_penampung' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_buka_segel_bottom_valve' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_kirim_sample' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_periksa_level_storage' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_check_fullbody_harness_desc' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_webbing' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_D_rings' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_buckles' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_carabiner' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_lanyard' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_shockabsorber_pack' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_fall_arrester' => ['integer', Rule::in(['0','1','2']),],
            'un9_persiapan_petugas_naik_ke_isotank' => ['integer', Rule::in(['0','1','2']),],
            'un9_unloading_bottom_valve_dibuka' => ['integer', Rule::in(['0','1','2']),],
            'un9_unloading_hidupkan_dcs' => ['integer', Rule::in(['0','1','2']),],
            'un9_unloading_cek_pipa_coupling_valve_tidak_bocor' => ['integer', Rule::in(['0','1','2']),],
            'un9_unloading_pastikan_unloading_aman' => ['integer', Rule::in(['0','1','2']),],
            'un9_unloading_periksa_pompa' => ['integer', Rule::in(['0','1','2']),],
            'un9_selesai_unloading_selesai' => ['integer', Rule::in(['0','1','2']),],
            'un9_selesai_matikan_pompa' => ['integer', Rule::in(['0','1','2']),],
            'un9_selesai_tutup_valve' => ['integer', Rule::in(['0','1','2']),],
            'un9_selesai_tutup_venting_system' => ['integer', Rule::in(['0','1','2']),],
            'un9_selesai_pastikan_wadah_penampung_masih_ada' => ['integer', Rule::in(['0','1','2']),],
            'un9_selesai_tutup_hose' => ['integer', Rule::in(['0','1','2']),],
            'un9_selesai_simpan_coupling' => ['integer', Rule::in(['0','1','2']),],
            'un9_selesai_pastikan_valve_tertutup' => ['integer', Rule::in(['0','1','2']),],
            'un9_selesai_lepas_pengganjal_ban' => ['integer', Rule::in(['0','1','2']),],
            'un9_selesai_panggil_sopir_kembali' => ['integer', Rule::in(['0','1','2']),],
            'un9_selesai_pastikan_peralatan_tidak_terbawa_truk' => ['integer', Rule::in(['0','1','2']),],
            'un9_selesai_lakukan_timbang_akhir' => ['integer', Rule::in(['0','1','2']),],
            'un9_selesai_pastikan_qty_pas' => ['integer', Rule::in(['0','1','2']),],
            'un9_selesai_tandatangan_serahterima' => ['integer', Rule::in(['0','1','2']),],
            'un9_status' => ['integer', Rule::in(['0','1']),],
            'un9_operator_complete' => ['integer', Rule::in(['0','1','2']),],
            'un9_checker_complete' => ['integer', Rule::in(['0','1','2']),],
            'un9_cancel_load_unload' => ['integer', Rule::in(['0','1','2']),],

            'un9_report_code' => 'string|max:255',
            'un9_batch_no' => 'string|max:255',
            'un9_no_storage' => 'string|max:255',
            'un9_level_awal' => 'string|max:255',
            'un9_level_akhir' => 'string|max:255',
            'un9_jml_dimuat' => 'string|max:255',
            'un9_persiapan_memakai_ppe_desc' => 'string|max:255',
            'un9_persiapan_cek_hose_piping_desc' => 'string|max:255',
            'un9_persiapan_safety_shower_desc' => 'string|max:255',
            'un9_persiapan_operator_terima_dokumen_desc' => 'string|max:255',
            'un9_persiapan_arahkan_truk_parkir_desc' => 'string|max:255',
            'un9_persiapan_ganjal_roda_desc' => 'string|max:255',
            'un9_persiapan_safety_cone_desc' => 'string|max:255',
            'un9_persiapan_verifikasi_fisik_desc' => 'string|max:255',
            'un9_persiapan_sopir_serahkan_kunci_desc' => 'string|max:255',
            'un9_persiapan_sopir_kenek_leave_unloading_desc' => 'string|max:255',
            'un9_persiapan_isotank_bersih_desc' => 'string|max:255',
            'un9_persiapan_label_segel_terpasang_desc' => 'string|max:255',
            'un9_persiapan_kenakan_ppe_tambahan_desc' => 'string|max:255',
            'un9_persiapan_pasang_wadah_penampung_dec' => 'string|max:255',
            'un9_persiapan_buka_segel_bottom_valve_desc' => 'string|max:255',
            'un9_persiapan_kirim_sample_desc' => 'string|max:255',
            'un9_persiapan_periksa_level_storage_desc' => 'string|max:255',
            'un9_persiapan_18a_level_awal_kg' => 'string|max:255',
            'un9_persiapan_18a_level_awal_persen' => 'string|max:255',
            'un9_persiapan_18a_level_max_kg' => 'string|max:255',
            'un9_persiapan_18a_level_max_persen' => 'string|max:255',
            'un9_persiapan_18a_dapat_diisi_kg' => 'string|max:255',
            'un9_persiapan_18a_dapat_diisi_persen' => 'string|max:255',
            'un9_persiapan_petugas_naik_ke_isotank_desc' => 'string|max:255',
            'un9_unloading_bottom_valve_dibuka_desc' => 'string|max:255',
            'un9_unloading_hidupkan_dcs_desc' => 'string|max:255',
            'un9_unloading_cek_pipa_coupling_valve_tidak_bocor_desc' => 'string|max:255',
            'un9_unloading_pastikan_unloading_aman_desc' => 'string|max:255',
            'un9_unloading_periksa_pompa_desc' => 'string|max:255',
            'un9_selesai_unloading_selesai_desc' => 'string|max:255',
            'un9_selesai_matikan_pompa_dec' => 'string|max:255',
            'un9_selesai_tutup_valve_desc' => 'string|max:255',
            'un9_selesai_tutup_venting_system_desc' => 'string|max:255',
            'un9_selesai_pastikan_wadah_penampung_masih_ada_desc' => 'string|max:255',
            'un9_selesai_tutup_hose_desc' => 'string|max:255',
            'un9_selesai_simpan_coupling_desc' => 'string|max:255',
            'un9_selesai_pastikan_valve_tertutup_desc' => 'string|max:255',
            'un9_selesai_lepas_pengganjal_ban_desc' => 'string|max:255',
            'un9_selesai_panggil_sopir_kembali_desc' => 'string|max:255',
            'un9_selesai_pastikan_peralatan_tidak_terbawa_truk_desc' => 'string|max:255',
            'un9_selesai_lakukan_timbang_akhir_desc' => 'string|max:255',
            'un9_netto_disuratjalan' => 'string|max:255',
            'un9_netto_hasil_timbang' => 'string|max:255',
            'un9_pemeriksa' => 'string|max:255',
            'un9_signature_employee' => 'string|max:255',
            'un9_signature_checker' => 'string|max:255',
            'un9_delete_reason' => 'string|max:255',
            'un9_reason_cancel_load_unload' => 'string|max:255',
        ]);

        $employee = Auth::user();
        try{
            $formId = $request->input('form_id');
            $gate = FormEGateCheck::findOrFail($request->input('gate_id'));
            if( $formId != null || $formId != 0){
                $isCreate = "Update";

                try{
                    $formUnloadingCitricAcid = $employee->formUnloadingCitricAcid()->findOrFail($formId);


                } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
                    return response()->json([
                        'code' => 404,
                        'message' => 'Given FormUnloadingCitricAcid Form ID not found',
                        'data' => []
                        ], 404);
                }
            } else {
                $isCreate = "Create";

                $formUnloadingCitricAcid = FormUnloadingCitricAcid::create([
                    'un9_employee_id' => $employee->id,
                    'un9_report_kendaraan_id' => $gate->id,
                ]);
            }
            $formUnloadingCitricAcid->update([
                'un9_persiapan_memakai_ppe' => (int) $request->input('un9_persiapan_memakai_ppe'),
                'un9_persiapan_cek_hose_piping' => (int) $request->input('un9_persiapan_cek_hose_piping'),
                'un9_persiapan_safety_shower' => (int) $request->input('un9_persiapan_safety_shower'),
                'un9_persiapan_operator_terima_dokumen' => (int) $request->input('un9_persiapan_operator_terima_dokumen'),
                'un9_persiapan_arahkan_truk_parkir' => (int) $request->input('un9_persiapan_arahkan_truk_parkir'),
                'un9_persiapan_ganjal_roda' => (int) $request->input('un9_persiapan_ganjal_roda'),
                'un9_persiapan_safety_cone' => (int) $request->input('un9_persiapan_safety_cone'),
                'un9_persiapan_verifikasi_fisik' => (int) $request->input('un9_persiapan_verifikasi_fisik'),
                'un9_persiapan_sopir_serahkan_kunci' => (int) $request->input('un9_persiapan_sopir_serahkan_kunci'),
                'un9_persiapan_sopir_kenek_leave_unloading' => (int) $request->input('un9_persiapan_sopir_kenek_leave_unloading'),
                'un9_persiapan_isotank_bersih' => (int) $request->input('un9_persiapan_isotank_bersih'),
                'un9_persiapan_label_segel_terpasang' => (int) $request->input('un9_persiapan_label_segel_terpasang'),
                'un9_persiapan_kenakan_ppe_tambahan' => (int) $request->input('un9_persiapan_kenakan_ppe_tambahan'),
                'un9_persiapan_pasang_wadah_penampung' => (int) $request->input('un9_persiapan_pasang_wadah_penampung'),
                'un9_persiapan_buka_segel_bottom_valve' => (int) $request->input('un9_persiapan_buka_segel_bottom_valve'),
                'un9_persiapan_kirim_sample' => (int) $request->input('un9_persiapan_kirim_sample'),
                'un9_persiapan_periksa_level_storage' => (int) $request->input('un9_persiapan_periksa_level_storage'),
                'un9_persiapan_check_fullbody_harness_desc' => (int) $request->input('un9_persiapan_check_fullbody_harness_desc'),
                'un9_persiapan_webbing' => (int) $request->input('un9_persiapan_webbing'),
                'un9_persiapan_D_rings' => (int) $request->input('un9_persiapan_D_rings'),
                'un9_persiapan_buckles' => (int) $request->input('un9_persiapan_buckles'),
                'un9_persiapan_carabiner' => (int) $request->input('un9_persiapan_carabiner'),
                'un9_persiapan_lanyard' => (int) $request->input('un9_persiapan_lanyard'),
                'un9_persiapan_shockabsorber_pack' => (int) $request->input('un9_persiapan_shockabsorber_pack'),
                'un9_persiapan_fall_arrester' => (int) $request->input('un9_persiapan_fall_arrester'),
                'un9_persiapan_petugas_naik_ke_isotank' => (int) $request->input('un9_persiapan_petugas_naik_ke_isotank'),
                'un9_unloading_bottom_valve_dibuka' => (int) $request->input('un9_unloading_bottom_valve_dibuka'),
                'un9_unloading_hidupkan_dcs' => (int) $request->input('un9_unloading_hidupkan_dcs'),
                'un9_unloading_cek_pipa_coupling_valve_tidak_bocor' => (int) $request->input('un9_unloading_cek_pipa_coupling_valve_tidak_bocor'),
                'un9_unloading_pastikan_unloading_aman' => (int) $request->input('un9_unloading_pastikan_unloading_aman'),
                'un9_unloading_periksa_pompa' => (int) $request->input('un9_unloading_periksa_pompa'),
                'un9_selesai_unloading_selesai' => (int) $request->input('un9_selesai_unloading_selesai'),
                'un9_selesai_matikan_pompa' => (int) $request->input('un9_selesai_matikan_pompa'),
                'un9_selesai_tutup_valve' => (int) $request->input('un9_selesai_tutup_valve'),
                'un9_selesai_tutup_venting_system' => (int) $request->input('un9_selesai_tutup_venting_system'),
                'un9_selesai_pastikan_wadah_penampung_masih_ada' => (int) $request->input('un9_selesai_pastikan_wadah_penampung_masih_ada'),
                'un9_selesai_tutup_hose' => (int) $request->input('un9_selesai_tutup_hose'),
                'un9_selesai_simpan_coupling' => (int) $request->input('un9_selesai_simpan_coupling'),
                'un9_selesai_pastikan_valve_tertutup' => (int) $request->input('un9_selesai_pastikan_valve_tertutup'),
                'un9_selesai_lepas_pengganjal_ban' => (int) $request->input('un9_selesai_lepas_pengganjal_ban'),
                'un9_selesai_panggil_sopir_kembali' => (int) $request->input('un9_selesai_panggil_sopir_kembali'),
                'un9_selesai_pastikan_peralatan_tidak_terbawa_truk' => (int) $request->input('un9_selesai_pastikan_peralatan_tidak_terbawa_truk'),
                'un9_selesai_lakukan_timbang_akhir' => (int) $request->input('un9_selesai_lakukan_timbang_akhir'),
                'un9_selesai_pastikan_qty_pas' => (int) $request->input('un9_selesai_pastikan_qty_pas'),
                'un9_selesai_tandatangan_serahterima' => (int) $request->input('un9_selesai_tandatangan_serahterima'),
                'un9_status' => (int) $request->input('un9_status'),
                'un9_operator_complete' => (int) $request->input('un9_operator_complete'),
                'un9_checker_complete' => (int) $request->input('un9_checker_complete'),
                'un9_cancel_load_unload' => (int) $request->input('un9_cancel_load_unload'),

                'un9_report_code' => $request->input('un9_report_code'),
                'un9_batch_no' => $request->input('un9_batch_no'),
                'un9_no_storage' => $request->input('un9_no_storage'),
                'un9_level_awal' => $request->input('un9_level_awal'),
                'un9_level_akhir' => $request->input('un9_level_akhir'),
                'un9_jml_dimuat' => $request->input('un9_jml_dimuat'),
                'un9_persiapan_memakai_ppe_desc' => $request->input('un9_persiapan_memakai_ppe_desc'),
                'un9_persiapan_cek_hose_piping_desc' => $request->input('un9_persiapan_cek_hose_piping_desc'),
                'un9_persiapan_safety_shower_desc' => $request->input('un9_persiapan_safety_shower_desc'),
                'un9_persiapan_operator_terima_dokumen_desc' => $request->input('un9_persiapan_operator_terima_dokumen_desc'),
                'un9_persiapan_arahkan_truk_parkir_desc' => $request->input('un9_persiapan_arahkan_truk_parkir_desc'),
                'un9_persiapan_ganjal_roda_desc' => $request->input('un9_persiapan_ganjal_roda_desc'),
                'un9_persiapan_safety_cone_desc' => $request->input('un9_persiapan_safety_cone_desc'),
                'un9_persiapan_verifikasi_fisik_desc' => $request->input('un9_persiapan_verifikasi_fisik_desc'),
                'un9_persiapan_sopir_serahkan_kunci_desc' => $request->input('un9_persiapan_sopir_serahkan_kunci_desc'),
                'un9_persiapan_sopir_kenek_leave_unloading_desc' => $request->input('un9_persiapan_sopir_kenek_leave_unloading_desc'),
                'un9_persiapan_isotank_bersih_desc' => $request->input('un9_persiapan_isotank_bersih_desc'),
                'un9_persiapan_label_segel_terpasang_desc' => $request->input('un9_persiapan_label_segel_terpasang_desc'),
                'un9_persiapan_kenakan_ppe_tambahan_desc' => $request->input('un9_persiapan_kenakan_ppe_tambahan_desc'),
                'un9_persiapan_pasang_wadah_penampung_dec' => $request->input('un9_persiapan_pasang_wadah_penampung_dec'),
                'un9_persiapan_buka_segel_bottom_valve_desc' => $request->input('un9_persiapan_buka_segel_bottom_valve_desc'),
                'un9_persiapan_kirim_sample_desc' => $request->input('un9_persiapan_kirim_sample_desc'),
                'un9_persiapan_periksa_level_storage_desc' => $request->input('un9_persiapan_periksa_level_storage_desc'),
                'un9_persiapan_18a_level_awal_kg' => $request->input('un9_persiapan_18a_level_awal_kg'),
                'un9_persiapan_18a_level_awal_persen' => $request->input('un9_persiapan_18a_level_awal_persen'),
                'un9_persiapan_18a_level_max_kg' => $request->input('un9_persiapan_18a_level_max_kg'),
                'un9_persiapan_18a_level_max_persen' => $request->input('un9_persiapan_18a_level_max_persen'),
                'un9_persiapan_18a_dapat_diisi_kg' => $request->input('un9_persiapan_18a_dapat_diisi_kg'),
                'un9_persiapan_18a_dapat_diisi_persen' => $request->input('un9_persiapan_18a_dapat_diisi_persen'),
                'un9_persiapan_petugas_naik_ke_isotank_desc' => $request->input('un9_persiapan_petugas_naik_ke_isotank_desc'),
                'un9_unloading_bottom_valve_dibuka_desc' => $request->input('un9_unloading_bottom_valve_dibuka_desc'),
                'un9_unloading_hidupkan_dcs_desc' => $request->input('un9_unloading_hidupkan_dcs_desc'),
                'un9_unloading_cek_pipa_coupling_valve_tidak_bocor_desc' => $request->input('un9_unloading_cek_pipa_coupling_valve_tidak_bocor_desc'),
                'un9_unloading_pastikan_unloading_aman_desc' => $request->input('un9_unloading_pastikan_unloading_aman_desc'),
                'un9_unloading_periksa_pompa_desc' => $request->input('un9_unloading_periksa_pompa_desc'),
                'un9_selesai_unloading_selesai_desc' => $request->input('un9_selesai_unloading_selesai_desc'),
                'un9_selesai_matikan_pompa_dec' => $request->input('un9_selesai_matikan_pompa_dec'),
                'un9_selesai_tutup_valve_desc' => $request->input('un9_selesai_tutup_valve_desc'),
                'un9_selesai_tutup_venting_system_desc' => $request->input('un9_selesai_tutup_venting_system_desc'),
                'un9_selesai_pastikan_wadah_penampung_masih_ada_desc' => $request->input('un9_selesai_pastikan_wadah_penampung_masih_ada_desc'),
                'un9_selesai_tutup_hose_desc' => $request->input('un9_selesai_tutup_hose_desc'),
                'un9_selesai_simpan_coupling_desc' => $request->input('un9_selesai_simpan_coupling_desc'),
                'un9_selesai_pastikan_valve_tertutup_desc' => $request->input('un9_selesai_pastikan_valve_tertutup_desc'),
                'un9_selesai_lepas_pengganjal_ban_desc' => $request->input('un9_selesai_lepas_pengganjal_ban_desc'),
                'un9_selesai_panggil_sopir_kembali_desc' => $request->input('un9_selesai_panggil_sopir_kembali_desc'),
                'un9_selesai_pastikan_peralatan_tidak_terbawa_truk_desc' => $request->input('un9_selesai_pastikan_peralatan_tidak_terbawa_truk_desc'),
                'un9_selesai_lakukan_timbang_akhir_desc' => $request->input('un9_selesai_lakukan_timbang_akhir_desc'),
                'un9_netto_disuratjalan' => $request->input('un9_netto_disuratjalan'),
                'un9_netto_hasil_timbang' => $request->input('un9_netto_hasil_timbang'),
                'un9_pemeriksa' => $request->input('un9_pemeriksa'),
                'un9_signature_employee' => $request->input('un9_signature_employee'),
                'un9_signature_checker' => $request->input('un9_signature_checker'),
                'un9_delete_reason' => $request->input('un9_delete_reason'),
                'un9_reason_cancel_load_unload' => $request->input('un9_reason_cancel_load_unload'),
            ]);
            $gate->update([
                'gateable_id' => $formUnloadingCitricAcid->id,
                'gateable_type' => "App\Model\FormUnloadingCitricAcid"
                ]);
            return response()->json([
                'code' => 200,
                'message' => 'Success '.$isCreate.' FormUnloadingCitricAcid Form',
                'data' => [
                    $formUnloadingCitricAcid]
                ], 200);


        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given E Gate Form ID not found',
                'data' => []
                ], 404);
        }
    }

    public function approveFormUnloadingCitricAcid(Request $request){
        $formId = $request->input('form_id');
        try{
            $formUnloadingCitricAcid = $employee->formUnloadingCitricAcid()->findOrFail($formId);
            $formUnloadingCitricAcid->update([
                'un9_status' => 2,
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Success Approve FormUnloadingCitricAcid Form',
                'data' => [
                    $formUnloadingCitricAcid]
                ], 200);


        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given formUnloadingCitricAcid Form ID not found',
                'data' => []
                ], 404);
        }
    }
}
