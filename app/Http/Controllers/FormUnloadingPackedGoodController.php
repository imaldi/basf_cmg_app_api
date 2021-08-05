<?php

namespace App\Http\Controllers;

use App\Models\FormEGateCheck;
use App\Models\FormUnloadingPackedGood;
use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class FormUnloadingPackedGoodController extends Controller
{
    public function viewAll(){
        return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' =>
            FormUnloadingPackedGood::all()
            ], 200);
    }
    public function createOrUpdate(Request $request){
        $this->validate($request, [
            'form_id' => 'integer',
            'gate_id' => 'required|integer',

            'un10_simbol_1' => ['integer', Rule::in(['0','1','2']),],
            'un10_simbol_2' => ['integer', Rule::in(['0','1','2']),],
            'un10_simbol_3' => ['integer', Rule::in(['0','1','2']),],
            'un10_simbol_4' => ['integer', Rule::in(['0','1','2']),],
            'un10_simbol_5' => ['integer', Rule::in(['0','1','2']),],
            'un10_simbol_6' => ['integer', Rule::in(['0','1','2']),],
            'un10_simbol_7' => ['integer', Rule::in(['0','1','2']),],
            'un10_persiapan_memakai_ppe' => ['integer', Rule::in(['0','1','2']),],
            'un10_persiapan_forklift_sudah_lulus' => ['integer', Rule::in(['0','1','2']),],
            'un10_persiapan_drum_handler_sdh_lulus' => ['integer', Rule::in(['0','1','2']),],
            'un10_persiapan_operator_terima_dokumen' => ['integer', Rule::in(['0','1','2']),],
            'un10_persiapan_arahkan_truk_parkir' => ['integer', Rule::in(['0','1','2']),],
            'un10_persiapan_ganjal_roda' => ['integer', Rule::in(['0','1','2']),],
            'un10_persiapan_safety_cone' => ['integer', Rule::in(['0','1','2']),],
            'un10_persiapan_sopir_serahkan_kunci' => ['integer', Rule::in(['0','1','2']),],
            'un10_persiapan_sopir_kenek_leave_unloading' => ['integer', Rule::in(['0','1','2']),],
            'un10_persiapan_truk_bersih' => ['integer', Rule::in(['0','1','2']),],
            'un10_persiapan_cctv_berfungsi' => ['integer', Rule::in(['0','1','2']),],
            'un10_persiapan_container_tersegel' => ['integer', Rule::in(['0','1','2']),],
            'un10_persiapan_pintu_container_sdh_dibuka' => ['integer', Rule::in(['0','1','2']),],
            'un10_persiapan_truk_non_container_buka_terpal' => ['integer', Rule::in(['0','1','2']),],
            'un10_persiapan_adjusment_lvl_dock_aktif' => ['integer', Rule::in(['0','1','2']),],
            'un10_persiapan_safety_cone_pasang_di_adjusment_lvl' => ['integer', Rule::in(['0','1','2']),],
            'un10_persiapan_susunan_produk_rapi' => ['integer', Rule::in(['0','1','2']),],
            'un10_persiapan_pallet_tdk_patah' => ['integer', Rule::in(['0','1','2']),],
            'un10_persiapan_produk_tdk_pakai_pallet' => ['integer', Rule::in(['0','1','2']),],
            'un10_unloading_turunkan_produk_dg_forklift' => ['integer', Rule::in(['0','1','2']),],
            'un10_unloading_turunkan_produk_dg_drum_handler' => ['integer', Rule::in(['0','1','2']),],
            'un10_unloading_gunakan_tenaga_manusia' => ['integer', Rule::in(['0','1','2']),],
            'un10_unloading_produk_tdk_rusak' => ['integer', Rule::in(['0','1','2']),],
            'un10_unloading_label_sesuai' => ['integer', Rule::in(['0','1','2']),],
            'un10_unloading_expire_date' => ['integer', Rule::in(['0','1','2']),],
            'un10_unloading_jml_barang_sesuai' => ['integer', Rule::in(['0','1','2']),],
            'un10_selesai_lantai_dinding_truk_bersih' => ['integer', Rule::in(['0','1','2']),],
            'un10_selesai_timbang_acak' => ['integer', Rule::in(['0','1','2']),],
            'un10_selesai_stiker_sdh_dipasang' => ['integer', Rule::in(['0','1','2']),],
            'un10_selesai_panggil_sopir_kembali' => ['integer', Rule::in(['0','1','2']),],
            'un10_selesai_tandatangan_serahterima' => ['integer', Rule::in(['0','1','2']),],
            'un10_status' => ['integer', Rule::in(['0','1']),],
            'un10_operator_complete' => ['integer', Rule::in(['0','1','2']),],
            'un10_checker_complete' => ['integer', Rule::in(['0','1','2']),],
            'un10_cancel_load_unload' => ['integer', Rule::in(['0','1','2']),],

            'un10_report_code' => 'string|max:255',
            'un10_no_po' => 'string|max:255',
            'un10_jml_kemasan' => 'string|max:255',
            'un10_tipe_kemasan' => 'string|max:255',
            'un10_jml_total' => 'string|max:255',
            'un10_jml_dimuat' => 'string|max:255',
            'un10_persiapan_memakai_ppe_desc' => 'string|max:255',
            'un10_persiapan_forklift_sudah_lulus_desc' => 'string|max:255',
            'un10_persiapan_drum_handler_sdh_lulus_desc' => 'string|max:255',
            'un10_persiapan_operator_terima_dokumen_desc' => 'string|max:255',
            'un10_persiapan_arahkan_truk_parkir_desc' => 'string|max:255',
            'un10_persiapan_ganjal_roda_desc' => 'string|max:255',
            'un10_persiapan_safety_cone_desc' => 'string|max:255',
            'un10_persiapan_sopir_serahkan_kunci_desc' => 'string|max:255',
            'un10_persiapan_sopir_kenek_leave_unloading_desc' => 'string|max:255',
            'un10_persiapan_truk_bersih_desc' => 'string|max:255',
            'un10_persiapan_cctv_berfungsi_desc' => 'string|max:255',
            'un10_persiapan_container_tersegel_desc' => 'string|max:255',
            'un10_persiapan_pintu_container_sdh_dibuka_desc' => 'string|max:255',
            'un10_persiapan_truk_non_container_buka_terpal_dec' => 'string|max:255',
            'un10_persiapan_adjusment_lvl_dock_aktif_desc' => 'string|max:255',
            'un10_persiapan_safety_cone_pasang_di_adjusment_lvl_desc' => 'string|max:255',
            'un10_unloading_turunkan_produk_dg_forklift_desc' => 'string|max:255',
            'un10_unloading_turunkan_produk_dg_drum_handler_desc' => 'string|max:255',
            'un10_unloading_gunakan_tenaga_manusia_desc' => 'string|max:255',
            'un10_unloading_produk_tdk_rusak_desc' => 'string|max:255',
            'un10_unloading_label_sesuai_desc' => 'string|max:255',
            'un10_unloading_expire_date_desc' => 'string|max:255',
            'un10_unloading_jml_barang_sesuai_desc' => 'string|max:255',
            'un10_selesai_timbang_acak_dec' => 'string|max:255',
            'un10_selesai_stiker_sdh_dipasang_desc' => 'string|max:255',
            'un10_selesai_panggil_sopir_kembali_desc' => 'string|max:255',
            'un10_pemeriksa' => 'string|max:255',
            'un10_signature_employee' => 'string|max:255',
            'un10_signature_checker' => 'string|max:255',
            'un10_delete_reason' => 'string|max:255',
            'un10_foto_container_tersegel1' => 'string|max:255',
            'un10_foto_container_tersegel2' => 'string|max:255',
            'un10_foto_container_tersegel3' => 'string|max:255',
            'un10_foto_pintu_container_sdh_dibuka1' => 'string|max:255',
            'un10_foto_pintu_container_sdh_dibuka2' => 'string|max:255',
            'un10_foto_pintu_container_sdh_dibuka3' => 'string|max:255',
            'un10_foto_truk_non_container_buka_terpal1' => 'string|max:255',
            'un10_foto_truk_non_container_buka_terpal2' => 'string|max:255',
            'un10_foto_truk_non_container_buka_terpal3' => 'string|max:255',
            'un10_foto_susunan_produk_rapi1' => 'string|max:255',
            'un10_foto_susunan_produk_rapi2' => 'string|max:255',
            'un10_foto_susunan_produk_rapi3' => 'string|max:255',
            'un10_foto_pallet_tdk_patah1' => 'string|max:255',
            'un10_foto_pallet_tdk_patah2' => 'string|max:255',
            'un10_foto_pallet_tdk_patah3' => 'string|max:255',
            'un10_foto_produk_tdk_pakai_pallet1' => 'string|max:255',
            'un10_foto_produk_tdk_pakai_pallet2' => 'string|max:255',
            'un10_foto_produk_tdk_pakai_pallet3' => 'string|max:255',
            'un10_foto_lantai_dinding_truk_bersih1' => 'string|max:255',
            'un10_foto_lantai_dinding_truk_bersih2' => 'string|max:255',
            'un10_foto_lantai_dinding_truk_bersih3' => 'string|max:255',
            'un10_reason_cancel_load_unload' => 'string|max:255',
        ]);

        $employee = Auth::user();
        try{
            $formId = $request->input('form_id');
            $gate = FormEGateCheck::findOrFail($request->input('gate_id'));
            if( $formId != null || $formId != 0){
                $isCreate = "Update";

                try{
                    $formUnloadingPackedGood = $employee->formUnloadingPackedGood()->findOrFail($formId);

                    if($gate->gateable_id != $formId && $gate->gateable_type != 'App\Models\FormUnloadingPackedGood'){
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
                        'message' => 'Given FormUnloadingPackedGood Form ID not found',
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

                $formUnloadingPackedGood = FormUnloadingPackedGood::create([
                    'un10_employee_id' => $employee->id,
                    'un10_report_kendaraan_id' => $gate->id,
                ]);
            }
            $formUnloadingPackedGood->update([
                'un10_simbol_1' => (int) $request->input('un10_simbol_1'),
                'un10_simbol_2' => (int) $request->input('un10_simbol_2'),
                'un10_simbol_3' => (int) $request->input('un10_simbol_3'),
                'un10_simbol_4' => (int) $request->input('un10_simbol_4'),
                'un10_simbol_5' => (int) $request->input('un10_simbol_5'),
                'un10_simbol_6' => (int) $request->input('un10_simbol_6'),
                'un10_simbol_7' => (int) $request->input('un10_simbol_7'),
                'un10_persiapan_memakai_ppe' => (int) $request->input('un10_persiapan_memakai_ppe'),
                'un10_persiapan_forklift_sudah_lulus' => (int) $request->input('un10_persiapan_forklift_sudah_lulus'),
                'un10_persiapan_drum_handler_sdh_lulus' => (int) $request->input('un10_persiapan_drum_handler_sdh_lulus'),
                'un10_persiapan_operator_terima_dokumen' => (int) $request->input('un10_persiapan_operator_terima_dokumen'),
                'un10_persiapan_arahkan_truk_parkir' => (int) $request->input('un10_persiapan_arahkan_truk_parkir'),
                'un10_persiapan_ganjal_roda' => (int) $request->input('un10_persiapan_ganjal_roda'),
                'un10_persiapan_safety_cone' => (int) $request->input('un10_persiapan_safety_cone'),
                'un10_persiapan_sopir_serahkan_kunci' => (int) $request->input('un10_persiapan_sopir_serahkan_kunci'),
                'un10_persiapan_sopir_kenek_leave_unloading' => (int) $request->input('un10_persiapan_sopir_kenek_leave_unloading'),
                'un10_persiapan_truk_bersih' => (int) $request->input('un10_persiapan_truk_bersih'),
                'un10_persiapan_cctv_berfungsi' => (int) $request->input('un10_persiapan_cctv_berfungsi'),
                'un10_persiapan_container_tersegel' => (int) $request->input('un10_persiapan_container_tersegel'),
                'un10_persiapan_pintu_container_sdh_dibuka' => (int) $request->input('un10_persiapan_pintu_container_sdh_dibuka'),
                'un10_persiapan_truk_non_container_buka_terpal' => (int) $request->input('un10_persiapan_truk_non_container_buka_terpal'),
                'un10_persiapan_adjusment_lvl_dock_aktif' => (int) $request->input('un10_persiapan_adjusment_lvl_dock_aktif'),
                'un10_persiapan_safety_cone_pasang_di_adjusment_lvl' => (int) $request->input('un10_persiapan_safety_cone_pasang_di_adjusment_lvl'),
                'un10_persiapan_susunan_produk_rapi' => (int) $request->input('un10_persiapan_susunan_produk_rapi'),
                'un10_persiapan_pallet_tdk_patah' => (int) $request->input('un10_persiapan_pallet_tdk_patah'),
                'un10_persiapan_produk_tdk_pakai_pallet' => (int) $request->input('un10_persiapan_produk_tdk_pakai_pallet'),
                'un10_unloading_turunkan_produk_dg_forklift' => (int) $request->input('un10_unloading_turunkan_produk_dg_forklift'),
                'un10_unloading_turunkan_produk_dg_drum_handler' => (int) $request->input('un10_unloading_turunkan_produk_dg_drum_handler'),
                'un10_unloading_gunakan_tenaga_manusia' => (int) $request->input('un10_unloading_gunakan_tenaga_manusia'),
                'un10_unloading_produk_tdk_rusak' => (int) $request->input('un10_unloading_produk_tdk_rusak'),
                'un10_unloading_label_sesuai' => (int) $request->input('un10_unloading_label_sesuai'),
                'un10_unloading_expire_date' => (int) $request->input('un10_unloading_expire_date'),
                'un10_unloading_jml_barang_sesuai' => (int) $request->input('un10_unloading_jml_barang_sesuai'),
                'un10_selesai_lantai_dinding_truk_bersih' => (int) $request->input('un10_selesai_lantai_dinding_truk_bersih'),
                'un10_selesai_timbang_acak' => (int) $request->input('un10_selesai_timbang_acak'),
                'un10_selesai_stiker_sdh_dipasang' => (int) $request->input('un10_selesai_stiker_sdh_dipasang'),
                'un10_selesai_panggil_sopir_kembali' => (int) $request->input('un10_selesai_panggil_sopir_kembali'),
                'un10_selesai_tandatangan_serahterima' => (int) $request->input('un10_selesai_tandatangan_serahterima'),
                'un10_status' => (int) $request->input('un10_status'),
                'un10_operator_complete' => (int) $request->input('un10_operator_complete'),
                'un10_checker_complete' => (int) $request->input('un10_checker_complete'),
                'un10_cancel_load_unload' => (int) $request->input('un10_cancel_load_unload'),

                'un10_report_code' => $request->input('un10_report_code'),
                'un10_no_po' => $request->input('un10_no_po'),
                'un10_jml_kemasan' => $request->input('un10_jml_kemasan'),
                'un10_tipe_kemasan' => $request->input('un10_tipe_kemasan'),
                'un10_jml_total' => $request->input('un10_jml_total'),
                'un10_jml_dimuat' => $request->input('un10_jml_dimuat'),
                'un10_persiapan_memakai_ppe_desc' => $request->input('un10_persiapan_memakai_ppe_desc'),
                'un10_persiapan_forklift_sudah_lulus_desc' => $request->input('un10_persiapan_forklift_sudah_lulus_desc'),
                'un10_persiapan_drum_handler_sdh_lulus_desc' => $request->input('un10_persiapan_drum_handler_sdh_lulus_desc'),
                'un10_persiapan_operator_terima_dokumen_desc' => $request->input('un10_persiapan_operator_terima_dokumen_desc'),
                'un10_persiapan_arahkan_truk_parkir_desc' => $request->input('un10_persiapan_arahkan_truk_parkir_desc'),
                'un10_persiapan_ganjal_roda_desc' => $request->input('un10_persiapan_ganjal_roda_desc'),
                'un10_persiapan_safety_cone_desc' => $request->input('un10_persiapan_safety_cone_desc'),
                'un10_persiapan_sopir_serahkan_kunci_desc' => $request->input('un10_persiapan_sopir_serahkan_kunci_desc'),
                'un10_persiapan_sopir_kenek_leave_unloading_desc' => $request->input('un10_persiapan_sopir_kenek_leave_unloading_desc'),
                'un10_persiapan_truk_bersih_desc' => $request->input('un10_persiapan_truk_bersih_desc'),
                'un10_persiapan_cctv_berfungsi_desc' => $request->input('un10_persiapan_cctv_berfungsi_desc'),
                'un10_persiapan_container_tersegel_desc' => $request->input('un10_persiapan_container_tersegel_desc'),
                'un10_persiapan_pintu_container_sdh_dibuka_desc' => $request->input('un10_persiapan_pintu_container_sdh_dibuka_desc'),
                'un10_persiapan_truk_non_container_buka_terpal_dec' => $request->input('un10_persiapan_truk_non_container_buka_terpal_dec'),
                'un10_persiapan_adjusment_lvl_dock_aktif_desc' => $request->input('un10_persiapan_adjusment_lvl_dock_aktif_desc'),
                'un10_persiapan_safety_cone_pasang_di_adjusment_lvl_desc' => $request->input('un10_persiapan_safety_cone_pasang_di_adjusment_lvl_desc'),
                'un10_unloading_turunkan_produk_dg_forklift_desc' => $request->input('un10_unloading_turunkan_produk_dg_forklift_desc'),
                'un10_unloading_turunkan_produk_dg_drum_handler_desc' => $request->input('un10_unloading_turunkan_produk_dg_drum_handler_desc'),
                'un10_unloading_gunakan_tenaga_manusia_desc' => $request->input('un10_unloading_gunakan_tenaga_manusia_desc'),
                'un10_unloading_produk_tdk_rusak_desc' => $request->input('un10_unloading_produk_tdk_rusak_desc'),
                'un10_unloading_label_sesuai_desc' => $request->input('un10_unloading_label_sesuai_desc'),
                'un10_unloading_expire_date_desc' => $request->input('un10_unloading_expire_date_desc'),
                'un10_unloading_jml_barang_sesuai_desc' => $request->input('un10_unloading_jml_barang_sesuai_desc'),
                'un10_selesai_timbang_acak_dec' => $request->input('un10_selesai_timbang_acak_dec'),
                'un10_selesai_stiker_sdh_dipasang_desc' => $request->input('un10_selesai_stiker_sdh_dipasang_desc'),
                'un10_selesai_panggil_sopir_kembali_desc' => $request->input('un10_selesai_panggil_sopir_kembali_desc'),
                'un10_pemeriksa' => $request->input('un10_pemeriksa'),
                'un10_signature_employee' => $request->input('un10_signature_employee'),
                'un10_signature_checker' => $request->input('un10_signature_checker'),
                'un10_delete_reason' => $request->input('un10_delete_reason'),
                'un10_foto_container_tersegel1' => $request->input('un10_foto_container_tersegel1'),
                'un10_foto_container_tersegel2' => $request->input('un10_foto_container_tersegel2'),
                'un10_foto_container_tersegel3' => $request->input('un10_foto_container_tersegel3'),
                'un10_foto_pintu_container_sdh_dibuka1' => $request->input('un10_foto_pintu_container_sdh_dibuka1'),
                'un10_foto_pintu_container_sdh_dibuka2' => $request->input('un10_foto_pintu_container_sdh_dibuka2'),
                'un10_foto_pintu_container_sdh_dibuka3' => $request->input('un10_foto_pintu_container_sdh_dibuka3'),
                'un10_foto_truk_non_container_buka_terpal1' => $request->input('un10_foto_truk_non_container_buka_terpal1'),
                'un10_foto_truk_non_container_buka_terpal2' => $request->input('un10_foto_truk_non_container_buka_terpal2'),
                'un10_foto_truk_non_container_buka_terpal3' => $request->input('un10_foto_truk_non_container_buka_terpal3'),
                'un10_foto_susunan_produk_rapi1' => $request->input('un10_foto_susunan_produk_rapi1'),
                'un10_foto_susunan_produk_rapi2' => $request->input('un10_foto_susunan_produk_rapi2'),
                'un10_foto_susunan_produk_rapi3' => $request->input('un10_foto_susunan_produk_rapi3'),
                'un10_foto_pallet_tdk_patah1' => $request->input('un10_foto_pallet_tdk_patah1'),
                'un10_foto_pallet_tdk_patah2' => $request->input('un10_foto_pallet_tdk_patah2'),
                'un10_foto_pallet_tdk_patah3' => $request->input('un10_foto_pallet_tdk_patah3'),
                'un10_foto_produk_tdk_pakai_pallet1' => $request->input('un10_foto_produk_tdk_pakai_pallet1'),
                'un10_foto_produk_tdk_pakai_pallet2' => $request->input('un10_foto_produk_tdk_pakai_pallet2'),
                'un10_foto_produk_tdk_pakai_pallet3' => $request->input('un10_foto_produk_tdk_pakai_pallet3'),
                'un10_foto_lantai_dinding_truk_bersih1' => $request->input('un10_foto_lantai_dinding_truk_bersih1'),
                'un10_foto_lantai_dinding_truk_bersih2' => $request->input('un10_foto_lantai_dinding_truk_bersih2'),
                'un10_foto_lantai_dinding_truk_bersih3' => $request->input('un10_foto_lantai_dinding_truk_bersih3'),
                'un10_reason_cancel_load_unload' => $request->input('un10_reason_cancel_load_unload'),
            ]);
            $gate->update([
                'gateable_id' => $formUnloadingPackedGood->id,
                'gateable_type' => "App\Models\FormUnloadingPackedGood"
                ]);
            return response()->json([
                'code' => 200,
                'message' => 'Success '.$isCreate.' FormUnloadingPackedGood Form',
                'data' => [
                    $formUnloadingPackedGood]
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
            $formUnloadingPackedGood = $employee->formUnloadingPackedGood()->findOrFail($formId);
            $formUnloadingPackedGood->update([
                'un10_status' => 2,
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Success Approve FormUnloadingPackedGood Form',
                'data' => [
                    $formUnloadingPackedGood]
                ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given FormUnloadingPackedGood Form ID not found',
                'data' => []
                ], 404);
        }
    }

    public function getOne($formId){

        $employee = Auth::user();

        try{
            $formUnloadingPackedGood = $employee->formUnloadingPackedGood()->findOrFail($formId);

            return response()->json([
                'code' => 200,
                'message' => 'Success Fetch FormUnloadingPackedGood Form',
                'data' => [
                    $formUnloadingPackedGood]
                ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given FormUnloadingPackedGood Form ID not found',
                'data' => []
                ], 404);
        }
    }
}
