<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormUnloadingDehytonKeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_unloading_dehyton_ke', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('un8_employee_id')->nullable()->comment('join tabel m_employees');
            $table->foreign('un8_employee_id')->references('id')->on('m_employees');
            $table->unsignedBigInteger('un8_report_kendaraan_id')->nullable()->comment('join tabel form_gate_check');
            $table->foreign('un8_report_kendaraan_id')->references('id')->on('form_gate_check');
            $table->string('un8_report_code',255)->nullable()->comment('random code 9 character kombinasi huruf dan angka');
            $table->string('un8_batch_no',255)->nullable()->comment('batch no');
            $table->string('un8_no_storage1',255)->nullable()->comment('No Storage');
            $table->string('un8_level_awal1',255)->nullable()->comment('Level Awal');
            $table->string('un8_level_akhir1',255)->nullable()->comment('Level Akhir');
            $table->string('un8_no_storage2',255)->nullable()->comment('No Storage');
            $table->string('un8_level_awal2',255)->nullable()->comment('Level Awal');
            $table->string('un8_level_akhir2',255)->nullable()->comment('Level Akhir');
            $table->string('un8_jml_dimuat',255)->nullable()->comment('Jumlah yang dimuat');

            // khusus table ini varcha diganti text karena ada error "SQLSTATE[42000]: Syntax error or access violation: 1118 Row size too large."
            $table->tinyInteger('un8_persiapan_memakai_ppe')->nullable()->comment('1');
            $table->text('un8_persiapan_memakai_ppe_desc')->nullable()->comment('1');
            $table->tinyInteger('un8_persiapan_cek_hose_piping')->nullable()->comment('2');
            $table->text('un8_persiapan_cek_hose_piping_desc')->nullable()->comment('2');
            $table->tinyInteger('un8_persiapan_safety_shower')->nullable()->comment('3');
            $table->text('un8_persiapan_safety_shower_desc')->nullable()->comment('3');
            $table->tinyInteger('un8_persiapan_operator_terima_dokumen')->nullable()->comment('4');
            $table->text('un8_persiapan_operator_terima_dokumen_desc')->nullable()->comment('4');
            $table->tinyInteger('un8_persiapan_arahkan_truk_parkir')->nullable()->comment('5');
            $table->text('un8_persiapan_arahkan_truk_parkir_desc')->nullable()->comment('5');
            $table->tinyInteger('un8_persiapan_ganjal_roda')->nullable()->comment('6');
            $table->text('un8_persiapan_ganjal_roda_desc')->nullable()->comment('6');
            $table->tinyInteger('un8_persiapan_safety_cone')->nullable()->comment('7');
            $table->text('un8_persiapan_safety_cone_desc')->nullable()->comment('7');
            $table->tinyInteger('un8_persiapan_verifikasi_fisik')->nullable()->comment('8');
            $table->text('un8_persiapan_verifikasi_fisik_desc')->nullable()->comment('8');
            $table->tinyInteger('un8_persiapan_sopir_serahkan_kunci')->nullable()->comment('9');
            $table->text('un8_persiapan_sopir_serahkan_kunci_desc')->nullable()->comment('9');
            $table->tinyInteger('un8_persiapan_sopir_kenek_leave_pemanasan')->nullable()->comment('10');
            $table->text('un8_persiapan_sopir_kenek_leave_pemanasan_desc')->nullable()->comment('10');
            $table->tinyInteger('un8_persiapan_isotank_bersih')->nullable()->comment('11');
            $table->text('un8_persiapan_isotank_bersih_desc')->nullable()->comment('11');
            $table->tinyInteger('un8_persiapan_label_segel_terpasang')->nullable()->comment('12');
            $table->text('un8_persiapan_label_segel_terpasang_desc')->nullable()->comment('12');
            $table->tinyInteger('un8_persiapan_pasang_hose_steam')->nullable()->comment('13');
            $table->text('un8_persiapan_pasang_hose_steam_desc')->nullable()->comment('13');
            $table->tinyInteger('un8_persiapan_setelah_produk_mencair')->nullable()->comment('14');
            $table->text('un8_persiapan_setelah_produk_mencair_dec')->nullable()->comment('14');
            $table->tinyInteger('un8_persiapan_ambil_safety_cone_pemanasan')->nullable()->comment('15');
            $table->text('un8_persiapan_ambil_safety_cone_pemanasan_desc')->nullable()->comment('15');
            $table->tinyInteger('un8_persiapan_sopir_kenek_leave_unloading')->nullable()->comment('16');
            $table->text('un8_persiapan_sopir_kenek_leave_unloading_desc')->nullable()->comment('16');
            $table->tinyInteger('un8_persiapan_kenakan_ppe_tambahan')->nullable()->comment('17');
            $table->text('un8_persiapan_kenakan_ppe_tambahan_desc')->nullable()->comment('17');
            $table->tinyInteger('un8_persiapan_pasang_penampung_tetesan')->nullable()->comment('18');
            $table->text('un8_persiapan_pasang_penampung_tetesan_desc')->nullable()->comment('18');
            $table->tinyInteger('un8_persiapan_bukasegel_ambil_sampel')->nullable()->comment('19');
            $table->text('un8_persiapan_bukasegel_ambil_sampel_desc')->nullable()->comment('19');
            $table->tinyInteger('un8_persiapan_kirim_sample')->nullable()->comment('20');
            $table->text('un8_persiapan_kirim_sample_desc')->nullable()->comment('20');

            $table->tinyInteger('un8_persiapan_periksa_level_storage')->nullable()->comment('21');
            $table->string('un8_persiapan_18a_level_awal_kg',255)->nullable();
            $table->string('un8_persiapan_18a_level_awal_persen',255)->nullable();
            $table->string('un8_persiapan_18a_level_max_kg',255)->nullable();
            $table->string('un8_persiapan_18a_level_max_persen',255)->nullable();
            $table->string('un8_persiapan_18a_dapat_diisi_kg',255)->nullable();
            $table->string('un8_persiapan_18a_dapat_diisi_persen',255)->nullable();
            $table->string('un8_persiapan_18b_level_awal_kg',255)->nullable();
            $table->string('un8_persiapan_18b_level_awal_persen',255)->nullable();
            $table->string('un8_persiapan_18b_level_max_kg',255)->nullable();
            $table->string('un8_persiapan_18b_level_max_persen',255)->nullable();
            $table->string('un8_persiapan_18b_dapat_diisi_kg',255)->nullable();
            $table->string('un8_persiapan_18b_dapat_diisi_persen',255)->nullable();

            $table->tinyInteger('un8_persiapan_check_fullbody_harness_desc')->nullable()->comment('22');
            $table->tinyInteger('un8_persiapan_webbing')->nullable()->comment('22-1');
            $table->tinyInteger('un8_persiapan_D_rings')->nullable()->comment('22-2');
            $table->tinyInteger('un8_persiapan_buckles')->nullable()->comment('22-3');
            $table->tinyInteger('un8_persiapan_carabiner')->nullable()->comment('22-4');
            $table->tinyInteger('un8_persiapan_lanyard')->nullable()->comment('22-5');
            $table->tinyInteger('un8_persiapan_shockabsorber_pack')->nullable()->comment('22-6');
            $table->tinyInteger('un8_persiapan_fall_arrester')->nullable()->comment('22-7');

            $table->tinyInteger('un8_persiapan_petugas_naik_body_isotank')->nullable()->comment('23');
            $table->string('un8_persiapan_petugas_naik_body_isotank_desc',255)->nullable()->comment('23');

            $table->tinyInteger('un8_unloading_bottom_valve_dibuka_penuh')->nullable()->comment('1');
            $table->string('un8_unloading_bottom_valve_dibuka_penuh_desc',255)->nullable()->comment('1');
            $table->tinyInteger('un8_unloading_hidupkan_mesinDCS')->nullable()->comment('2');
            $table->string('un8_unloading_hidupkan_mesinDCS_desc',255)->nullable()->comment('2');
            $table->tinyInteger('un8_unloading_cek_pipa_coupling_valve_tidak_bocor')->nullable()->comment('3');
            $table->string('un8_unloading_cek_pipa_coupling_valve_tidak_bocor_desc',255)->nullable()->comment('3');
            $table->tinyInteger('un8_unloading_pastikan_unloading_aman')->nullable()->comment('4');
            $table->string('un8_unloading_pastikan_unloading_aman_desc',255)->nullable()->comment('4');
            $table->tinyInteger('un8_unloading_periksa_pompa')->nullable()->comment('5');
            $table->string('un8_unloading_periksa_pompa_desc',255)->nullable()->comment('5');

            $table->tinyInteger('un8_selesai_unloading_selesai')->nullable()->comment('1');
            $table->string('un8_selesai_unloading_selesai_desc',255)->nullable()->comment('1');
            $table->tinyInteger('un8_selesai_matikan_pompa')->nullable()->comment('2');
            $table->string('un8_selesai_matikan_pompa_dec',255)->nullable()->comment('2');
            $table->tinyInteger('un8_selesai_tutup_valve')->nullable()->comment('3');
            $table->string('un8_selesai_tutup_valve_desc',255)->nullable()->comment('3');
            $table->tinyInteger('un8_selesai_petugas_naik_tutup_venting_system')->nullable()->comment('4');
            $table->string('un8_selesai_petugas_naik_tutup_venting_system_desc',255)->nullable()->comment('4');
            $table->tinyInteger('un8_selesai_pastikan_wadah_penampung_masih_ada')->nullable()->comment('5');
            $table->string('un8_selesai_pastikan_wadah_penampung_masih_ada_desc',255)->nullable()->comment('5');
            $table->tinyInteger('un8_selesai_tutup_hose_dg_caphose')->nullable()->comment('6');
            $table->string('un8_selesai_tutup_hose_dg_caphose_desc',255)->nullable()->comment('6');
            $table->tinyInteger('un8_selesai_simpan_coupling_dg_aman')->nullable()->comment('7');
            $table->string('un8_selesai_simpan_coupling_dg_aman_desc',255)->nullable()->comment('7');
            $table->tinyInteger('un8_selesai_periksa_valve_ditutup')->nullable()->comment('8');
            $table->string('un8_selesai_periksa_valve_ditutup_desc',255)->nullable()->comment('8');
            $table->tinyInteger('un8_selesai_panggil_sopir_kembali')->nullable()->comment('9');
            $table->string('un8_selesai_panggil_sopir_kembali_desc',255)->nullable()->comment('9');
            $table->tinyInteger('un8_selesai_lepas_pengganjal_roda_safetycone')->nullable()->comment('10');
            $table->string('un8_selesai_lepas_pengganjal_roda_safetycone_desc',255)->nullable()->comment('10');
            $table->tinyInteger('un8_selesai_pastikan_peralatan_tidak_terbawa_truk')->nullable()->comment('11');
            $table->string('un8_selesai_pastikan_peralatan_tidak_terbawa_truk_desc',255)->nullable()->comment('11');
            $table->tinyInteger('un8_selesai_lakukan_timbang_akhir')->nullable()->comment('12');
            $table->string('un8_selesai_lakukan_timbang_akhir_desc',255)->nullable()->comment('12');
            $table->tinyInteger('un8_selesai_pastikan_qty')->nullable()->comment('13');            
            $table->tinyInteger('un8_selesai_tandatangan_serahterima')->nullable()->comment('14');            

            $table->string('un8_netto_disuratjalan',255)->nullable()->comment('Berat Netto yang tertera di Surat Jalan/DO');
            $table->string('un8_netto_hasil_timbang',255)->nullable()->comment('Berat Netto hasil penimbangan yang aktual diterima');
            $table->string('un8_pemeriksa',255)->nullable()->comment('Diperiksa Oleh: ');
            $table->string('un8_signature_employee',255)->nullable();
            $table->string('un8_signature_checker',255)->nullable();
            $table->tinyInteger('un8_status')->nullable()->comment('"0. trash", "1. aktif"');
            $table->string('un8_delete_reason',255)->nullable();
            $table->tinyInteger('un8_operator_complete')->nullable()->comment('Operator Complete');
            $table->tinyInteger('un8_checker_complete')->nullable()->comment('Pemeriksa Complete');
            $table->tinyInteger('un8_cancel_load_unload')->nullable()->comment('Tidak Jadi Unloading');
            $table->string('un8_reason_cancel_load_unload',255)->nullable()->comment('Alasan');
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
        Schema::dropIfExists('form_unloading_dehyton_ke');
    }
}
