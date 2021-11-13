<?php

namespace App\Http\Controllers;

use App\Models\FormEGateCheck;
use App\Models\FormUnloadingDieselOil;
use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class FormUnloadingDieselOilController extends Controller
{
    public function viewAll(){
        return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' =>
            FormUnloadingDieselOil::all()
            ], 200);
    }
    public function createOrUpdate(Request $request){
        $this->validate($request, [
            'form_id' => 'integer',
            'gate_id' => 'required|integer',

            'un7_persiapan_memakai_ppe' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_cek_hose_piping' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_safety_shower' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_operator_terima_dokumen' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_arahkan_truk_parkir' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_ganjal_roda' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_safety_cone' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_sopir_serahkan_kunci' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_sopir_kenek_leave_unloading' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_isotank_bersih' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_label_segel_terpasang' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_kenakan_ppe_tambahan' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_pasang_penampung_tetesan' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_bukasegel_ambil_sampel' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_kirim_sample' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_periksa_level_storage' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_check_fullbody_harness_desc' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_webbing' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_D_rings' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_buckles' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_carabiner' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_lanyard' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_shockabsorber_pack' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_fall_arrester' => ['integer', Rule::in(['0','1','2']),],
            'un7_persiapan_petugas_naik_body_isotank' => ['integer', Rule::in(['0','1','2']),],
            'un7_unloading_bottom_valve_dibuka_penuh' => ['integer', Rule::in(['0','1','2']),],
            'un7_unloading_hidupkan_mesinDCS' => ['integer', Rule::in(['0','1','2']),],
            'un7_unloading_cek_pipa_coupling_valve_tidak_bocor' => ['integer', Rule::in(['0','1','2']),],
            'un7_unloading_pastikan_unloading_aman' => ['integer', Rule::in(['0','1','2']),],
            'un7_unloading_periksa_pompa' => ['integer', Rule::in(['0','1','2']),],
            'un7_selesai_unloading_selesai' => ['integer', Rule::in(['0','1','2']),],
            'un7_selesai_matikan_pompa' => ['integer', Rule::in(['0','1','2']),],
            'un7_selesai_tutup_valve' => ['integer', Rule::in(['0','1','2']),],
            'un7_selesai_petugas_naik_tutup_venting_system' => ['integer', Rule::in(['0','1','2']),],
            'un7_selesai_pastikan_wadah_penampung_masih_ada' => ['integer', Rule::in(['0','1','2']),],
            'un7_selesai_tutup_hose_dg_caphose' => ['integer', Rule::in(['0','1','2']),],
            'un7_selesai_simpan_coupling_dg_aman' => ['integer', Rule::in(['0','1','2']),],
            'un7_selesai_periksa_valve_ditutup' => ['integer', Rule::in(['0','1','2']),],
            'un7_selesai_panggil_sopir_kembali' => ['integer', Rule::in(['0','1','2']),],
            'un7_selesai_lepas_pengganjal_roda_safetycone' => ['integer', Rule::in(['0','1','2']),],
            'un7_selesai_pastikan_peralatan_tidak_terbawa_truk' => ['integer', Rule::in(['0','1','2']),],
            'un7_selesai_lakukan_timbang_akhir' => ['integer', Rule::in(['0','1','2']),],
            'un7_selesai_tandatangan_serahterima' => ['integer', Rule::in(['0','1','2']),],
            'un7_status' => ['integer', Rule::in(['0','1']),],
            'un7_operator_complete' => ['integer', Rule::in(['0','1','2']),],
            'un7_checker_complete' => ['integer', Rule::in(['0','1','2']),],
            'un7_cancel_load_unload' => ['integer', Rule::in(['0','1','2']),],

            'un7_report_code' => 'string|max:255',
            'un7_batch_no' => 'string|max:255',
            'un7_no_storage1' => 'string|max:255',
            'un7_level_awal1' => 'string|max:255',
            'un7_level_akhir1' => 'string|max:255',
            'un7_no_storage2' => 'string|max:255',
            'un7_level_awal2' => 'string|max:255',
            'un7_level_akhir2' => 'string|max:255',
            'un7_jml_dimuat' => 'string|max:255',
            'un7_persiapan_memakai_ppe_desc' => 'string|max:255',
            'un7_persiapan_cek_hose_piping_desc' => 'string|max:255',
            'un7_persiapan_safety_shower_desc' => 'string|max:255',
            'un7_persiapan_operator_terima_dokumen_desc' => 'string|max:255',
            'un7_persiapan_arahkan_truk_parkir_desc' => 'string|max:255',
            'un7_persiapan_ganjal_roda_desc' => 'string|max:255',
            'un7_persiapan_safety_cone_desc' => 'string|max:255',
            'un7_persiapan_sopir_serahkan_kunci_desc' => 'string|max:255',
            'un7_persiapan_sopir_kenek_leave_unloading_desc' => 'string|max:255',
            'un7_persiapan_isotank_bersih_desc' => 'string|max:255',
            'un7_persiapan_label_segel_terpasang_desc' => 'string|max:255',
            'un7_persiapan_kenakan_ppe_tambahan_desc' => 'string|max:255',
            'un7_persiapan_pasang_penampung_tetesan_desc' => 'string|max:255',
            'un7_persiapan_bukasegel_ambil_sampel_dec' => 'string|max:255',
            'un7_persiapan_kirim_sample_desc' => 'string|max:255',
            'un7_persiapan_18a_level_awal_kg' => 'string|max:255',
            'un7_persiapan_18a_level_awal_persen' => 'string|max:255',
            'un7_persiapan_18a_level_max_kg' => 'string|max:255',
            'un7_persiapan_18a_level_max_persen' => 'string|max:255',
            'un7_persiapan_18a_dapat_diisi_kg' => 'string|max:255',
            'un7_persiapan_18a_dapat_diisi_persen' => 'string|max:255',
            'un7_persiapan_18b_level_awal_kg' => 'string|max:255',
            'un7_persiapan_18b_level_awal_persen' => 'string|max:255',
            'un7_persiapan_18b_level_max_kg' => 'string|max:255',
            'un7_persiapan_18b_level_max_persen' => 'string|max:255',
            'un7_persiapan_18b_dapat_diisi_kg' => 'string|max:255',
            'un7_persiapan_18b_dapat_diisi_persen' => 'string|max:255',
            'un7_persiapan_petugas_naik_body_isotank_desc' => 'string|max:255',
            'un7_unloading_bottom_valve_dibuka_penuh_desc' => 'string|max:255',
            'un7_unloading_hidupkan_mesinDCS_desc' => 'string|max:255',
            'un7_unloading_cek_pipa_coupling_valve_tidak_bocor_desc' => 'string|max:255',
            'un7_unloading_pastikan_unloading_aman_desc' => 'string|max:255',
            'un7_unloading_periksa_pompa_desc' => 'string|max:255',
            'un7_selesai_unloading_selesai_desc' => 'string|max:255',
            'un7_selesai_matikan_pompa_dec' => 'string|max:255',
            'un7_selesai_tutup_valve_desc' => 'string|max:255',
            'un7_selesai_petugas_naik_tutup_venting_system_desc' => 'string|max:255',
            'un7_selesai_pastikan_wadah_penampung_masih_ada_desc' => 'string|max:255',
            'un7_selesai_tutup_hose_dg_caphose_desc' => 'string|max:255',
            'un7_selesai_simpan_coupling_dg_aman_desc' => 'string|max:255',
            'un7_selesai_periksa_valve_ditutup_desc' => 'string|max:255',
            'un7_selesai_panggil_sopir_kembali_desc' => 'string|max:255',
            'un7_selesai_lepas_pengganjal_roda_safetycone_desc' => 'string|max:255',
            'un7_selesai_pastikan_peralatan_tidak_terbawa_truk_desc' => 'string|max:255',
            'un7_selesai_lakukan_timbang_akhir_desc' => 'string|max:255',
            'un7_netto_disuratjalan' => 'string|max:255',
            'un7_netto_hasil_timbang' => 'string|max:255',
            'un7_pemeriksa' => 'string|max:255',
            // 'un7_signature_employee' => 'file',
            // 'un7_signature_checker' => 'file',
            'un7_delete_reason' => 'string|max:255',
            'un7_reason_cancel_load_unload' => 'string|max:255',

        ]);

        $employee = Auth::user();
        try{
            $formId = $request->input('form_id');
            $gate = FormEGateCheck::findOrFail($request->input('gate_id'));
            if( $formId != null || $formId != 0){
                $isCreate = "Update";

                try{
                    $formUnloadingDieselOil = $employee->formUnloadingDieselOil()->findOrFail($formId);

                    if($gate->gateable_id != $formId && $gate->gateable_type != 'App\Models\FormUnloadingDieselOil'){
                        return
                        // 'Failed';
                        response()->json([
                            'code' => 451,
                            'message' => 'Given E Gate Form Already Have A Gateable and Can\'t be changed',
                            'data' => []
                            ], 451);
                    }

                } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
                    return response()->json([
                        'code' => 404,
                        'message' => 'Given FormUnloadingDieselOil Form ID not found',
                        'data' => []
                        ], 404);
                }
            } else {
                $isCreate = "Create";

                if($gate->gateable_id != null && $gate->gateable_type != null){
                    return
                    // 'Failed';
                    response()->json([
                        'code' => 451,
                        'message' => 'Given E Gate Form Already Have A Gateable and Can\'t be changed',
                        'data' => []
                        ], 451);
                }

                $formUnloadingDieselOil = FormUnloadingDieselOil::create([
                    'un7_employee_id' => $employee->id,
                    'un7_report_kendaraan_id' => $gate->id,
                ]);

                $gate->update([
                    'gateable_id' => $formUnloadingDieselOil->id,
                    'gateable_type' => "App\Models\FormUnloadingDieselOil"
                    ]);
            }
            $formUnloadingDieselOil->update([
                'un7_persiapan_memakai_ppe' => (int) $request->input('un7_persiapan_memakai_ppe'),
                'un7_persiapan_cek_hose_piping' => (int) $request->input('un7_persiapan_cek_hose_piping'),
                'un7_persiapan_safety_shower' => (int) $request->input('un7_persiapan_safety_shower'),
                'un7_persiapan_operator_terima_dokumen' => (int) $request->input('un7_persiapan_operator_terima_dokumen'),
                'un7_persiapan_arahkan_truk_parkir' => (int) $request->input('un7_persiapan_arahkan_truk_parkir'),
                'un7_persiapan_ganjal_roda' => (int) $request->input('un7_persiapan_ganjal_roda'),
                'un7_persiapan_safety_cone' => (int) $request->input('un7_persiapan_safety_cone'),
                'un7_persiapan_sopir_serahkan_kunci' => (int) $request->input('un7_persiapan_sopir_serahkan_kunci'),
                'un7_persiapan_sopir_kenek_leave_unloading' => (int) $request->input('un7_persiapan_sopir_kenek_leave_unloading'),
                'un7_persiapan_isotank_bersih' => (int) $request->input('un7_persiapan_isotank_bersih'),
                'un7_persiapan_label_segel_terpasang' => (int) $request->input('un7_persiapan_label_segel_terpasang'),
                'un7_persiapan_kenakan_ppe_tambahan' => (int) $request->input('un7_persiapan_kenakan_ppe_tambahan'),
                'un7_persiapan_pasang_penampung_tetesan' => (int) $request->input('un7_persiapan_pasang_penampung_tetesan'),
                'un7_persiapan_bukasegel_ambil_sampel' => (int) $request->input('un7_persiapan_bukasegel_ambil_sampel'),
                'un7_persiapan_kirim_sample' => (int) $request->input('un7_persiapan_kirim_sample'),
                'un7_persiapan_periksa_level_storage' => (int) $request->input('un7_persiapan_periksa_level_storage'),
                'un7_persiapan_check_fullbody_harness_desc' => (int) $request->input('un7_persiapan_check_fullbody_harness_desc'),
                'un7_persiapan_webbing' => (int) $request->input('un7_persiapan_webbing'),
                'un7_persiapan_D_rings' => (int) $request->input('un7_persiapan_D_rings'),
                'un7_persiapan_buckles' => (int) $request->input('un7_persiapan_buckles'),
                'un7_persiapan_carabiner' => (int) $request->input('un7_persiapan_carabiner'),
                'un7_persiapan_lanyard' => (int) $request->input('un7_persiapan_lanyard'),
                'un7_persiapan_shockabsorber_pack' => (int) $request->input('un7_persiapan_shockabsorber_pack'),
                'un7_persiapan_fall_arrester' => (int) $request->input('un7_persiapan_fall_arrester'),
                'un7_persiapan_petugas_naik_body_isotank' => (int) $request->input('un7_persiapan_petugas_naik_body_isotank'),
                'un7_unloading_bottom_valve_dibuka_penuh' => (int) $request->input('un7_unloading_bottom_valve_dibuka_penuh'),
                'un7_unloading_hidupkan_mesinDCS' => (int) $request->input('un7_unloading_hidupkan_mesinDCS'),
                'un7_unloading_cek_pipa_coupling_valve_tidak_bocor' => (int) $request->input('un7_unloading_cek_pipa_coupling_valve_tidak_bocor'),
                'un7_unloading_pastikan_unloading_aman' => (int) $request->input('un7_unloading_pastikan_unloading_aman'),
                'un7_unloading_periksa_pompa' => (int) $request->input('un7_unloading_periksa_pompa'),
                'un7_selesai_unloading_selesai' => (int) $request->input('un7_selesai_unloading_selesai'),
                'un7_selesai_matikan_pompa' => (int) $request->input('un7_selesai_matikan_pompa'),
                'un7_selesai_tutup_valve' => (int) $request->input('un7_selesai_tutup_valve'),
                'un7_selesai_petugas_naik_tutup_venting_system' => (int) $request->input('un7_selesai_petugas_naik_tutup_venting_system'),
                'un7_selesai_pastikan_wadah_penampung_masih_ada' => (int) $request->input('un7_selesai_pastikan_wadah_penampung_masih_ada'),
                'un7_selesai_tutup_hose_dg_caphose' => (int) $request->input('un7_selesai_tutup_hose_dg_caphose'),
                'un7_selesai_simpan_coupling_dg_aman' => (int) $request->input('un7_selesai_simpan_coupling_dg_aman'),
                'un7_selesai_periksa_valve_ditutup' => (int) $request->input('un7_selesai_periksa_valve_ditutup'),
                'un7_selesai_panggil_sopir_kembali' => (int) $request->input('un7_selesai_panggil_sopir_kembali'),
                'un7_selesai_lepas_pengganjal_roda_safetycone' => (int) $request->input('un7_selesai_lepas_pengganjal_roda_safetycone'),
                'un7_selesai_pastikan_peralatan_tidak_terbawa_truk' => (int) $request->input('un7_selesai_pastikan_peralatan_tidak_terbawa_truk'),
                'un7_selesai_lakukan_timbang_akhir' => (int) $request->input('un7_selesai_lakukan_timbang_akhir'),
                'un7_selesai_tandatangan_serahterima' => (int) $request->input('un7_selesai_tandatangan_serahterima'),
                'un7_status' => (int) $request->input('un7_status'),
                'un7_operator_complete' => (int) $request->input('un7_operator_complete'),
                'un7_checker_complete' => (int) $request->input('un7_checker_complete'),
                'un7_cancel_load_unload' => (int) $request->input('un7_cancel_load_unload'),

                'un7_report_code' => $request->input('un7_report_code'),
                'un7_batch_no' => $request->input('un7_batch_no'),
                'un7_no_storage1' => $request->input('un7_no_storage1'),
                'un7_level_awal1' => $request->input('un7_level_awal1'),
                'un7_level_akhir1' => $request->input('un7_level_akhir1'),
                'un7_no_storage2' => $request->input('un7_no_storage2'),
                'un7_level_awal2' => $request->input('un7_level_awal2'),
                'un7_level_akhir2' => $request->input('un7_level_akhir2'),
                'un7_jml_dimuat' => $request->input('un7_jml_dimuat'),
                'un7_persiapan_memakai_ppe_desc' => $request->input('un7_persiapan_memakai_ppe_desc'),
                'un7_persiapan_cek_hose_piping_desc' => $request->input('un7_persiapan_cek_hose_piping_desc'),
                'un7_persiapan_safety_shower_desc' => $request->input('un7_persiapan_safety_shower_desc'),
                'un7_persiapan_operator_terima_dokumen_desc' => $request->input('un7_persiapan_operator_terima_dokumen_desc'),
                'un7_persiapan_arahkan_truk_parkir_desc' => $request->input('un7_persiapan_arahkan_truk_parkir_desc'),
                'un7_persiapan_ganjal_roda_desc' => $request->input('un7_persiapan_ganjal_roda_desc'),
                'un7_persiapan_safety_cone_desc' => $request->input('un7_persiapan_safety_cone_desc'),
                'un7_persiapan_sopir_serahkan_kunci_desc' => $request->input('un7_persiapan_sopir_serahkan_kunci_desc'),
                'un7_persiapan_sopir_kenek_leave_unloading_desc' => $request->input('un7_persiapan_sopir_kenek_leave_unloading_desc'),
                'un7_persiapan_isotank_bersih_desc' => $request->input('un7_persiapan_isotank_bersih_desc'),
                'un7_persiapan_label_segel_terpasang_desc' => $request->input('un7_persiapan_label_segel_terpasang_desc'),
                'un7_persiapan_kenakan_ppe_tambahan_desc' => $request->input('un7_persiapan_kenakan_ppe_tambahan_desc'),
                'un7_persiapan_pasang_penampung_tetesan_desc' => $request->input('un7_persiapan_pasang_penampung_tetesan_desc'),
                'un7_persiapan_bukasegel_ambil_sampel_dec' => $request->input('un7_persiapan_bukasegel_ambil_sampel_dec'),
                'un7_persiapan_kirim_sample_desc' => $request->input('un7_persiapan_kirim_sample_desc'),
                'un7_persiapan_18a_level_awal_kg' => $request->input('un7_persiapan_18a_level_awal_kg'),
                'un7_persiapan_18a_level_awal_persen' => $request->input('un7_persiapan_18a_level_awal_persen'),
                'un7_persiapan_18a_level_max_kg' => $request->input('un7_persiapan_18a_level_max_kg'),
                'un7_persiapan_18a_level_max_persen' => $request->input('un7_persiapan_18a_level_max_persen'),
                'un7_persiapan_18a_dapat_diisi_kg' => $request->input('un7_persiapan_18a_dapat_diisi_kg'),
                'un7_persiapan_18a_dapat_diisi_persen' => $request->input('un7_persiapan_18a_dapat_diisi_persen'),
                'un7_persiapan_18b_level_awal_kg' => $request->input('un7_persiapan_18b_level_awal_kg'),
                'un7_persiapan_18b_level_awal_persen' => $request->input('un7_persiapan_18b_level_awal_persen'),
                'un7_persiapan_18b_level_max_kg' => $request->input('un7_persiapan_18b_level_max_kg'),
                'un7_persiapan_18b_level_max_persen' => $request->input('un7_persiapan_18b_level_max_persen'),
                'un7_persiapan_18b_dapat_diisi_kg' => $request->input('un7_persiapan_18b_dapat_diisi_kg'),
                'un7_persiapan_18b_dapat_diisi_persen' => $request->input('un7_persiapan_18b_dapat_diisi_persen'),
                'un7_persiapan_petugas_naik_body_isotank_desc' => $request->input('un7_persiapan_petugas_naik_body_isotank_desc'),
                'un7_unloading_bottom_valve_dibuka_penuh_desc' => $request->input('un7_unloading_bottom_valve_dibuka_penuh_desc'),
                'un7_unloading_hidupkan_mesinDCS_desc' => $request->input('un7_unloading_hidupkan_mesinDCS_desc'),
                'un7_unloading_cek_pipa_coupling_valve_tidak_bocor_desc' => $request->input('un7_unloading_cek_pipa_coupling_valve_tidak_bocor_desc'),
                'un7_unloading_pastikan_unloading_aman_desc' => $request->input('un7_unloading_pastikan_unloading_aman_desc'),
                'un7_unloading_periksa_pompa_desc' => $request->input('un7_unloading_periksa_pompa_desc'),
                'un7_selesai_unloading_selesai_desc' => $request->input('un7_selesai_unloading_selesai_desc'),
                'un7_selesai_matikan_pompa_dec' => $request->input('un7_selesai_matikan_pompa_dec'),
                'un7_selesai_tutup_valve_desc' => $request->input('un7_selesai_tutup_valve_desc'),
                'un7_selesai_petugas_naik_tutup_venting_system_desc' => $request->input('un7_selesai_petugas_naik_tutup_venting_system_desc'),
                'un7_selesai_pastikan_wadah_penampung_masih_ada_desc' => $request->input('un7_selesai_pastikan_wadah_penampung_masih_ada_desc'),
                'un7_selesai_tutup_hose_dg_caphose_desc' => $request->input('un7_selesai_tutup_hose_dg_caphose_desc'),
                'un7_selesai_simpan_coupling_dg_aman_desc' => $request->input('un7_selesai_simpan_coupling_dg_aman_desc'),
                'un7_selesai_periksa_valve_ditutup_desc' => $request->input('un7_selesai_periksa_valve_ditutup_desc'),
                'un7_selesai_panggil_sopir_kembali_desc' => $request->input('un7_selesai_panggil_sopir_kembali_desc'),
                'un7_selesai_lepas_pengganjal_roda_safetycone_desc' => $request->input('un7_selesai_lepas_pengganjal_roda_safetycone_desc'),
                'un7_selesai_pastikan_peralatan_tidak_terbawa_truk_desc' => $request->input('un7_selesai_pastikan_peralatan_tidak_terbawa_truk_desc'),
                'un7_selesai_lakukan_timbang_akhir_desc' => $request->input('un7_selesai_lakukan_timbang_akhir_desc'),
                'un7_netto_disuratjalan' => $request->input('un7_netto_disuratjalan'),
                'un7_netto_hasil_timbang' => $request->input('un7_netto_hasil_timbang'),
                'un7_pemeriksa' => $request->input('un7_pemeriksa'),
                // 'un7_signature_employee' => $request->input('un7_signature_employee'),
                // 'un7_signature_checker' => $request->input('un7_signature_checker'),
                'un7_delete_reason' => $request->input('un7_delete_reason'),
                'un7_reason_cancel_load_unload' => $request->input('un7_reason_cancel_load_unload'),
            ]);


                if($request->input('un7_signature_checker')){
                    $decodedDocs = base64_decode($request->input('un7_signature_checker'));


                    $name = time()."_un7_signature_checker.png";
                    file_put_contents('uploads/unloading/signatures/'.$name, $decodedDocs);


                    $formUnloadingDieselOil->update(
                        [
                            'un7_signature_checker' => $name,
                            ]
                        );

                }
                if($request->input('un7_signature_employee')){
                    $decodedDocs = base64_decode($request->input('un7_signature_employee'));


                    $name = time()."_un7_signature_employee.png";
                    file_put_contents('uploads/unloading/signatures/'.$name, $decodedDocs);


                    $formUnloadingDieselOil->update(
                        [
                            'un7_signature_employee' => $name,
                            ]
                        );

                }
            return response()->json([
                'code' => 200,
                'message' => 'Success '.$isCreate.' FormUnloadingDieselOil Form',
                'data' => [
                    $formUnloadingDieselOil]
                ], 200);


        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given E Gate Form ID not found',
                'data' => []
                ], 404);
        }
    }

    public function approve(Request $request){
        $formId = $request->input('form_id');
        try{
            $formUnloadingDieselOil = $employee->formUnloadingDieselOil()->findOrFail($formId);
            $formUnloadingDieselOil->update([
                'un7_status' => 2,
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Success Approve FormUnloadingDieselOil Form',
                'data' => [
                    $formUnloadingDieselOil]
                ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given formUnloadingDieselOil Form ID not found',
                'data' => []
                ], 404);
        }
    }

    public function getOne($formId){

        $employee = Auth::user();

        try{
            $formUnloadingDieselOil = $employee->formUnloadingDieselOil()->findOrFail($formId);

            return response()->json([
                'code' => 200,
                'message' => 'Success Fetch FormUnloadingDieselOil Form',
                'data' => [
                    $formUnloadingDieselOil]
                ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given FormUnloadingDieselOil Form ID not found',
                'data' => []
                ], 404);
        }
    }
}
