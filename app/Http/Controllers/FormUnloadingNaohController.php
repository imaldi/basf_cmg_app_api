<?php

namespace App\Http\Controllers;

use App\Models\FormEGateCheck;
use App\Models\FormUnloadingNaoh;
use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class FormUnloadingNaohController extends Controller
{
    public function viewAll(){
        return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' =>
            FormUnloadingNaoh::all()
            ], 200);
    }
    public function createOrUpdate(Request $request){
        $this->validate($request, [
            // 'form_id' => 'integer',
            'gate_id' => 'required|integer',

            'un4_persiapan_memakai_ppe' => ['integer', Rule::in(['0','1','2']),],
            'un4_persiapan_cek_hose_piping' => ['integer', Rule::in(['0','1','2']),],
            'un4_persiapan_safety_shower' => ['integer', Rule::in(['0','1','2']),],
            'un4_persiapan_operator_terima_dokumen' => ['integer', Rule::in(['0','1','2']),],
            'un4_persiapan_arahkan_truk_parkir' => ['integer', Rule::in(['0','1','2']),],
            'un4_persiapan_ganjal_roda' => ['integer', Rule::in(['0','1','2']),],
            'un4_persiapan_safety_cone' => ['integer', Rule::in(['0','1','2']),],
            'un4_persiapan_sopir_serahkan_kunci' => ['integer', Rule::in(['0','1','2']),],
            'un4_persiapan_sopir_kenek_leave_unloading' => ['integer', Rule::in(['0','1','2']),],
            'un4_persiapan_isotank_bersih' => ['integer', Rule::in(['0','1','2']),],
            'un4_persiapan_label_segel_terpasang' => ['integer', Rule::in(['0','1','2']),],
            'un4_persiapan_pasang_penampung_tetesan' => ['integer', Rule::in(['0','1','2']),],
            'un4_persiapan_kenakan_ppe_tambahan' => ['integer', Rule::in(['0','1','2']),],

            'un4_persiapan_kirim_sample' => ['integer', Rule::in(['0','1','2']),],
            'un4_persiapan_webbing' => ['integer', Rule::in(['0','1','2']),],
            'un4_persiapan_d_ring' => ['integer', Rule::in(['0','1','2']),],
            'un4_persiapan_buckles' => ['integer', Rule::in(['0','1','2']),],
            'un4_persiapan_carabiner' => ['integer', Rule::in(['0','1','2']),],
            'un4_persiapan_lanyard' => ['integer', Rule::in(['0','1','2']),],
            'un4_persiapan_shockabsorber_pack' => ['integer', Rule::in(['0','1','2']),],
            'un4_persiapan_fall_arrester' => ['integer', Rule::in(['0','1','2']),],
            'un4_persiapan_petugas_naik_body_isotank' => ['integer', Rule::in(['0','1','2']),],
            'un4_unloading_buttom_valve_dibuka_penuh' => ['integer', Rule::in(['0','1','2']),],
            'un4_unloading_hidupkan_mesinDCS' => ['integer', Rule::in(['0','1','2']),],
            'un4_unloading_cek_pipa_coupling_valve_tidak_bocor' => ['integer', Rule::in(['0','1','2']),],
            'un4_unloading_pastikan_unloading_aman' => ['integer', Rule::in(['0','1','2']),],
            'un4_unloading_periksa_pompa' => ['integer', Rule::in(['0','1','2']),],
            'un4_selesai_unloading_selesai' => ['integer', Rule::in(['0','1','2']),],
            'un4_selesai_matikan_pompa' => ['integer', Rule::in(['0','1','2']),],
            'un4_selesai_tutup_valve' => ['integer', Rule::in(['0','1','2']),],
            'un4_selesai_pastikan_hose_liquid_kosong' => ['integer', Rule::in(['0','1','2']),],
            'un4_selesai_tutup_hose_dg_caphose' => ['integer', Rule::in(['0','1','2']),],
            'un4_selesai_simpan_coupling_dg_aman' => ['integer', Rule::in(['0','1','2']),],
            'un4_selesai_tutup_venting_system' => ['integer', Rule::in(['0','1','2']),],
            'un4_selesai_periksa_valve_ditutup' => ['integer', Rule::in(['0','1','2']),],
            'un4_selesai_panggil_sopir_kembali' => ['integer', Rule::in(['0','1','2']),],
            'un4_selesai_lepas_pengganjal_roda_safetycone' => ['integer', Rule::in(['0','1','2']),],
            'un4_selesai_pastikan_peralatan_tidak_terbawa_truk' => ['integer', Rule::in(['0','1','2']),],
            'un4_selesai_lakukan_timbang_akhir' => ['integer', Rule::in(['0','1','2']),],
            'un4_selesai_pastikan_qty_pas' => ['integer', Rule::in(['0','1','2']),],
            'un4_selesai_tandatangan_serahterima' => ['integer', Rule::in(['0','1','2']),],
            'un4_status' => ['integer', Rule::in(['0','1','2']),],
            'un4_operator_complete' => ['integer', Rule::in(['0','1','2']),],
            'un4_checker_complete' => ['integer', Rule::in(['0','1']),],
            'un4_cancel_load_unload' => ['integer', Rule::in(['0','1','2']),],
            'un4_persiapan_bukasegel_ambil_sampel' => ['integer', Rule::in(['0','1','2']),],
            'un4_report_code' => 'string|max:255',
            'un4_batch_no' => 'string|max:255',
            'un4_no_storage1' => 'string|max:255',
            'un4_level_awal1' => 'string|max:255',
            'un4_level_akhir1' => 'string|max:255',
            'un4_no_storage2' => 'string|max:255',
            'un4_level_awal2' => 'string|max:255',
            'un4_level_akhir2' => 'string|max:255',
            'un4_jml_dimuat' => 'string|max:255',
            "un4_netto_disuratjalan" => 'string|max:255',
            "un4_netto_hasil_timbang" => 'string|max:255',
            'un4_persiapan_bukasegel_ambil_sampel_desc' => 'string|max:255',
            'un4_persiapan_memakai_ppe_desc' => 'string|max:255',
            'un4_persiapan_cek_hose_piping_desc' => 'string|max:255',
            'un4_persiapan_safety_shower_desc' => 'string|max:255',
            'un4_persiapan_operator_terima_dokumen_desc' => 'string|max:255',
            'un4_persiapan_arahkan_truk_parkir_desc' => 'string|max:255',
            'un4_persiapan_ganjal_roda_desc' => 'string|max:255',
            'un4_persiapan_safety_cone_desc' => 'string|max:255',
            'un4_persiapan_sopir_serahkan_kunci_desc' => 'string|max:255',
            'un4_persiapan_sopir_kenek_leave_unloading_desc' => 'string|max:255',
            'un4_persiapan_isotank_bersih_desc' => 'string|max:255',
            'un4_persiapan_label_segel_terpasang_desc' => 'string|max:255',
            'un4_persiapan_pasang_penampung_tetesan_desc' => 'string|max:255',
            'un4_persiapan_kenakan_ppe_tambahan_desc' => 'string|max:255',
            'un4_persiapan_18a_level_awal_kg' => 'string|max:255',
            'un4_persiapan_18a_level_awal_persen' => 'string|max:255',
            'un4_persiapan_18a_level_max_kg' => 'string|max:255',
            'un4_persiapan_18a_level_max_persen' => 'string|max:255',
            'un4_persiapan_18a_level_diisi_kg' => 'string|max:255',
            'un4_persiapan_18a_level_diisi_persen' => 'string|max:255',
            'un4_persiapan_18b_level_awal_kg' => 'string|max:255',
            'un4_persiapan_18b_level_awal_persen' => 'string|max:255',
            'un4_persiapan_18b_level_max_kg' => 'string|max:255',
            'un4_persiapan_18b_level_max_persen' => 'string|max:255',
            'un4_persiapan_18b_level_diisi_kg' => 'string|max:255',
            'un4_persiapan_18b_level_diisi_persen' => 'string|max:255',
            'un4_persiapan_check_fullbody_harness_desc' => 'string|max:255',
            'un4_persiapan_petugas_naik_body_isotank_desc' => 'string|max:255',
            'un4_unloading_buttom_valve_dibuka_penuh_desc' => 'string|max:255',
            'un4_unloading_hidupkan_mesinDCS_desc' => 'string|max:255',
            'un4_unloading_cek_pipa_coupling_valve_tidak_bocor_desc' => 'string|max:255',
            'un4_unloading_pastikan_unloading_aman_desc' => 'string|max:255',
            'un4_unloading_periksa_pompa_desc' => 'string|max:255',
            'un4_selesai_unloading_selesai_desc' => 'string|max:255',
            'un4_selesai_matikan_pompa_desc' => 'string|max:255',
            'un4_selesai_tutup_valve_desc' => 'string|max:255',
            'un4_selesai_pastikan_hose_liquid_kosong_desc' => 'string|max:255',
            'un4_selesai_tutup_hose_dg_caphose_desc' => 'string|max:255',
            'un4_selesai_simpan_coupling_dg_aman_desc' => 'string|max:255',
            'un4_selesai_tutup_venting_system_desc' => 'string|max:255',
            'un4_selesai_periksa_valve_ditutup_desc' => 'string|max:255',
            'un4_selesai_panggil_sopir_kembali_desc' => 'string|max:255',
            'un4_selesai_lepas_pengganjal_roda_safetycone_desc' => 'string|max:255',
            'un4_selesai_pastikan_peralatan_tidak_terbawa_truk_desc' => 'string|max:255',
            'un4_selesai_lakukan_timbang_akhir_desc' => 'string|max:255',
            'un4_pemeriksa' => 'string|max:255',
            'un4_reason_cancel_load_unload' => 'string|max:255',
        ]);

        $employee = Auth::user();
        try{
            $formId = (int) $request->input('form_id');
            $gate = FormEGateCheck::findOrFail($request->input('gate_id'));
            if( $formId != null || $formId != 0){
                $isCreate = "Update";

                try{
                    $formUnloadingNaoh = $employee->formUnloadingNaoh()->findOrFail($formId);

                    if($gate->gateable_id != $formId && $gate->gateable_type != 'App\Models\FormUnloadingNaoh'){
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
                        'message' => 'Given FormUnloadingNaoh Form ID not found',
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

                $formUnloadingNaoh = FormUnloadingNaoh::create([
                    'un4_employee_id' => $employee->id,
                    'un4_report_kendaraan_id' => $gate->id,
                ]);

                $gate->update([
                    'gateable_id' => $formUnloadingNaoh->id,
                    'gateable_type' => "App\Models\FormUnloadingNaoh"
                    ]);
            }
            $formUnloadingNaoh->update([
                'un4_persiapan_memakai_ppe' => (int) $request->input('un4_persiapan_memakai_ppe'),
                'un4_persiapan_cek_hose_piping' => (int) $request->input('un4_persiapan_cek_hose_piping'),
                'un4_persiapan_safety_shower' => (int) $request->input('un4_persiapan_safety_shower'),
                'un4_persiapan_operator_terima_dokumen' => (int) $request->input('un4_persiapan_operator_terima_dokumen'),
                'un4_persiapan_arahkan_truk_parkir' => (int) $request->input('un4_persiapan_arahkan_truk_parkir'),
                'un4_persiapan_ganjal_roda' => (int) $request->input('un4_persiapan_ganjal_roda'),
                'un4_persiapan_safety_cone' => (int) $request->input('un4_persiapan_safety_cone'),
                'un4_persiapan_sopir_serahkan_kunci' => (int) $request->input('un4_persiapan_sopir_serahkan_kunci'),
                'un4_persiapan_sopir_kenek_leave_unloading' => (int) $request->input('un4_persiapan_sopir_kenek_leave_unloading'),
                'un4_persiapan_isotank_bersih' => (int) $request->input('un4_persiapan_isotank_bersih'),
                'un4_persiapan_label_segel_terpasang' => (int) $request->input('un4_persiapan_label_segel_terpasang'),
                'un4_persiapan_pasang_penampung_tetesan' => (int) $request->input('un4_persiapan_pasang_penampung_tetesan'),
                'un4_persiapan_kenakan_ppe_tambahan' => (int) $request->input('un4_persiapan_kenakan_ppe_tambahan'),
                'un4_persiapan_bukasegel_ambil_sampel_desc' => $request->input('un4_persiapan_bukasegel_ambil_sampel_desc'),
                'un4_persiapan_kirim_sample' => (int) $request->input('un4_persiapan_kirim_sample'),
                'un4_persiapan_webbing' => (int) $request->input('un4_persiapan_webbing'),
                'un4_persiapan_d_ring' => (int) $request->input('un4_persiapan_d_ring'),
                'un4_persiapan_buckles' => (int) $request->input('un4_persiapan_buckles'),
                'un4_persiapan_carabiner' => (int) $request->input('un4_persiapan_carabiner'),
                'un4_persiapan_lanyard' => (int) $request->input('un4_persiapan_lanyard'),
                'un4_persiapan_shockabsorber_pack' => (int) $request->input('un4_persiapan_shockabsorber_pack'),
                'un4_persiapan_fall_arrester' => (int) $request->input('un4_persiapan_fall_arrester'),
                'un4_persiapan_petugas_naik_body_isotank' => (int) $request->input('un4_persiapan_petugas_naik_body_isotank'),
                'un4_unloading_buttom_valve_dibuka_penuh' => (int) $request->input('un4_unloading_buttom_valve_dibuka_penuh'),
                'un4_unloading_hidupkan_mesinDCS' => (int) $request->input('un4_unloading_hidupkan_mesinDCS'),
                'un4_unloading_cek_pipa_coupling_valve_tidak_bocor' => (int) $request->input('un4_unloading_cek_pipa_coupling_valve_tidak_bocor'),
                'un4_unloading_pastikan_unloading_aman' => (int) $request->input('un4_unloading_pastikan_unloading_aman'),
                'un4_unloading_periksa_pompa' => (int) $request->input('un4_unloading_periksa_pompa'),
                'un4_selesai_unloading_selesai' => (int) $request->input('un4_selesai_unloading_selesai'),
                'un4_selesai_matikan_pompa' => (int) $request->input('un4_selesai_matikan_pompa'),
                'un4_selesai_tutup_valve' => (int) $request->input('un4_selesai_tutup_valve'),
                'un4_selesai_pastikan_hose_liquid_kosong' => (int) $request->input('un4_selesai_pastikan_hose_liquid_kosong'),
                'un4_selesai_tutup_hose_dg_caphose' => (int) $request->input('un4_selesai_tutup_hose_dg_caphose'),
                'un4_selesai_simpan_coupling_dg_aman' => (int) $request->input('un4_selesai_simpan_coupling_dg_aman'),
                'un4_selesai_tutup_venting_system' => (int) $request->input('un4_selesai_tutup_venting_system'),
                'un4_selesai_periksa_valve_ditutup' => (int) $request->input('un4_selesai_periksa_valve_ditutup'),
                'un4_selesai_panggil_sopir_kembali' => (int) $request->input('un4_selesai_panggil_sopir_kembali'),
                'un4_selesai_lepas_pengganjal_roda_safetycone' => (int) $request->input('un4_selesai_lepas_pengganjal_roda_safetycone'),
                'un4_selesai_pastikan_peralatan_tidak_terbawa_truk' => (int) $request->input('un4_selesai_pastikan_peralatan_tidak_terbawa_truk'),
                'un4_selesai_lakukan_timbang_akhir' => (int) $request->input('un4_selesai_lakukan_timbang_akhir'),
                'un4_selesai_pastikan_qty_pas' => (int) $request->input('un4_selesai_pastikan_qty_pas'),
                'un4_selesai_tandatangan_serahterima' => (int) $request->input('un4_selesai_tandatangan_serahterima'),
                'un4_status' => (int) $request->input('un4_status'),
                'un4_operator_complete' => (int) $request->input('un4_operator_complete'),
                'un4_checker_complete' => (int) $request->input('un4_checker_complete'),
                'un4_cancel_load_unload' => (int) $request->input('un4_cancel_load_unload'),

                'un4_report_code' => $request->input('un4_report_code'),
                'un4_batch_no' => $request->input('un4_batch_no'),
                'un4_level_awal1' => $request->input('un4_level_awal1'),
                'un4_level_akhir1' => $request->input('un4_level_akhir1'),
                'un4_no_storage2' => $request->input('un4_no_storage2'),
                'un4_level_awal2' => $request->input('un4_level_awal2'),
                'un4_level_akhir2' => $request->input('un4_level_akhir2'),
                'un4_jml_dimuat' => $request->input('un4_jml_dimuat'),
                'un4_pemeriksa' => $request->input('un4_pemeriksa'),
                'un4_reason_cancel_load_unload' => $request->input('un4_reason_cancel_load_unload'),
                "un4_netto_disuratjalan" => $request->input('"un4_netto_disuratjalan"'),
                "un4_netto_hasil_timbang" => $request->input('"un4_netto_hasil_timbang"'),
                'un4_persiapan_memakai_ppe_desc' => $request->input('un4_persiapan_memakai_ppe_desc'),
                'un4_persiapan_cek_hose_piping_desc' => $request->input('un4_persiapan_cek_hose_piping_desc'),
                'un4_persiapan_safety_shower_desc' => $request->input('un4_persiapan_safety_shower_desc'),
                'un4_persiapan_operator_terima_dokumen_desc' => $request->input('un4_persiapan_operator_terima_dokumen_desc'),
                'un4_persiapan_arahkan_truk_parkir_desc' => $request->input('un4_persiapan_arahkan_truk_parkir_desc'),
                'un4_persiapan_ganjal_roda_desc' => $request->input('un4_persiapan_ganjal_roda_desc'),
                'un4_persiapan_safety_cone_desc' => $request->input('un4_persiapan_safety_cone_desc'),
                'un4_persiapan_sopir_serahkan_kunci_desc' => $request->input('un4_persiapan_sopir_serahkan_kunci_desc'),
                'un4_persiapan_sopir_kenek_leave_unloading_desc' => $request->input('un4_persiapan_sopir_kenek_leave_unloading_desc'),
                'un4_persiapan_isotank_bersih_desc' => $request->input('un4_persiapan_isotank_bersih_desc'),
                'un4_persiapan_label_segel_terpasang_desc' => $request->input('un4_persiapan_label_segel_terpasang_desc'),
                'un4_persiapan_pasang_penampung_tetesan_desc' => $request->input('un4_persiapan_pasang_penampung_tetesan_desc'),
                'un4_persiapan_kenakan_ppe_tambahan_desc' => $request->input('un4_persiapan_kenakan_ppe_tambahan_desc'),
                'un4_persiapan_bukasegel_ambil_sampel' => (int) $request->input('un4_persiapan_bukasegel_ambil_sampel'),
                'un4_persiapan_18a_level_awal_kg' => $request->input('un4_persiapan_18a_level_awal_kg'),
                'un4_persiapan_18a_level_awal_persen' => $request->input('un4_persiapan_18a_level_awal_persen'),
                'un4_persiapan_18a_level_max_kg' => $request->input('un4_persiapan_18a_level_max_kg'),
                'un4_persiapan_18a_level_max_persen' => $request->input('un4_persiapan_18a_level_max_persen'),
                'un4_persiapan_18a_level_diisi_kg' => $request->input('un4_persiapan_18a_level_diisi_kg'),
                'un4_persiapan_18a_level_diisi_persen' => $request->input('un4_persiapan_18a_level_diisi_persen'),
                'un4_persiapan_18b_level_awal_kg' => $request->input('un4_persiapan_18b_level_awal_kg'),
                'un4_persiapan_18b_level_awal_persen' => $request->input('un4_persiapan_18b_level_awal_persen'),
                'un4_persiapan_18b_level_max_kg' => $request->input('un4_persiapan_18b_level_max_kg'),
                'un4_persiapan_18b_level_max_persen' => $request->input('un4_persiapan_18b_level_max_persen'),
                'un4_persiapan_18b_level_diisi_kg' => $request->input('un4_persiapan_18b_level_diisi_kg'),
                'un4_persiapan_18b_level_diisi_persen' => $request->input('un4_persiapan_18b_level_diisi_persen'),
                'un4_persiapan_check_fullbody_harness_desc' => $request->input('un4_persiapan_check_fullbody_harness_desc'),
                'un4_persiapan_petugas_naik_body_isotank_desc' => $request->input('un4_persiapan_petugas_naik_body_isotank_desc'),
                'un4_unloading_buttom_valve_dibuka_penuh_desc' => $request->input('un4_unloading_buttom_valve_dibuka_penuh_desc'),
                'un4_unloading_hidupkan_mesinDCS_desc' => $request->input('un4_unloading_hidupkan_mesinDCS_desc'),
                'un4_unloading_cek_pipa_coupling_valve_tidak_bocor_desc' => $request->input('un4_unloading_cek_pipa_coupling_valve_tidak_bocor_desc'),
                'un4_unloading_pastikan_unloading_aman_desc' => $request->input('un4_unloading_pastikan_unloading_aman_desc'),
                'un4_unloading_periksa_pompa_desc' => $request->input('un4_unloading_periksa_pompa_desc'),
                'un4_selesai_unloading_selesai_desc' => $request->input('un4_selesai_unloading_selesai_desc'),
                'un4_selesai_matikan_pompa_desc' => $request->input('un4_selesai_matikan_pompa_desc'),
                'un4_selesai_tutup_valve_desc' => $request->input('un4_selesai_tutup_valve_desc'),
                'un4_selesai_pastikan_hose_liquid_kosong_desc' => $request->input('un4_selesai_pastikan_hose_liquid_kosong_desc'),
                'un4_selesai_tutup_hose_dg_caphose_desc' => $request->input('un4_selesai_tutup_hose_dg_caphose_desc'),
                'un4_selesai_simpan_coupling_dg_aman_desc' => $request->input('un4_selesai_simpan_coupling_dg_aman_desc'),
                'un4_selesai_tutup_venting_system_desc' => $request->input('un4_selesai_tutup_venting_system_desc'),
                'un4_selesai_periksa_valve_ditutup_desc' => $request->input('un4_selesai_periksa_valve_ditutup_desc'),
                'un4_selesai_panggil_sopir_kembali_desc' => $request->input('un4_selesai_panggil_sopir_kembali_desc'),
                'un4_selesai_lepas_pengganjal_roda_safetycone_desc' => $request->input('un4_selesai_lepas_pengganjal_roda_safetycone_desc'),
                'un4_selesai_pastikan_peralatan_tidak_terbawa_truk_desc' => $request->input('un4_selesai_pastikan_peralatan_tidak_terbawa_truk_desc'),
                'un4_selesai_lakukan_timbang_akhir_desc' => $request->input('un4_selesai_lakukan_timbang_akhir_desc'),
            ]);

            if($request->input('un4_signature_checker')){
                $decodedDocs = base64_decode($request->input('un4_signature_checker'));


                $name = time()."_un4_signature_checker.png";
                file_put_contents('uploads/unloading/signatures/'.$name, $decodedDocs);


                $formUnloadingPac->update(
                    [
                        'un4_signature_checker' => $name,
                        ]
                    );

            }
            if($request->input('un4_signature_employee')){
                $decodedDocs = base64_decode($request->input('un4_signature_employee'));


                $name = time()."_un4_signature_employee.png";
                file_put_contents('uploads/unloading/signatures/'.$name, $decodedDocs);


                $formUnloadingPac->update(
                    [
                        'un4_signature_employee' => $name,
                        ]
                    );

            }

            return response()->json([
                'code' => 200,
                'message' => 'Success '.$isCreate.' FormUnloadingNaoh Form',
                'data' => [
                    $formUnloadingNaoh]
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
        $formId = (int) $request->input('form_id');
        $employee = Auth::user();

        try{
            $formUnloadingNaoh = $employee->formUnloadingNaoh()->findOrFail($formId);
            $formUnloadingNaoh->update([
                'un4_status' => 2,
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Success Approve FormUnloadingNaoh Form',
                'data' => [
                    $formUnloadingNaoh]
                ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given formUnloadingNaoh Form ID not found',
                'data' => []
                ], 404);
        }
    }

    public function getOne($formId){

        $employee = Auth::user();

        try{
            $formUnloadingNaoh = $employee->formUnloadingNaoh()->findOrFail($formId);

            return response()->json([
                'code' => 200,
                'message' => 'Success Fetch FormUnloadingNaoh Form',
                'data' => [
                    $formUnloadingNaoh]
                ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given FormUnloadingNaoh Form ID not found',
                'data' => []
                ], 404);
        }
    }
}
