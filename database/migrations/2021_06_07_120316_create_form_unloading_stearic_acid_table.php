<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormUnloadingStearicAcidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_unloading_stearic_acid', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('un5_employee_id')->nullable()->comment('join tabel m_employees');
            $table->foreign('un5_employee_id')->references('id')->on('m_employees');
            $table->unsignedBigInteger('un5_report_kendaraan_id')->nullable()->comment('join tabel form_gate_check');
            $table->foreign('un5_report_kendaraan_id')->references('id')->on('form_gate_check');
            $table->string('un5_report_code',255)->nullable()->comment('random code 9 character kombinasi huruf dan angka');
            $table->string('un5_batch_no',255)->nullable()->comment('batch no');
            $table->string('un5_level_awal',255)->nullable()->comment('level awal');
            $table->string('un5_level_akhir',255)->nullable()->comment('level awal');
            $table->string('un5_jml_dimuat',255)->nullable()->comment('no storage 2');
            $table->tinyInteger('un5_persiapan_memakai_ppe')->nullable()->comment('1');
            $table->string('un5_persiapan_memakai_ppe_desc',255)->nullable()->comment('1');
            $table->tinyInteger('un5_persiapan_cek_hose_piping')->nullable()->comment('2');
            $table->string('un5_persiapan_cek_hose_piping_desc',255)->nullable()->comment('2');
            $table->tinyInteger('un5_persiapan_safety_shower')->nullable()->comment('3');
            $table->string('un5_persiapan_safety_shower_desc',255)->nullable()->comment('3');
            $table->tinyInteger('un5_persiapan_operator_terima_dokumen')->nullable()->comment('4');
            $table->string('un5_persiapan_operator_terima_dokumen_desc',255)->nullable()->comment('4');
            $table->tinyInteger('un5_persiapan_arahkan_truk_parkir')->nullable()->comment('5');
            $table->string('un5_persiapan_arahkan_truk_parkir_desc',255)->nullable()->comment('5');
            $table->tinyInteger('un5_persiapan_ganjal_roda')->nullable()->comment('6');
            $table->string('un5_persiapan_ganjal_roda_desc',255)->nullable()->comment('6');
            $table->tinyInteger('un5_persiapan_safety_cone')->nullable()->comment('7');
            $table->string('un5_persiapan_safety_cone_desc',255)->nullable()->comment('7');
            $table->tinyInteger('un5_persiapan_verifikasi_fisik')->nullable()->comment('8');
            $table->string('un5_persiapan_verifikasi_fisik_desc',255)->nullable()->comment('8');
            $table->tinyInteger('un5_persiapan_sopir_serahkan_kunci')->nullable()->comment('9');
            $table->string('un5_persiapan_sopir_serahkan_kunci_desc',255)->nullable()->comment('9');
            $table->tinyInteger('un5_persiapan_sopir_kenek_leave_unloading')->nullable()->comment('10');
            $table->string('un5_persiapan_sopir_kenek_leave_unloading_desc',255)->nullable()->comment('10');
            $table->tinyInteger('un5_persiapan_isotank_bersih')->nullable()->comment('11');
            $table->string('un5_persiapan_isotank_bersih_desc',255)->nullable()->comment('11');
            $table->tinyInteger('un5_persiapan_label_segel_terpasang')->nullable()->comment('12');
            $table->string('un5_persiapan_label_segel_terpasang_desc',255)->nullable()->comment('12');
            $table->tinyInteger('un5_persiapan_pasang_hose_steam')->nullable()->comment('13');
            $table->string('un5_persiapan_pasang_hose_steam_desc',255)->nullable()->comment('13');
            $table->tinyInteger('un5_persiapan_siapkan_botol_sample')->nullable()->comment('14');
            $table->string('un5_persiapan_siapkan_botol_sample_desc',255)->nullable()->comment('14');
            $table->tinyInteger('un5_persiapan_check_fullbody_harness_desc')->nullable()->comment('15');
            $table->tinyInteger('un5_persiapan_webbing')->nullable()->comment('15-1');
            $table->tinyInteger('un5_persiapan_D_rings')->nullable()->comment('15-2');
            $table->tinyInteger('un5_persiapan_buckles')->nullable()->comment('15-3');
            $table->tinyInteger('un5_persiapan_carabiner')->nullable()->comment('15-4');
            $table->tinyInteger('un5_persiapan_lanyard')->nullable()->comment('15-5');
            $table->tinyInteger('un5_persiapan_shockabsorber_pack')->nullable()->comment('15-6');
            $table->tinyInteger('un5_persiapan_fall_arrester')->nullable()->comment('15-7');
            $table->tinyInteger('un5_persiapan_setelah_pemanasan_14jam')->nullable()->comment('16');
            $table->string('un5_persiapan_setelah_pemanasan_14jam_desc',255)->nullable()->comment('16');
            $table->tinyInteger('un5_persiapan_ambil_sample')->nullable()->comment('17');
            $table->string('un5_persiapan_ambil_sample_desc',255)->nullable()->comment('17');
            $table->tinyInteger('un5_persiapan_ambil_hose_stearic_acid')->nullable()->comment('18');
            $table->string('un5_persiapan_ambil_hose_stearic_acid_desc',255)->nullable()->comment('18');
            $table->tinyInteger('un5_persiapan_periksa_level_storage')->nullable()->comment('19');
            $table->string('un5_persiapan_periksa_level_storage_desc',255)->nullable()->comment('19');
            $table->tinyInteger('un5_persiapan_konfirmasi_ok')->nullable()->comment('20');
            $table->string('un5_persiapan_konfirmasi_ok_desc',255)->nullable()->comment('20');
            $table->tinyInteger('un5_persiapan_buka_segel')->nullable()->comment('21');
            $table->string('un5_persiapan_buka_segel_desc',255)->nullable()->comment('21');
            $table->tinyInteger('un5_persiapan_periksa_hose_tidak_bocor')->nullable()->comment('22');
            $table->string('un5_persiapan_periksa_hose_tidak_bocor_desc',255)->nullable()->comment('22');

            $table->tinyInteger('un5_unloading_bottom_valve_dibuka_penuh')->nullable()->comment('1');
            $table->string('un5_unloading_bottom_valve_dibuka_penuh_desc',255)->nullable()->comment('1');
            $table->tinyInteger('un5_unloading_cek_pipa_coupling_valve_tidak_bocor')->nullable()->comment('2');
            $table->string('un5_unloading_cek_pipa_coupling_valve_tidak_bocor_desc',255)->nullable()->comment('2');
            $table->tinyInteger('un5_unloading_pastikan_unloading_aman')->nullable()->comment('3');
            $table->string('un5_unloading_pastikan_unloading_aman_desc',255)->nullable()->comment('3');

            $table->tinyInteger('un5_selesai_unloading_selesai')->nullable()->comment('1');
            $table->string('un5_selesai_unloading_selesai_desc',255)->nullable()->comment('1');
            $table->tinyInteger('un5_selesai_matikan_pompa')->nullable()->comment('2');
            $table->string('un5_selesai_matikan_pompa_desc',255)->nullable()->comment('2');
            $table->tinyInteger('un5_selesai_buka_bottom_valve_storage')->nullable()->comment('3');
            $table->string('un5_selesai_buka_bottom_valve_storage_desc',255)->nullable()->comment('3');
            $table->tinyInteger('un5_selesai_tutup_valve')->nullable()->comment('4');
            $table->string('un5_selesai_tutup_valve_desc',255)->nullable()->comment('4');
            $table->tinyInteger('un5_selesai_pastikan_hose_liquid_kosong')->nullable()->comment('5');
            $table->string('un5_selesai_pastikan_hose_liquid_kosong_desc',255)->nullable()->comment('5');
            $table->tinyInteger('un5_selesai_periksa_valve_ditutup')->nullable()->comment('6');
            $table->string('un5_selesai_periksa_valve_ditutup_desc',255)->nullable()->comment('6');
            $table->tinyInteger('un5_selesai_panggil_sopir_kembali')->nullable()->comment('7');
            $table->string('un5_selesai_panggil_sopir_kembali_desc',255)->nullable()->comment('7');
            $table->tinyInteger('un5_selesai_lepas_pengganjal_roda_safetycone')->nullable()->comment('8');
            $table->string('un5_selesai_lepas_pengganjal_roda_safetycone_desc',255)->nullable()->comment('8');
            $table->tinyInteger('un5_selesai_pastikan_peralatan_tidak_terbawa_truk')->nullable()->comment('9');
            $table->string('un5_selesai_pastikan_peralatan_tidak_terbawa_truk_desc',255)->nullable()->comment('9');
            $table->tinyInteger('un5_selesai_lakukan_timbang_akhir')->nullable()->comment('10');
            $table->string('un5_selesai_lakukan_timbang_akhir_desc',255)->nullable()->comment('10');
            $table->tinyInteger('un5_selesai_pastikan_qty_pas')->nullable()->comment('11');

            $table->string('un5_netto_disuratjalan',255)->nullable()->comment('Berat Netto yang tertera di Surat Jalan/DO');
            $table->string('un5_netto_hasil_timbang',255)->nullable()->comment('Berat Netto hasil penimbangan yang aktual diterima');
            $table->string('un5_pemeriksa',255)->nullable()->comment('Diperiksa Oleh: ');
            $table->string('un5_signature_employee',255)->nullable();
            $table->string('un5_signature_checker',255)->nullable();
            $table->tinyInteger('un5_status')->nullable()->comment('"0. trash", "1. aktif"');
            $table->string('un5_delete_reason',255)->nullable();
            $table->tinyInteger('un5_operator_complete')->nullable()->comment('Operator Complete');
            $table->tinyInteger('un5_checker_complete')->nullable()->comment('Pemeriksa Complete');
            $table->tinyInteger('un5_cancel_load_unload')->nullable()->comment('Tidak Jadi Unloading');
            $table->string('un5_reason_cancel_load_unload',255)->nullable()->comment('Alasan');
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
        Schema::dropIfExists('form_unloading_stearic_acid');
    }
}
