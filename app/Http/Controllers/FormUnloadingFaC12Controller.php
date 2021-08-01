<?php

namespace App\Http\Controllers;

use App\Models\FormEGateCheck;
use App\Models\FormUnloadingFaC12;
use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class FormUnloadingFaC12Controller extends Controller
{
    public function viewAllFormUnloadingFaC12(){
        return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' =>
            FormUnloadingFaC12::all()
            ], 200);
    }
    public function createOrUpdateFormUnloadingFaC12(Request $request){
        $this->validate($request, [
            'form_id' => 'integer',
            'gate_id' => 'required|integer',

            'un1_persiapan_memakai_ppe' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_cek_hose_piping' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_safety_shower' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_operator_terima_dokumen' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_arahkan_truk_parkir' => ['integer', Rule::in(['0','1','2']),],
            'un1_perisapan_ganjal_roda' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_safety_cone' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_verifikasi_fisik' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_sopir_serahkan_kunci' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_sopir_kenek_leave_unloading' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_isotank_bersih' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_label_segel_terpasang' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_kenakan_ppe_tambahan' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_pasang_penampung_tetesan' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_cek_coupling_station' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_bukasegel_ambil_sampel' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_kirim_sample' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_18a_level_awal_kg' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_webbing' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_d_rings' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_buckles' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_carabiner' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_lanyard' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_shockabsorber_pack' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_fall_arrester' => ['integer', Rule::in(['0','1','2']),],
            'un1_persiapan_petugas_naik_body_isotank' => ['integer', Rule::in(['0','1','2']),],
            'un1_unloading_buttom_valve_dibuka_penuh' => ['integer', Rule::in(['0','1','2']),],
            'un1_unloading_hidupkan_mesinDCS' => ['integer', Rule::in(['0','1','2']),],
            'un1_unloading_cek_pipa_coupling_valve_tidak_bocor' => ['integer', Rule::in(['0','1','2']),],
            'un1_unloading_pastikan_unloading_aman' => ['integer', Rule::in(['0','1','2']),],
            'un1_unloading_periksa_pompa' => ['integer', Rule::in(['0','1','2']),],
            'un1_selesai_unloading_selesai' => ['integer', Rule::in(['0','1','2']),],
            'un1_selesai_matikan_pompa' => ['integer', Rule::in(['0','1','2']),],
            'un1_selesai_tutup_valve' => ['integer', Rule::in(['0','1','2']),],
            'un1_selesai_petugas_naik_tutup_venting_system' => ['integer', Rule::in(['0','1','2']),],
            'un1_selesai_pastikan_wadah_penampung_masih_ada' => ['integer', Rule::in(['0','1','2']),],
            'un1_selesai_tutup_hose_dg_caphose' => ['integer', Rule::in(['0','1','2']),],
            'un1_selesai_simpanan_coupling_dg_aman' => ['integer', Rule::in(['0','1','2']),],
            'un1_selesai_periksa_valve_ditutup' => ['integer', Rule::in(['0','1','2']),],
            'un1_selesai_panggil_sopir_kembali' => ['integer', Rule::in(['0','1','2']),],
            'un1_selesai_lepas_pengganjal_roda_safetycone' => ['integer', Rule::in(['0','1','2']),],
            'un1_selesai_pastikan_peralatan_tidak_terbawa_truck' => ['integer', Rule::in(['0','1','2']),],
            'un1_selesai_lakukan_timbang_akhir' => ['integer', Rule::in(['0','1','2']),],
            'un1_selesai_pastikan_qty_pas' => ['integer', Rule::in(['0','1','2']),],
            'un1_selesai_tandatangan_serahterima' => ['integer', Rule::in(['0','1','2']),],
            'un1_status' => ['integer', Rule::in(['0','1']),],
            'un1_operator_complate' => ['integer', Rule::in(['0','1','2']),],
            'un1_checker_complete' => ['integer', Rule::in(['0','1','2']),],
            'un1_cancel_load_unload' => ['integer', Rule::in(['0','1','2']),],

            'un1_report_code' => 'string|max:255',
            'un1_nama_produk' => 'string|max:255',
            'un1_batch_no' => 'string|max:255',
            'un1_no_storage1' => 'string|max:255',
            'un1_level_awal1' => 'string|max:255',
            'un1_level_akhir1' => 'string|max:255',
            'un1_no_storage2' => 'string|max:255',
            'un1_level_awal2' => 'string|max:255',
            'un1_level_akhir2' => 'string|max:255',
            'un1_jml_dimuat' => 'string|max:255',
            'un1_persiapan_memakai_ppe_desc' => 'string|max:255',
            'un1_persiapan_cek_hose_piping_desc' => 'string|max:255',
            'un1_persiapan_safety_shower_desc' => 'string|max:255',
            'un1_persiapan_operator_terima_dokumen_desc' => 'string|max:255',
            'un1_persiapan_arahkan_truk_parkir_desc' => 'string|max:255',
            'un1_perisapan_ganjal_roda_desc' => 'string|max:255',
            'un1_persiapan_safery_cone_desc' => 'string|max:255',
            'un1_persiapan_verifikasi_fisik_desc' => 'string|max:255',
            'un1_persiapan_sopir_serahkan_kunci_desc' => 'string|max:255',
            'un1_persiapan_sopir_kenek_leave_unloading_desc' => 'string|max:255',
            'un1_persiapan_isotank_bersih_desc' => 'string|max:255',
            'un1_persiapan_label_segel_terpasang_desc' => 'string|max:255',
            'un1_persiapan_kenakan_ppe_tambahan_desc' => 'string|max:255',
            'un1_persiapan_pasang_penampung_tetesan_desc' => 'string|max:255',
            'un1_persiapan_cek_coupling_station_desc' => 'string|max:255',
            'un1_persiapan_bukasegel_ambil_sampel_desc' => 'string|max:255',
            'un1_persiapan_kirim_sample_desc' => 'string|max:255',
            'un1_persiapan_18a_level_awal_persen' => 'string|max:255',
            'un1_persiapan_18a_level_max_kg' => 'string|max:255',
            'un1_persiapan_18a_level_max_persen' => 'string|max:255',
            'un1_persiapan_18a_level_diisi_kg' => 'string|max:255',
            'un1_persiapan_18a_level_diisi_persen' => 'string|max:255',
            'un1_persiapan_18b_level_awal_kg' => 'string|max:255',
            'un1_persiapan_18b_level_awal_persen' => 'string|max:255',
            'un1_persiapan_18b_level_max_kg' => 'string|max:255',
            'un1_persiapan_18b_level_max_persen' => 'string|max:255',
            'un1_persiapan_18b_level_diisi_kg' => 'string|max:255',
            'un1_persiapan_18b_level_diisi_persen' => 'string|max:255',
            'un1_persiapan_check_fullbody_harness_desc' => 'string|max:255',
            'un1_persiapan_petugas_naik_body_isotank_desc' => 'string|max:255',
            'un1_unloading_buttom_valve_dibuka_penuh_desc' => 'string|max:255',
            'un1_unloading_hidupkan_mesinDCS_desc' => 'string|max:255',
            'un1_unloading_cek_pipa_coupling_valve_tidak_bocor_desc' => 'string|max:255',
            'un1_unloading_pastikan_unloading_aman_desc' => 'string|max:255',
            'un1_unloading_periksa_pompa_desc' => 'string|max:255',
            'un1_selesai_unloading_selesai_desc' => 'string|max:255',
            'un1_selesai_matikan_pompa_desc' => 'string|max:255',
            'un1_selesai_tutup_valve_desc' => 'string|max:255',
            'un1_selesai_petugas_naik_tutup_venting_system_desc' => 'string|max:255',
            'un1_selesai_pastikan_wadah_penampung_masih_ada_desc' => 'string|max:255',
            'un1_selesai_tutup_hose_dg_caphose_desc' => 'string|max:255',
            'un1_selesai_simpanan_coupling_dg_aman_desc' => 'string|max:255',
            'un1_selesai_periksa_valve_ditutup_desc' => 'string|max:255',
            'un1_selesai_panggil_sopir_kembali_desc' => 'string|max:255',
            'un1_selesai_lepas_pengganjal_roda_safetycone_desc' => 'string|max:255',
            'un1_selesai_pastikan_peralatan_tidak_terbawa_truck_desc' => 'string|max:255',
            'un1_selesai_lakukan_timbang_akhir_desc' => 'string|max:255',
            'un1_netto_disuratjalan' => 'string|max:255',
            'un1_netto_hasil_timbang' => 'string|max:255',
            'un1_pemeriksa' => 'string|max:255',
            'un1_signature_employee' => 'string|max:255',
            'un1_signature_checker' => 'string|max:255',
            'un1_delete_reason' => 'string|max:255',
            'un1_reason_cancel_load_unload' => 'string|max:255',

        ]);

        $employee = Auth::user();
        try{
            $formId = $request->input('form_id');
            $gate = FormEGateCheck::findOrFail($request->input('gate_id'));
            if( $formId != null || $formId != 0){
                $isCreate = "Update";

                try{
                    $formUnloadingFaC12 = $employee->formUnloadingFaC12()->findOrFail($formId);



                } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
                    return response()->json([
                        'code' => 404,
                        'message' => 'Given FormUnloadingFaC12 Form ID not found',
                        'data' => []
                        ], 404);
                }
            } else {
                $isCreate = "Create";

                $formUnloadingFaC12 = FormUnloadingFaC12::create([
                    'un1_employee_id' => $employee->id,
                    'un1_report_kendaraan_id' => $gate->id,
                ]);
            }

            $formUnloadingFaC12->update([
                'un1_persiapan_memakai_ppe' => (int) $request->input('un1_persiapan_memakai_ppe'),
                'un1_persiapan_cek_hose_piping' => (int) $request->input('un1_persiapan_cek_hose_piping'),
                'un1_persiapan_safety_shower' => (int) $request->input('un1_persiapan_safety_shower'),
                'un1_persiapan_operator_terima_dokumen' => (int) $request->input('un1_persiapan_operator_terima_dokumen'),
                'un1_persiapan_arahkan_truk_parkir' => (int) $request->input('un1_persiapan_arahkan_truk_parkir'),
                'un1_perisapan_ganjal_roda' => (int) $request->input('un1_perisapan_ganjal_roda'),
                'un1_persiapan_safety_cone' => (int) $request->input('un1_persiapan_safety_cone'),
                'un1_persiapan_verifikasi_fisik' => (int) $request->input('un1_persiapan_verifikasi_fisik'),
                'un1_persiapan_sopir_serahkan_kunci' => (int) $request->input('un1_persiapan_sopir_serahkan_kunci'),
                'un1_persiapan_sopir_kenek_leave_unloading' => (int) $request->input('un1_persiapan_sopir_kenek_leave_unloading'),
                'un1_persiapan_isotank_bersih' => (int) $request->input('un1_persiapan_isotank_bersih'),
                'un1_persiapan_label_segel_terpasang' => (int) $request->input('un1_persiapan_label_segel_terpasang'),
                'un1_persiapan_kenakan_ppe_tambahan' => (int) $request->input('un1_persiapan_kenakan_ppe_tambahan'),
                'un1_persiapan_pasang_penampung_tetesan' => (int) $request->input('un1_persiapan_pasang_penampung_tetesan'),
                'un1_persiapan_cek_coupling_station' => (int) $request->input('un1_persiapan_cek_coupling_station'),
                'un1_persiapan_bukasegel_ambil_sampel' => (int) $request->input('un1_persiapan_bukasegel_ambil_sampel'),
                'un1_persiapan_kirim_sample' => (int) $request->input('un1_persiapan_kirim_sample'),
                'un1_persiapan_18a_level_awal_kg' => (int) $request->input('un1_persiapan_18a_level_awal_kg'),
                'un1_persiapan_webbing' => (int) $request->input('un1_persiapan_webbing'),
                'un1_persiapan_d_rings' => (int) $request->input('un1_persiapan_d_rings'),
                'un1_persiapan_buckles' => (int) $request->input('un1_persiapan_buckles'),
                'un1_persiapan_carabiner' => (int) $request->input('un1_persiapan_carabiner'),
                'un1_persiapan_lanyard' => (int) $request->input('un1_persiapan_lanyard'),
                'un1_persiapan_shockabsorber_pack' => (int) $request->input('un1_persiapan_shockabsorber_pack'),
                'un1_persiapan_fall_arrester' => (int) $request->input('un1_persiapan_fall_arrester'),
                'un1_persiapan_petugas_naik_body_isotank' => (int) $request->input('un1_persiapan_petugas_naik_body_isotank'),
                'un1_unloading_buttom_valve_dibuka_penuh' => (int) $request->input('un1_unloading_buttom_valve_dibuka_penuh'),
                'un1_unloading_hidupkan_mesinDCS' => (int) $request->input('un1_unloading_hidupkan_mesinDCS'),
                'un1_unloading_cek_pipa_coupling_valve_tidak_bocor' => (int) $request->input('un1_unloading_cek_pipa_coupling_valve_tidak_bocor'),
                'un1_unloading_pastikan_unloading_aman' => (int) $request->input('un1_unloading_pastikan_unloading_aman'),
                'un1_unloading_periksa_pompa' => (int) $request->input('un1_unloading_periksa_pompa'),
                'un1_selesai_unloading_selesai' => (int) $request->input('un1_selesai_unloading_selesai'),
                'un1_selesai_matikan_pompa' => (int) $request->input('un1_selesai_matikan_pompa'),
                'un1_selesai_tutup_valve' => (int) $request->input('un1_selesai_tutup_valve'),
                'un1_selesai_petugas_naik_tutup_venting_system' => (int) $request->input('un1_selesai_petugas_naik_tutup_venting_system'),
                'un1_selesai_pastikan_wadah_penampung_masih_ada' => (int) $request->input('un1_selesai_pastikan_wadah_penampung_masih_ada'),
                'un1_selesai_tutup_hose_dg_caphose' => (int) $request->input('un1_selesai_tutup_hose_dg_caphose'),
                'un1_selesai_simpanan_coupling_dg_aman' => (int) $request->input('un1_selesai_simpanan_coupling_dg_aman'),
                'un1_selesai_periksa_valve_ditutup' => (int) $request->input('un1_selesai_periksa_valve_ditutup'),
                'un1_selesai_panggil_sopir_kembali' => (int) $request->input('un1_selesai_panggil_sopir_kembali'),
                'un1_selesai_lepas_pengganjal_roda_safetycone' => (int) $request->input('un1_selesai_lepas_pengganjal_roda_safetycone'),
                'un1_selesai_pastikan_peralatan_tidak_terbawa_truck' => (int) $request->input('un1_selesai_pastikan_peralatan_tidak_terbawa_truck'),
                'un1_selesai_lakukan_timbang_akhir' => (int) $request->input('un1_selesai_lakukan_timbang_akhir'),
                'un1_selesai_pastikan_qty_pas' => (int) $request->input('un1_selesai_pastikan_qty_pas'),
                'un1_selesai_tandatangan_serahterima' => (int) $request->input('un1_selesai_tandatangan_serahterima'),
                'un1_status' => (int) $request->input('un1_status'),
                'un1_operator_complate' => (int) $request->input('un1_operator_complate'),
                'un1_checker_complete' => (int) $request->input('un1_checker_complete'),
                'un1_cancel_load_unload' => (int) $request->input('un1_cancel_load_unload'),

                'un1_report_code' => $request->input('un1_report_code'),
                'un1_nama_produk' => $request->input('un1_nama_produk'),
                'un1_batch_no' => $request->input('un1_batch_no'),
                'un1_no_storage1' => $request->input('un1_no_storage1'),
                'un1_level_awal1' => $request->input('un1_level_awal1'),
                'un1_level_akhir1' => $request->input('un1_level_akhir1'),
                'un1_no_storage2' => $request->input('un1_no_storage2'),
                'un1_level_awal2' => $request->input('un1_level_awal2'),
                'un1_level_akhir2' => $request->input('un1_level_akhir2'),
                'un1_jml_dimuat' => $request->input('un1_jml_dimuat'),
                'un1_persiapan_memakai_ppe_desc' => $request->input('un1_persiapan_memakai_ppe_desc'),
                'un1_persiapan_cek_hose_piping_desc' => $request->input('un1_persiapan_cek_hose_piping_desc'),
                'un1_persiapan_safety_shower_desc' => $request->input('un1_persiapan_safety_shower_desc'),
                'un1_persiapan_operator_terima_dokumen_desc' => $request->input('un1_persiapan_operator_terima_dokumen_desc'),
                'un1_persiapan_arahkan_truk_parkir_desc' => $request->input('un1_persiapan_arahkan_truk_parkir_desc'),
                'un1_perisapan_ganjal_roda_desc' => $request->input('un1_perisapan_ganjal_roda_desc'),
                'un1_persiapan_safery_cone_desc' => $request->input('un1_persiapan_safery_cone_desc'),
                'un1_persiapan_verifikasi_fisik_desc' => $request->input('un1_persiapan_verifikasi_fisik_desc'),
                'un1_persiapan_sopir_serahkan_kunci_desc' => $request->input('un1_persiapan_sopir_serahkan_kunci_desc'),
                'un1_persiapan_sopir_kenek_leave_unloading_desc' => $request->input('un1_persiapan_sopir_kenek_leave_unloading_desc'),
                'un1_persiapan_isotank_bersih_desc' => $request->input('un1_persiapan_isotank_bersih_desc'),
                'un1_persiapan_label_segel_terpasang_desc' => $request->input('un1_persiapan_label_segel_terpasang_desc'),
                'un1_persiapan_kenakan_ppe_tambahan_desc' => $request->input('un1_persiapan_kenakan_ppe_tambahan_desc'),
                'un1_persiapan_pasang_penampung_tetesan_desc' => $request->input('un1_persiapan_pasang_penampung_tetesan_desc'),
                'un1_persiapan_cek_coupling_station_desc' => $request->input('un1_persiapan_cek_coupling_station_desc'),
                'un1_persiapan_bukasegel_ambil_sampel_desc' => $request->input('un1_persiapan_bukasegel_ambil_sampel_desc'),
                'un1_persiapan_kirim_sample_desc' => $request->input('un1_persiapan_kirim_sample_desc'),
                'un1_persiapan_18a_level_awal_persen' => $request->input('un1_persiapan_18a_level_awal_persen'),
                'un1_persiapan_18a_level_max_kg' => $request->input('un1_persiapan_18a_level_max_kg'),
                'un1_persiapan_18a_level_max_persen' => $request->input('un1_persiapan_18a_level_max_persen'),
                'un1_persiapan_18a_level_diisi_kg' => $request->input('un1_persiapan_18a_level_diisi_kg'),
                'un1_persiapan_18a_level_diisi_persen' => $request->input('un1_persiapan_18a_level_diisi_persen'),
                'un1_persiapan_18b_level_awal_kg' => $request->input('un1_persiapan_18b_level_awal_kg'),
                'un1_persiapan_18b_level_awal_persen' => $request->input('un1_persiapan_18b_level_awal_persen'),
                'un1_persiapan_18b_level_max_kg' => $request->input('un1_persiapan_18b_level_max_kg'),
                'un1_persiapan_18b_level_max_persen' => $request->input('un1_persiapan_18b_level_max_persen'),
                'un1_persiapan_18b_level_diisi_kg' => $request->input('un1_persiapan_18b_level_diisi_kg'),
                'un1_persiapan_18b_level_diisi_persen' => $request->input('un1_persiapan_18b_level_diisi_persen'),
                'un1_persiapan_check_fullbody_harness_desc' => $request->input('un1_persiapan_check_fullbody_harness_desc'),
                'un1_persiapan_petugas_naik_body_isotank_desc' => $request->input('un1_persiapan_petugas_naik_body_isotank_desc'),
                'un1_unloading_buttom_valve_dibuka_penuh_desc' => $request->input('un1_unloading_buttom_valve_dibuka_penuh_desc'),
                'un1_unloading_hidupkan_mesinDCS_desc' => $request->input('un1_unloading_hidupkan_mesinDCS_desc'),
                'un1_unloading_cek_pipa_coupling_valve_tidak_bocor_desc' => $request->input('un1_unloading_cek_pipa_coupling_valve_tidak_bocor_desc'),
                'un1_unloading_pastikan_unloading_aman_desc' => $request->input('un1_unloading_pastikan_unloading_aman_desc'),
                'un1_unloading_periksa_pompa_desc' => $request->input('un1_unloading_periksa_pompa_desc'),
                'un1_selesai_unloading_selesai_desc' => $request->input('un1_selesai_unloading_selesai_desc'),
                'un1_selesai_matikan_pompa_desc' => $request->input('un1_selesai_matikan_pompa_desc'),
                'un1_selesai_tutup_valve_desc' => $request->input('un1_selesai_tutup_valve_desc'),
                'un1_selesai_petugas_naik_tutup_venting_system_desc' => $request->input('un1_selesai_petugas_naik_tutup_venting_system_desc'),
                'un1_selesai_pastikan_wadah_penampung_masih_ada_desc' => $request->input('un1_selesai_pastikan_wadah_penampung_masih_ada_desc'),
                'un1_selesai_tutup_hose_dg_caphose_desc' => $request->input('un1_selesai_tutup_hose_dg_caphose_desc'),
                'un1_selesai_simpanan_coupling_dg_aman_desc' => $request->input('un1_selesai_simpanan_coupling_dg_aman_desc'),
                'un1_selesai_periksa_valve_ditutup_desc' => $request->input('un1_selesai_periksa_valve_ditutup_desc'),
                'un1_selesai_panggil_sopir_kembali_desc' => $request->input('un1_selesai_panggil_sopir_kembali_desc'),
                'un1_selesai_lepas_pengganjal_roda_safetycone_desc' => $request->input('un1_selesai_lepas_pengganjal_roda_safetycone_desc'),
                'un1_selesai_pastikan_peralatan_tidak_terbawa_truck_desc' => $request->input('un1_selesai_pastikan_peralatan_tidak_terbawa_truck_desc'),
                'un1_selesai_lakukan_timbang_akhir_desc' => $request->input('un1_selesai_lakukan_timbang_akhir_desc'),
                'un1_netto_disuratjalan' => $request->input('un1_netto_disuratjalan'),
                'un1_netto_hasil_timbang' => $request->input('un1_netto_hasil_timbang'),
                'un1_pemeriksa' => $request->input('un1_pemeriksa'),
                'un1_signature_employee' => $request->input('un1_signature_employee'),
                'un1_signature_checker' => $request->input('un1_signature_checker'),
                'un1_delete_reason' => $request->input('un1_delete_reason'),
                'un1_reason_cancel_load_unload' => $request->input('un1_reason_cancel_load_unload'),
            ]);

            $gate->update([
                'gateable_id' => $formUnloadingFaC12->id,
                'gateable_type' => "App\Model\FormUnloadingFaC12"
                ]);
            return response()->json([
                'code' => 200,
                'message' => 'Success '.$isCreate.' FormUnloadingFaC12 Form',
                'data' => [
                    $formUnloadingFaC12]
                ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given E Gate Form ID not found',
                'data' => []
                ], 404);
        }
    }

    public function approveFormUnloadingFaC12(Request $request){
        $formId = $request->input('form_id');
        try{
            $formUnloadingFaC12 = $employee->formUnloadingFaC12()->findOrFail($formId);
            $formUnloadingFaC12->update([
                'un1_status' => 2,
            ]);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given FormUnloadingFaC12 Form ID not found',
                'data' => []
                ], 404);
        }
    }
}
