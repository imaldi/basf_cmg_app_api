<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormLoadingPackedGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_loading_packed_goods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('ul2_simbol_api')->nullable();
            $table->tinyInteger('ul2_simbol_cair')->nullable();
            $table->tinyInteger('ul2_simbol_tanda_seru')->nullable();
            $table->tinyInteger('ul2_simbol_flammable_solid')->nullable();
            $table->tinyInteger('ul2_persiapan_memakai_ppe')->nullable()->comment('1');
            $table->tinyInteger('ul2_persiapan_forklift_sudah_lulus')->nullable()->comment('2');
            $table->tinyInteger('ul2_persiapan_drum_handler_sdh_lulus')->nullable()->comment('3');
            $table->tinyInteger('ul2_persiapan_operator_terima_dokumen')->nullable()->comment('4');
            $table->tinyInteger('ul2_persiapan_arahkan_truk_parkir')->nullable()->comment('5');
            $table->tinyInteger('ul2_persiapan_stuffing_texapon_ocn')->nullable()->comment('6');
            $table->tinyInteger('ul2_persiapan_truk_besar_non_container')->nullable()->comment('7');
            $table->tinyInteger('ul2_persiapan_safety_cone_didepan_truk')->nullable()->comment('8');
            $table->tinyInteger('ul2_persiapan_ganjal_roda')->nullable()->comment('9');
            $table->tinyInteger('ul2_persiapan_cctv_berfungsi')->nullable()->comment('10');
            $table->tinyInteger('ul2_persiapan_pasang_signed_disisi_kanan')->nullable()->comment('11');
            $table->tinyInteger('ul2_persiapan_truk_bersih')->nullable()->comment('12');
            $table->tinyInteger('ul2_persiapan_sopir_serahkan_kunci')->nullable()->comment('13');
            $table->tinyInteger('ul2_persiapan_sopir_tinggalkan_area_unloading')->nullable()->comment('14');
            $table->tinyInteger('ul2_persiapan_adjusment_lvl_dock_aktif')->nullable()->comment('15');
            $table->tinyInteger('ul2_persiapan_safety_cone_pasang_di_adjusment_lvl')->nullable()->comment('16');
            $table->tinyInteger('ul2_persiapan_lantai_truk_bersih')->nullable()->comment('17');
            $table->tinyInteger('ul2_persiapan_container_export_checklist_7')->nullable()->comment('18');
            $table->tinyInteger('ul2_persiapan_utk_export_pallet_ispm_15')->nullable()->comment('19');
            $table->tinyInteger('ul2_persiapan_periksa_pallet')->nullable()->comment('20');
            $table->tinyInteger('ul2_persiapan_pastikan_kemasan_kosong_bersih')->nullable()->comment('21');
            $table->tinyInteger('ul2_loading_produk_tersusun_baik')->nullable()->comment('3');
            $table->tinyInteger('ul2_loading_dry_container_export')->nullable()->comment('4');
            $table->tinyInteger('ul2_loading_produk_pakai_pengaman')->nullable()->comment('5');
            $table->tinyInteger('ul2_selesai_kembalikan_adjusment_leveler')->nullable()->comment('1');
            $table->tinyInteger('ul2_selesai_khusus_cont_ocn_export')->nullable()->comment('2');
            $table->tinyInteger('ul2_selesai_dg_produk_label_terpasang')->nullable()->comment('3');
            $table->tinyInteger('ul2_loading_pastikan_tdk_orang')->nullable()->comment('1');
            $table->tinyInteger('ul2_loading_muat_produk_ke_truk')->nullable()->comment('2');
            $table->tinyInteger('ul2_selesai_panggil_sopir_kembali')->nullable()->comment('4');
            $table->tinyInteger('ul2_selesai_angkat_safety_cone')->nullable()->comment('5');
            $table->tinyInteger('ul2_selesai_nota_ekspor_wajib_ditandatangan')->nullable()->comment('6');
            $table->tinyInteger('ul2_selesai_nota_lokal_wajib_ditandatangan')->nullable()->comment('7');
            $table->tinyInteger('ul2_selesai_wh_spv_memastikan_ttd')->nullable()->comment('8');
            $table->tinyInteger('ul2_selesai_khusus_produk_kosong_ttd')->nullable()->comment('9');
            $table->tinyInteger('ul2_operator_complete')->nullable()->comment('Operator Complete');
            $table->tinyInteger('ul2_checker_complete')->nullable()->comment('Pemeriksa Complete');
            $table->tinyInteger('ul2_cancel_load_unload')->nullable()->comment('Tidak Jadi Unloading');
            $table->tinyInteger('ul2_status')->nullable()->comment('"0. trash", "1. aktif"');

            // khusus table ini varcha diganti text karena ada error "SQLSTATE[42000]: Syntax error or access violation: 1118 Row size too large."
            $table->text('ul2_persiapan_memakai_ppe_desc')->nullable()->comment('1');
            $table->text('ul2_persiapan_forklift_sudah_lulus_desc')->nullable()->comment('2');
            $table->text('ul2_persiapan_drum_handler_sdh_lulus_desc')->nullable()->comment('3');
            $table->text('ul2_persiapan_operator_terima_dokumen_desc')->nullable()->comment('4');
            $table->text('ul2_persiapan_arahkan_truk_parkir_desc')->nullable()->comment('5');
            $table->text('ul2_persiapan_stuffing_texapon_ocn_desc')->nullable()->comment('6');
            $table->text('ul2_persiapan_truk_besar_non_container_desc')->nullable()->comment('7');
            $table->text('ul2_persiapan_safety_cone_didepan_truk_desc')->nullable()->comment('8');
            $table->text('ul2_persiapan_ganjal_roda_desc')->nullable()->comment('9');
            $table->text('ul2_persiapan_cctv_berfungsi_desc')->nullable()->comment('10');
            $table->text('ul2_persiapan_pasang_signed_disisi_kanan_desc')->nullable()->comment('11');
            $table->text('ul2_persiapan_truk_bersih_desc')->nullable()->comment('12');
            $table->text('ul2_persiapan_sopir_serahkan_kunci_desc')->nullable()->comment('13');
            $table->text('ul2_persiapan_sopir_tinggalkan_area_unloading_dec')->nullable()->comment('14');
            $table->text('ul2_persiapan_adjusment_lvl_dock_aktif_desc')->nullable()->comment('15');
            $table->text('ul2_persiapan_safety_cone_pasang_di_adjusment_lvl_desc')->nullable()->comment('16');
            $table->text('ul2_persiapan_pastikan_kemasan_kosong_bersih_desc')->nullable()->comment('21');

            $table->string('ul2_report_code',255)->nullable()->comment('random code 9 character kombinasi huruf dan angka');
            $table->string('ul2_lsp_bcci',255)->nullable()->comment('LSP BCCI / Non LSP');
            $table->string('ul2_tujuan',255)->nullable()->comment('nama produk');
            $table->string('ul2_no_do',255)->nullable()->comment('No. DO');
            $table->string('ul2_lot_batch_no',255)->nullable()->comment('Lot / Batch Number');
            $table->string('ul2_no_container',255)->nullable()->comment('No. Container');
            $table->string('ul2_tipe_kemasan',255)->nullable()->comment('Kemasan');
            $table->string('ul2_jml_total',255)->nullable()->comment('Jumlah Total');
            $table->string('ul2_loading_pastikan_tdk_orang_desc',255)->nullable()->comment('1');
            $table->string('ul2_loading_muat_produk_ke_truk_desc',255)->nullable()->comment('2');
            $table->string('ul2_selesai_dg_produk_label_terpasang_desc',255)->nullable()->comment('3');
            $table->string('ul2_selesai_panggil_sopir_kembali_desc',255)->nullable()->comment('4');
            $table->string('ul2_selesai_angkat_safety_cone_desc',255)->nullable()->comment('5');
            $table->string('ul2_selesai_nota_ekspor_wajib_ditandatangan_desc',255)->nullable()->comment('6');

            // $table->string('ul1_netto_disuratjalan',255)->nullable()->comment('Berat Netto yang tertera di Surat Jalan/DO');


            $table->string('ul2_pemeriksa',255)->nullable()->comment('Diperiksa Oleh: ');
            $table->string('ul2_signature_employee',255)->nullable();
            $table->string('ul2_signature_checker',255)->nullable();
            $table->string('ul2_foto_lantai_truk_bersih1',255)->nullable();
            $table->string('ul2_foto_lantai_truk_bersih2',255)->nullable();
            $table->string('ul2_foto_lantai_truk_bersih3',255)->nullable();
            $table->string('ul2_foto_container_export_checklist1',255)->nullable();
            $table->string('ul2_foto_container_export_checklist2',255)->nullable();
            $table->string('ul2_foto_container_export_checklist3',255)->nullable();
            $table->string('ul2_foto_utk_export_pallet_ispm1',255)->nullable();
            $table->string('ul2_foto_utk_export_pallet_ispm2',255)->nullable();
            $table->string('ul2_foto_utk_export_pallet_ispm3',255)->nullable();
            $table->string('ul2_foto_periksa_pallet1',255)->nullable();
            $table->string('ul2_foto_periksa_pallet2',255)->nullable();
            $table->string('ul2_foto_periksa_pallet3',255)->nullable();
            $table->string('ul2_foto_pastikan_tdk_ada_orang_asing1',255)->nullable();
            $table->string('ul2_foto_pastikan_tdk_ada_orang_asing2',255)->nullable();
            $table->string('ul2_foto_pastikan_tdk_ada_orang_asing3',255)->nullable();
            $table->string('ul2_foto_produk_tersusun_baik1',255)->nullable();
            $table->string('ul2_foto_produk_tersusun_baik2',255)->nullable();
            $table->string('ul2_foto_produk_tersusun_baik3',255)->nullable();
            $table->string('ul2_foto_dry_container_export1',255)->nullable();
            $table->string('ul2_foto_dry_container_export2',255)->nullable();
            $table->string('ul2_foto_dry_container_export3',255)->nullable();
            $table->string('ul2_foto_produk_pakai_pengaman1',255)->nullable();
            $table->string('ul2_foto_produk_pakai_pengaman2',255)->nullable();
            $table->string('ul2_foto_produk_pakai_pengaman3',255)->nullable();
            $table->string('ul2_foto_kembalikan_adjusment_leveler1',255)->nullable();
            $table->string('ul2_foto_kembalikan_adjusment_leveler2',255)->nullable();
            $table->string('ul2_foto_kembalikan_adjusment_leveler3',255)->nullable();
            $table->string('ul2_foto_khusus_cont_ocn_export1',255)->nullable();
            $table->string('ul2_foto_khusus_cont_ocn_export2',255)->nullable();
            $table->string('ul2_foto_khusus_cont_ocn_export3',255)->nullable();
            $table->string('ul2_reason_cancel_load_unload',255)->nullable()->comment('Alasan');

            $table->unsignedBigInteger('ul2_employee_id')->nullable()->comment('join tabel m_employees');
            $table->foreign('ul2_employee_id')->references('id')->on('m_employees');
            $table->unsignedBigInteger('ul2_report_kendaraan_id')->nullable()->comment('join tabel form_gate_check');
            $table->foreign('ul2_report_kendaraan_id')->references('id')->on('form_gate_check');
            $table->Integer('ul2_jml_kemasan')->nullable()->comment('Jumlah Total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_loading_packed_goods');
    }
}
