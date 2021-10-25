<?php

namespace App\Http\Controllers;

use App\Models\FormEGateCheck;
use App\Models\FormUnloadingSulphurLiquid;
use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class FormUnloadingSulphurLiquidController extends Controller
{
    public function viewAll(){
        return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' =>
            FormUnloadingSulphurLiquid::all()
            ], 200);
    }
    public function createOrUpdate(Request $request){
        $this->validate($request, [
            'form_id' => 'integer',
            'gate_id' => 'required|integer',

            'un6_persiapan_memakai_ppe' => ['integer', Rule::in(['0','1','2']),],
            'un6_persiapan_cek_hose_piping' => ['integer', Rule::in(['0','1','2']),],
            'un6_persiapan_safety_shower' => ['integer', Rule::in(['0','1','2']),],
            'un6_persiapan_operator_terima_dokumen' => ['integer', Rule::in(['0','1','2']),],
            'un6_persiapan_arahkan_truk_parkir' => ['integer', Rule::in(['0','1','2']),],
            'un6_persiapan_ganjal_roda' => ['integer', Rule::in(['0','1','2']),],
            'un6_persiapan_safety_cone' => ['integer', Rule::in(['0','1','2']),],
            'un6_persiapan_verifikasi_fisik' => ['integer', Rule::in(['0','1','2']),],
            'un6_persiapan_sopir_serahkan_kunci' => ['integer', Rule::in(['0','1','2']),],
            'un6_persiapan_sopir_kenek_leave_unloading' => ['integer', Rule::in(['0','1','2']),],
            'un6_persiapan_isotank_bersih' => ['integer', Rule::in(['0','1','2']),],
            'un6_persiapan_label_segel_terpasang' => ['integer', Rule::in(['0','1','2']),],
            'un6_persiapan_pastikan_pipa_tidak_bocor' => ['integer', Rule::in(['0','1','2']),],
            'un6_persiapan_periksa_kabel_grounding' => ['integer', Rule::in(['0','1','2']),],
            'un6_persiapan_kabel_grounding_dipasang' => ['integer', Rule::in(['0','1','2']),],
            'un6_persiapan_cek_pompa' => ['integer', Rule::in(['0','1','2']),],
            'un6_persiapan_pasang_wadah_penampung' => ['integer', Rule::in(['0','1','2']),],
            'un6_persiapan_pasang_hose_steam' => ['integer', Rule::in(['0','1','2']),],
            'un6_persiapan_periksa_level_storage' => ['integer', Rule::in(['0','1','2']),],
            'un6_unloading_pakai_goggles' => ['integer', Rule::in(['0','1','2']),],
            'un6_unloading_check_fullbody_harness_desc' => ['integer', Rule::in(['0','1','2']),],
            'un6_unloading_webbing' => ['integer', Rule::in(['0','1','2']),],
            'un6_unloading_D_rings' => ['integer', Rule::in(['0','1','2']),],
            'un6_unloading_buckles' => ['integer', Rule::in(['0','1','2']),],
            'un6_unloading_carabiner' => ['integer', Rule::in(['0','1','2']),],
            'un6_unloading_lanyard' => ['integer', Rule::in(['0','1','2']),],
            'un6_unloading_shockabsorber_pack' => ['integer', Rule::in(['0','1','2']),],
            'un6_unloading_fall_arrester' => ['integer', Rule::in(['0','1','2']),],
            'un6_unloading_hidupkan_dcs' => ['integer', Rule::in(['0','1','2']),],
            'un6_unloading_cek_pipa_coupling_valve_tidak_bocor' => ['integer', Rule::in(['0','1','2']),],
            'un6_unloading_pastikan_unloading_aman' => ['integer', Rule::in(['0','1','2']),],
            'un6_selesai_unloading_selesai' => ['integer', Rule::in(['0','1','2']),],
            'un6_selesai_matikan_pompa' => ['integer', Rule::in(['0','1','2']),],
            'un6_selesai_tutup_aliran_steam' => ['integer', Rule::in(['0','1','2']),],
            'un6_selesai_tutup_valve_lorry' => ['integer', Rule::in(['0','1','2']),],
            'un6_selesai_tutup_valve_storage' => ['integer', Rule::in(['0','1','2']),],
            'un6_selesai_periksa_valve_ditutup' => ['integer', Rule::in(['0','1','2']),],
            'un6_selesai_lepas_kabel_grounding' => ['integer', Rule::in(['0','1','2']),],
            'un6_selesai_panggil_sopir_kembali' => ['integer', Rule::in(['0','1','2']),],
            'un6_selesai_pastikan_peralatan_tidak_terbawa_truk' => ['integer', Rule::in(['0','1','2']),],
            'un6_selesai_lakukan_timbang_akhir' => ['integer', Rule::in(['0','1','2']),],
            'un6_selesai_pastikan_qty_pas' => ['integer', Rule::in(['0','1','2']),],
            'un6_selesai_tandatangan_serahterima' => ['integer', Rule::in(['0','1','2']),],
            'un6_status' => ['integer', Rule::in(['0','1']),],
            'un6_operator_complete' => ['integer', Rule::in(['0','1','2']),],
            'un6_checker_complete' => ['integer', Rule::in(['0','1','2']),],
            'un6_cancel_load_unload' => ['integer', Rule::in(['0','1','2']),],

            'un6_report_code' => 'string|max:255',
            'un6_batch_no' => 'string|max:255',
            'un6_no_storage' => 'string|max:255',
            'un6_level_awal' => 'string|max:255',
            'un6_level_akhir' => 'string|max:255',
            'un6_jml_dimuat' => 'string|max:255',
            'un6_persiapan_memakai_ppe_desc' => 'string|max:255',
            'un6_persiapan_cek_hose_piping_desc' => 'string|max:255',
            'un6_persiapan_safety_shower_desc' => 'string|max:255',
            'un6_persiapan_operator_terima_dokumen_desc' => 'string|max:255',
            'un6_persiapan_arahkan_truk_parkir_desc' => 'string|max:255',
            'un6_persiapan_ganjal_roda_desc' => 'string|max:255',
            'un6_persiapan_safety_cone_desc' => 'string|max:255',
            'un6_persiapan_verifikasi_fisik_desc' => 'string|max:255',
            'un6_persiapan_sopir_serahkan_kunci_desc' => 'string|max:255',
            'un6_persiapan_sopir_kenek_leave_unloading_desc' => 'string|max:255',
            'un6_persiapan_isotank_bersih_desc' => 'string|max:255',
            'un6_persiapan_label_segel_terpasang_desc' => 'string|max:255',
            'un6_persiapan_pastikan_pipa_tidak_bocor_desc' => 'string|max:255',
            'un6_persiapan_periksa_kabel_grounding_desc' => 'string|max:255',
            'un6_persiapan_kabel_grounding_dipasang_desc' => 'string|max:255',
            'un6_persiapan_cek_pompa_desc' => 'string|max:255',
            'un6_persiapan_pasang_wadah_penampung_desc' => 'string|max:255',
            'un6_persiapan_pasang_hose_steam_desc' => 'string|max:255',
            'un6_persiapan_periksa_level_storage_desc' => 'string|max:255',
            'un6_unloading_pakai_goggles_desc' => 'string|max:255',
            'un6_unloading_hidupkan_dcs_desc' => 'string|max:255',
            'un6_unloading_cek_pipa_coupling_valve_tidak_bocor_desc' => 'string|max:255',
            'un6_unloading_pastikan_unloading_aman_desc' => 'string|max:255',
            'un6_selesai_unloading_selesai_desc' => 'string|max:255',
            'un6_selesai_matikan_pompa_desc' => 'string|max:255',
            'un6_selesai_tutup_aliran_steam_desc' => 'string|max:255',
            'un6_selesai_tutup_valve_lorry_desc' => 'string|max:255',
            'un6_selesai_tutup_valve_storage_desc' => 'string|max:255',
            'un6_selesai_periksa_valve_ditutup_desc' => 'string|max:255',
            'un6_selesai_lepas_kabel_grounding_desc' => 'string|max:255',
            'un6_selesai_panggil_sopir_kembali_desc' => 'string|max:255',
            'un6_selesai_pastikan_peralatan_tidak_terbawa_truk_desc' => 'string|max:255',
            'un6_selesai_lakukan_timbang_akhir_desc' => 'string|max:255',
            'un6_netto_disuratjalan' => 'string|max:255',
            'un6_netto_hasil_timbang' => 'string|max:255',
            'un6_pemeriksa' => 'string|max:255',
            // 'un6_signature_employee' => 'file',
            // 'un6_signature_checker' => 'file',
            'un6_delete_reason' => 'string|max:255',
            'un6_reason_cancel_load_unload' => 'string|max:255',

        ]);

        $employee = Auth::user();
        try{
            $formId = $request->input('form_id');
            $gate = FormEGateCheck::findOrFail($request->input('gate_id'));
            if( $formId != null || $formId != 0){
                $isCreate = "Update";

                try{
                    $formUnloadingSulphurLiquid = $employee->formUnloadingSulphurLiquid()->findOrFail($formId);

                    if($gate->gateable_id != $formId && $gate->gateable_type != 'App\Models\FormUnloadingSulphurLiquid'){
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
                        'message' => 'Given FormUnloadingSulphurLiquid Form ID not found',
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

                $formUnloadingSulphurLiquid = FormUnloadingSulphurLiquid::create([
                    'un6_employee_id' => $employee->id,
                    'un6_report_kendaraan_id' => $gate->id,
                ]);
            }
            $formUnloadingSulphurLiquid->update([
                'un6_persiapan_memakai_ppe' => (int) $request->input('un6_persiapan_memakai_ppe'),
                'un6_persiapan_cek_hose_piping' => (int) $request->input('un6_persiapan_cek_hose_piping'),
                'un6_persiapan_safety_shower' => (int) $request->input('un6_persiapan_safety_shower'),
                'un6_persiapan_operator_terima_dokumen' => (int) $request->input('un6_persiapan_operator_terima_dokumen'),
                'un6_persiapan_arahkan_truk_parkir' => (int) $request->input('un6_persiapan_arahkan_truk_parkir'),
                'un6_persiapan_ganjal_roda' => (int) $request->input('un6_persiapan_ganjal_roda'),
                'un6_persiapan_safety_cone' => (int) $request->input('un6_persiapan_safety_cone'),
                'un6_persiapan_verifikasi_fisik' => (int) $request->input('un6_persiapan_verifikasi_fisik'),
                'un6_persiapan_sopir_serahkan_kunci' => (int) $request->input('un6_persiapan_sopir_serahkan_kunci'),
                'un6_persiapan_sopir_kenek_leave_unloading' => (int) $request->input('un6_persiapan_sopir_kenek_leave_unloading'),
                'un6_persiapan_isotank_bersih' => (int) $request->input('un6_persiapan_isotank_bersih'),
                'un6_persiapan_label_segel_terpasang' => (int) $request->input('un6_persiapan_label_segel_terpasang'),
                'un6_persiapan_pastikan_pipa_tidak_bocor' => (int) $request->input('un6_persiapan_pastikan_pipa_tidak_bocor'),
                'un6_persiapan_periksa_kabel_grounding' => (int) $request->input('un6_persiapan_periksa_kabel_grounding'),
                'un6_persiapan_kabel_grounding_dipasang' => (int) $request->input('un6_persiapan_kabel_grounding_dipasang'),
                'un6_persiapan_cek_pompa' => (int) $request->input('un6_persiapan_cek_pompa'),
                'un6_persiapan_pasang_wadah_penampung' => (int) $request->input('un6_persiapan_pasang_wadah_penampung'),
                'un6_persiapan_pasang_hose_steam' => (int) $request->input('un6_persiapan_pasang_hose_steam'),
                'un6_persiapan_periksa_level_storage' => (int) $request->input('un6_persiapan_periksa_level_storage'),
                'un6_unloading_pakai_goggles' => (int) $request->input('un6_unloading_pakai_goggles'),
                'un6_unloading_check_fullbody_harness_desc' => (int) $request->input('un6_unloading_check_fullbody_harness_desc'),
                'un6_unloading_webbing' => (int) $request->input('un6_unloading_webbing'),
                'un6_unloading_D_rings' => (int) $request->input('un6_unloading_D_rings'),
                'un6_unloading_buckles' => (int) $request->input('un6_unloading_buckles'),
                'un6_unloading_carabiner' => (int) $request->input('un6_unloading_carabiner'),
                'un6_unloading_lanyard' => (int) $request->input('un6_unloading_lanyard'),
                'un6_unloading_shockabsorber_pack' => (int) $request->input('un6_unloading_shockabsorber_pack'),
                'un6_unloading_fall_arrester' => (int) $request->input('un6_unloading_fall_arrester'),
                'un6_unloading_hidupkan_dcs' => (int) $request->input('un6_unloading_hidupkan_dcs'),
                'un6_unloading_cek_pipa_coupling_valve_tidak_bocor' => (int) $request->input('un6_unloading_cek_pipa_coupling_valve_tidak_bocor'),
                'un6_unloading_pastikan_unloading_aman' => (int) $request->input('un6_unloading_pastikan_unloading_aman'),
                'un6_selesai_unloading_selesai' => (int) $request->input('un6_selesai_unloading_selesai'),
                'un6_selesai_matikan_pompa' => (int) $request->input('un6_selesai_matikan_pompa'),
                'un6_selesai_tutup_aliran_steam' => (int) $request->input('un6_selesai_tutup_aliran_steam'),
                'un6_selesai_tutup_valve_lorry' => (int) $request->input('un6_selesai_tutup_valve_lorry'),
                'un6_selesai_tutup_valve_storage' => (int) $request->input('un6_selesai_tutup_valve_storage'),
                'un6_selesai_periksa_valve_ditutup' => (int) $request->input('un6_selesai_periksa_valve_ditutup'),
                'un6_selesai_lepas_kabel_grounding' => (int) $request->input('un6_selesai_lepas_kabel_grounding'),
                'un6_selesai_panggil_sopir_kembali' => (int) $request->input('un6_selesai_panggil_sopir_kembali'),
                'un6_selesai_pastikan_peralatan_tidak_terbawa_truk' => (int) $request->input('un6_selesai_pastikan_peralatan_tidak_terbawa_truk'),
                'un6_selesai_lakukan_timbang_akhir' => (int) $request->input('un6_selesai_lakukan_timbang_akhir'),
                'un6_selesai_pastikan_qty_pas' => (int) $request->input('un6_selesai_pastikan_qty_pas'),
                'un6_selesai_tandatangan_serahterima' => (int) $request->input('un6_selesai_tandatangan_serahterima'),
                'un6_status' => (int) $request->input('un6_status'),
                'un6_operator_complete' => (int) $request->input('un6_operator_complete'),
                'un6_checker_complete' => (int) $request->input('un6_checker_complete'),
                'un6_cancel_load_unload' => (int) $request->input('un6_cancel_load_unload'),

                'un6_report_code' => $request->input('un6_report_code'),
                'un6_batch_no' => $request->input('un6_batch_no'),
                'un6_no_storage' => $request->input('un6_no_storage'),
                'un6_level_awal' => $request->input('un6_level_awal'),
                'un6_level_akhir' => $request->input('un6_level_akhir'),
                'un6_jml_dimuat' => $request->input('un6_jml_dimuat'),
                'un6_persiapan_memakai_ppe_desc' => $request->input('un6_persiapan_memakai_ppe_desc'),
                'un6_persiapan_cek_hose_piping_desc' => $request->input('un6_persiapan_cek_hose_piping_desc'),
                'un6_persiapan_safety_shower_desc' => $request->input('un6_persiapan_safety_shower_desc'),
                'un6_persiapan_operator_terima_dokumen_desc' => $request->input('un6_persiapan_operator_terima_dokumen_desc'),
                'un6_persiapan_arahkan_truk_parkir_desc' => $request->input('un6_persiapan_arahkan_truk_parkir_desc'),
                'un6_persiapan_ganjal_roda_desc' => $request->input('un6_persiapan_ganjal_roda_desc'),
                'un6_persiapan_safety_cone_desc' => $request->input('un6_persiapan_safety_cone_desc'),
                'un6_persiapan_verifikasi_fisik_desc' => $request->input('un6_persiapan_verifikasi_fisik_desc'),
                'un6_persiapan_sopir_serahkan_kunci_desc' => $request->input('un6_persiapan_sopir_serahkan_kunci_desc'),
                'un6_persiapan_sopir_kenek_leave_unloading_desc' => $request->input('un6_persiapan_sopir_kenek_leave_unloading_desc'),
                'un6_persiapan_isotank_bersih_desc' => $request->input('un6_persiapan_isotank_bersih_desc'),
                'un6_persiapan_label_segel_terpasang_desc' => $request->input('un6_persiapan_label_segel_terpasang_desc'),
                'un6_persiapan_pastikan_pipa_tidak_bocor_desc' => $request->input('un6_persiapan_pastikan_pipa_tidak_bocor_desc'),
                'un6_persiapan_periksa_kabel_grounding_desc' => $request->input('un6_persiapan_periksa_kabel_grounding_desc'),
                'un6_persiapan_kabel_grounding_dipasang_desc' => $request->input('un6_persiapan_kabel_grounding_dipasang_desc'),
                'un6_persiapan_cek_pompa_desc' => $request->input('un6_persiapan_cek_pompa_desc'),
                'un6_persiapan_pasang_wadah_penampung_desc' => $request->input('un6_persiapan_pasang_wadah_penampung_desc'),
                'un6_persiapan_pasang_hose_steam_desc' => $request->input('un6_persiapan_pasang_hose_steam_desc'),
                'un6_persiapan_periksa_level_storage_desc' => $request->input('un6_persiapan_periksa_level_storage_desc'),
                'un6_unloading_pakai_goggles_desc' => $request->input('un6_unloading_pakai_goggles_desc'),
                'un6_unloading_hidupkan_dcs_desc' => $request->input('un6_unloading_hidupkan_dcs_desc'),
                'un6_unloading_cek_pipa_coupling_valve_tidak_bocor_desc' => $request->input('un6_unloading_cek_pipa_coupling_valve_tidak_bocor_desc'),
                'un6_unloading_pastikan_unloading_aman_desc' => $request->input('un6_unloading_pastikan_unloading_aman_desc'),
                'un6_selesai_unloading_selesai_desc' => $request->input('un6_selesai_unloading_selesai_desc'),
                'un6_selesai_matikan_pompa_desc' => $request->input('un6_selesai_matikan_pompa_desc'),
                'un6_selesai_tutup_aliran_steam_desc' => $request->input('un6_selesai_tutup_aliran_steam_desc'),
                'un6_selesai_tutup_valve_lorry_desc' => $request->input('un6_selesai_tutup_valve_lorry_desc'),
                'un6_selesai_tutup_valve_storage_desc' => $request->input('un6_selesai_tutup_valve_storage_desc'),
                'un6_selesai_periksa_valve_ditutup_desc' => $request->input('un6_selesai_periksa_valve_ditutup_desc'),
                'un6_selesai_lepas_kabel_grounding_desc' => $request->input('un6_selesai_lepas_kabel_grounding_desc'),
                'un6_selesai_panggil_sopir_kembali_desc' => $request->input('un6_selesai_panggil_sopir_kembali_desc'),
                'un6_selesai_pastikan_peralatan_tidak_terbawa_truk_desc' => $request->input('un6_selesai_pastikan_peralatan_tidak_terbawa_truk_desc'),
                'un6_selesai_lakukan_timbang_akhir_desc' => $request->input('un6_selesai_lakukan_timbang_akhir_desc'),
                'un6_netto_disuratjalan' => $request->input('un6_netto_disuratjalan'),
                'un6_netto_hasil_timbang' => $request->input('un6_netto_hasil_timbang'),
                'un6_pemeriksa' => $request->input('un6_pemeriksa'),
                // 'un6_signature_employee' => $request->input('un6_signature_employee'),
                // 'un6_signature_checker' => $request->input('un6_signature_checker'),
                'un6_delete_reason' => $request->input('un6_delete_reason'),
                'un6_reason_cancel_load_unload' => $request->input('un6_reason_cancel_load_unload'),
            ]);
            $gate->update([
                'gateable_id' => $formUnloadingSulphurLiquid->id,
                'gateable_type' => "App\Models\FormUnloadingSulphurLiquid"
                ]);
                if($request->input('un6_signature_checker')){
                    $decodedDocs = base64_decode($request->input('un6_signature_checker'));


                    $name = time()."someone_that_i_used_to_know.png";
                    file_put_contents('uploads/unloading/signatures/'.$name, $decodedDocs);


                    $formUnloadingSulphurLiquid->update(
                        [
                            'un6_signature_checker' => $name,
                            ]
                        );

                }
                if($request->input('un6_signature_employee')){
                    $decodedDocs = base64_decode($request->input('un6_signature_employee'));


                    $name = time()."someone_that_i_used_to_know.png";
                    file_put_contents('uploads/unloading/signatures/'.$name, $decodedDocs);


                    $formUnloadingSulphurLiquid->update(
                        [
                            'un6_signature_employee' => $name,
                            ]
                        );

                }
            return response()->json([
                'code' => 200,
                'message' => 'Success '.$isCreate.' FormUnloadingSulphurLiquid Form',
                'data' => [
                    $formUnloadingSulphurLiquid]
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
            $formUnloadingSulphurLiquid = $employee->formUnloadingSulphurLiquid()->findOrFail($formId);
            $formUnloadingSulphurLiquid->update([
                'un6_status' => 2,
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Success Approve FormUnloadingSulphurLiquid Form',
                'data' => [
                    $formUnloadingSulphurLiquid]
                ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given FormUnloadingSulphurLiquid Form ID not found',
                'data' => []
                ], 404);
        }
    }

    public function getOne($formId){

        $employee = Auth::user();

        try{
            $formUnloadingSulphurLiquid = $employee->formUnloadingSulphurLiquid()->findOrFail($formId);

            return response()->json([
                'code' => 200,
                'message' => 'Success Fetch FormUnloadingSulphurLiquid Form',
                'data' => [
                    $formUnloadingSulphurLiquid]
                ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given FormUnloadingSulphurLiquid Form ID not found',
                'data' => []
                ], 404);
        }
    }
}
