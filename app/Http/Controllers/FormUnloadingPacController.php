<?php

namespace App\Http\Controllers;

use App\Models\FormEGateCheck;
use App\Models\FormUnloadingPac;
use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class FormUnloadingPacController extends Controller
{
    public function viewAll(){
        return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' =>
            FormUnloadingPac::all()
            ], 200);
    }
    public function createOrUpdate(Request $request){
        $this->validate($request, [
            // 'form_id' => 'integer',
            'gate_id' => 'required|integer',

            'un3_persiapan_memakai_ppe' => ['integer', Rule::in(['0','1','2']),],
            'un3_persiapan_cek_hose_piping' => ['integer', Rule::in(['0','1','2']),],
            'un3_persiapan_safety_shower' => ['integer', Rule::in(['0','1','2']),],
            'un3_persiapan_operator_terima_dokumen' => ['integer', Rule::in(['0','1','2']),],
            'un3_persiapan_arahkan_truk_parkir' => ['integer', Rule::in(['0','1','2']),],
            'un3_persiapan_ganjal_roda' => ['integer', Rule::in(['0','1','2']),],
            'un3_persiapan_safety_cone' => ['integer', Rule::in(['0','1','2']),],
            'un3_persiapan_sopir_serahkan_kunci' => ['integer', Rule::in(['0','1','2']),],
            'un3_persiapan_sopir_kenek_leave_unloading' => ['integer', Rule::in(['0','1','2']),],
            'un3_persiapan_isotank_bersih' => ['integer', Rule::in(['0','1','2']),],
            'un3_persiapan_label_segel_terpasang' => ['integer', Rule::in(['0','1','2']),],
            'un3_persiapan_pasang_penampung_tetesan' => ['integer', Rule::in(['0','1','2']),],
            'un3_persiapan_bukasegel_ambil_sampel' => ['integer', Rule::in(['0','1','2']),],
            'un3_persiapan_pasang_penampung_tetesan' => ['integer', Rule::in(['0','1','2']),],
            'un3_persiapan_kirim_sample_desc' => ['integer', Rule::in(['0','1','2']),],
            'un3_persiapan_periksa_level_storage' => ['integer', Rule::in(['0','1','2']),],
            'un3_persiapan_bersiap_nyalakan_pompa' => ['integer', Rule::in(['0','1','2']),],
            'un3_unloading_buttom_valve_dibuka_penuh' => ['integer', Rule::in(['0','1','2']),],
            'un3_unloading_hidupkan_pompa' => ['integer', Rule::in(['0','1','2']),],
            'un3_unloading_cek_pipa_coupling_valve_tidak_bocor' => ['integer', Rule::in(['0','1','2']),],
            'un3_unloading_pastikan_unloading_aman' => ['integer', Rule::in(['0','1','2']),],
            'un3_unloading_periksa_pompa' => ['integer', Rule::in(['0','1','2']),],
            'un3_selesai_unloading_selesai' => ['integer', Rule::in(['0','1','2']),],
            'un3_selesai_matikan_pompa' => ['integer', Rule::in(['0','1','2']),],
            'un3_selesai_tutup_valve' => ['integer', Rule::in(['0','1','2']),],
            'un3_selesai_pastikan_hose_liquid_kosong' => ['integer', Rule::in(['0','1','2']),],
            'un3_selesai_tutup_hose_dg_caphose' => ['integer', Rule::in(['0','1','2']),],
            'un3_selesai_simpan_coupling_dg_aman' => ['integer', Rule::in(['0','1','2']),],
            'un3_selesai_periksa_valve_ditutup' => ['integer', Rule::in(['0','1','2']),],
            'un3_selesai_panggil_sopir_kembali' => ['integer', Rule::in(['0','1','2']),],
            'un3_selesai_lepas_pengganjal_roda_safetycone' => ['integer', Rule::in(['0','1','2']),],
            'un3_selesai_pastikan_peralatan_tidak_terbawa_truk' => ['integer', Rule::in(['0','1','2']),],
            'un3_selesai_lakukan_timbang_akhir' => ['integer', Rule::in(['0','1','2']),],
            'un3_selesai_pastikan_qty_pas' => ['integer', Rule::in(['0','1','2']),],
            'un3_selesai_tandatangan_serahterima' => ['integer', Rule::in(['0','1','2']),],
            'un3_status' => ['integer', Rule::in(['0','1']),],
            'un3_operator_complete' => ['integer', Rule::in(['0','1','2']),],
            'un3_checker_complete' => ['integer', Rule::in(['0','1']),],
            'un3_cancel_load_unload' => ['integer', Rule::in(['0','1','2']),],
            'un3_report_code' => 'string|max:255',
            'un3_batch_no' => 'string|max:255',
            'un3_level_awal' => 'string|max:255',
            'un3_level_akhir' => 'string|max:255',
            'un3_jml_dimuat' => 'string|max:255',
            'un3_persiapan_memakai_ppe_desc' => 'string|max:255',
            'un3_persiapan_cek_hose_piping_desc' => 'string|max:255',
            'un3_persiapan_safety_shower_desc' => 'string|max:255',
            'un3_persiapan_operator_terima_dokumen_desc' => 'string|max:255',
            'un3_persiapan_arahkan_truk_parkir_desc' => 'string|max:255',
            'un3_persiapan_ganjal_roda_desc' => 'string|max:255',
            'un3_persiapan_safety_cone_desc' => 'string|max:255',
            'un3_persiapan_sopir_serahkan_kunci_desc' => 'string|max:255',
            'un3_persiapan_sopir_kenek_leave_unloading_desc' => 'string|max:255',
            'un3_persiapan_isotank_bersih_desc' => 'string|max:255',
            'un3_persiapan_label_segel_terpasang_desc' => 'string|max:255',
            'un3_persiapan_pasang_penampung_tetesan_desc' => 'string|max:255',
            'un3_persiapan_bukasegel_ambil_sampel_desc' => 'string|max:255',
            'un3_persiapan_kirim_sample' => 'string|max:255',
            'un3_persiapan_periksa_level_storage_desc' => 'string|max:255',
            'un3_persiapan_bersiap_nyalakan_pompa_desc' => 'string|max:255',
            'un3_unloading_buttom_valve_dibuka_penuh_desc' => 'string|max:255',
            'un3_unloading_hidupkan_pompa_desc' => 'string|max:255',
            'un3_unloading_cek_pipa_coupling_valve_tidak_bocor_desc' => 'string|max:255',
            'un3_unloading_pastikan_unloading_aman_desc' => 'string|max:255',
            'un3_unloading_periksa_pompa_desc' => 'string|max:255',
            'un3_selesai_unloading_selesai_desc' => 'string|max:255',
            'un3_selesai_matikan_pompa_desc' => 'string|max:255',
            'un3_selesai_tutup_valve_desc' => 'string|max:255',
            'un3_selesai_pastikan_hose_liquid_kosong_desc' => 'string|max:255',
            'un3_selesai_tutup_hose_dg_caphose_desc' => 'string|max:255',
            'un3_selesai_simpan_coupling_dg_aman_desc' => 'string|max:255',
            'un3_selesai_periksa_valve_ditutup_desc' => 'string|max:255',
            'un3_selesai_panggil_sopir_kembali_desc' => 'string|max:255',
            'un3_selesai_lepas_pengganjal_roda_safetycone_desc' => 'string|max:255',
            'un3_selesai_pastikan_peralatan_tidak_terbawa_truk_desc' => 'string|max:255',
            'un3_selesai_lakukan_timbang_akhir_desc' => 'string|max:255',
            'un3_netto_disuratjalan' => 'string|max:255',
            'un3_netto_hasil_timbang' => 'string|max:255',
            'un3_pemeriksa' => 'string|max:255',
            // 'un3_signature_employee' => 'file',
            // 'un3_signature_checker' => 'file',
            'un3_delete_reason' => 'string|max:255',
            'un3_reason_cancel_load_unload' => 'string|max:255',

        ]);

        $employee = Auth::user();
        try{
            $formId = (int) $request->input('form_id');
            $gate = FormEGateCheck::findOrFail($request->input('gate_id'));
            if( $formId != null || $formId != 0){
                $isCreate = "Update";

                try{
                    $formUnloadingPac = $employee->formUnloadingPac()->findOrFail($formId);

                    if($gate->gateable_id != $formId && $gate->gateable_type != 'App\Models\FormUnloadingPac'){
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
                        'message' => 'Given FormUnloadingPac Form ID not found',
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

                $formUnloadingPac = FormUnloadingPac::create([
                    'un3_employee_id' => $employee->id,
                    'un3_report_kendaraan_id' => $gate->id,
                ]);
                $gate->update([
                    'gateable_id' => $formUnloadingPac->id,
                    'gateable_type' => "App\Models\FormUnloadingPac"
                    ]);
            }



            $formUnloadingPac->update([


                'un3_persiapan_memakai_ppe' => (int) $request->input('un3_persiapan_memakai_ppe'),
                'un3_persiapan_cek_hose_piping' => (int) $request->input('un3_persiapan_cek_hose_piping'),
                'un3_persiapan_safety_shower' => (int) $request->input('un3_persiapan_safety_shower'),
                'un3_persiapan_operator_terima_dokumen' => (int) $request->input('un3_persiapan_operator_terima_dokumen'),
                'un3_persiapan_arahkan_truk_parkir' => (int) $request->input('un3_persiapan_arahkan_truk_parkir'),
                'un3_persiapan_ganjal_roda' => (int) $request->input('un3_persiapan_ganjal_roda'),
                'un3_persiapan_safety_cone' => (int) $request->input('un3_persiapan_safety_cone'),
                'un3_persiapan_sopir_serahkan_kunci' => (int) $request->input('un3_persiapan_sopir_serahkan_kunci'),
                'un3_persiapan_sopir_kenek_leave_unloading' => (int) $request->input('un3_persiapan_sopir_kenek_leave_unloading'),
                'un3_persiapan_isotank_bersih' => (int) $request->input('un3_persiapan_isotank_bersih'),
                'un3_persiapan_label_segel_terpasang' => (int) $request->input('un3_persiapan_label_segel_terpasang'),
                'un3_persiapan_pasang_penampung_tetesan' => (int) $request->input('un3_persiapan_pasang_penampung_tetesan'),
                'un3_persiapan_bukasegel_ambil_sampel' => (int) $request->input('un3_persiapan_bukasegel_ambil_sampel'),
                'un3_persiapan_pasang_penampung_tetesan' => (int) $request->input('un3_persiapan_pasang_penampung_tetesan'),
                'un3_persiapan_kirim_sample_desc' => (int) $request->input('un3_persiapan_kirim_sample_desc'),
                'un3_persiapan_periksa_level_storage' => (int) $request->input('un3_persiapan_periksa_level_storage'),
                'un3_persiapan_bersiap_nyalakan_pompa' => (int) $request->input('un3_persiapan_bersiap_nyalakan_pompa'),
                'un3_unloading_buttom_valve_dibuka_penuh' => (int) $request->input('un3_unloading_buttom_valve_dibuka_penuh'),
                'un3_unloading_hidupkan_pompa' => (int) $request->input('un3_unloading_hidupkan_pompa'),
                'un3_unloading_cek_pipa_coupling_valve_tidak_bocor' => (int) $request->input('un3_unloading_cek_pipa_coupling_valve_tidak_bocor'),
                'un3_unloading_pastikan_unloading_aman' => (int) $request->input('un3_unloading_pastikan_unloading_aman'),
                'un3_unloading_periksa_pompa' => (int) $request->input('un3_unloading_periksa_pompa'),
                'un3_selesai_unloading_selesai' => (int) $request->input('un3_selesai_unloading_selesai'),
                'un3_selesai_matikan_pompa' => (int) $request->input('un3_selesai_matikan_pompa'),
                'un3_selesai_tutup_valve' => (int) $request->input('un3_selesai_tutup_valve'),
                'un3_selesai_pastikan_hose_liquid_kosong' => (int) $request->input('un3_selesai_pastikan_hose_liquid_kosong'),
                'un3_selesai_tutup_hose_dg_caphose' => (int) $request->input('un3_selesai_tutup_hose_dg_caphose'),
                'un3_selesai_simpan_coupling_dg_aman' => (int) $request->input('un3_selesai_simpan_coupling_dg_aman'),
                'un3_selesai_periksa_valve_ditutup' => (int) $request->input('un3_selesai_periksa_valve_ditutup'),
                'un3_selesai_panggil_sopir_kembali' => (int) $request->input('un3_selesai_panggil_sopir_kembali'),
                'un3_selesai_lepas_pengganjal_roda_safetycone' => (int) $request->input('un3_selesai_lepas_pengganjal_roda_safetycone'),
                'un3_selesai_pastikan_peralatan_tidak_terbawa_truk' => (int) $request->input('un3_selesai_pastikan_peralatan_tidak_terbawa_truk'),
                'un3_selesai_lakukan_timbang_akhir' => (int) $request->input('un3_selesai_lakukan_timbang_akhir'),
                'un3_selesai_pastikan_qty_pas' => (int) $request->input('un3_selesai_pastikan_qty_pas'),
                'un3_selesai_tandatangan_serahterima' => (int) $request->input('un3_selesai_tandatangan_serahterima'),
                'un3_status' => (int) $request->input('un3_status'),
                'un3_operator_complete' => (int) $request->input('un3_operator_complete'),
                'un3_checker_complete' => (int) $request->input('un3_checker_complete'),
                'un3_cancel_load_unload' => (int) $request->input('un3_cancel_load_unload'),

                'un3_report_code' => $request->input('un3_report_code'),
                'un3_batch_no' => $request->input('un3_batch_no'),
                'un3_level_awal' => $request->input('un3_level_awal'),
                'un3_level_akhir' => $request->input('un3_level_akhir'),
                'un3_jml_dimuat' => $request->input('un3_jml_dimuat'),
                'un3_persiapan_memakai_ppe_desc' => $request->input('un3_persiapan_memakai_ppe_desc'),
                'un3_persiapan_cek_hose_piping_desc' => $request->input('un3_persiapan_cek_hose_piping_desc'),
                'un3_persiapan_safety_shower_desc' => $request->input('un3_persiapan_safety_shower_desc'),
                'un3_persiapan_operator_terima_dokumen_desc' => $request->input('un3_persiapan_operator_terima_dokumen_desc'),
                'un3_persiapan_arahkan_truk_parkir_desc' => $request->input('un3_persiapan_arahkan_truk_parkir_desc'),
                'un3_persiapan_ganjal_roda_desc' => $request->input('un3_persiapan_ganjal_roda_desc'),
                'un3_persiapan_safety_cone_desc' => $request->input('un3_persiapan_safety_cone_desc'),
                'un3_persiapan_sopir_serahkan_kunci_desc' => $request->input('un3_persiapan_sopir_serahkan_kunci_desc'),
                'un3_persiapan_sopir_kenek_leave_unloading_desc' => $request->input('un3_persiapan_sopir_kenek_leave_unloading_desc'),
                'un3_persiapan_isotank_bersih_desc' => $request->input('un3_persiapan_isotank_bersih_desc'),
                'un3_persiapan_label_segel_terpasang_desc' => $request->input('un3_persiapan_label_segel_terpasang_desc'),
                'un3_persiapan_pasang_penampung_tetesan_desc' => $request->input('un3_persiapan_pasang_penampung_tetesan_desc'),
                'un3_persiapan_bukasegel_ambil_sampel_desc' => $request->input('un3_persiapan_bukasegel_ambil_sampel_desc'),
                'un3_persiapan_kirim_sample' => $request->input('un3_persiapan_kirim_sample'),
                'un3_persiapan_periksa_level_storage_desc' => $request->input('un3_persiapan_periksa_level_storage_desc'),
                'un3_persiapan_bersiap_nyalakan_pompa_desc' => $request->input('un3_persiapan_bersiap_nyalakan_pompa_desc'),
                'un3_unloading_buttom_valve_dibuka_penuh_desc' => $request->input('un3_unloading_buttom_valve_dibuka_penuh_desc'),
                'un3_unloading_hidupkan_pompa_desc' => $request->input('un3_unloading_hidupkan_pompa_desc'),
                'un3_unloading_cek_pipa_coupling_valve_tidak_bocor_desc' => $request->input('un3_unloading_cek_pipa_coupling_valve_tidak_bocor_desc'),
                'un3_unloading_pastikan_unloading_aman_desc' => $request->input('un3_unloading_pastikan_unloading_aman_desc'),
                'un3_unloading_periksa_pompa_desc' => $request->input('un3_unloading_periksa_pompa_desc'),
                'un3_selesai_unloading_selesai_desc' => $request->input('un3_selesai_unloading_selesai_desc'),
                'un3_selesai_matikan_pompa_desc' => $request->input('un3_selesai_matikan_pompa_desc'),
                'un3_selesai_tutup_valve_desc' => $request->input('un3_selesai_tutup_valve_desc'),
                'un3_selesai_pastikan_hose_liquid_kosong_desc' => $request->input('un3_selesai_pastikan_hose_liquid_kosong_desc'),
                'un3_selesai_tutup_hose_dg_caphose_desc' => $request->input('un3_selesai_tutup_hose_dg_caphose_desc'),
                'un3_selesai_simpan_coupling_dg_aman_desc' => $request->input('un3_selesai_simpan_coupling_dg_aman_desc'),
                'un3_selesai_periksa_valve_ditutup_desc' => $request->input('un3_selesai_periksa_valve_ditutup_desc'),
                'un3_selesai_panggil_sopir_kembali_desc' => $request->input('un3_selesai_panggil_sopir_kembali_desc'),
                'un3_selesai_lepas_pengganjal_roda_safetycone_desc' => $request->input('un3_selesai_lepas_pengganjal_roda_safetycone_desc'),
                'un3_selesai_pastikan_peralatan_tidak_terbawa_truk_desc' => $request->input('un3_selesai_pastikan_peralatan_tidak_terbawa_truk_desc'),
                'un3_selesai_lakukan_timbang_akhir_desc' => $request->input('un3_selesai_lakukan_timbang_akhir_desc'),
                'un3_netto_disuratjalan' => $request->input('un3_netto_disuratjalan'),
                'un3_netto_hasil_timbang' => $request->input('un3_netto_hasil_timbang'),
                'un3_pemeriksa' => $request->input('un3_pemeriksa'),
                // 'un3_signature_employee' => $request->input('un3_signature_employee'),
                // 'un3_signature_checker' => $request->input('un3_signature_checker'),
                'un3_delete_reason' => $request->input('un3_delete_reason'),
                'un3_reason_cancel_load_unload' => $request->input('un3_reason_cancel_load_unload'),
            ]);

                if($request->input('un3_signature_checker')){
                    $decodedDocs = base64_decode($request->input('un3_signature_checker'));


                    $name = time()."_un3_signature_checker.png";
                    file_put_contents('uploads/unloading/signatures/'.$name, $decodedDocs);


                    $formUnloadingPac->update(
                        [
                            'un3_signature_checker' => $name,
                            ]
                        );

                }
                if($request->input('un3_signature_employee')){
                    $decodedDocs = base64_decode($request->input('un3_signature_employee'));


                    $name = time()."_un3_signature_employee.png";
                    file_put_contents('uploads/unloading/signatures/'.$name, $decodedDocs);


                    $formUnloadingPac->update(
                        [
                            'un3_signature_employee' => $name,
                            ]
                        );

                }
                $gate->update([
                    'gate_loading_status' => (int) FormEGateCheck::
                        returnEgateStatus($gate),
                    'gate_is_editable'=> (int) FormEGateCheck::
                        returnIsEditable($gate),
                    ]);
            return response()->json([
                'code' => 200,
                'message' => 'Success '.$isCreate.' FormUnloadingPac Form',
                'data' => [
                    $formUnloadingPac]
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
            $formUnloadingPac = $employee->formUnloadingPac()->findOrFail($formId);
            $formUnloadingPac->update([
                'un3_status' => 2,
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Success Approve FormUnloadingPac Form',
                'data' => [
                    $formUnloadingPac]
                ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given formUnloadingPac Form ID not found',
                'data' => []
                ], 404);
        }
    }

    public function getOne($formId){

        $employee = Auth::user();

        try{
            $formUnloadingPac = $employee->formUnloadingPac()->findOrFail($formId);

            return response()->json([
                'code' => 200,
                'message' => 'Success Fetch FormUnloadingPac Form',
                'data' => [
                    $formUnloadingPac]
                ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given FormUnloadingPac Form ID not found',
                'data' => []
                ], 404);
        }
    }
}
