<?php

namespace App\Http\Controllers;

use App\Models\FormEGateCheck;
use App\Models\FormUnloadingFa1eo;
use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class FormUnloadingFa1eoController extends Controller
{
    public function viewAll(){
        return response()->json([
            'code' => 200,
            'message' => 'Success Fetch All Data',
            'data' =>
            FormUnloadingFa1eo::all()
            ], 200);
    }
    public function createOrUpdate(Request $request){
        $this->validate($request, [
            'form_id' => 'integer',
            'gate_id' => 'required|integer',

            'un2_persiapan_memakai_ppe' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_cek_hose_piping' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_safety_shower' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_operator_terima_dokumen' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_arahkan_truk_parkir' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_ganjal_roda' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_safety_cone' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_verifikasi_fisik' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_sopir_serahkan_kunci' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_sopir_kenek_leave_unloading' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_isotank_bersih' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_label_segel_terpasang' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_kenakan_ppe_tambahan' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_pasang_penampung_tetesan' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_ls3_coupling_switch_ke_storage' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_bukasegel_ambil_sampel' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_kirim_sample' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_periksa_level_storage' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_webbing' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_d_rings' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_buckles' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_carabiner' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_lanyard' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_shockabsorber_pack' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_fall_arrester' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_petugas_baik_body_isotank' => ['integer', Rule::in(['0','1','2']),],
            'un2_persiapan_petugas_baik_body_isotank_desc' => ['integer', Rule::in(['0','1','2']),],
            'un2_unloading_bottom_valve_dibuka_penuh' => ['integer', Rule::in(['0','1','2']),],
            'un2_unloading_hidupkan_mesinDCS' => ['integer', Rule::in(['0','1','2']),],
            'un2_unloading_cek_pipa_coupling_valve_tidak_bocor' => ['integer', Rule::in(['0','1','2']),],
            'un2_unloading_pastikan_unloading_aman' => ['integer', Rule::in(['0','1','2']),],
            'un2_unloading_periksa_pompa' => ['integer', Rule::in(['0','1','2']),],
            'un2_selesai_unloading_selesai' => ['integer', Rule::in(['0','1','2']),],
            'un2_selesai_matikan_pompa' => ['integer', Rule::in(['0','1','2']),],
            'un2_selesai_tutup_valve' => ['integer', Rule::in(['0','1','2']),],
            'un2_selesai_petugas_naik_tutup_venting_system' => ['integer', Rule::in(['0','1','2']),],
            'un2_selesai_pastikan_wadah_penampung_masih_ada' => ['integer', Rule::in(['0','1','2']),],
            'un2_selesai_tutup_hose_dg_caphose' => ['integer', Rule::in(['0','1','2']),],
            'un2_selesai_simpan_coupling_dg_aman' => ['integer', Rule::in(['0','1','2']),],
            'un2_selesai_periksa_valve_ditutup' => ['integer', Rule::in(['0','1','2']),],
            'un2_selesai_panggil_sopir_kembali' => ['integer', Rule::in(['0','1','2']),],
            'un2_selesai_lepas_pengganjal_roda_safetycone' => ['integer', Rule::in(['0','1','2']),],
            'un2_selesai_pastikan_peralatan_tidak_terbawa_truk' => ['integer', Rule::in(['0','1','2']),],
            'un2_selesai_lakukan_timbang_akhir' => ['integer', Rule::in(['0','1','2']),],
            'un2_selesai_pastikan_qty_pas' => ['integer', Rule::in(['0','1','2']),],
            'un2_selesai_tandatangan_serahterima' => ['integer', Rule::in(['0','1','2']),],
            'un2_status' => ['integer', Rule::in(['0','1']),],
            'un2_operator_complete' => ['integer', Rule::in(['0','1','2']),],
            'un2_checker_complete' => ['integer', Rule::in(['0','1','2']),],
            'un2_cancel_load_unload' => ['integer', Rule::in(['0','1','2']),],

            'un2_report_code' => 'string|max:255',
            'un2_nama_produk' => 'string|max:255',
            'un2_batch_no' => 'string|max:255',
            'un2_no_storage1' => 'string|max:255',
            'un2_level_awal1' => 'string|max:255',
            'un2_level_akhir1' => 'string|max:255',
            'un2_no_storage2' => 'string|max:255',
            'un2_level_awal2' => 'string|max:255',
            'un2_level_akhir2' => 'string|max:255',
            'un2_jml_dimuat' => 'string|max:255',
            'un2_persiapan_memakai_ppe_desc' => 'string|max:255',
            'un2_persiapan_cek_hose_piping_desc' => 'string|max:255',
            'un2_persiapan_safety_shower_desc' => 'string|max:255',
            'un2_persiapan_operator_terima_dokumen_desc' => 'string|max:255',
            'un2_persiapan_arahkan_truk_parkir_desc' => 'string|max:255',
            'un2_persiapan_ganjal_roda_desc' => 'string|max:255',
            'un2_persiapan_safety_cone_desc' => 'string|max:255',
            'un2_persiapan_verifikasi_fisik_desc' => 'string|max:255',
            'un2_persiapan_sopir_serahkan_kunci_desc' => 'string|max:255',
            'un2_persiapan_sopir_kenek_leave_unloading_desc' => 'string|max:255',
            'un2_persiapan_isotank_bersih_desc' => 'string|max:255',
            'un2_persiapan_label_segel_terpasang_desc' => 'string|max:255',
            'un2_persiapan_kenakan_ppe_tambahan_desc' => 'string|max:255',
            'un2_persiapan_pasang_penampung_tetesan_desc' => 'string|max:255',
            'un2_persiapan_bukasegel_ambil_sampel_desc' => 'string|max:255',
            'un2_persiapan_kirim_sample_desc' => 'string|max:255',
            'un2_persiapan_18a_level_awal_kg' => 'string|max:255',
            'un2_persiapan_18a_level_awal_persen' => 'string|max:255',
            'un2_persiapan_18a_level_max_kg' => 'string|max:255',
            'un2_persiapan_18a_level_max_persen' => 'string|max:255',
            'un2_persiapan_18a_level_diisi_kg' => 'string|max:255',
            'un2_persiapan_18a_level_diisi_persen' => 'string|max:255',
            'un2_persiapan_18b_level_awal_kg' => 'string|max:255',
            'un2_persiapan_18b_level_awal_persen' => 'string|max:255',
            'un2_persiapan_18b_level_max_kg' => 'string|max:255',
            'un2_persiapan_18b_level_max_persen' => 'string|max:255',
            'un2_persiapan_18b_level_diisi_kg' => 'string|max:255',
            'un2_persiapan_18b_level_diisi_persen' => 'string|max:255',
            'un2_persiapan_check_fullbody_harness_desc' => 'string|max:255',
            'un2_unloading_bottom_valve_dibuka_penuh_desc' => 'string|max:255',
            'un2_unloading_hidupkan_mesinDCS_desc' => 'string|max:255',
            'un2_unloading_cek_pipa_coupling_valve_tidak_bocor_desc' => 'string|max:255',
            'un2_unloading_pastikan_unloading_aman_desc' => 'string|max:255',
            'un2_unloading_periksa_pompa_desc' => 'string|max:255',
            'un2_selesai_unloading_selesai_desc' => 'string|max:255',
            'un2_selesai_matikan_pompa_desc' => 'string|max:255',
            'un2_selesai_tutup_valve_desc' => 'string|max:255',
            'un2_selesai_petugas_naik_tutup_venting_system_desc' => 'string|max:255',
            'un2_selesai_pastikan_wadah_penampung_masih_ada_desc' => 'string|max:255',
            'un2_selesai_tutup_hose_dg_caphose_desc' => 'string|max:255',
            'un2_selesai_simpan_coupling_dg_aman_desc' => 'string|max:255',
            'un2_selesai_periksa_valve_ditutup_desc' => 'string|max:255',
            'un2_selesai_panggil_sopir_kembali_desc' => 'string|max:255',
            'un2_selesai_lepas_pengganjal_roda_safetycone_desc' => 'string|max:255',
            'un2_selesai_pastikan_peralatan_tidak_terbawa_truk_desc' => 'string|max:255',
            'un2_selesai_lakukan_timbang_akhir_desc' => 'string|max:255',
            'un2_netto_diruatjalan' => 'string|max:255',
            'un2_netto_hasil_timbang' => 'string|max:255',
            'un2_pemeriksa' => 'string|max:255',
            'un2_signature_employee' => 'string|max:255',
            'un2_signature_checker' => 'string|max:255',
            'un2_delete_reason' => 'string|max:255',
            'un2_reason_cancel_load_unload' => 'string|max:255',

        ]);

        $employee = Auth::user();
        try{
            $formId = $request->input('form_id');
            $gate = FormEGateCheck::findOrFail($request->input('gate_id'));
            if( $formId != null || $formId != 0){
                $isCreate = "Update";

                try{
                    $formUnloadingFa1eo = $employee->formUnloadingFa1eo()->findOrFail($formId);

                    if($gate->gateable_id != $formId && $gate->gateable_type != 'App\Models\FormUnloadingFa1eo'){
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
                        'message' => 'Given FormUnloadingFa1eo Form ID not found',
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

                $formUnloadingFa1eo = FormUnloadingFa1eo::create([
                    'un2_employee_id' => $employee->id,
                    'un2_report_kendaraan_id' => $gate->id,
                ]);
            }
            $formUnloadingFa1eo->update([


                'un2_persiapan_memakai_ppe' => (int) $request->input('un2_persiapan_memakai_ppe'),
                'un2_persiapan_cek_hose_piping' => (int) $request->input('un2_persiapan_cek_hose_piping'),
                'un2_persiapan_safety_shower' => (int) $request->input('un2_persiapan_safety_shower'),
                'un2_persiapan_operator_terima_dokumen' => (int) $request->input('un2_persiapan_operator_terima_dokumen'),
                'un2_persiapan_arahkan_truk_parkir' => (int) $request->input('un2_persiapan_arahkan_truk_parkir'),
                'un2_persiapan_ganjal_roda' => (int) $request->input('un2_persiapan_ganjal_roda'),
                'un2_persiapan_safety_cone' => (int) $request->input('un2_persiapan_safety_cone'),
                'un2_persiapan_verifikasi_fisik' => (int) $request->input('un2_persiapan_verifikasi_fisik'),
                'un2_persiapan_sopir_serahkan_kunci' => (int) $request->input('un2_persiapan_sopir_serahkan_kunci'),
                'un2_persiapan_sopir_kenek_leave_unloading' => (int) $request->input('un2_persiapan_sopir_kenek_leave_unloading'),
                'un2_persiapan_isotank_bersih' => (int) $request->input('un2_persiapan_isotank_bersih'),
                'un2_persiapan_label_segel_terpasang' => (int) $request->input('un2_persiapan_label_segel_terpasang'),
                'un2_persiapan_kenakan_ppe_tambahan' => (int) $request->input('un2_persiapan_kenakan_ppe_tambahan'),
                'un2_persiapan_pasang_penampung_tetesan' => (int) $request->input('un2_persiapan_pasang_penampung_tetesan'),
                'un2_persiapan_ls3_coupling_switch_ke_storage' => (int) $request->input('un2_persiapan_ls3_coupling_switch_ke_storage'),
                'un2_persiapan_bukasegel_ambil_sampel' => (int) $request->input('un2_persiapan_bukasegel_ambil_sampel'),
                'un2_persiapan_kirim_sample' => (int) $request->input('un2_persiapan_kirim_sample'),
                'un2_persiapan_periksa_level_storage' => (int) $request->input('un2_persiapan_periksa_level_storage'),
                'un2_persiapan_webbing' => (int) $request->input('un2_persiapan_webbing'),
                'un2_persiapan_d_rings' => (int) $request->input('un2_persiapan_d_rings'),
                'un2_persiapan_buckles' => (int) $request->input('un2_persiapan_buckles'),
                'un2_persiapan_carabiner' => (int) $request->input('un2_persiapan_carabiner'),
                'un2_persiapan_lanyard' => (int) $request->input('un2_persiapan_lanyard'),
                'un2_persiapan_shockabsorber_pack' => (int) $request->input('un2_persiapan_shockabsorber_pack'),
                'un2_persiapan_fall_arrester' => (int) $request->input('un2_persiapan_fall_arrester'),
                'un2_persiapan_petugas_baik_body_isotank' => (int) $request->input('un2_persiapan_petugas_baik_body_isotank'),
                'un2_persiapan_petugas_baik_body_isotank_desc' => (int) $request->input('un2_persiapan_petugas_baik_body_isotank_desc'),
                'un2_unloading_bottom_valve_dibuka_penuh' => (int) $request->input('un2_unloading_bottom_valve_dibuka_penuh'),
                'un2_unloading_hidupkan_mesinDCS' => (int) $request->input('un2_unloading_hidupkan_mesinDCS'),
                'un2_unloading_cek_pipa_coupling_valve_tidak_bocor' => (int) $request->input('un2_unloading_cek_pipa_coupling_valve_tidak_bocor'),
                'un2_unloading_pastikan_unloading_aman' => (int) $request->input('un2_unloading_pastikan_unloading_aman'),
                'un2_unloading_periksa_pompa' => (int) $request->input('un2_unloading_periksa_pompa'),
                'un2_selesai_unloading_selesai' => (int) $request->input('un2_selesai_unloading_selesai'),
                'un2_selesai_matikan_pompa' => (int) $request->input('un2_selesai_matikan_pompa'),
                'un2_selesai_tutup_valve' => (int) $request->input('un2_selesai_tutup_valve'),
                'un2_selesai_petugas_naik_tutup_venting_system' => (int) $request->input('un2_selesai_petugas_naik_tutup_venting_system'),
                'un2_selesai_pastikan_wadah_penampung_masih_ada' => (int) $request->input('un2_selesai_pastikan_wadah_penampung_masih_ada'),
                'un2_selesai_tutup_hose_dg_caphose' => (int) $request->input('un2_selesai_tutup_hose_dg_caphose'),
                'un2_selesai_simpan_coupling_dg_aman' => (int) $request->input('un2_selesai_simpan_coupling_dg_aman'),
                'un2_selesai_periksa_valve_ditutup' => (int) $request->input('un2_selesai_periksa_valve_ditutup'),
                'un2_selesai_panggil_sopir_kembali' => (int) $request->input('un2_selesai_panggil_sopir_kembali'),
                'un2_selesai_lepas_pengganjal_roda_safetycone' => (int) $request->input('un2_selesai_lepas_pengganjal_roda_safetycone'),
                'un2_selesai_pastikan_peralatan_tidak_terbawa_truk' => (int) $request->input('un2_selesai_pastikan_peralatan_tidak_terbawa_truk'),
                'un2_selesai_lakukan_timbang_akhir' => (int) $request->input('un2_selesai_lakukan_timbang_akhir'),
                'un2_selesai_pastikan_qty_pas' => (int) $request->input('un2_selesai_pastikan_qty_pas'),
                'un2_selesai_tandatangan_serahterima' => (int) $request->input('un2_selesai_tandatangan_serahterima'),
                'un2_status' => (int) $request->input('un2_status'),
                'un2_operator_complete' => (int) $request->input('un2_operator_complete'),
                'un2_checker_complete' => (int) $request->input('un2_checker_complete'),
                'un2_cancel_load_unload' => (int) $request->input('un2_cancel_load_unload'),

                'un2_report_code' => $request->input('un2_report_code'),
                'un2_nama_produk' => $request->input('un2_nama_produk'),
                'un2_batch_no' => $request->input('un2_batch_no'),
                'un2_no_storage1' => $request->input('un2_no_storage1'),
                'un2_level_awal1' => $request->input('un2_level_awal1'),
                'un2_level_akhir1' => $request->input('un2_level_akhir1'),
                'un2_no_storage2' => $request->input('un2_no_storage2'),
                'un2_level_awal2' => $request->input('un2_level_awal2'),
                'un2_level_akhir2' => $request->input('un2_level_akhir2'),
                'un2_jml_dimuat' => $request->input('un2_jml_dimuat'),
                'un2_persiapan_memakai_ppe_desc' => $request->input('un2_persiapan_memakai_ppe_desc'),
                'un2_persiapan_cek_hose_piping_desc' => $request->input('un2_persiapan_cek_hose_piping_desc'),
                'un2_persiapan_safety_shower_desc' => $request->input('un2_persiapan_safety_shower_desc'),
                'un2_persiapan_operator_terima_dokumen_desc' => $request->input('un2_persiapan_operator_terima_dokumen_desc'),
                'un2_persiapan_arahkan_truk_parkir_desc' => $request->input('un2_persiapan_arahkan_truk_parkir_desc'),
                'un2_persiapan_ganjal_roda_desc' => $request->input('un2_persiapan_ganjal_roda_desc'),
                'un2_persiapan_safety_cone_desc' => $request->input('un2_persiapan_safety_cone_desc'),
                'un2_persiapan_verifikasi_fisik_desc' => $request->input('un2_persiapan_verifikasi_fisik_desc'),
                'un2_persiapan_sopir_serahkan_kunci_desc' => $request->input('un2_persiapan_sopir_serahkan_kunci_desc'),
                'un2_persiapan_sopir_kenek_leave_unloading_desc' => $request->input('un2_persiapan_sopir_kenek_leave_unloading_desc'),
                'un2_persiapan_isotank_bersih_desc' => $request->input('un2_persiapan_isotank_bersih_desc'),
                'un2_persiapan_label_segel_terpasang_desc' => $request->input('un2_persiapan_label_segel_terpasang_desc'),
                'un2_persiapan_kenakan_ppe_tambahan_desc' => $request->input('un2_persiapan_kenakan_ppe_tambahan_desc'),
                'un2_persiapan_pasang_penampung_tetesan_desc' => $request->input('un2_persiapan_pasang_penampung_tetesan_desc'),
                'un2_persiapan_bukasegel_ambil_sampel_desc' => $request->input('un2_persiapan_bukasegel_ambil_sampel_desc'),
                'un2_persiapan_kirim_sample_desc' => $request->input('un2_persiapan_kirim_sample_desc'),
                'un2_persiapan_18a_level_awal_kg' => $request->input('un2_persiapan_18a_level_awal_kg'),
                'un2_persiapan_18a_level_awal_persen' => $request->input('un2_persiapan_18a_level_awal_persen'),
                'un2_persiapan_18a_level_max_kg' => $request->input('un2_persiapan_18a_level_max_kg'),
                'un2_persiapan_18a_level_max_persen' => $request->input('un2_persiapan_18a_level_max_persen'),
                'un2_persiapan_18a_level_diisi_kg' => $request->input('un2_persiapan_18a_level_diisi_kg'),
                'un2_persiapan_18a_level_diisi_persen' => $request->input('un2_persiapan_18a_level_diisi_persen'),
                'un2_persiapan_18b_level_awal_kg' => $request->input('un2_persiapan_18b_level_awal_kg'),
                'un2_persiapan_18b_level_awal_persen' => $request->input('un2_persiapan_18b_level_awal_persen'),
                'un2_persiapan_18b_level_max_kg' => $request->input('un2_persiapan_18b_level_max_kg'),
                'un2_persiapan_18b_level_max_persen' => $request->input('un2_persiapan_18b_level_max_persen'),
                'un2_persiapan_18b_level_diisi_kg' => $request->input('un2_persiapan_18b_level_diisi_kg'),
                'un2_persiapan_18b_level_diisi_persen' => $request->input('un2_persiapan_18b_level_diisi_persen'),
                'un2_persiapan_check_fullbody_harness_desc' => $request->input('un2_persiapan_check_fullbody_harness_desc'),
                'un2_unloading_bottom_valve_dibuka_penuh_desc' => $request->input('un2_unloading_bottom_valve_dibuka_penuh_desc'),
                'un2_unloading_hidupkan_mesinDCS_desc' => $request->input('un2_unloading_hidupkan_mesinDCS_desc'),
                'un2_unloading_cek_pipa_coupling_valve_tidak_bocor_desc' => $request->input('un2_unloading_cek_pipa_coupling_valve_tidak_bocor_desc'),
                'un2_unloading_pastikan_unloading_aman_desc' => $request->input('un2_unloading_pastikan_unloading_aman_desc'),
                'un2_unloading_periksa_pompa_desc' => $request->input('un2_unloading_periksa_pompa_desc'),
                'un2_selesai_unloading_selesai_desc' => $request->input('un2_selesai_unloading_selesai_desc'),
                'un2_selesai_matikan_pompa_desc' => $request->input('un2_selesai_matikan_pompa_desc'),
                'un2_selesai_tutup_valve_desc' => $request->input('un2_selesai_tutup_valve_desc'),
                'un2_selesai_petugas_naik_tutup_venting_system_desc' => $request->input('un2_selesai_petugas_naik_tutup_venting_system_desc'),
                'un2_selesai_pastikan_wadah_penampung_masih_ada_desc' => $request->input('un2_selesai_pastikan_wadah_penampung_masih_ada_desc'),
                'un2_selesai_tutup_hose_dg_caphose_desc' => $request->input('un2_selesai_tutup_hose_dg_caphose_desc'),
                'un2_selesai_simpan_coupling_dg_aman_desc' => $request->input('un2_selesai_simpan_coupling_dg_aman_desc'),
                'un2_selesai_periksa_valve_ditutup_desc' => $request->input('un2_selesai_periksa_valve_ditutup_desc'),
                'un2_selesai_panggil_sopir_kembali_desc' => $request->input('un2_selesai_panggil_sopir_kembali_desc'),
                'un2_selesai_lepas_pengganjal_roda_safetycone_desc' => $request->input('un2_selesai_lepas_pengganjal_roda_safetycone_desc'),
                'un2_selesai_pastikan_peralatan_tidak_terbawa_truk_desc' => $request->input('un2_selesai_pastikan_peralatan_tidak_terbawa_truk_desc'),
                'un2_selesai_lakukan_timbang_akhir_desc' => $request->input('un2_selesai_lakukan_timbang_akhir_desc'),
                'un2_netto_diruatjalan' => $request->input('un2_netto_diruatjalan'),
                'un2_netto_hasil_timbang' => $request->input('un2_netto_hasil_timbang'),
                'un2_pemeriksa' => $request->input('un2_pemeriksa'),
                'un2_signature_employee' => $request->input('un2_signature_employee'),
                'un2_signature_checker' => $request->input('un2_signature_checker'),
                'un2_delete_reason' => $request->input('un2_delete_reason'),
                'un2_reason_cancel_load_unload' => $request->input('un2_reason_cancel_load_unload'),
            ]);
            $gate->update([
                'gateable_id' => $formUnloadingFa1eo->id,
                'gateable_type' => "App\Models\FormUnloadingFa1eo"
                ]);
            return response()->json([
                'code' => 200,
                'message' => 'Success '.$isCreate.' FormUnloadingFa1eo Form',
                'data' => [
                    $formUnloadingFa1eo]
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
        $employee = Auth::user();

        try{
            $formUnloadingFa1eo = $employee->formUnloadingFa1eo()->findOrFail($formId);
            $formUnloadingFa1eo->update([
                'un2_status' => 2,
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Success Approve FormUnloadingFa1eo Form',
                'data' => [
                    $formUnloadingFa1eo]
                ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given formUnloadingFa1eo Form ID not found',
                'data' => []
                ], 404);
        }
    }

    public function getOne($formId){

        $employee = Auth::user();

        try{
            $formUnloadingFa1eo = $employee->formUnloadingFa1eo()->findOrFail($formId);

            return response()->json([
                'code' => 200,
                'message' => 'Success Fetch FormUnloadingFa1eo Form',
                'data' => [
                    $formUnloadingFa1eo]
                ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given FormUnloadingFa1eo Form ID not found',
                'data' => []
                ], 404);
        }
    }
}
