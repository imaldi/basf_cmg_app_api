<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormUnloadingPackedGoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_unloading_packed_good', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('un10_employee_id')->nullable()->comment('join tabel m_employees');
            $table->foreign('un10_employee_id')->references('id')->on('m_employees');
            $table->unsignedBigInteger('un10_report_kendaraan_id')->nullable()->comment('join tabel form_gate_check');
            $table->foreign('un10_report_kendaraan_id')->references('id')->on('form_gate_check');
            $table->string('un10_report_code',255)->nullable()->comment('random code 9 character kombinasi huruf dan angka');
            $table->string('un10_no_po',255)->nullable()->comment('No. PO');
            $table->string('un10_jml_kemasan',255)->nullable()->comment('Kemasan');
            $table->string('un10_tipe_kemasan',255)->nullable()->comment('Jumlah Kemasan');
            $table->string('un10_jml_total',255)->nullable()->comment('Jumlah Total');
            $table->string('un10_jml_dimuat',255)->nullable()->comment('Quantity yang dimuat');

            $table->tinyInteger('un10_simbol_1')->nullable()->comment('check');
            $table->tinyInteger('un10_simbol_2')->nullable()->comment('check');
            $table->tinyInteger('un10_simbol_3')->nullable()->comment('check');
            $table->tinyInteger('un10_simbol_4')->nullable()->comment('check');
            $table->tinyInteger('un10_simbol_5')->nullable()->comment('check');
            $table->tinyInteger('un10_simbol_6')->nullable()->comment('check');
            $table->tinyInteger('un10_simbol_7')->nullable()->comment('check');

            $table->tinyInteger('un10_persiapan_memakai_ppe')->nullable()->comment('1');
            $table->string('un10_persiapan_memakai_ppe_desc',255)->nullable()->comment('1');
            $table->tinyInteger('un10_persiapan_forklift_sudah_lulus')->nullable()->comment('2');
            $table->string('un10_persiapan_forklift_sudah_lulus_desc',255)->nullable()->comment('2');
            $table->tinyInteger('un10_persiapan_drum_handler_sdh_lulus')->nullable()->comment('3');
            $table->string('un10_persiapan_drum_handler_sdh_lulus_desc',255)->nullable()->comment('3');
            $table->tinyInteger('un10_persiapan_operator_terima_dokumen')->nullable()->comment('4');
            $table->string('un10_persiapan_operator_terima_dokumen_desc',255)->nullable()->comment('4');
            $table->tinyInteger('un10_persiapan_arahkan_truk_parkir')->nullable()->comment('5');
            $table->string('un10_persiapan_arahkan_truk_parkir_desc',255)->nullable()->comment('5');
            $table->tinyInteger('un10_persiapan_ganjal_roda')->nullable()->comment('6');
            $table->string('un10_persiapan_ganjal_roda_desc',255)->nullable()->comment('6');
            $table->tinyInteger('un10_persiapan_safety_cone')->nullable()->comment('7');
            $table->string('un10_persiapan_safety_cone_desc',255)->nullable()->comment('7');
            $table->tinyInteger('un10_persiapan_sopir_serahkan_kunci')->nullable()->comment('8');
            $table->string('un10_persiapan_sopir_serahkan_kunci_desc',255)->nullable()->comment('8');
            $table->tinyInteger('un10_persiapan_sopir_kenek_leave_unloading')->nullable()->comment('9');
            $table->string('un10_persiapan_sopir_kenek_leave_unloading_desc',255)->nullable()->comment('9');
            $table->tinyInteger('un10_persiapan_truk_bersih')->nullable()->comment('10');
            $table->string('un10_persiapan_truk_bersih_desc',255)->nullable()->comment('10');
            $table->tinyInteger('un10_persiapan_cctv_berfungsi')->nullable()->comment('11');
            $table->string('un10_persiapan_cctv_berfungsi_desc',255)->nullable()->comment('11');
            $table->tinyInteger('un10_persiapan_container_tersegel')->nullable()->comment('12');
            $table->string('un10_persiapan_container_tersegel_desc',255)->nullable()->comment('12');
            $table->tinyInteger('un10_persiapan_pintu_container_sdh_dibuka')->nullable()->comment('13');
            $table->string('un10_persiapan_pintu_container_sdh_dibuka_desc',255)->nullable()->comment('13');
            $table->tinyInteger('un10_persiapan_truk_non_container_buka_terpal')->nullable()->comment('14');
            $table->string('un10_persiapan_truk_non_container_buka_terpal_dec',255)->nullable()->comment('14');
            $table->tinyInteger('un10_persiapan_adjusment_lvl_dock_aktif')->nullable()->comment('15');
            $table->string('un10_persiapan_adjusment_lvl_dock_aktif_desc',255)->nullable()->comment('15');
            $table->tinyInteger('un10_persiapan_safety_cone_pasang_di_adjusment_lvl')->nullable()->comment('16');
            $table->string('un10_persiapan_safety_cone_pasang_di_adjusment_lvl_desc',255)->nullable()->comment('16');
            $table->tinyInteger('un10_persiapan_susunan_produk_rapi')->nullable()->comment('17');
            $table->tinyInteger('un10_persiapan_pallet_tdk_patah')->nullable()->comment('18');
            $table->tinyInteger('un10_persiapan_produk_tdk_pakai_pallet')->nullable()->comment('19');

            $table->tinyInteger('un10_unloading_turunkan_produk_dg_forklift')->nullable()->comment('1');
            $table->string('un10_unloading_turunkan_produk_dg_forklift_desc',255)->nullable()->comment('1');
            $table->tinyInteger('un10_unloading_turunkan_produk_dg_drum_handler')->nullable()->comment('2');
            $table->string('un10_unloading_turunkan_produk_dg_drum_handler_desc',255)->nullable()->comment('2');
            $table->tinyInteger('un10_unloading_gunakan_tenaga_manusia')->nullable()->comment('3');
            $table->string('un10_unloading_gunakan_tenaga_manusia_desc',255)->nullable()->comment('3');
            $table->tinyInteger('un10_unloading_produk_tdk_rusak')->nullable()->comment('4');
            $table->string('un10_unloading_produk_tdk_rusak_desc',255)->nullable()->comment('4');
            $table->tinyInteger('un10_unloading_label_sesuai')->nullable()->comment('5');
            $table->string('un10_unloading_label_sesuai_desc',255)->nullable()->comment('5');
            $table->tinyInteger('un10_unloading_expire_date')->nullable()->comment('6');
            $table->string('un10_unloading_expire_date_desc',255)->nullable()->comment('6');
            $table->tinyInteger('un10_unloading_jml_barang_sesuai')->nullable()->comment('7');
            $table->string('un10_unloading_jml_barang_sesuai_desc',255)->nullable()->comment('7');

            $table->tinyInteger('un10_selesai_lantai_dinding_truk_bersih')->nullable();
            $table->tinyInteger('un10_selesai_timbang_acak')->nullable();
            $table->string('un10_selesai_timbang_acak_dec',255)->nullable();
            $table->tinyInteger('un10_selesai_stiker_sdh_dipasang')->nullable();
            $table->string('un10_selesai_stiker_sdh_dipasang_desc',255)->nullable();
            $table->tinyInteger('un10_selesai_panggil_sopir_kembali')->nullable();
            $table->string('un10_selesai_panggil_sopir_kembali_desc',255)->nullable();
            $table->tinyInteger('un10_selesai_tandatangan_serahterima')->nullable();

            $table->string('un10_pemeriksa',255)->nullable()->comment('Berat Netto yang tertera di Surat Jalan/DO');
            $table->string('un10_signature_employee',255)->nullable()->comment('Berat Netto hasil penimbangan yang aktual diterima');
            $table->string('un10_signature_checker',255)->nullable()->comment('Diperiksa Oleh: ');
            $table->tinyInteger('un10_status')->nullable()->comment('"0. trash", "1. aktif"');
            $table->string('un10_delete_reason',255)->nullable();
            $table->string('un10_foto_container_tersegel1',255)->nullable();
            $table->string('un10_foto_container_tersegel2',255)->nullable();
            $table->string('un10_foto_container_tersegel3',255)->nullable();
            $table->string('un10_foto_pintu_container_sdh_dibuka1',255)->nullable();
            $table->string('un10_foto_pintu_container_sdh_dibuka2',255)->nullable();
            $table->string('un10_foto_pintu_container_sdh_dibuka3',255)->nullable();
            $table->string('un10_foto_truk_non_container_buka_terpal1',255)->nullable();
            $table->string('un10_foto_truk_non_container_buka_terpal2',255)->nullable();
            $table->string('un10_foto_truk_non_container_buka_terpal3',255)->nullable();
            $table->string('un10_foto_susunan_produk_rapi1',255)->nullable();
            $table->string('un10_foto_susunan_produk_rapi2',255)->nullable();
            $table->string('un10_foto_susunan_produk_rapi3',255)->nullable();
            $table->string('un10_foto_pallet_tdk_patah1',255)->nullable();
            $table->string('un10_foto_pallet_tdk_patah2',255)->nullable();
            $table->string('un10_foto_pallet_tdk_patah3',255)->nullable();
            $table->string('un10_foto_produk_tdk_pakai_pallet1',255)->nullable();
            $table->string('un10_foto_produk_tdk_pakai_pallet2',255)->nullable();
            $table->string('un10_foto_produk_tdk_pakai_pallet3',255)->nullable();
            $table->string('un10_foto_lantai_dinding_truk_bersih1',255)->nullable();
            $table->string('un10_foto_lantai_dinding_truk_bersih2',255)->nullable();
            $table->string('un10_foto_lantai_dinding_truk_bersih3',255)->nullable();
            $table->tinyInteger('un10_operator_complete')->nullable()->comment('Operator Complete');
            $table->tinyInteger('un10_checker_complete')->nullable()->comment('Pemeriksa Complete');
            $table->tinyInteger('un10_cancel_load_unload')->nullable()->comment('Tidak Jadi Unloading');
            $table->string('un10_reason_cancel_load_unload',255)->nullable()->comment('Alasan');
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
        Schema::dropIfExists('form_unloading_packed_good');
    }
}
