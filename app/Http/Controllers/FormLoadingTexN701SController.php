<?php

namespace App\Http\Controllers;

use App\Models\FormEGateCheck;
use App\Models\FormLoadingTexN701S;
use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class FormLoadingTexN701SController extends Controller
{
    public function viewAll(){
        return response()->json([
            'code' => 200,
            'message' => 'Success Fetch All Data',
            'data' =>
            FormLoadingTexN701S::all()
            ], 200);
    }
    public function createOrUpdate(Request $request){
        $this->validate($request, [
            // 'form_id' => 'integer',
            'gate_id' => 'required',
            'ul1_persiapan_memakai_ppe' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_cek_hose_piping' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_safety_shower' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_operator_terima_dokumen' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_arahkan_truk_parkir' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_ganjal_roda' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_safety_cone_didepan_truk' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_sopir_serahkan_kunci' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_sopir_kenek_leave_unloading' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_isotank_bersih' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_isotank_sdh_dicek_qc' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_isotank_bekas_pengisian_kemarin' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_webbing' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_D_rings' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_carabiner' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_buckles' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_lanyard' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_shockabsorber_pack' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_fall_arrester' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_petugas_naik_ke_isotank' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_pasang_high_switch_level' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_hose_piping_tdk_bocor' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_cek_sisa_produk_tersedia' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_pastikan_isotank_kosong' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_ambil_hose_sesuai' => ['integer', Rule::in(['0','1','2']),],
            'ul1_persiapan_ambil_sample_awal' => ['integer', Rule::in(['0','1','2']),],
            'ul1_loading_buka_valve_storage' => ['integer', Rule::in(['0','1','2']),],
            'ul1_loading_hidupkan_dcs' => ['integer', Rule::in(['0','1','2']),],
            'ul1_loading_cek_pipa_tidak_bocor' => ['integer', Rule::in(['0','1','2']),],
            'ul1_loading_periksa_massflow_meter_baik' => ['integer', Rule::in(['0','1','2']),],
            'ul1_selesai_ambil_sample_akhir' => ['integer', Rule::in(['0','1','2']),],
            'ul1_selesai_tutup_valve_isotank' => ['integer', Rule::in(['0','1','2']),],
            'ul1_selesai_pastikan_produk_mendekati_kuantiti' => ['integer', Rule::in(['0','1','2']),],
            'ul1_selesai_tutup_hose' => ['integer', Rule::in(['0','1','2']),],
            'ul1_selesai_tutup_venting_system' => ['integer', Rule::in(['0','1','2']),],
            'ul1_selesai_pastikan_semua_valve_tertutup' => ['integer', Rule::in(['0','1','2']),],
            'ul1_selesai_lepas_pengganjal_ban' => ['integer', Rule::in(['0','1','2']),],
            'ul1_selesai_panggil_sopir_kembali' => ['integer', Rule::in(['0','1','2']),],
            'ul1_selesai_pastikan_peralatan_tidak_terbawa_truk' => ['integer', Rule::in(['0','1','2']),],
            'ul1_selesai_lakukan_timbang_akhir' => ['integer', Rule::in(['0','1','2']),],
            'ul1_selesai_pastikan_qty_pas' => ['integer', Rule::in(['0','1','2']),],
            'ul1_selesai_tandatangan_serahterima' => ['integer', Rule::in(['0','1','2']),],
            'ul1_status' => ['integer', Rule::in(['0','1']),],
            'ul1_operator_complete' => ['integer', Rule::in(['0','1','2']),],
            'ul1_checker_complete' => ['integer', Rule::in(['0','1','2']),],
            'ul1_cancel_load_unload' => ['integer', Rule::in(['0','1','2']),],
            'ul1_report_code' => 'string|max:255',
            'ul1_nama_produk' => 'string|max:255',
            'ul1_batch_no' => 'string|max:255',
            'ul1_no_storage1' => 'string|max:255',
            'ul1_level_awal1' => 'string|max:255',
            'ul1_level_akhir1' => 'string|max:255',
            'ul1_no_storage2' => 'string|max:255',
            'ul1_level_awal2' => 'string|max:255',
            'ul1_level_akhir2' => 'string|max:255',
            'ul1_jml_dimuat' =>
            'ul1_persiapan_check_fullbody_harness_desc' => 'string|max:255',
            'ul1_persiapan_memakai_ppe_desc' => 'string|max:255',
            'ul1_persiapan_cek_hose_piping_desc' => 'string|max:255',
            'ul1_persiapan_safety_shower_desc' => 'string|max:255',
            'ul1_persiapan_operator_terima_dokumen_desc' => 'string|max:255',
            'ul1_persiapan_arahkan_truk_parkir_desc' => 'string|max:255',
            'ul1_persiapan_ganjal_roda_desc' => 'string|max:255',
            'ul1_persiapan_safety_cone_didepan_truk_desc' => 'string|max:255',
            'ul1_persiapan_sopir_serahkan_kunci_desc' => 'string|max:255',
            'ul1_persiapan_sopir_kenek_leave_unloading_desc' => 'string|max:255',
            'ul1_persiapan_isotank_bersih_desc' => 'string|max:255',
            'ul1_persiapan_isotank_sdh_dicek_qc_desc' => 'string|max:255',
            'ul1_persiapan_isotank_bekas_pengisian_kemarin_desc' => 'string|max:255',
            'ul1_persiapan_petugas_naik_ke_isotank_dec' => 'string|max:255',
            'ul1_persiapan_pasang_high_switch_level_desc' => 'string|max:255',
            'ul1_persiapan_hose_piping_tdk_bocor_desc' => 'string|max:255',
            'ul1_persiapan_cek_sisa_produk_tersedia_desc' => 'string|max:255',
            'ul1_persiapan_pastikan_isotank_kosong_desc' => 'string|max:255',
            'ul1_persiapan_ambil_hose_sesuai_desc' => 'string|max:255',
            'ul1_persiapan_ambil_sample_awal_desc' => 'string|max:255',
            'ul1_loading_buka_valve_storage_desc' => 'string|max:255',
            'ul1_loading_hidupkan_dcs_desc' => 'string|max:255',
            'ul1_loading_cek_pipa_tidak_bocor_desc' => 'string|max:255',
            'ul1_loading_periksa_massflow_meter_baik_desc' => 'string|max:255',
            'ul1_selesai_ambil_sample_akhir_desc' => 'string|max:255',
            'ul1_selesai_tutup_valve_isotank_desc' => 'string|max:255',
            'ul1_selesai_volume_isotank_diisi' => 'string|max:255',
            'ul1_selesai_pastikan_produk_mendekati_kuantiti_desc' => 'string|max:255',
            'ul1_selesai_tutup_hose_desc' => 'string|max:255',
            'ul1_selesai_tutup_venting_system_desc' => 'string|max:255',
            'ul1_selesai_pastikan_semua_valve_tertutup_desc' => 'string|max:255',
            'ul1_selesai_lepas_pengganjal_ban_desc' => 'string|max:255',
            'ul1_selesai_panggil_sopir_kembali_desc' => 'string|max:255',
            'ul1_selesai_pastikan_peralatan_tidak_terbawa_truk_desc' => 'string|max:255',
            'ul1_selesai_lakukan_timbang_akhir_desc' => 'string|max:255',
            'ul1_netto_disuratjalan' => 'string|max:255',
            'ul1_netto_hasil_timbang' => 'string|max:255',
            'ul1_pemeriksa' => 'string|max:255',
            // 'ul1_signature_employee' => 'file',
            // 'ul1_signature_checker' => 'file',
            'ul1_delete_reason' => 'string|max:255',
            'ul1_reason_cancel_load_unload' => 'string|max:255',
        ]);

        $employee = Auth::user();
        try{
            $formId = $request->input('form_id');
            $gate = FormEGateCheck::findOrFail($request->input('gate_id'));
            if( $formId != null || $formId != 0){
                $isCreate = "Update";
                try{
                    $formLoadingTexN701S = $employee->formLoadingTexN701S()->findOrFail($formId);
                    if($gate->gateable_id != $formId && $gate->gateable_type != 'App\Models\FormLoadingTexN701S'){
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
                        'message' => 'Given FormLoadingTexN701S Form ID not found',
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

                $formLoadingTexN701S = FormLoadingTexN701S::create([
                    'ul1_employee_id' => $employee->id,
                    'ul1_report_kendaraan_id' => $gate->id,
                ]);

            }

            $formLoadingTexN701S->update([
                // 'ul1_employee_id' => $employee->id,
                // 'ul1_report_kendaraan_id' => $gate->id,

                'ul1_persiapan_memakai_ppe' => (int) $request->input('ul1_persiapan_memakai_ppe'),
                'ul1_persiapan_cek_hose_piping' => (int) $request->input('ul1_persiapan_cek_hose_piping'),
                'ul1_persiapan_safety_shower' => (int) $request->input('ul1_persiapan_safety_shower'),
                'ul1_persiapan_operator_terima_dokumen' => (int) $request->input('ul1_persiapan_operator_terima_dokumen'),
                'ul1_persiapan_arahkan_truk_parkir' => (int) $request->input('ul1_persiapan_arahkan_truk_parkir'),
                'ul1_persiapan_ganjal_roda' => (int) $request->input('ul1_persiapan_ganjal_roda'),
                'ul1_persiapan_safety_cone_didepan_truk' => (int) $request->input('ul1_persiapan_safety_cone_didepan_truk'),
                'ul1_persiapan_sopir_serahkan_kunci' => (int) $request->input('ul1_persiapan_sopir_serahkan_kunci'),
                'ul1_persiapan_sopir_kenek_leave_unloading' => (int) $request->input('ul1_persiapan_sopir_kenek_leave_unloading'),
                'ul1_persiapan_isotank_bersih' => (int) $request->input('ul1_persiapan_isotank_bersih'),
                'ul1_persiapan_isotank_sdh_dicek_qc' => (int) $request->input('ul1_persiapan_isotank_sdh_dicek_qc'),
                'ul1_persiapan_isotank_bekas_pengisian_kemarin' => (int) $request->input('ul1_persiapan_isotank_bekas_pengisian_kemarin'),
                'ul1_persiapan_check_fullbody_harness_desc' => $request->input('ul1_persiapan_check_fullbody_harness_desc'),
                'ul1_persiapan_webbing' => (int) $request->input('ul1_persiapan_webbing'),
                'ul1_persiapan_D_rings' => (int) $request->input('ul1_persiapan_D_rings'),
                'ul1_persiapan_carabiner' => (int) $request->input('ul1_persiapan_carabiner'),
                'ul1_persiapan_buckles' => (int) $request->input('ul1_persiapan_buckles'),
                'ul1_persiapan_lanyard' => (int) $request->input('ul1_persiapan_lanyard'),
                'ul1_persiapan_shockabsorber_pack' => (int) $request->input('ul1_persiapan_shockabsorber_pack'),
                'ul1_persiapan_fall_arrester' => (int) $request->input('ul1_persiapan_fall_arrester'),
                'ul1_persiapan_petugas_naik_ke_isotank' => (int) $request->input('ul1_persiapan_petugas_naik_ke_isotank'),
                'ul1_persiapan_pasang_high_switch_level' => (int) $request->input('ul1_persiapan_pasang_high_switch_level'),
                'ul1_persiapan_hose_piping_tdk_bocor' => (int) $request->input('ul1_persiapan_hose_piping_tdk_bocor'),
                'ul1_persiapan_cek_sisa_produk_tersedia' => (int) $request->input('ul1_persiapan_cek_sisa_produk_tersedia'),
                'ul1_persiapan_pastikan_isotank_kosong' => (int) $request->input('ul1_persiapan_pastikan_isotank_kosong'),
                'ul1_persiapan_ambil_hose_sesuai' => (int) $request->input('ul1_persiapan_ambil_hose_sesuai'),
                'ul1_persiapan_ambil_sample_awal' => (int) $request->input('ul1_persiapan_ambil_sample_awal'),
                'ul1_loading_buka_valve_storage' => (int) $request->input('ul1_loading_buka_valve_storage'),
                'ul1_loading_hidupkan_dcs' => (int) $request->input('ul1_loading_hidupkan_dcs'),
                'ul1_loading_cek_pipa_tidak_bocor' => (int) $request->input('ul1_loading_cek_pipa_tidak_bocor'),
                'ul1_loading_periksa_massflow_meter_baik' => (int) $request->input('ul1_loading_periksa_massflow_meter_baik'),
                'ul1_selesai_ambil_sample_akhir' => (int) $request->input('ul1_selesai_ambil_sample_akhir'),
                'ul1_selesai_tutup_valve_isotank' => (int) $request->input('ul1_selesai_tutup_valve_isotank'),
                'ul1_selesai_pastikan_produk_mendekati_kuantiti' => (int) $request->input('ul1_selesai_pastikan_produk_mendekati_kuantiti'),
                'ul1_selesai_tutup_hose' => (int) $request->input('ul1_selesai_tutup_hose'),
                'ul1_selesai_tutup_venting_system' => (int) $request->input('ul1_selesai_tutup_venting_system'),
                'ul1_selesai_pastikan_semua_valve_tertutup' => (int) $request->input('ul1_selesai_pastikan_semua_valve_tertutup'),
                'ul1_selesai_lepas_pengganjal_ban' => (int) $request->input('ul1_selesai_lepas_pengganjal_ban'),
                'ul1_selesai_panggil_sopir_kembali' => (int) $request->input('ul1_selesai_panggil_sopir_kembali'),
                'ul1_selesai_pastikan_peralatan_tidak_terbawa_truk' => (int) $request->input('ul1_selesai_pastikan_peralatan_tidak_terbawa_truk'),
                'ul1_selesai_lakukan_timbang_akhir' => (int) $request->input('ul1_selesai_lakukan_timbang_akhir'),
                'ul1_selesai_pastikan_qty_pas' => (int) $request->input('ul1_selesai_pastikan_qty_pas'),
                'ul1_selesai_tandatangan_serahterima' => (int) $request->input('ul1_selesai_tandatangan_serahterima'),
                'ul1_status' => (int) $request->input('ul1_status'),
                'ul1_operator_complete' => (int) $request->input('ul1_operator_complete'),
                'ul1_checker_complete' => (int) $request->input('ul1_checker_complete'),
                'ul1_cancel_load_unload' => (int) $request->input('ul1_cancel_load_unload'),

                'ul1_report_code' => $request->input('ul1_report_code'),
                'ul1_nama_produk' => $request->input('ul1_nama_produk'),
                'ul1_batch_no' => $request->input('ul1_batch_no'),
                'ul1_no_storage1' => $request->input('ul1_no_storage1'),
                'ul1_level_awal1' => $request->input('ul1_level_awal1'),
                'ul1_level_akhir1' => $request->input('ul1_level_akhir1'),
                'ul1_no_storage2' => $request->input('ul1_no_storage2'),
                'ul1_level_awal2' => $request->input('ul1_level_awal2'),
                'ul1_level_akhir2' => $request->input('ul1_level_akhir2'),
                'ul1_jml_dimuat' => $request->input('ul1_jml_dimuat'),
                'ul1_persiapan_memakai_ppe_desc' => $request->input('ul1_persiapan_memakai_ppe_desc'),
                'ul1_persiapan_cek_hose_piping_desc' => $request->input('ul1_persiapan_cek_hose_piping_desc'),
                'ul1_persiapan_safety_shower_desc' => $request->input('ul1_persiapan_safety_shower_desc'),
                'ul1_persiapan_operator_terima_dokumen_desc' => $request->input('ul1_persiapan_operator_terima_dokumen_desc'),
                'ul1_persiapan_arahkan_truk_parkir_desc' => $request->input('ul1_persiapan_arahkan_truk_parkir_desc'),
                'ul1_persiapan_ganjal_roda_desc' => $request->input('ul1_persiapan_ganjal_roda_desc'),
                'ul1_persiapan_safety_cone_didepan_truk_desc' => $request->input('ul1_persiapan_safety_cone_didepan_truk_desc'),
                'ul1_persiapan_sopir_serahkan_kunci_desc' => $request->input('ul1_persiapan_sopir_serahkan_kunci_desc'),
                'ul1_persiapan_sopir_kenek_leave_unloading_desc' => $request->input('ul1_persiapan_sopir_kenek_leave_unloading_desc'),
                'ul1_persiapan_isotank_bersih_desc' => $request->input('ul1_persiapan_isotank_bersih_desc'),
                'ul1_persiapan_isotank_sdh_dicek_qc_desc' => $request->input('ul1_persiapan_isotank_sdh_dicek_qc_desc'),
                'ul1_persiapan_isotank_bekas_pengisian_kemarin_desc' => $request->input('ul1_persiapan_isotank_bekas_pengisian_kemarin_desc'),
                'ul1_persiapan_petugas_naik_ke_isotank_dec' => $request->input('ul1_persiapan_petugas_naik_ke_isotank_dec'),
                'ul1_persiapan_pasang_high_switch_level_desc' => $request->input('ul1_persiapan_pasang_high_switch_level_desc'),
                'ul1_persiapan_hose_piping_tdk_bocor_desc' => $request->input('ul1_persiapan_hose_piping_tdk_bocor_desc'),
                'ul1_persiapan_cek_sisa_produk_tersedia_desc' => $request->input('ul1_persiapan_cek_sisa_produk_tersedia_desc'),
                'ul1_persiapan_pastikan_isotank_kosong_desc' => $request->input('ul1_persiapan_pastikan_isotank_kosong_desc'),
                'ul1_persiapan_ambil_hose_sesuai_desc' => $request->input('ul1_persiapan_ambil_hose_sesuai_desc'),
                'ul1_persiapan_ambil_sample_awal_desc' => $request->input('ul1_persiapan_ambil_sample_awal_desc'),
                'ul1_loading_buka_valve_storage_desc' => $request->input('ul1_loading_buka_valve_storage_desc'),
                'ul1_loading_hidupkan_dcs_desc' => $request->input('ul1_loading_hidupkan_dcs_desc'),
                'ul1_loading_cek_pipa_tidak_bocor_desc' => $request->input('ul1_loading_cek_pipa_tidak_bocor_desc'),
                'ul1_loading_periksa_massflow_meter_baik_desc' => $request->input('ul1_loading_periksa_massflow_meter_baik_desc'),
                'ul1_selesai_ambil_sample_akhir_desc' => $request->input('ul1_selesai_ambil_sample_akhir_desc'),
                'ul1_selesai_tutup_valve_isotank_desc' => $request->input('ul1_selesai_tutup_valve_isotank_desc'),
                'ul1_selesai_volume_isotank_diisi' => $request->input('ul1_selesai_volume_isotank_diisi'),
                'ul1_selesai_pastikan_produk_mendekati_kuantiti_desc' => $request->input('ul1_selesai_pastikan_produk_mendekati_kuantiti_desc'),
                'ul1_selesai_tutup_hose_desc' => $request->input('ul1_selesai_tutup_hose_desc'),
                'ul1_selesai_tutup_venting_system_desc' => $request->input('ul1_selesai_tutup_venting_system_desc'),
                'ul1_selesai_pastikan_semua_valve_tertutup_desc' => $request->input('ul1_selesai_pastikan_semua_valve_tertutup_desc'),
                'ul1_selesai_lepas_pengganjal_ban_desc' => $request->input('ul1_selesai_lepas_pengganjal_ban_desc'),
                'ul1_selesai_panggil_sopir_kembali_desc' => $request->input('ul1_selesai_panggil_sopir_kembali_desc'),
                'ul1_selesai_pastikan_peralatan_tidak_terbawa_truk_desc' => $request->input('ul1_selesai_pastikan_peralatan_tidak_terbawa_truk_desc'),
                'ul1_selesai_lakukan_timbang_akhir_desc' => $request->input('ul1_selesai_lakukan_timbang_akhir_desc'),
                'ul1_netto_disuratjalan' => $request->input('ul1_netto_disuratjalan'),
                'ul1_netto_hasil_timbang' => $request->input('ul1_netto_hasil_timbang'),
                'ul1_pemeriksa' => $request->input('ul1_pemeriksa'),
                // 'ul1_signature_employee' => $request->input('ul1_signature_employee'),
                // 'ul1_signature_checker' => $request->input('ul1_signature_checker'),
                'ul1_delete_reason' => $request->input('ul1_delete_reason'),
                'ul1_reason_cancel_load_unload' => $request->input('ul1_reason_cancel_load_unload'),
            ]);
            $gate->update([
                'gateable_id' => $formLoadingTexN701S->id,
                'gateable_type' => "App\Models\FormLoadingTexN701S"
                ]);

                if($request->input('ul1_signature_checker')){
                    $decodedDocs = base64_decode($request->input('ul1_signature_checker'));


                    $name = time()."someone_that_i_used_to_know.png";
                    file_put_contents('uploads/loading/signatures/'.$name, $decodedDocs);


                    $formLoadingTexN701S->update(
                        [
                            'ul1_signature_checker' => $name,
                            ]
                        );

                }
                if($request->input('ul1_signature_employee')){
                    $decodedDocs = base64_decode($request->input('ul1_signature_employee'));


                    $name = time()."someone_that_i_used_to_know.png";
                    file_put_contents('uploads/loading/signatures/'.$name, $decodedDocs);


                    $formLoadingTexN701S->update(
                        [
                            'ul1_signature_employee' => $name,
                            ]
                        );

                }
            return response()->json([
                'code' => 200,
                'message' => 'Success '.$isCreate.' FormLoadingTexN701S Form',
                'data' => [
                    $formLoadingTexN701S]
                ], 200);


        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given E Gate Form ID not found',
                'data' => [$request->input('gate_id')]
                ], 404);
        }
    }

    public function approve($formId){
        // $formId = $request->input('form_id');
        $employee = Auth::user();

        try{
            $formLoadingTexN701S = $employee->formLoadingTexN701S()->findOrFail($formId);
            $formLoadingTexN701S->update([
                'ul1_status' => 2,
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Success Approve FormLoadingTexN701S Form',
                'data' => [
                    $formLoadingTexN701S]
                ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given FormLoadingTexN701S Form ID not found',
                'data' => []
                ], 404);
        }
    }

    public function getOne($formId){

        $employee = Auth::user();

        try{
            $formLoadingTexN701S = $employee->formLoadingTexN701S()->findOrFail($formId);

            return response()->json([
                'code' => 200,
                'message' => 'Success Fetch FormLoadingTexN701S Form',
                'data' => [
                    $formLoadingTexN701S]
                ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given FormLoadingTexN701S Form ID not found',
                'data' => []
                ], 404);
        }
    }
}
