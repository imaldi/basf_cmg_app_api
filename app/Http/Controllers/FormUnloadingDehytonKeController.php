<?php

namespace App\Http\Controllers;

use App\Models\FormEGateCheck;
use App\Models\FormUnloadingDehytonKe;
use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class FormUnloadingDehytonKeController extends Controller
{
    public function viewAllFormUnloadingDehytonKe(){
        return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' =>
            FormUnloadingDehytonKe::all()
            ], 200);
    }
    public function createOrUpdateFormUnloadingDehytonKe(Request $request){
        $this->validate($request, [
            'form_id' => 'integer',
            'gate_id' => 'required|integer',



            'un8_persiapan_memakai_ppe' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_cek_hose_piping' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_safety_shower' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_operator_terima_dokumen' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_arahkan_truk_parkir' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_ganjal_roda' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_safety_cone' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_verifikasi_fisik' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_sopir_serahkan_kunci' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_sopir_kenek_leave_pemanasan' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_isotank_bersih' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_label_segel_terpasang' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_pasang_hose_steam' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_setelah_produk_mencair' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_ambil_safety_cone_pemanasan' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_sopir_kenek_leave_unloading' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_kenakan_ppe_tambahan' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_pasang_penampung_tetesan' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_bukasegel_ambil_sampel' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_kirim_sample' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_periksa_level_storage' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_check_fullbody_harness_desc' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_webbing' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_D_rings' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_buckles' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_carabiner' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_lanyard' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_shockabsorber_pack' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_fall_arrester' => ['integer', Rule::in(['0','1','2']),],
            'un8_persiapan_petugas_naik_body_isotank' => ['integer', Rule::in(['0','1','2']),],
            'un8_unloading_bottom_valve_dibuka_penuh' => ['integer', Rule::in(['0','1','2']),],
            'un8_unloading_hidupkan_mesinDCS' => ['integer', Rule::in(['0','1','2']),],
            'un8_unloading_cek_pipa_coupling_valve_tidak_bocor' => ['integer', Rule::in(['0','1','2']),],
            'un8_unloading_pastikan_unloading_aman' => ['integer', Rule::in(['0','1','2']),],
            'un8_unloading_periksa_pompa' => ['integer', Rule::in(['0','1','2']),],
            'un8_selesai_unloading_selesai' => ['integer', Rule::in(['0','1','2']),],
            'un8_selesai_matikan_pompa' => ['integer', Rule::in(['0','1','2']),],
            'un8_selesai_tutup_valve' => ['integer', Rule::in(['0','1','2']),],
            'un8_selesai_petugas_naik_tutup_venting_system' => ['integer', Rule::in(['0','1','2']),],
            'un8_selesai_pastikan_wadah_penampung_masih_ada' => ['integer', Rule::in(['0','1','2']),],
            'un8_selesai_tutup_hose_dg_caphose' => ['integer', Rule::in(['0','1','2']),],
            'un8_selesai_simpan_coupling_dg_aman' => ['integer', Rule::in(['0','1','2']),],
            'un8_selesai_periksa_valve_ditutup' => ['integer', Rule::in(['0','1','2']),],
            'un8_selesai_panggil_sopir_kembali' => ['integer', Rule::in(['0','1','2']),],
            'un8_selesai_lepas_pengganjal_roda_safetycone' => ['integer', Rule::in(['0','1','2']),],
            'un8_selesai_pastikan_peralatan_tidak_terbawa_truk' => ['integer', Rule::in(['0','1','2']),],
            'un8_selesai_lakukan_timbang_akhir' => ['integer', Rule::in(['0','1','2']),],
            'un8_selesai_pastikan_qty' => ['integer', Rule::in(['0','1','2']),],
            'un8_selesai_tandatangan_serahterima' => ['integer', Rule::in(['0','1','2']),],
            'un8_status' => ['integer', Rule::in(['0','1']),],
            'un8_operator_complete' => ['integer', Rule::in(['0','1','2']),],
            'un8_checker_complete' => ['integer', Rule::in(['0','1','2']),],
            'un8_cancel_load_unload' => ['integer', Rule::in(['0','1','2']),],

            'un8_persiapan_memakai_ppe_desc' => 'string|max:255',
            'un8_persiapan_cek_hose_piping_desc' => 'string|max:255',
            'un8_persiapan_safety_shower_desc' => 'string|max:255',
            'un8_persiapan_operator_terima_dokumen_desc' => 'string|max:255',
            'un8_persiapan_arahkan_truk_parkir_desc' => 'string|max:255',
            'un8_persiapan_ganjal_roda_desc' => 'string|max:255',
            'un8_persiapan_safety_cone_desc' => 'string|max:255',
            'un8_persiapan_verifikasi_fisik_desc' => 'string|max:255',
            'un8_persiapan_sopir_serahkan_kunci_desc' => 'string|max:255',
            'un8_persiapan_sopir_kenek_leave_pemanasan_desc' => 'string|max:255',
            'un8_persiapan_isotank_bersih_desc' => 'string|max:255',
            'un8_persiapan_label_segel_terpasang_desc' => 'string|max:255',
            'un8_persiapan_pasang_hose_steam_desc' => 'string|max:255',
            'un8_persiapan_setelah_produk_mencair_dec' => 'string|max:255',
            'un8_persiapan_ambil_safety_cone_pemanasan_desc' => 'string|max:255',
            'un8_persiapan_sopir_kenek_leave_unloading_desc' => 'string|max:255',
            'un8_persiapan_kenakan_ppe_tambahan_desc' => 'string|max:255',
            'un8_persiapan_pasang_penampung_tetesan_desc' => 'string|max:255',
            'un8_persiapan_bukasegel_ambil_sampel_desc' => 'string|max:255',
            'un8_persiapan_kirim_sample_desc' => 'string|max:255',
            'un8_report_code' => 'string|max:255',
            'un8_batch_no' => 'string|max:255',
            'un8_no_storage1' => 'string|max:255',
            'un8_level_awal1' => 'string|max:255',
            'un8_level_akhir1' => 'string|max:255',
            'un8_no_storage2' => 'string|max:255',
            'un8_level_awal2' => 'string|max:255',
            'un8_level_akhir2' => 'string|max:255',
            'un8_jml_dimuat' => 'string|max:255',
            'un8_persiapan_18a_level_awal_kg' => 'string|max:255',
            'un8_persiapan_18a_level_awal_persen' => 'string|max:255',
            'un8_persiapan_18a_level_max_kg' => 'string|max:255',
            'un8_persiapan_18a_level_max_persen' => 'string|max:255',
            'un8_persiapan_18a_dapat_diisi_kg' => 'string|max:255',
            'un8_persiapan_18a_dapat_diisi_persen' => 'string|max:255',
            'un8_persiapan_18b_level_awal_kg' => 'string|max:255',
            'un8_persiapan_18b_level_awal_persen' => 'string|max:255',
            'un8_persiapan_18b_level_max_kg' => 'string|max:255',
            'un8_persiapan_18b_level_max_persen' => 'string|max:255',
            'un8_persiapan_18b_dapat_diisi_kg' => 'string|max:255',
            'un8_persiapan_18b_dapat_diisi_persen' => 'string|max:255',
            'un8_persiapan_petugas_naik_body_isotank_desc' => 'string|max:255',
            'un8_unloading_bottom_valve_dibuka_penuh_desc' => 'string|max:255',
            'un8_unloading_hidupkan_mesinDCS_desc' => 'string|max:255',
            'un8_unloading_cek_pipa_coupling_valve_tidak_bocor_desc' => 'string|max:255',
            'un8_unloading_pastikan_unloading_aman_desc' => 'string|max:255',
            'un8_unloading_periksa_pompa_desc' => 'string|max:255',
            'un8_selesai_unloading_selesai_desc' => 'string|max:255',
            'un8_selesai_matikan_pompa_dec' => 'string|max:255',
            'un8_selesai_tutup_valve_desc' => 'string|max:255',
            'un8_selesai_petugas_naik_tutup_venting_system_desc' => 'string|max:255',
            'un8_selesai_pastikan_wadah_penampung_masih_ada_desc' => 'string|max:255',
            'un8_selesai_tutup_hose_dg_caphose_desc' => 'string|max:255',
            'un8_selesai_simpan_coupling_dg_aman_desc' => 'string|max:255',
            'un8_selesai_periksa_valve_ditutup_desc' => 'string|max:255',
            'un8_selesai_panggil_sopir_kembali_desc' => 'string|max:255',
            'un8_selesai_lepas_pengganjal_roda_safetycone_desc' => 'string|max:255',
            'un8_selesai_pastikan_peralatan_tidak_terbawa_truk_desc' => 'string|max:255',
            'un8_selesai_lakukan_timbang_akhir_desc' => 'string|max:255',
            'un8_netto_disuratjalan' => 'string|max:255',
            'un8_netto_hasil_timbang' => 'string|max:255',
            'un8_pemeriksa' => 'string|max:255',
            'un8_signature_employee' => 'string|max:255',
            'un8_signature_checker' => 'string|max:255',
            'un8_delete_reason' => 'string|max:255',
            'un8_reason_cancel_load_unload' => 'string|max:255',
        ]);

        $employee = Auth::user();
        try{
            $formId = $request->input('form_id');
            $gate = FormEGateCheck::findOrFail($request->input('gate_id'));
            if( $formId != null || $formId != 0){
                $isCreate = "Update";

                try{
                    $formUnloadingDehytonKe = $employee->formUnloadingDehytonKe()->findOrFail($formId);


                } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
                    return response()->json([
                        'code' => 404,
                        'message' => 'Given FormUnloadingDehytonKe Form ID not found',
                        'data' => []
                        ], 404);
                }
            } else {
                $isCreate = "Create";

                $formUnloadingDehytonKe = FormUnloadingDehytonKe::create([
                    'un8_employee_id' => $employee->id,
                    'un8_report_kendaraan_id' => $gate->id,
                ]);
            }
            $formUnloadingDehytonKe->update([
                'un8_persiapan_memakai_ppe' => (int) $request->input('un8_persiapan_memakai_ppe'),
                'un8_persiapan_cek_hose_piping' => (int) $request->input('un8_persiapan_cek_hose_piping'),
                'un8_persiapan_safety_shower' => (int) $request->input('un8_persiapan_safety_shower'),
                'un8_persiapan_operator_terima_dokumen' => (int) $request->input('un8_persiapan_operator_terima_dokumen'),
                'un8_persiapan_arahkan_truk_parkir' => (int) $request->input('un8_persiapan_arahkan_truk_parkir'),
                'un8_persiapan_ganjal_roda' => (int) $request->input('un8_persiapan_ganjal_roda'),
                'un8_persiapan_safety_cone' => (int) $request->input('un8_persiapan_safety_cone'),
                'un8_persiapan_verifikasi_fisik' => (int) $request->input('un8_persiapan_verifikasi_fisik'),
                'un8_persiapan_sopir_serahkan_kunci' => (int) $request->input('un8_persiapan_sopir_serahkan_kunci'),
                'un8_persiapan_sopir_kenek_leave_pemanasan' => (int) $request->input('un8_persiapan_sopir_kenek_leave_pemanasan'),
                'un8_persiapan_isotank_bersih' => (int) $request->input('un8_persiapan_isotank_bersih'),
                'un8_persiapan_label_segel_terpasang' => (int) $request->input('un8_persiapan_label_segel_terpasang'),
                'un8_persiapan_pasang_hose_steam' => (int) $request->input('un8_persiapan_pasang_hose_steam'),
                'un8_persiapan_setelah_produk_mencair' => (int) $request->input('un8_persiapan_setelah_produk_mencair'),
                'un8_persiapan_ambil_safety_cone_pemanasan' => (int) $request->input('un8_persiapan_ambil_safety_cone_pemanasan'),
                'un8_persiapan_sopir_kenek_leave_unloading' => (int) $request->input('un8_persiapan_sopir_kenek_leave_unloading'),
                'un8_persiapan_kenakan_ppe_tambahan' => (int) $request->input('un8_persiapan_kenakan_ppe_tambahan'),
                'un8_persiapan_pasang_penampung_tetesan' => (int) $request->input('un8_persiapan_pasang_penampung_tetesan'),
                'un8_persiapan_bukasegel_ambil_sampel' => (int) $request->input('un8_persiapan_bukasegel_ambil_sampel'),
                'un8_persiapan_kirim_sample' => (int) $request->input('un8_persiapan_kirim_sample'),
                'un8_persiapan_periksa_level_storage' => (int) $request->input('un8_persiapan_periksa_level_storage'),
                'un8_persiapan_check_fullbody_harness_desc' => (int) $request->input('un8_persiapan_check_fullbody_harness_desc'),
                'un8_persiapan_webbing' => (int) $request->input('un8_persiapan_webbing'),
                'un8_persiapan_D_rings' => (int) $request->input('un8_persiapan_D_rings'),
                'un8_persiapan_buckles' => (int) $request->input('un8_persiapan_buckles'),
                'un8_persiapan_carabiner' => (int) $request->input('un8_persiapan_carabiner'),
                'un8_persiapan_lanyard' => (int) $request->input('un8_persiapan_lanyard'),
                'un8_persiapan_shockabsorber_pack' => (int) $request->input('un8_persiapan_shockabsorber_pack'),
                'un8_persiapan_fall_arrester' => (int) $request->input('un8_persiapan_fall_arrester'),
                'un8_persiapan_petugas_naik_body_isotank' => (int) $request->input('un8_persiapan_petugas_naik_body_isotank'),
                'un8_unloading_bottom_valve_dibuka_penuh' => (int) $request->input('un8_unloading_bottom_valve_dibuka_penuh'),
                'un8_unloading_hidupkan_mesinDCS' => (int) $request->input('un8_unloading_hidupkan_mesinDCS'),
                'un8_unloading_cek_pipa_coupling_valve_tidak_bocor' => (int) $request->input('un8_unloading_cek_pipa_coupling_valve_tidak_bocor'),
                'un8_unloading_pastikan_unloading_aman' => (int) $request->input('un8_unloading_pastikan_unloading_aman'),
                'un8_unloading_periksa_pompa' => (int) $request->input('un8_unloading_periksa_pompa'),
                'un8_selesai_unloading_selesai' => (int) $request->input('un8_selesai_unloading_selesai'),
                'un8_selesai_matikan_pompa' => (int) $request->input('un8_selesai_matikan_pompa'),
                'un8_selesai_tutup_valve' => (int) $request->input('un8_selesai_tutup_valve'),
                'un8_selesai_petugas_naik_tutup_venting_system' => (int) $request->input('un8_selesai_petugas_naik_tutup_venting_system'),
                'un8_selesai_pastikan_wadah_penampung_masih_ada' => (int) $request->input('un8_selesai_pastikan_wadah_penampung_masih_ada'),
                'un8_selesai_tutup_hose_dg_caphose' => (int) $request->input('un8_selesai_tutup_hose_dg_caphose'),
                'un8_selesai_simpan_coupling_dg_aman' => (int) $request->input('un8_selesai_simpan_coupling_dg_aman'),
                'un8_selesai_periksa_valve_ditutup' => (int) $request->input('un8_selesai_periksa_valve_ditutup'),
                'un8_selesai_panggil_sopir_kembali' => (int) $request->input('un8_selesai_panggil_sopir_kembali'),
                'un8_selesai_lepas_pengganjal_roda_safetycone' => (int) $request->input('un8_selesai_lepas_pengganjal_roda_safetycone'),
                'un8_selesai_pastikan_peralatan_tidak_terbawa_truk' => (int) $request->input('un8_selesai_pastikan_peralatan_tidak_terbawa_truk'),
                'un8_selesai_lakukan_timbang_akhir' => (int) $request->input('un8_selesai_lakukan_timbang_akhir'),
                'un8_selesai_pastikan_qty' => (int) $request->input('un8_selesai_pastikan_qty'),
                'un8_selesai_tandatangan_serahterima' => (int) $request->input('un8_selesai_tandatangan_serahterima'),
                'un8_status' => (int) $request->input('un8_status'),
                'un8_operator_complete' => (int) $request->input('un8_operator_complete'),
                'un8_checker_complete' => (int) $request->input('un8_checker_complete'),
                'un8_cancel_load_unload' => (int) $request->input('un8_cancel_load_unload'),


                'un8_persiapan_memakai_ppe_desc' => $request->input('un8_persiapan_memakai_ppe_desc'),
                'un8_persiapan_cek_hose_piping_desc' => $request->input('un8_persiapan_cek_hose_piping_desc'),
                'un8_persiapan_safety_shower_desc' => $request->input('un8_persiapan_safety_shower_desc'),
                'un8_persiapan_operator_terima_dokumen_desc' => $request->input('un8_persiapan_operator_terima_dokumen_desc'),
                'un8_persiapan_arahkan_truk_parkir_desc' => $request->input('un8_persiapan_arahkan_truk_parkir_desc'),
                'un8_persiapan_ganjal_roda_desc' => $request->input('un8_persiapan_ganjal_roda_desc'),
                'un8_persiapan_safety_cone_desc' => $request->input('un8_persiapan_safety_cone_desc'),
                'un8_persiapan_verifikasi_fisik_desc' => $request->input('un8_persiapan_verifikasi_fisik_desc'),
                'un8_persiapan_sopir_serahkan_kunci_desc' => $request->input('un8_persiapan_sopir_serahkan_kunci_desc'),
                'un8_persiapan_sopir_kenek_leave_pemanasan_desc' => $request->input('un8_persiapan_sopir_kenek_leave_pemanasan_desc'),
                'un8_persiapan_isotank_bersih_desc' => $request->input('un8_persiapan_isotank_bersih_desc'),
                'un8_persiapan_label_segel_terpasang_desc' => $request->input('un8_persiapan_label_segel_terpasang_desc'),
                'un8_persiapan_pasang_hose_steam_desc' => $request->input('un8_persiapan_pasang_hose_steam_desc'),
                'un8_persiapan_setelah_produk_mencair_dec' => $request->input('un8_persiapan_setelah_produk_mencair_dec'),
                'un8_persiapan_ambil_safety_cone_pemanasan_desc' => $request->input('un8_persiapan_ambil_safety_cone_pemanasan_desc'),
                'un8_persiapan_sopir_kenek_leave_unloading_desc' => $request->input('un8_persiapan_sopir_kenek_leave_unloading_desc'),
                'un8_persiapan_kenakan_ppe_tambahan_desc' => $request->input('un8_persiapan_kenakan_ppe_tambahan_desc'),
                'un8_persiapan_pasang_penampung_tetesan_desc' => $request->input('un8_persiapan_pasang_penampung_tetesan_desc'),
                'un8_persiapan_bukasegel_ambil_sampel_desc' => $request->input('un8_persiapan_bukasegel_ambil_sampel_desc'),
                'un8_persiapan_kirim_sample_desc' => $request->input('un8_persiapan_kirim_sample_desc'),
                'un8_report_code' => $request->input('un8_report_code'),
                'un8_batch_no' => $request->input('un8_batch_no'),
                'un8_no_storage1' => $request->input('un8_no_storage1'),
                'un8_level_awal1' => $request->input('un8_level_awal1'),
                'un8_level_akhir1' => $request->input('un8_level_akhir1'),
                'un8_no_storage2' => $request->input('un8_no_storage2'),
                'un8_level_awal2' => $request->input('un8_level_awal2'),
                'un8_level_akhir2' => $request->input('un8_level_akhir2'),
                'un8_jml_dimuat' => $request->input('un8_jml_dimuat'),
                'un8_persiapan_18a_level_awal_kg' => $request->input('un8_persiapan_18a_level_awal_kg'),
                'un8_persiapan_18a_level_awal_persen' => $request->input('un8_persiapan_18a_level_awal_persen'),
                'un8_persiapan_18a_level_max_kg' => $request->input('un8_persiapan_18a_level_max_kg'),
                'un8_persiapan_18a_level_max_persen' => $request->input('un8_persiapan_18a_level_max_persen'),
                'un8_persiapan_18a_dapat_diisi_kg' => $request->input('un8_persiapan_18a_dapat_diisi_kg'),
                'un8_persiapan_18a_dapat_diisi_persen' => $request->input('un8_persiapan_18a_dapat_diisi_persen'),
                'un8_persiapan_18b_level_awal_kg' => $request->input('un8_persiapan_18b_level_awal_kg'),
                'un8_persiapan_18b_level_awal_persen' => $request->input('un8_persiapan_18b_level_awal_persen'),
                'un8_persiapan_18b_level_max_kg' => $request->input('un8_persiapan_18b_level_max_kg'),
                'un8_persiapan_18b_level_max_persen' => $request->input('un8_persiapan_18b_level_max_persen'),
                'un8_persiapan_18b_dapat_diisi_kg' => $request->input('un8_persiapan_18b_dapat_diisi_kg'),
                'un8_persiapan_18b_dapat_diisi_persen' => $request->input('un8_persiapan_18b_dapat_diisi_persen'),
                'un8_persiapan_petugas_naik_body_isotank_desc' => $request->input('un8_persiapan_petugas_naik_body_isotank_desc'),
                'un8_unloading_bottom_valve_dibuka_penuh_desc' => $request->input('un8_unloading_bottom_valve_dibuka_penuh_desc'),
                'un8_unloading_hidupkan_mesinDCS_desc' => $request->input('un8_unloading_hidupkan_mesinDCS_desc'),
                'un8_unloading_cek_pipa_coupling_valve_tidak_bocor_desc' => $request->input('un8_unloading_cek_pipa_coupling_valve_tidak_bocor_desc'),
                'un8_unloading_pastikan_unloading_aman_desc' => $request->input('un8_unloading_pastikan_unloading_aman_desc'),
                'un8_unloading_periksa_pompa_desc' => $request->input('un8_unloading_periksa_pompa_desc'),
                'un8_selesai_unloading_selesai_desc' => $request->input('un8_selesai_unloading_selesai_desc'),
                'un8_selesai_matikan_pompa_dec' => $request->input('un8_selesai_matikan_pompa_dec'),
                'un8_selesai_tutup_valve_desc' => $request->input('un8_selesai_tutup_valve_desc'),
                'un8_selesai_petugas_naik_tutup_venting_system_desc' => $request->input('un8_selesai_petugas_naik_tutup_venting_system_desc'),
                'un8_selesai_pastikan_wadah_penampung_masih_ada_desc' => $request->input('un8_selesai_pastikan_wadah_penampung_masih_ada_desc'),
                'un8_selesai_tutup_hose_dg_caphose_desc' => $request->input('un8_selesai_tutup_hose_dg_caphose_desc'),
                'un8_selesai_simpan_coupling_dg_aman_desc' => $request->input('un8_selesai_simpan_coupling_dg_aman_desc'),
                'un8_selesai_periksa_valve_ditutup_desc' => $request->input('un8_selesai_periksa_valve_ditutup_desc'),
                'un8_selesai_panggil_sopir_kembali_desc' => $request->input('un8_selesai_panggil_sopir_kembali_desc'),
                'un8_selesai_lepas_pengganjal_roda_safetycone_desc' => $request->input('un8_selesai_lepas_pengganjal_roda_safetycone_desc'),
                'un8_selesai_pastikan_peralatan_tidak_terbawa_truk_desc' => $request->input('un8_selesai_pastikan_peralatan_tidak_terbawa_truk_desc'),
                'un8_selesai_lakukan_timbang_akhir_desc' => $request->input('un8_selesai_lakukan_timbang_akhir_desc'),
                'un8_netto_disuratjalan' => $request->input('un8_netto_disuratjalan'),
                'un8_netto_hasil_timbang' => $request->input('un8_netto_hasil_timbang'),
                'un8_pemeriksa' => $request->input('un8_pemeriksa'),
                'un8_signature_employee' => $request->input('un8_signature_employee'),
                'un8_signature_checker' => $request->input('un8_signature_checker'),
                'un8_delete_reason' => $request->input('un8_delete_reason'),
                'un8_reason_cancel_load_unload' => $request->input('un8_reason_cancel_load_unload'),
            ]);
            $gate->update([
                'gateable_id' => $formUnloadingDehytonKe->id,
                'gateable_type' => "App\Model\FormUnloadingDehytonKe"
                ]);
            return response()->json([
                'code' => 200,
                'message' => 'Success Update FormUnloadingDehytonKe Form',
                'data' => [
                    $formUnloadingDehytonKe]
                ], 200);


        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given E Gate Form ID not found',
                'data' => []
                ], 404);
        }
    }

    public function approveFormUnloadingDehytonKe(Request $request){
        $formId = $request->input('form_id');
        try{
            $formUnloadingDehytonKe = $employee->formUnloadingDehytonKe()->findOrFail($formId);
            $formUnloadingDehytonKe->update([
                'un8_status' => 2,
            ]);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given formUnloadingDehytonKe Form ID not found',
                'data' => []
                ], 404);
        }
    }
}
