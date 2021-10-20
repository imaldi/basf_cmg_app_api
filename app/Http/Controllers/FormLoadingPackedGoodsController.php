<?php

namespace App\Http\Controllers;

use App\Models\FormEGateCheck;
use App\Models\FormLoadingPackedGoods;
use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class FormLoadingPackedGoodsController extends Controller
{
    public function viewAll(){
        return response()->json([
            'code' => 200,
            'message' => 'Success Create Data',
            'data' =>
                FormLoadingPackedGoods::all()
            ], 200);
    }

    public function createOrUpdate(Request $request){
        $this->validate($request, [
            'form_id' => 'integer',
            'gate_id' => 'required|integer',
            'ul2_jml_kemasan' => 'integer',
            'ul2_simbol_api' => ['integer', Rule::in(['0','1','2']),],
            'ul2_simbol_cair' => ['integer', Rule::in(['0','1','2']),],
            'ul2_simbol_tanda_seru' => ['integer', Rule::in(['0','1','2']),],
            'ul2_simbol_flammable_solid' => ['integer', Rule::in(['0','1','2']),],
            'ul2_persiapan_memakai_ppe' => ['integer', Rule::in(['0','1','2']),],
            'ul2_persiapan_forklift_sudah_lulus' => ['integer', Rule::in(['0','1','2']),],
            'ul2_persiapan_drum_handler_sdh_lulus' => ['integer', Rule::in(['0','1','2']),],
            'ul2_persiapan_operator_terima_dokumen' => ['integer', Rule::in(['0','1','2']),],
            'ul2_persiapan_arahkan_truk_parkir' => ['integer', Rule::in(['0','1','2']),],
            'ul2_persiapan_stuffing_texapon_ocn' => ['integer', Rule::in(['0','1','2']),],
            'ul2_persiapan_truk_besar_non_container' => ['integer', Rule::in(['0','1','2']),],
            'ul2_persiapan_safety_cone_didepan_truk' => ['integer', Rule::in(['0','1','2']),],
            'ul2_persiapan_ganjal_roda' => ['integer', Rule::in(['0','1','2']),],
            'ul2_persiapan_cctv_berfungsi' => ['integer', Rule::in(['0','1','2']),],
            'ul2_persiapan_pasang_signed_disisi_kanan' => ['integer', Rule::in(['0','1','2']),],
            'ul2_persiapan_truk_bersih' => ['integer', Rule::in(['0','1','2']),],
            'ul2_persiapan_sopir_serahkan_kunci' => ['integer', Rule::in(['0','1','2']),],
            'ul2_persiapan_sopir_tinggalkan_area_unloading' => ['integer', Rule::in(['0','1','2']),],
            'ul2_persiapan_adjusment_lvl_dock_aktif' => ['integer', Rule::in(['0','1','2']),],
            'ul2_persiapan_safety_cone_pasang_di_adjusment_lvl' => ['integer', Rule::in(['0','1','2']),],
            'ul2_persiapan_lantai_truk_bersih' => ['integer', Rule::in(['0','1','2']),],
            'ul2_persiapan_container_export_checklist_7' => ['integer', Rule::in(['0','1','2']),],
            'ul2_persiapan_utk_export_pallet_ispm_15' => ['integer', Rule::in(['0','1','2']),],
            'ul2_persiapan_periksa_pallet' => ['integer', Rule::in(['0','1','2']),],
            'ul2_persiapan_pastikan_kemasan_kosong_bersih' => ['integer', Rule::in(['0','1','2']),],
            'ul2_loading_produk_tersusun_baik' => ['integer', Rule::in(['0','1','2']),],
            'ul2_loading_dry_container_export' => ['integer', Rule::in(['0','1','2']),],
            'ul2_loading_produk_pakai_pengaman' => ['integer', Rule::in(['0','1','2']),],
            'ul2_selesai_kembalikan_adjusment_leveler' => ['integer', Rule::in(['0','1','2']),],
            'ul2_selesai_khusus_cont_ocn_export' => ['integer', Rule::in(['0','1','2']),],
            'ul2_selesai_dg_produk_label_terpasang' => ['integer', Rule::in(['0','1','2']),],
            'ul2_loading_pastikan_tdk_orang' => ['integer', Rule::in(['0','1','2']),],
            'ul2_loading_muat_produk_ke_truk' => ['integer', Rule::in(['0','1','2']),],
            'ul2_selesai_panggil_sopir_kembali' => ['integer', Rule::in(['0','1','2']),],
            'ul2_selesai_angkat_safety_cone' => ['integer', Rule::in(['0','1','2']),],
            'ul2_selesai_nota_ekspor_wajib_ditandatangan' => ['integer', Rule::in(['0','1','2']),],
            'ul2_selesai_nota_lokal_wajib_ditandatangan' => ['integer', Rule::in(['0','1','2']),],
            'ul2_selesai_wh_spv_memastikan_ttd' => ['integer', Rule::in(['0','1','2']),],
            'ul2_selesai_khusus_produk_kosong_ttd' => ['integer', Rule::in(['0','1','2']),],
            'ul2_operator_complete' => ['integer', Rule::in(['0','1','2']),],
            'ul2_checker_complete' => ['integer', Rule::in(['0','1','2']),],
            'ul2_cancel_load_unload' => ['integer', Rule::in(['0','1','2']),],
            'ul2_status' => ['integer', Rule::in(['1','2','3']),],
            'ul2_persiapan_memakai_ppe_desc' => 'string',
            'ul2_persiapan_forklift_sudah_lulus_desc' => 'string',
            'ul2_persiapan_drum_handler_sdh_lulus_desc' => 'string',
            'ul2_persiapan_operator_terima_dokumen_desc' => 'string',
            'ul2_persiapan_arahkan_truk_parkir_desc' => 'string',
            'ul2_persiapan_stuffing_texapon_ocn_desc' => 'string',
            'ul2_persiapan_truk_besar_non_container_desc' => 'string',
            'ul2_persiapan_safety_cone_didepan_truk_desc' => 'string',
            'ul2_persiapan_ganjal_roda_desc' => 'string',
            'ul2_persiapan_cctv_berfungsi_desc' => 'string',
            'ul2_persiapan_pasang_signed_disisi_kanan_desc' => 'string',
            'ul2_persiapan_truk_bersih_desc' => 'string',
            'ul2_persiapan_sopir_serahkan_kunci_desc' => 'string',
            'ul2_persiapan_sopir_tinggalkan_area_unloading_dec' => 'string',
            'ul2_persiapan_adjusment_lvl_dock_aktif_desc' => 'string',
            'ul2_persiapan_safety_cone_pasang_di_adjusment_lvl_desc' => 'string',
            'ul2_persiapan_pastikan_kemasan_kosong_bersih_desc' => 'string',
            'ul2_report_code' => 'string|max:255',
            'ul2_lsp_bcci' => 'string|max:255',
            'ul2_tujuan' => 'string|max:255',
            'ul2_no_do' => 'string|max:255',
            'ul2_lot_batch_no' => 'string|max:255',
            'ul2_no_container' => 'string|max:255',
            'ul2_tipe_kemasan' => 'string|max:255',
            'ul2_jml_total' => 'string|max:255',
            'ul2_loading_pastikan_tdk_orang_desc' => 'string|max:255',
            'ul2_loading_muat_produk_ke_truk_desc' => 'string|max:255',
            'ul2_selesai_dg_produk_label_terpasang_desc' => 'string|max:255',
            'ul2_selesai_panggil_sopir_kembali_desc' => 'string|max:255',
            'ul2_selesai_angkat_safety_cone_desc' => 'string|max:255',
            'ul2_selesai_nota_ekspor_wajib_ditandatangan_desc' => 'string|max:255',
            'ul2_pemeriksa' => 'string|max:255',
            'ul2_signature_employee' => 'file',
            'ul2_signature_checker' => 'file',
            'ul2_foto_lantai_truk_bersih1' => 'string|max:255',
            'ul2_foto_lantai_truk_bersih2' => 'string|max:255',
            'ul2_foto_lantai_truk_bersih3' => 'string|max:255',
            'ul2_foto_container_export_checklist1' => 'string|max:255',
            'ul2_foto_container_export_checklist2' => 'string|max:255',
            'ul2_foto_container_export_checklist3' => 'string|max:255',
            'ul2_foto_utk_export_pallet_ispm1' => 'string|max:255',
            'ul2_foto_utk_export_pallet_ispm2' => 'string|max:255',
            'ul2_foto_utk_export_pallet_ispm3' => 'string|max:255',
            'ul2_foto_periksa_pallet1' => 'string|max:255',
            'ul2_foto_periksa_pallet2' => 'string|max:255',
            'ul2_foto_periksa_pallet3' => 'string|max:255',
            'ul2_foto_pastikan_tdk_ada_orang_asing1' => 'string|max:255',
            'ul2_foto_pastikan_tdk_ada_orang_asing2' => 'string|max:255',
            'ul2_foto_pastikan_tdk_ada_orang_asing3' => 'string|max:255',
            'ul2_foto_produk_tersusun_baik1' => 'string|max:255',
            'ul2_foto_produk_tersusun_baik2' => 'string|max:255',
            'ul2_foto_produk_tersusun_baik3' => 'string|max:255',
            'ul2_foto_dry_container_export1' => 'string|max:255',
            'ul2_foto_dry_container_export2' => 'string|max:255',
            'ul2_foto_dry_container_export3' => 'string|max:255',
            'ul2_foto_produk_pakai_pengaman1' => 'string|max:255',
            'ul2_foto_produk_pakai_pengaman2' => 'string|max:255',
            'ul2_foto_produk_pakai_pengaman3' => 'string|max:255',
            'ul2_foto_kembalikan_adjusment_leveler1' => 'string|max:255',
            'ul2_foto_kembalikan_adjusment_leveler2' => 'string|max:255',
            'ul2_foto_kembalikan_adjusment_leveler3' => 'string|max:255',
            'ul2_foto_khusus_cont_ocn_export1' => 'string|max:255',
            'ul2_foto_khusus_cont_ocn_export2' => 'string|max:255',
            'ul2_foto_khusus_cont_ocn_export3' => 'string|max:255',
            'ul2_reason_cancel_load_unload' => 'string|max:255',
        ]);

        $employee = Auth::user();
        try{
            $formId = $request->input('form_id');
            $gate = FormEGateCheck::findOrFail($request->input('gate_id'));

            if( $formId != null || $formId != 0){

                $isCreate = "Update";

                try{
                    $formLoadingPackedGoods = $employee->formLoadingPackedGoods()->findOrFail($formId);

                    if($gate->gateable_id != $formId && $gate->gateable_type != 'App\Models\FormLoadingPackedGoods'){
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
                        'message' => 'Given FormLoadingPackedGoods Form ID not found',
                        'data' => []
                        ], 404);
                }
            } else {
                if($gate->gateable_id != null || $gate->gateable_type != null){
                    return
                    // 'Failed';
                    response()->json([
                        'code' => 451,
                        'message' => 'Given E Gate Form Already Have A Gateable and Can\'t be changed',
                        'data' => []
                        ], 451);
                }
                $isCreate = "Create";

                $formLoadingPackedGoods = FormLoadingPackedGoods::create([
                    'ul2_employee_id' => $employee->id,
                    'ul2_report_kendaraan_id' => $gate->id,
                ]);
            }

            $formLoadingPackedGoods->update([
                // 'ul2_employee_id' => $employee->id,
                // 'ul2_report_kendaraan_id' => $gate->id,
                'ul2_jml_kemasan' => (int) $request->input('ul2_jml_kemasan'),
                'ul2_simbol_api' => (int) $request->input('ul2_simbol_api'),
                'ul2_simbol_cair' => (int) $request->input('ul2_simbol_cair'),
                'ul2_simbol_tanda_seru' => (int) $request->input('ul2_simbol_tanda_seru'),
                'ul2_simbol_flammable_solid' => (int) $request->input('ul2_simbol_flammable_solid'),
                'ul2_persiapan_memakai_ppe' => (int) $request->input('ul2_persiapan_memakai_ppe'),
                'ul2_persiapan_forklift_sudah_lulus' => (int) $request->input('ul2_persiapan_forklift_sudah_lulus'),
                'ul2_persiapan_drum_handler_sdh_lulus' => (int) $request->input('ul2_persiapan_drum_handler_sdh_lulus'),
                'ul2_persiapan_operator_terima_dokumen' => (int) $request->input('ul2_persiapan_operator_terima_dokumen'),
                'ul2_persiapan_arahkan_truk_parkir' => (int) $request->input('ul2_persiapan_arahkan_truk_parkir'),
                'ul2_persiapan_stuffing_texapon_ocn' => (int) $request->input('ul2_persiapan_stuffing_texapon_ocn'),
                'ul2_persiapan_truk_besar_non_container' => (int) $request->input('ul2_persiapan_truk_besar_non_container'),
                'ul2_persiapan_safety_cone_didepan_truk' => (int) $request->input('ul2_persiapan_safety_cone_didepan_truk'),
                'ul2_persiapan_ganjal_roda' => (int) $request->input('ul2_persiapan_ganjal_roda'),
                'ul2_persiapan_cctv_berfungsi' => (int) $request->input('ul2_persiapan_cctv_berfungsi'),
                'ul2_persiapan_pasang_signed_disisi_kanan' => (int) $request->input('ul2_persiapan_pasang_signed_disisi_kanan'),
                'ul2_persiapan_truk_bersih' => (int) $request->input('ul2_persiapan_truk_bersih'),
                'ul2_persiapan_sopir_serahkan_kunci' => (int) $request->input('ul2_persiapan_sopir_serahkan_kunci'),
                'ul2_persiapan_sopir_tinggalkan_area_unloading' => (int) $request->input('ul2_persiapan_sopir_tinggalkan_area_unloading'),
                'ul2_persiapan_adjusment_lvl_dock_aktif' => (int) $request->input('ul2_persiapan_adjusment_lvl_dock_aktif'),
                'ul2_persiapan_safety_cone_pasang_di_adjusment_lvl' => (int) $request->input('ul2_persiapan_safety_cone_pasang_di_adjusment_lvl'),
                'ul2_persiapan_lantai_truk_bersih' => (int) $request->input('ul2_persiapan_lantai_truk_bersih'),
                'ul2_persiapan_container_export_checklist_7' => (int) $request->input('ul2_persiapan_container_export_checklist_7'),
                'ul2_persiapan_utk_export_pallet_ispm_15' => (int) $request->input('ul2_persiapan_utk_export_pallet_ispm_15'),
                'ul2_persiapan_periksa_pallet' => (int) $request->input('ul2_persiapan_periksa_pallet'),
                'ul2_persiapan_pastikan_kemasan_kosong_bersih' => (int) $request->input('ul2_persiapan_pastikan_kemasan_kosong_bersih'),
                'ul2_loading_produk_tersusun_baik' => (int) $request->input('ul2_loading_produk_tersusun_baik'),
                'ul2_loading_dry_container_export' => (int) $request->input('ul2_loading_dry_container_export'),
                'ul2_loading_produk_pakai_pengaman' => (int) $request->input('ul2_loading_produk_pakai_pengaman'),
                'ul2_selesai_kembalikan_adjusment_leveler' => (int) $request->input('ul2_selesai_kembalikan_adjusment_leveler'),
                'ul2_selesai_khusus_cont_ocn_export' => (int) $request->input('ul2_selesai_khusus_cont_ocn_export'),
                'ul2_selesai_dg_produk_label_terpasang' => (int) $request->input('ul2_selesai_dg_produk_label_terpasang'),
                'ul2_loading_pastikan_tdk_orang' => (int) $request->input('ul2_loading_pastikan_tdk_orang'),
                'ul2_loading_muat_produk_ke_truk' => (int) $request->input('ul2_loading_muat_produk_ke_truk'),
                'ul2_selesai_panggil_sopir_kembali' => (int) $request->input('ul2_selesai_panggil_sopir_kembali'),
                'ul2_selesai_angkat_safety_cone' => (int) $request->input('ul2_selesai_angkat_safety_cone'),
                'ul2_selesai_nota_ekspor_wajib_ditandatangan' => (int) $request->input('ul2_selesai_nota_ekspor_wajib_ditandatangan'),
                'ul2_selesai_nota_lokal_wajib_ditandatangan' => (int) $request->input('ul2_selesai_nota_lokal_wajib_ditandatangan'),
                'ul2_selesai_wh_spv_memastikan_ttd' => (int) $request->input('ul2_selesai_wh_spv_memastikan_ttd'),
                'ul2_selesai_khusus_produk_kosong_ttd' => (int) $request->input('ul2_selesai_khusus_produk_kosong_ttd'),
                'ul2_operator_complete' => (int) $request->input('ul2_operator_complete'),
                'ul2_checker_complete' => (int) $request->input('ul2_checker_complete'),
                'ul2_cancel_load_unload' => (int) $request->input('ul2_cancel_load_unload'),
                'ul2_status' => (int) $request->input('ul2_status'),

                'ul2_persiapan_memakai_ppe_desc' => $request->input('ul2_persiapan_memakai_ppe_desc'),
                'ul2_persiapan_forklift_sudah_lulus_desc' => $request->input('ul2_persiapan_forklift_sudah_lulus_desc'),
                'ul2_persiapan_drum_handler_sdh_lulus_desc' => $request->input('ul2_persiapan_drum_handler_sdh_lulus_desc'),
                'ul2_persiapan_operator_terima_dokumen_desc' => $request->input('ul2_persiapan_operator_terima_dokumen_desc'),
                'ul2_persiapan_arahkan_truk_parkir_desc' => $request->input('ul2_persiapan_arahkan_truk_parkir_desc'),
                'ul2_persiapan_stuffing_texapon_ocn_desc' => $request->input('ul2_persiapan_stuffing_texapon_ocn_desc'),
                'ul2_persiapan_truk_besar_non_container_desc' => $request->input('ul2_persiapan_truk_besar_non_container_desc'),
                'ul2_persiapan_safety_cone_didepan_truk_desc' => $request->input('ul2_persiapan_safety_cone_didepan_truk_desc'),
                'ul2_persiapan_ganjal_roda_desc' => $request->input('ul2_persiapan_ganjal_roda_desc'),
                'ul2_persiapan_cctv_berfungsi_desc' => $request->input('ul2_persiapan_cctv_berfungsi_desc'),
                'ul2_persiapan_pasang_signed_disisi_kanan_desc' => $request->input('ul2_persiapan_pasang_signed_disisi_kanan_desc'),
                'ul2_persiapan_truk_bersih_desc' => $request->input('ul2_persiapan_truk_bersih_desc'),
                'ul2_persiapan_sopir_serahkan_kunci_desc' => $request->input('ul2_persiapan_sopir_serahkan_kunci_desc'),
                'ul2_persiapan_sopir_tinggalkan_area_unloading_dec' => $request->input('ul2_persiapan_sopir_tinggalkan_area_unloading_dec'),
                'ul2_persiapan_adjusment_lvl_dock_aktif_desc' => $request->input('ul2_persiapan_adjusment_lvl_dock_aktif_desc'),
                'ul2_persiapan_safety_cone_pasang_di_adjusment_lvl_desc' => $request->input('ul2_persiapan_safety_cone_pasang_di_adjusment_lvl_desc'),
                'ul2_persiapan_pastikan_kemasan_kosong_bersih_desc' => $request->input('ul2_persiapan_pastikan_kemasan_kosong_bersih_desc'),
                'ul2_report_code' => $request->input('ul2_report_code'),
                'ul2_lsp_bcci' => $request->input('ul2_lsp_bcci'),
                'ul2_tujuan' => $request->input('ul2_tujuan'),
                'ul2_no_do' => $request->input('ul2_no_do'),
                'ul2_lot_batch_no' => $request->input('ul2_lot_batch_no'),
                'ul2_no_container' => $request->input('ul2_no_container'),
                'ul2_tipe_kemasan' => $request->input('ul2_tipe_kemasan'),
                'ul2_jml_total' => $request->input('ul2_jml_total'),
                'ul2_loading_pastikan_tdk_orang_desc' => $request->input('ul2_loading_pastikan_tdk_orang_desc'),
                'ul2_loading_muat_produk_ke_truk_desc' => $request->input('ul2_loading_muat_produk_ke_truk_desc'),
                'ul2_selesai_dg_produk_label_terpasang_desc' => $request->input('ul2_selesai_dg_produk_label_terpasang_desc'),
                'ul2_selesai_panggil_sopir_kembali_desc' => $request->input('ul2_selesai_panggil_sopir_kembali_desc'),
                'ul2_selesai_angkat_safety_cone_desc' => $request->input('ul2_selesai_angkat_safety_cone_desc'),
                'ul2_selesai_nota_ekspor_wajib_ditandatangan_desc' => $request->input('ul2_selesai_nota_ekspor_wajib_ditandatangan_desc'),
                'ul2_pemeriksa' => $request->input('ul2_pemeriksa'),
                // 'ul2_signature_employee' => $request->input('ul2_signature_employee'),
                // 'ul2_signature_checker' => $request->input('ul2_signature_checker'),
                // 'ul2_foto_lantai_truk_bersih1' => $request->input('ul2_foto_lantai_truk_bersih1'),
                // 'ul2_foto_lantai_truk_bersih2' => $request->input('ul2_foto_lantai_truk_bersih2'),
                // 'ul2_foto_lantai_truk_bersih3' => $request->input('ul2_foto_lantai_truk_bersih3'),
                // 'ul2_foto_container_export_checklist1' => $request->input('ul2_foto_container_export_checklist1'),
                // 'ul2_foto_container_export_checklist2' => $request->input('ul2_foto_container_export_checklist2'),
                // 'ul2_foto_container_export_checklist3' => $request->input('ul2_foto_container_export_checklist3'),
                // 'ul2_foto_utk_export_pallet_ispm1' => $request->input('ul2_foto_utk_export_pallet_ispm1'),
                // 'ul2_foto_utk_export_pallet_ispm2' => $request->input('ul2_foto_utk_export_pallet_ispm2'),
                // 'ul2_foto_utk_export_pallet_ispm3' => $request->input('ul2_foto_utk_export_pallet_ispm3'),
                // 'ul2_foto_periksa_pallet1' => $request->input('ul2_foto_periksa_pallet1'),
                // 'ul2_foto_periksa_pallet2' => $request->input('ul2_foto_periksa_pallet2'),
                // 'ul2_foto_periksa_pallet3' => $request->input('ul2_foto_periksa_pallet3'),
                // 'ul2_foto_pastikan_tdk_ada_orang_asing1' => $request->input('ul2_foto_pastikan_tdk_ada_orang_asing1'),
                // 'ul2_foto_pastikan_tdk_ada_orang_asing2' => $request->input('ul2_foto_pastikan_tdk_ada_orang_asing2'),
                // 'ul2_foto_pastikan_tdk_ada_orang_asing3' => $request->input('ul2_foto_pastikan_tdk_ada_orang_asing3'),
                // 'ul2_foto_produk_tersusun_baik1' => $request->input('ul2_foto_produk_tersusun_baik1'),
                // 'ul2_foto_produk_tersusun_baik2' => $request->input('ul2_foto_produk_tersusun_baik2'),
                // 'ul2_foto_produk_tersusun_baik3' => $request->input('ul2_foto_produk_tersusun_baik3'),
                // 'ul2_foto_dry_container_export1' => $request->input('ul2_foto_dry_container_export1'),
                // 'ul2_foto_dry_container_export2' => $request->input('ul2_foto_dry_container_export2'),
                // 'ul2_foto_dry_container_export3' => $request->input('ul2_foto_dry_container_export3'),
                // 'ul2_foto_produk_pakai_pengaman1' => $request->input('ul2_foto_produk_pakai_pengaman1'),
                // 'ul2_foto_produk_pakai_pengaman2' => $request->input('ul2_foto_produk_pakai_pengaman2'),
                // 'ul2_foto_produk_pakai_pengaman3' => $request->input('ul2_foto_produk_pakai_pengaman3'),
                // 'ul2_foto_kembalikan_adjusment_leveler1' => $request->input('ul2_foto_kembalikan_adjusment_leveler1'),
                // 'ul2_foto_kembalikan_adjusment_leveler2' => $request->input('ul2_foto_kembalikan_adjusment_leveler2'),
                // 'ul2_foto_kembalikan_adjusment_leveler3' => $request->input('ul2_foto_kembalikan_adjusment_leveler3'),
                // 'ul2_foto_khusus_cont_ocn_export1' => $request->input('ul2_foto_khusus_cont_ocn_export1'),
                // 'ul2_foto_khusus_cont_ocn_export2' => $request->input('ul2_foto_khusus_cont_ocn_export2'),
                // 'ul2_foto_khusus_cont_ocn_export3' => $request->input('ul2_foto_khusus_cont_ocn_export3'),
                'ul2_reason_cancel_load_unload' => $request->input('ul2_reason_cancel_load_unload'),
            ]);
            $gate->update([
                'gateable_id' => $formLoadingPackedGoods->id,
                'gateable_type' => "App\Models\FormLoadingPackedGoods"
            ]);

            if($request->input('ul2_signature_checker')){
                $decodedDocs = base64_decode($request->input('ul2_signature_checker'));


                $name = time()."someone_that_i_used_to_know.png";
                file_put_contents('uploads/unloading/signatures/'.$name, $decodedDocs);


                $formLoadingPackedGoods->update(
                    [
                        'ul2_signature_checker' => $name,
                        ]
                    );

            }
            if($request->input('ul2_signature_employee')){
                $decodedDocs = base64_decode($request->input('ul2_signature_employee'));


                $name = time()."someone_that_i_used_to_know.png";
                file_put_contents('uploads/unloading/signatures/'.$name, $decodedDocs);


                $formLoadingPackedGoods->update(
                    [
                        'ul2_signature_employee' => $name,
                        ]
                    );

            }

            if($request->file('ul2_foto_lantai_truk_bersih1')){
                $file_ul2_foto_lantai_truk_bersih1 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_lantai_truk_bersih1;
                if(is_file($file_ul2_foto_lantai_truk_bersih1)){
                    unlink(public_path($file_ul2_foto_lantai_truk_bersih1));
                }
                $name_ul2_foto_lantai_truk_bersih1 = time().$request->file('ul2_foto_lantai_truk_bersih1')->getClientOriginalName();
                $request->file('ul2_foto_lantai_truk_bersih1')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_lantai_truk_bersih1);
                $gate->update(
                    [
                        'ul2_foto_lantai_truk_bersih1' => $name_ul2_foto_lantai_truk_bersih1,
                    ]
                );
            }

            if($request->file('ul2_foto_lantai_truk_bersih2')){
                $file_ul2_foto_lantai_truk_bersih2 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_lantai_truk_bersih2;
                if(is_file($file_ul2_foto_lantai_truk_bersih2)){
                    unlink(public_path($file_ul2_foto_lantai_truk_bersih2));
                }
                $name_ul2_foto_lantai_truk_bersih2 = time().$request->file('ul2_foto_lantai_truk_bersih2')->getClientOriginalName();
                $request->file('ul2_foto_lantai_truk_bersih2')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_lantai_truk_bersih2);
                $gate->update(
                    [
                        'ul2_foto_lantai_truk_bersih2' => $name_ul2_foto_lantai_truk_bersih2,
                    ]
                );
            }

            if($request->file('ul2_foto_lantai_truk_bersih3')){
                $file_ul2_foto_lantai_truk_bersih3 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_lantai_truk_bersih3;
                if(is_file($file_ul2_foto_lantai_truk_bersih3)){
                    unlink(public_path($file_ul2_foto_lantai_truk_bersih3));
                }
                $name_ul2_foto_lantai_truk_bersih3 = time().$request->file('ul2_foto_lantai_truk_bersih3')->getClientOriginalName();
                $request->file('ul2_foto_lantai_truk_bersih3')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_lantai_truk_bersih3);
                $gate->update(
                    [
                        'ul2_foto_lantai_truk_bersih3' => $name_ul2_foto_lantai_truk_bersih3,
                    ]
                );
            }

            if($request->file('ul2_foto_container_export_checklist1')){
                $file_ul2_foto_container_export_checklist1 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_container_export_checklist1;
                if(is_file($file_ul2_foto_container_export_checklist1)){
                    unlink(public_path($file_ul2_foto_container_export_checklist1));
                }
                $name_ul2_foto_container_export_checklist1 = time().$request->file('ul2_foto_container_export_checklist1')->getClientOriginalName();
                $request->file('ul2_foto_container_export_checklist1')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_container_export_checklist1);
                $gate->update(
                    [
                        'ul2_foto_container_export_checklist1' => $name_ul2_foto_container_export_checklist1,
                    ]
                );
            }

            if($request->file('ul2_foto_container_export_checklist2')){
                $file_ul2_foto_container_export_checklist2 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_container_export_checklist2;
                if(is_file($file_ul2_foto_container_export_checklist2)){
                    unlink(public_path($file_ul2_foto_container_export_checklist2));
                }
                $name_ul2_foto_container_export_checklist2 = time().$request->file('ul2_foto_container_export_checklist2')->getClientOriginalName();
                $request->file('ul2_foto_container_export_checklist2')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_container_export_checklist2);
                $gate->update(
                    [
                        'ul2_foto_container_export_checklist2' => $name_ul2_foto_container_export_checklist2,
                    ]
                );
            }

            if($request->file('ul2_foto_container_export_checklist3')){
                $file_ul2_foto_container_export_checklist3 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_container_export_checklist3;
                if(is_file($file_ul2_foto_container_export_checklist3)){
                    unlink(public_path($file_ul2_foto_container_export_checklist3));
                }
                $name_ul2_foto_container_export_checklist3 = time().$request->file('ul2_foto_container_export_checklist3')->getClientOriginalName();
                $request->file('ul2_foto_container_export_checklist3')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_container_export_checklist3);
                $gate->update(
                    [
                        'ul2_foto_container_export_checklist3' => $name_ul2_foto_container_export_checklist3,
                    ]
                );
            }

            if($request->file('ul2_foto_utk_export_pallet_ispm1')){
                $file_ul2_foto_utk_export_pallet_ispm1 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_utk_export_pallet_ispm1;
                if(is_file($file_ul2_foto_utk_export_pallet_ispm1)){
                    unlink(public_path($file_ul2_foto_utk_export_pallet_ispm1));
                }
                $name_ul2_foto_utk_export_pallet_ispm1 = time().$request->file('ul2_foto_utk_export_pallet_ispm1')->getClientOriginalName();
                $request->file('ul2_foto_utk_export_pallet_ispm1')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_utk_export_pallet_ispm1);
                $gate->update(
                    [
                        'ul2_foto_utk_export_pallet_ispm1' => $name_ul2_foto_utk_export_pallet_ispm1,
                    ]
                );
            }

            if($request->file('ul2_foto_utk_export_pallet_ispm2')){
                $file_ul2_foto_utk_export_pallet_ispm2 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_utk_export_pallet_ispm2;
                if(is_file($file_ul2_foto_utk_export_pallet_ispm2)){
                    unlink(public_path($file_ul2_foto_utk_export_pallet_ispm2));
                }
                $name_ul2_foto_utk_export_pallet_ispm2 = time().$request->file('ul2_foto_utk_export_pallet_ispm2')->getClientOriginalName();
                $request->file('ul2_foto_utk_export_pallet_ispm2')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_utk_export_pallet_ispm2);
                $gate->update(
                    [
                        'ul2_foto_utk_export_pallet_ispm2' => $name_ul2_foto_utk_export_pallet_ispm2,
                    ]
                );
            }

            if($request->file('ul2_foto_utk_export_pallet_ispm3')){
                $file_ul2_foto_utk_export_pallet_ispm3 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_utk_export_pallet_ispm3;
                if(is_file($file_ul2_foto_utk_export_pallet_ispm3)){
                    unlink(public_path($file_ul2_foto_utk_export_pallet_ispm3));
                }
                $name_ul2_foto_utk_export_pallet_ispm3 = time().$request->file('ul2_foto_utk_export_pallet_ispm3')->getClientOriginalName();
                $request->file('ul2_foto_utk_export_pallet_ispm3')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_utk_export_pallet_ispm3);
                $gate->update(
                    [
                        'ul2_foto_utk_export_pallet_ispm3' => $name_ul2_foto_utk_export_pallet_ispm3,
                    ]
                );
            }

            if($request->file('ul2_foto_periksa_pallet1')){
                $file_ul2_foto_periksa_pallet1 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_periksa_pallet1;
                if(is_file($file_ul2_foto_periksa_pallet1)){
                    unlink(public_path($file_ul2_foto_periksa_pallet1));
                }
                $name_ul2_foto_periksa_pallet1 = time().$request->file('ul2_foto_periksa_pallet1')->getClientOriginalName();
                $request->file('ul2_foto_periksa_pallet1')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_periksa_pallet1);
                $gate->update(
                    [
                        'ul2_foto_periksa_pallet1' => $name_ul2_foto_periksa_pallet1,
                    ]
                );
            }

            if($request->file('ul2_foto_periksa_pallet2')){
                $file_ul2_foto_periksa_pallet2 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_periksa_pallet2;
                if(is_file($file_ul2_foto_periksa_pallet2)){
                    unlink(public_path($file_ul2_foto_periksa_pallet2));
                }
                $name_ul2_foto_periksa_pallet2 = time().$request->file('ul2_foto_periksa_pallet2')->getClientOriginalName();
                $request->file('ul2_foto_periksa_pallet2')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_periksa_pallet2);
                $gate->update(
                    [
                        'ul2_foto_periksa_pallet2' => $name_ul2_foto_periksa_pallet2,
                    ]
                );
            }

            if($request->file('ul2_foto_periksa_pallet3')){
                $file_ul2_foto_periksa_pallet3 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_periksa_pallet3;
                if(is_file($file_ul2_foto_periksa_pallet3)){
                    unlink(public_path($file_ul2_foto_periksa_pallet3));
                }
                $name_ul2_foto_periksa_pallet3 = time().$request->file('ul2_foto_periksa_pallet3')->getClientOriginalName();
                $request->file('ul2_foto_periksa_pallet3')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_periksa_pallet3);
                $gate->update(
                    [
                        'ul2_foto_periksa_pallet3' => $name_ul2_foto_periksa_pallet3,
                    ]
                );
            }

            if($request->file('ul2_foto_pastikan_tdk_ada_orang_asing1')){
                $file_ul2_foto_pastikan_tdk_ada_orang_asing1 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_pastikan_tdk_ada_orang_asing1;
                if(is_file($file_ul2_foto_pastikan_tdk_ada_orang_asing1)){
                    unlink(public_path($file_ul2_foto_pastikan_tdk_ada_orang_asing1));
                }
                $name_ul2_foto_pastikan_tdk_ada_orang_asing1 = time().$request->file('ul2_foto_pastikan_tdk_ada_orang_asing1')->getClientOriginalName();
                $request->file('ul2_foto_pastikan_tdk_ada_orang_asing1')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_pastikan_tdk_ada_orang_asing1);
                $gate->update(
                    [
                        'ul2_foto_pastikan_tdk_ada_orang_asing1' => $name_ul2_foto_pastikan_tdk_ada_orang_asing1,
                    ]
                );
            }

            if($request->file('ul2_foto_pastikan_tdk_ada_orang_asing2')){
                $file_ul2_foto_pastikan_tdk_ada_orang_asing2 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_pastikan_tdk_ada_orang_asing2;
                if(is_file($file_ul2_foto_pastikan_tdk_ada_orang_asing2)){
                    unlink(public_path($file_ul2_foto_pastikan_tdk_ada_orang_asing2));
                }
                $name_ul2_foto_pastikan_tdk_ada_orang_asing2 = time().$request->file('ul2_foto_pastikan_tdk_ada_orang_asing2')->getClientOriginalName();
                $request->file('ul2_foto_pastikan_tdk_ada_orang_asing2')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_pastikan_tdk_ada_orang_asing2);
                $gate->update(
                    [
                        'ul2_foto_pastikan_tdk_ada_orang_asing2' => $name_ul2_foto_pastikan_tdk_ada_orang_asing2,
                    ]
                );
            }

            if($request->file('ul2_foto_pastikan_tdk_ada_orang_asing3')){
                $file_ul2_foto_pastikan_tdk_ada_orang_asing3 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_pastikan_tdk_ada_orang_asing3;
                if(is_file($file_ul2_foto_pastikan_tdk_ada_orang_asing3)){
                    unlink(public_path($file_ul2_foto_pastikan_tdk_ada_orang_asing3));
                }
                $name_ul2_foto_pastikan_tdk_ada_orang_asing3 = time().$request->file('ul2_foto_pastikan_tdk_ada_orang_asing3')->getClientOriginalName();
                $request->file('ul2_foto_pastikan_tdk_ada_orang_asing3')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_pastikan_tdk_ada_orang_asing3);
                $gate->update(
                    [
                        'ul2_foto_pastikan_tdk_ada_orang_asing3' => $name_ul2_foto_pastikan_tdk_ada_orang_asing3,
                    ]
                );
            }

            if($request->file('ul2_foto_produk_tersusun_baik1')){
                $file_ul2_foto_produk_tersusun_baik1 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_produk_tersusun_baik1;
                if(is_file($file_ul2_foto_produk_tersusun_baik1)){
                    unlink(public_path($file_ul2_foto_produk_tersusun_baik1));
                }
                $name_ul2_foto_produk_tersusun_baik1 = time().$request->file('ul2_foto_produk_tersusun_baik1')->getClientOriginalName();
                $request->file('ul2_foto_produk_tersusun_baik1')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_produk_tersusun_baik1);
                $gate->update(
                    [
                        'ul2_foto_produk_tersusun_baik1' => $name_ul2_foto_produk_tersusun_baik1,
                    ]
                );
            }

            if($request->file('ul2_foto_produk_tersusun_baik2')){
                $file_ul2_foto_produk_tersusun_baik2 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_produk_tersusun_baik2;
                if(is_file($file_ul2_foto_produk_tersusun_baik2)){
                    unlink(public_path($file_ul2_foto_produk_tersusun_baik2));
                }
                $name_ul2_foto_produk_tersusun_baik2 = time().$request->file('ul2_foto_produk_tersusun_baik2')->getClientOriginalName();
                $request->file('ul2_foto_produk_tersusun_baik2')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_produk_tersusun_baik2);
                $gate->update(
                    [
                        'ul2_foto_produk_tersusun_baik2' => $name_ul2_foto_produk_tersusun_baik2,
                    ]
                );
            }

            if($request->file('ul2_foto_produk_tersusun_baik3')){
                $file_ul2_foto_produk_tersusun_baik3 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_produk_tersusun_baik3;
                if(is_file($file_ul2_foto_produk_tersusun_baik3)){
                    unlink(public_path($file_ul2_foto_produk_tersusun_baik3));
                }
                $name_ul2_foto_produk_tersusun_baik3 = time().$request->file('ul2_foto_produk_tersusun_baik3')->getClientOriginalName();
                $request->file('ul2_foto_produk_tersusun_baik3')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_produk_tersusun_baik3);
                $gate->update(
                    [
                        'ul2_foto_produk_tersusun_baik3' => $name_ul2_foto_produk_tersusun_baik3,
                    ]
                );
            }

            if($request->file('ul2_foto_dry_container_export1')){
                $file_ul2_foto_dry_container_export1 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_dry_container_export1;
                if(is_file($file_ul2_foto_dry_container_export1)){
                    unlink(public_path($file_ul2_foto_dry_container_export1));
                }
                $name_ul2_foto_dry_container_export1 = time().$request->file('ul2_foto_dry_container_export1')->getClientOriginalName();
                $request->file('ul2_foto_dry_container_export1')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_dry_container_export1);
                $gate->update(
                    [
                        'ul2_foto_dry_container_export1' => $name_ul2_foto_dry_container_export1,
                    ]
                );
            }

            if($request->file('ul2_foto_dry_container_export2')){
                $file_ul2_foto_dry_container_export2 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_dry_container_export2;
                if(is_file($file_ul2_foto_dry_container_export2)){
                    unlink(public_path($file_ul2_foto_dry_container_export2));
                }
                $name_ul2_foto_dry_container_export2 = time().$request->file('ul2_foto_dry_container_export2')->getClientOriginalName();
                $request->file('ul2_foto_dry_container_export2')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_dry_container_export2);
                $gate->update(
                    [
                        'ul2_foto_dry_container_export2' => $name_ul2_foto_dry_container_export2,
                    ]
                );
            }

            if($request->file('ul2_foto_dry_container_export3')){
                $file_ul2_foto_dry_container_export3 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_dry_container_export3;
                if(is_file($file_ul2_foto_dry_container_export3)){
                    unlink(public_path($file_ul2_foto_dry_container_export3));
                }
                $name_ul2_foto_dry_container_export3 = time().$request->file('ul2_foto_dry_container_export3')->getClientOriginalName();
                $request->file('ul2_foto_dry_container_export3')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_dry_container_export3);
                $gate->update(
                    [
                        'ul2_foto_dry_container_export3' => $name_ul2_foto_dry_container_export3,
                    ]
                );
            }

            if($request->file('ul2_foto_produk_pakai_pengaman1')){
                $file_ul2_foto_produk_pakai_pengaman1 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_produk_pakai_pengaman1;
                if(is_file($file_ul2_foto_produk_pakai_pengaman1)){
                    unlink(public_path($file_ul2_foto_produk_pakai_pengaman1));
                }
                $name_ul2_foto_produk_pakai_pengaman1 = time().$request->file('ul2_foto_produk_pakai_pengaman1')->getClientOriginalName();
                $request->file('ul2_foto_produk_pakai_pengaman1')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_produk_pakai_pengaman1);
                $gate->update(
                    [
                        'ul2_foto_produk_pakai_pengaman1' => $name_ul2_foto_produk_pakai_pengaman1,
                    ]
                );
            }

            if($request->file('ul2_foto_produk_pakai_pengaman2')){
                $file_ul2_foto_produk_pakai_pengaman2 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_produk_pakai_pengaman2;
                if(is_file($file_ul2_foto_produk_pakai_pengaman2)){
                    unlink(public_path($file_ul2_foto_produk_pakai_pengaman2));
                }
                $name_ul2_foto_produk_pakai_pengaman2 = time().$request->file('ul2_foto_produk_pakai_pengaman2')->getClientOriginalName();
                $request->file('ul2_foto_produk_pakai_pengaman2')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_produk_pakai_pengaman2);
                $gate->update(
                    [
                        'ul2_foto_produk_pakai_pengaman2' => $name_ul2_foto_produk_pakai_pengaman2,
                    ]
                );
            }

            if($request->file('ul2_foto_produk_pakai_pengaman3')){
                $file_ul2_foto_produk_pakai_pengaman3 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_produk_pakai_pengaman3;
                if(is_file($file_ul2_foto_produk_pakai_pengaman3)){
                    unlink(public_path($file_ul2_foto_produk_pakai_pengaman3));
                }
                $name_ul2_foto_produk_pakai_pengaman3 = time().$request->file('ul2_foto_produk_pakai_pengaman3')->getClientOriginalName();
                $request->file('ul2_foto_produk_pakai_pengaman3')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_produk_pakai_pengaman3);
                $gate->update(
                    [
                        'ul2_foto_produk_pakai_pengaman3' => $name_ul2_foto_produk_pakai_pengaman3,
                    ]
                );
            }

            if($request->file('ul2_foto_kembalikan_adjusment_leveler1')){
                $file_ul2_foto_kembalikan_adjusment_leveler1 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_kembalikan_adjusment_leveler1;
                if(is_file($file_ul2_foto_kembalikan_adjusment_leveler1)){
                    unlink(public_path($file_ul2_foto_kembalikan_adjusment_leveler1));
                }
                $name_ul2_foto_kembalikan_adjusment_leveler1 = time().$request->file('ul2_foto_kembalikan_adjusment_leveler1')->getClientOriginalName();
                $request->file('ul2_foto_kembalikan_adjusment_leveler1')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_kembalikan_adjusment_leveler1);
                $gate->update(
                    [
                        'ul2_foto_kembalikan_adjusment_leveler1' => $name_ul2_foto_kembalikan_adjusment_leveler1,
                    ]
                );
            }

            if($request->file('ul2_foto_kembalikan_adjusment_leveler2')){
                $file_ul2_foto_kembalikan_adjusment_leveler2 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_kembalikan_adjusment_leveler2;
                if(is_file($file_ul2_foto_kembalikan_adjusment_leveler2)){
                    unlink(public_path($file_ul2_foto_kembalikan_adjusment_leveler2));
                }
                $name_ul2_foto_kembalikan_adjusment_leveler2 = time().$request->file('ul2_foto_kembalikan_adjusment_leveler2')->getClientOriginalName();
                $request->file('ul2_foto_kembalikan_adjusment_leveler2')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_kembalikan_adjusment_leveler2);
                $gate->update(
                    [
                        'ul2_foto_kembalikan_adjusment_leveler2' => $name_ul2_foto_kembalikan_adjusment_leveler2,
                    ]
                );
            }

            if($request->file('ul2_foto_kembalikan_adjusment_leveler3')){
                $file_ul2_foto_kembalikan_adjusment_leveler3 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_kembalikan_adjusment_leveler3;
                if(is_file($file_ul2_foto_kembalikan_adjusment_leveler3)){
                    unlink(public_path($file_ul2_foto_kembalikan_adjusment_leveler3));
                }
                $name_ul2_foto_kembalikan_adjusment_leveler3 = time().$request->file('ul2_foto_kembalikan_adjusment_leveler3')->getClientOriginalName();
                $request->file('ul2_foto_kembalikan_adjusment_leveler3')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_kembalikan_adjusment_leveler3);
                $gate->update(
                    [
                        'ul2_foto_kembalikan_adjusment_leveler3' => $name_ul2_foto_kembalikan_adjusment_leveler3,
                    ]
                );
            }

            if($request->file('ul2_foto_khusus_cont_ocn_export1')){
                $file_ul2_foto_khusus_cont_ocn_export1 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_khusus_cont_ocn_export1;
                if(is_file($file_ul2_foto_khusus_cont_ocn_export1)){
                    unlink(public_path($file_ul2_foto_khusus_cont_ocn_export1));
                }
                $name_ul2_foto_khusus_cont_ocn_export1 = time().$request->file('ul2_foto_khusus_cont_ocn_export1')->getClientOriginalName();
                $request->file('ul2_foto_khusus_cont_ocn_export1')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_khusus_cont_ocn_export1);
                $gate->update(
                    [
                        'ul2_foto_khusus_cont_ocn_export1' => $name_ul2_foto_khusus_cont_ocn_export1,
                    ]
                );
            }

            if($request->file('ul2_foto_khusus_cont_ocn_export2')){
                $file_ul2_foto_khusus_cont_ocn_export2 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_khusus_cont_ocn_export2;
                if(is_file($file_ul2_foto_khusus_cont_ocn_export2)){
                    unlink(public_path($file_ul2_foto_khusus_cont_ocn_export2));
                }
                $name_ul2_foto_khusus_cont_ocn_export2 = time().$request->file('ul2_foto_khusus_cont_ocn_export2')->getClientOriginalName();
                $request->file('ul2_foto_khusus_cont_ocn_export2')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_khusus_cont_ocn_export2);
                $gate->update(
                    [
                        'ul2_foto_khusus_cont_ocn_export2' => $name_ul2_foto_khusus_cont_ocn_export2,
                    ]
                );
            }

            if($request->file('ul2_foto_khusus_cont_ocn_export3')){
                $file_ul2_foto_khusus_cont_ocn_export3 = 'uploads/unloading/form_loading_packed_goods'.$gate->ul2_foto_khusus_cont_ocn_export3;
                if(is_file($file_ul2_foto_khusus_cont_ocn_export3)){
                    unlink(public_path($file_ul2_foto_khusus_cont_ocn_export3));
                }
                $name_ul2_foto_khusus_cont_ocn_export3 = time().$request->file('ul2_foto_khusus_cont_ocn_export3')->getClientOriginalName();
                $request->file('ul2_foto_khusus_cont_ocn_export3')->move('uploads/unloading/form_loading_packed_goods',$name_ul2_foto_khusus_cont_ocn_export3);
                $gate->update(
                    [
                        'ul2_foto_khusus_cont_ocn_export3' => $name_ul2_foto_khusus_cont_ocn_export3,
                    ]
                );
            }

            return response()->json([
                'code' => 200,
                'message' => 'Success '.$isCreate.' FormLoadingPackedGoods Form',
                'data' => [
                    $formLoadingPackedGoods
                ]], 200);


        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given E Gate Form ID not found',
                'data' => []
                ], 404);
        }
    }

    public function approve($formId){
        // $formId = $request->input('form_id');
        $employee = Auth::user();

        try{
            $formLoadingPackedGoods = $employee->formLoadingPackedGoods()->findOrFail($formId);
            $formLoadingPackedGoods->update([
                'ul2_status' => 2,
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Success Approve FormLoadingPackedGoods Form',
                'data' => [
                    $formLoadingPackedGoods
            ]], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given formLoadingPackedGoods Form ID not found',
                'data' => []
                ], 404);
        }


    }

    public function getOne($formId){

        $employee = Auth::user();

        try{
            $formLoadingPackedGoods = $employee->formLoadingPackedGoods()->findOrFail($formId);

            return response()->json([
                'code' => 200,
                'message' => 'Success Fetch FormLoadingPackedGoods Form',
                'data' => [
                    $formLoadingPackedGoods]
                ], 200);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'code' => 404,
                'message' => 'Given FormLoadingPackedGoods Form ID not found',
                'data' => []
                ], 404);
        }
    }
}
