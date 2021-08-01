<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormUnloadingNaohTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_unloading_naoh', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('un4_persiapan_memakai_ppe')->nullable()->comment('1');
            $table->tinyInteger('un4_persiapan_cek_hose_piping')->nullable()->comment('2');
            $table->tinyInteger('un4_persiapan_safety_shower')->nullable()->comment('3');
            $table->tinyInteger('un4_persiapan_operator_terima_dokumen')->nullable()->comment('4');
            $table->tinyInteger('un4_persiapan_arahkan_truk_parkir')->nullable()->comment('5');
            $table->tinyInteger('un4_persiapan_ganjal_roda')->nullable()->comment('6');
            $table->tinyInteger('un4_persiapan_safety_cone')->nullable()->comment('7');
            $table->tinyInteger('un4_persiapan_sopir_serahkan_kunci')->nullable()->comment('8');
            $table->tinyInteger('un4_persiapan_sopir_kenek_leave_unloading')->nullable()->comment('9');
            $table->tinyInteger('un4_persiapan_isotank_bersih')->nullable()->comment('10');
            $table->tinyInteger('un4_persiapan_label_segel_terpasang')->nullable()->comment('11');
            $table->tinyInteger('un4_persiapan_pasang_penampung_tetesan')->nullable()->comment('12');
            $table->tinyInteger('un4_persiapan_kenakan_ppe_tambahan')->nullable()->comment('13');
            $table->tinyInteger('un2_persiapan_pasang_penampung_tetesan')->nullable()->comment('14');
            $table->tinyInteger('un4_persiapan_bukasegel_ambil_sampel_desc')->nullable()->comment('14');
            $table->tinyInteger('un4_persiapan_kirim_sample')->nullable()->comment('15');
            $table->tinyInteger('un4_persiapan_webbing')->nullable()->comment('17-1');
            $table->tinyInteger('un4_persiapan_d_ring')->nullable()->comment('17-2');
            $table->tinyInteger('un4_persiapan_buckles')->nullable()->comment('17-3');
            $table->tinyInteger('un4_persiapan_carabiner')->nullable()->comment('17-4');
            $table->tinyInteger('un4_persiapan_lanyard')->nullable()->comment('17-5');
            $table->tinyInteger('un4_persiapan_shockabsorber_pack')->nullable()->comment('17-6');
            $table->tinyInteger('un4_persiapan_fall_arrester')->nullable()->comment('17-7');
            $table->tinyInteger('un4_persiapan_petugas_naik_body_isotank')->nullable()->comment('18');
            $table->tinyInteger('un4_unloading_buttom_valve_dibuka_penuh')->nullable()->comment('1');
            $table->tinyInteger('un4_unloading_hidupkan_mesinDCS')->nullable()->comment('2');
            $table->tinyInteger('un4_unloading_cek_pipa_coupling_valve_tidak_bocor')->nullable()->comment('3');
            $table->tinyInteger('un4_unloading_pastikan_unloading_aman')->nullable()->comment('4');
            $table->tinyInteger('un4_unloading_periksa_pompa')->nullable()->comment('5');
            $table->tinyInteger('un4_selesai_unloading_selesai')->nullable()->comment('1');
            $table->tinyInteger('un4_selesai_matikan_pompa')->nullable()->comment('2');
            $table->tinyInteger('un4_selesai_tutup_valve')->nullable()->comment('3');
            $table->tinyInteger('un4_selesai_pastikan_hose_liquid_kosong')->nullable()->comment('4');
            $table->tinyInteger('un4_selesai_tutup_hose_dg_caphose')->nullable()->comment('5');
            $table->tinyInteger('un4_selesai_simpan_coupling_dg_aman')->nullable()->comment('6');
            $table->tinyInteger('un4_selesai_tutup_venting_system')->nullable()->comment('7');
            $table->tinyInteger('un4_selesai_periksa_valve_ditutup')->nullable()->comment('8');
            $table->tinyInteger('un4_selesai_panggil_sopir_kembali')->nullable()->comment('9');
            $table->tinyInteger('un4_selesai_lepas_pengganjal_roda_safetycone')->nullable()->comment('10');
            $table->tinyInteger('un4_selesai_pastikan_peralatan_tidak_terbawa_truk')->nullable()->comment('11');
            $table->tinyInteger('un4_selesai_lakukan_timbang_akhir')->nullable()->comment('12');
            $table->tinyInteger('un4_selesai_pastikan_qty_pas')->nullable()->comment('13');
            $table->tinyInteger('un4_selesai_tandatangan_serahterima')->nullable()->comment('14');
            $table->tinyInteger('un4_status')->nullable()->comment('"0. trash", "1. aktif"');
            $table->tinyInteger('un4_operator_complete')->nullable()->comment('Operator Complete');
            $table->tinyInteger('un4_checker_complete')->nullable()->comment('Pemeriksa Complete');
            $table->tinyInteger('un4_cancel_load_unload')->nullable()->comment('Tidak Jadi Unloading');


            $table->string('un4_report_code',255)->nullable()->comment('random code 9 character kombinasi huruf dan angka');
            $table->string('un4_batch_no',255)->nullable()->comment('batch no');
            $table->string('un4_level_awal',255)->nullable()->comment('level awal');
            $table->string('un4_level_akhir',255)->nullable()->comment('level awal');
            $table->string('un4_jml_dimuat',255)->nullable()->comment('no storage 2');
            $table->string('un4_persiapan_memakai_ppe_desc',255)->nullable()->comment('1');
            $table->string('un4_persiapan_cek_hose_piping_desc',255)->nullable()->comment('2');
            $table->string('un4_persiapan_safety_shower_desc',255)->nullable()->comment('3');
            $table->string('un4_persiapan_operator_terima_dokumen_desc',255)->nullable()->comment('4');
            $table->string('un4_persiapan_arahkan_truk_parkir_desc',255)->nullable()->comment('5');
            $table->string('un4_persiapan_ganjal_roda_desc',255)->nullable()->comment('6');
            $table->string('un4_persiapan_safety_cone_desc',255)->nullable()->comment('7');
            $table->string('un4_persiapan_sopir_serahkan_kunci_desc',255)->nullable()->comment('8');
            $table->string('un4_persiapan_sopir_kenek_leave_unloading_desc',255)->nullable()->comment('9');
            $table->string('un4_persiapan_isotank_bersih_desc',255)->nullable()->comment('10');
            $table->string('un4_persiapan_label_segel_terpasang_desc',255)->nullable()->comment('11');
            $table->string('un4_persiapan_pasang_penampung_tetesan_desc',255)->nullable()->comment('12');
            $table->string('un4_persiapan_kenakan_ppe_tambahan_desc',255)->nullable()->comment('13');
            $table->string('un4_persiapan_bukasegel_ambil_sampel',255)->nullable()->comment('14');
            $table->string('un4_persiapan_18a_level_awal_kg',255)->nullable()->comment('16');
            $table->string('un4_persiapan_18a_level_awal_persen',255)->nullable();
            $table->string('un4_persiapan_18a_level_max_kg',255)->nullable();
            $table->string('un4_persiapan_18a_level_max_persen',255)->nullable();
            $table->string('un4_persiapan_18a_level_diisi_kg',255)->nullable();
            $table->string('un4_persiapan_18a_level_diisi_persen',255)->nullable();
            $table->string('un4_persiapan_18b_level_awal_kg',255)->nullable();
            $table->string('un4_persiapan_18b_level_awal_persen',255)->nullable();
            $table->string('un4_persiapan_18b_level_max_kg',255)->nullable();
            $table->string('un4_persiapan_18b_level_max_persen',255)->nullable();
            $table->string('un4_persiapan_18b_level_diisi_kg',255)->nullable();
            $table->string('un4_persiapan_18b_level_diisi_persen',255)->nullable();
            $table->string('un4_persiapan_check_fullbody_harness_desc',255)->nullable();
            $table->string('un4_persiapan_petugas_naik_body_isotank_desc',255)->nullable()->comment('18');
            $table->string('un4_unloading_buttom_valve_dibuka_penuh_desc',255)->nullable()->comment('1');
            $table->string('un4_unloading_hidupkan_mesinDCS_desc',255)->nullable()->comment('2');
            $table->string('un4_unloading_cek_pipa_coupling_valve_tidak_bocor_desc',255)->nullable()->comment('3');
            $table->string('un4_unloading_pastikan_unloading_aman_desc',255)->nullable()->comment('4');
            $table->string('un4_unloading_periksa_pompa_desc',255)->nullable()->comment('5');
            $table->string('un4_selesai_unloading_selesai_desc',255)->nullable()->comment('1');
            $table->string('un4_selesai_matikan_pompa_desc',255)->nullable()->comment('2');
            $table->string('un4_selesai_tutup_valve_desc',255)->nullable()->comment('3');
            $table->string('un4_selesai_pastikan_hose_liquid_kosong_desc',255)->nullable()->comment('4');
            $table->string('un4_selesai_tutup_hose_dg_caphose_desc',255)->nullable()->comment('5');
            $table->string('un4_selesai_simpan_coupling_dg_aman_desc',255)->nullable()->comment('6');
            $table->string('un4_selesai_tutup_venting_system_desc',255)->nullable()->comment('7');
            $table->string('un4_selesai_periksa_valve_ditutup_desc',255)->nullable()->comment('8');
            $table->string('un4_selesai_panggil_sopir_kembali_desc',255)->nullable()->comment('9');
            $table->string('un4_selesai_lepas_pengganjal_roda_safetycone_desc',255)->nullable()->comment('10');
            $table->string('un4_selesai_pastikan_peralatan_tidak_terbawa_truk_desc',255)->nullable()->comment('11');
            $table->string('un4_selesai_lakukan_timbang_akhir_desc',255)->nullable()->comment('12');

            $table->string('un4_netto_disuratjalan',255)->nullable()->comment('Berat Netto yang tertera di Surat Jalan/DO');
            $table->string('un4_netto_hasil_timbang',255)->nullable()->comment('Berat Netto hasil penimbangan yang aktual diterima');
            $table->string('un4_pemeriksa',255)->nullable()->comment('Diperiksa Oleh: ');
            $table->string('un4_signature_employee',255)->nullable();
            $table->string('un4_signature_checker',255)->nullable();
            $table->string('un4_delete_reason',255)->nullable();
            $table->string('un4_reason_cancel_load_unload',255)->nullable()->comment('Alasan');


            $table->unsignedBigInteger('un4_employee_id')->nullable()->comment('join tabel m_employees');
            $table->foreign('un4_employee_id')->references('id')->on('m_employees');
            $table->unsignedBigInteger('un4_report_kendaraan_id')->nullable()->comment('join tabel form_gate_check');
            $table->foreign('un4_report_kendaraan_id')->references('id')->on('form_gate_check');
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
        Schema::dropIfExists('form_unloading_naoh');
    }
}
