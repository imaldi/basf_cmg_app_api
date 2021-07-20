<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormLoadingTexN701sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_loading_tex_n701s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('ul1_persiapan_memakai_ppe')->nullable()->comment('1');
            $table->tinyInteger('ul1_persiapan_cek_hose_piping')->nullable()->comment('2');
            $table->tinyInteger('ul1_persiapan_safety_shower')->nullable()->comment('3');
            $table->tinyInteger('ul1_persiapan_operator_terima_dokumen')->nullable()->comment('4');
            $table->tinyInteger('ul1_persiapan_arahkan_truk_parkir')->nullable()->comment('5');
            $table->tinyInteger('ul1_persiapan_ganjal_roda')->nullable()->comment('6');
            $table->tinyInteger('ul1_persiapan_safety_cone_didepan_truk')->nullable()->comment('7');
            $table->tinyInteger('ul1_persiapan_sopir_serahkan_kunci')->nullable()->comment('8');
            $table->tinyInteger('ul1_persiapan_sopir_kenek_leave_unloading')->nullable()->comment('9');
            $table->tinyInteger('ul1_persiapan_isotank_bersih')->nullable()->comment('10');
            $table->tinyInteger('ul1_persiapan_isotank_sdh_dicek_qc')->nullable()->comment('11');
            $table->tinyInteger('ul1_persiapan_isotank_bekas_pengisian_kemarin')->nullable()->comment('12');
            $table->tinyInteger('ul1_persiapan_check_fullbody_harness_desc')->nullable()->comment('13');
            $table->tinyInteger('ul1_persiapan_webbing')->nullable()->comment('13-1');
            $table->tinyInteger('ul1_persiapan_D_rings')->nullable()->comment('13-2');
            $table->tinyInteger('ul1_persiapan_carabiner')->nullable()->comment('13-3');
            $table->tinyInteger('ul1_persiapan_buckles')->nullable()->comment('13-4');
            $table->tinyInteger('ul1_persiapan_lanyard')->nullable()->comment('13-5');
            $table->tinyInteger('ul1_persiapan_shockabsorber_pack')->nullable()->comment('13-6');
            $table->tinyInteger('ul1_persiapan_fall_arrester')->nullable()->comment('13-7');
            $table->tinyInteger('ul1_persiapan_petugas_naik_ke_isotank')->nullable()->comment('14');
            $table->tinyInteger('ul1_persiapan_pasang_high_switch_level')->nullable()->comment('15');
            $table->tinyInteger('ul1_persiapan_hose_piping_tdk_bocor')->nullable()->comment('16');
            $table->tinyInteger('ul1_persiapan_cek_sisa_produk_tersedia')->nullable()->comment('17');
            $table->tinyInteger('ul1_persiapan_pastikan_isotank_kosong')->nullable()->comment('18');
            $table->tinyInteger('ul1_persiapan_ambil_hose_sesuai')->nullable()->comment('19');
            $table->tinyInteger('ul1_persiapan_ambil_sample_awal')->nullable()->comment('20');
            $table->tinyInteger('ul1_loading_buka_valve_storage')->nullable()->comment('1');
            $table->tinyInteger('ul1_loading_hidupkan_dcs')->nullable()->comment('2');
            $table->tinyInteger('ul1_loading_cek_pipa_tidak_bocor')->nullable()->comment('3');
            $table->tinyInteger('ul1_loading_periksa_massflow_meter_baik')->nullable()->comment('4');
            $table->tinyInteger('ul1_selesai_ambil_sample_akhir')->nullable()->comment('1');
            $table->tinyInteger('ul1_selesai_tutup_valve_isotank')->nullable()->comment('2');
            $table->tinyInteger('ul1_selesai_pastikan_produk_mendekati_kuantiti')->nullable();
            $table->tinyInteger('ul1_selesai_tutup_hose')->nullable()->comment('4');
            $table->tinyInteger('ul1_selesai_tutup_venting_system')->nullable()->comment('5');
            $table->tinyInteger('ul1_selesai_pastikan_semua_valve_tertutup')->nullable()->comment('6');
            $table->tinyInteger('ul1_selesai_lepas_pengganjal_ban')->nullable()->comment('7');
            $table->tinyInteger('ul1_selesai_panggil_sopir_kembali')->nullable()->comment('8');
            $table->tinyInteger('ul1_selesai_pastikan_peralatan_tidak_terbawa_truk')->nullable()->comment('9');
            $table->tinyInteger('ul1_selesai_lakukan_timbang_akhir')->nullable()->comment('10');
            $table->tinyInteger('ul1_selesai_pastikan_qty_pas')->nullable()->comment('11');
            $table->tinyInteger('ul1_selesai_tandatangan_serahterima')->nullable()->comment('12');
            $table->tinyInteger('ul1_status')->nullable()->comment('"0. trash", "1. aktif"');
            $table->tinyInteger('ul1_operator_complete')->nullable()->comment('Operator Complete');
            $table->tinyInteger('ul1_checker_complete')->nullable()->comment('Pemeriksa Complete');
            $table->tinyInteger('ul1_cancel_load_unload')->nullable()->comment('Tidak Jadi Unloading');





            $table->string('ul1_report_code',255)->nullable()->comment('random code 9 character kombinasi huruf dan angka');
            $table->string('ul1_nama_produk',255)->nullable()->comment('nama produk');
            $table->string('ul1_batch_no',255)->nullable()->comment('batch no');
            $table->string('ul1_no_storage1',255)->nullable()->comment('no storage');
            $table->string('ul1_level_awal1',255)->nullable()->comment('level awal');
            $table->string('ul1_level_akhir1',255)->nullable()->comment('level akhir');
            $table->string('ul1_no_storage2',255)->nullable()->comment('no storage');
            $table->string('ul1_level_awal2',255)->nullable()->comment('level awal');
            $table->string('ul1_level_akhir2',255)->nullable()->comment('level akhir');
            $table->string('ul1_jml_dimuat',255)->nullable();
            $table->string('ul1_persiapan_memakai_ppe_desc',255)->nullable()->comment('1');
            $table->string('ul1_persiapan_cek_hose_piping_desc',255)->nullable()->comment('2');
            $table->string('ul1_persiapan_safety_shower_desc',255)->nullable()->comment('3');
            $table->string('ul1_persiapan_operator_terima_dokumen_desc',255)->nullable()->comment('4');
            $table->string('ul1_persiapan_arahkan_truk_parkir_desc',255)->nullable()->comment('5');
            $table->string('ul1_persiapan_ganjal_roda_desc',255)->nullable()->comment('6');
            $table->string('ul1_persiapan_safety_cone_didepan_truk_desc',255)->nullable()->comment('7');
            $table->string('ul1_persiapan_sopir_serahkan_kunci_desc',255)->nullable()->comment('8');
            $table->string('ul1_persiapan_sopir_kenek_leave_unloading_desc',255)->nullable()->comment('9');
            $table->string('ul1_persiapan_isotank_bersih_desc',255)->nullable()->comment('10');
            $table->string('ul1_persiapan_isotank_sdh_dicek_qc_desc',255)->nullable()->comment('11');
            $table->string('ul1_persiapan_isotank_bekas_pengisian_kemarin_desc',255)->nullable()->comment('12');
            $table->string('ul1_persiapan_petugas_naik_ke_isotank_dec',255)->nullable()->comment('14');
            $table->string('ul1_persiapan_pasang_high_switch_level_desc',255)->nullable()->comment('15');
            $table->string('ul1_persiapan_hose_piping_tdk_bocor_desc',255)->nullable()->comment('16');
            $table->string('ul1_persiapan_cek_sisa_produk_tersedia_desc',255)->nullable()->comment('17');
            $table->string('ul1_persiapan_pastikan_isotank_kosong_desc',255)->nullable()->comment('18');
            $table->string('ul1_persiapan_ambil_hose_sesuai_desc',255)->nullable()->comment('19');
            $table->string('ul1_persiapan_ambil_sample_awal_desc',255)->nullable()->comment('20');
            $table->string('ul1_loading_buka_valve_storage_desc',255)->nullable()->comment('1');
            $table->string('ul1_loading_hidupkan_dcs_desc',255)->nullable()->comment('2');
            $table->string('ul1_loading_cek_pipa_tidak_bocor_desc',255)->nullable()->comment('3');
            $table->string('ul1_loading_periksa_massflow_meter_baik_desc',255)->nullable()->comment('4');
            $table->string('ul1_selesai_ambil_sample_akhir_desc',255)->nullable()->comment('1');
            $table->string('ul1_selesai_tutup_valve_isotank_desc',255)->nullable()->comment('3');
            $table->string('ul1_selesai_volume_isotank_diisi',255)->nullable();
            $table->string('ul1_selesai_pastikan_produk_mendekati_kuantiti_desc',255)->nullable();
            $table->string('ul1_selesai_tutup_hose_desc',255)->nullable()->comment('4');
            $table->string('ul1_selesai_tutup_venting_system_desc',255)->nullable()->comment('5');
            $table->string('ul1_selesai_pastikan_semua_valve_tertutup_desc',255)->nullable()->comment('6');
            $table->string('ul1_selesai_lepas_pengganjal_ban_desc',255)->nullable()->comment('7');
            $table->string('ul1_selesai_panggil_sopir_kembali_desc',255)->nullable()->comment('8');
            $table->string('ul1_selesai_pastikan_peralatan_tidak_terbawa_truk_desc',255)->nullable()->comment('9');
            $table->string('ul1_selesai_lakukan_timbang_akhir_desc',255)->nullable()->comment('10');
            $table->string('ul1_netto_disuratjalan',255)->nullable()->comment('Berat Netto yang tertera di Surat Jalan/DO');
            $table->string('ul1_netto_hasil_timbang',255)->nullable()->comment('Berat Netto hasil penimbangan yang aktual diterima');
            $table->string('ul1_pemeriksa',255)->nullable()->comment('Diperiksa Oleh: ');
            $table->string('ul1_signature_employee',255)->nullable();
            $table->string('ul1_signature_checker',255)->nullable();
            $table->string('ul1_delete_reason',255)->nullable();
            $table->string('ul1_reason_cancel_load_unload',255)->nullable()->comment('Alasan');

            $table->unsignedBigInteger('ul1_employee_id')->nullable()->comment('join tabel m_employees');
            $table->foreign('ul1_employee_id')->references('id')->on('m_employees');
            $table->unsignedBigInteger('ul1_report_kendaraan_id')->nullable()->comment('join tabel form_gate_check');
            $table->foreign('ul1_report_kendaraan_id')->references('id')->on('form_gate_check');
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
        Schema::dropIfExists('form_loading_tex_n701s');
    }
}
