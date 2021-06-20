<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormUnloadingCitricAcidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_unloading_citric_acid', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('un9_employee_id')->nullable()->comment('join tabel m_employees');
            $table->foreign('un9_employee_id')->references('id')->on('m_employees');
            $table->unsignedBigInteger('un9_report_kendaraan_id')->nullable()->comment('join tabel form_gate_check');
            $table->foreign('un9_report_kendaraan_id')->references('id')->on('form_gate_check');
            $table->string('un9_report_code',255)->nullable()->comment('random code 9 character kombinasi huruf dan angka');
            $table->string('un9_batch_no',255)->nullable()->comment('batch no');
            $table->string('un9_no_storage',255)->nullable()->comment('No Storage');
            $table->string('un9_level_awal',255)->nullable()->comment('Level Awal');
            $table->string('un9_level_akhir',255)->nullable()->comment('Level Akhir');
            $table->string('un9_jml_dimuat',255)->nullable()->comment('Jumlah yang dimuat');

            $table->tinyInteger('un9_persiapan_memakai_ppe')->nullable()->comment('1');
            $table->string('un9_persiapan_memakai_ppe_desc',255)->nullable()->comment('1');
            $table->tinyInteger('un9_persiapan_cek_hose_piping')->nullable()->comment('2');
            $table->string('un9_persiapan_cek_hose_piping_desc',255)->nullable()->comment('2');
            $table->tinyInteger('un9_persiapan_safety_shower')->nullable()->comment('3');
            $table->string('un9_persiapan_safety_shower_desc',255)->nullable()->comment('3');
            $table->tinyInteger('un9_persiapan_operator_terima_dokumen')->nullable()->comment('4');
            $table->string('un9_persiapan_operator_terima_dokumen_desc',255)->nullable()->comment('4');
            $table->tinyInteger('un9_persiapan_arahkan_truk_parkir')->nullable()->comment('5');
            $table->string('un9_persiapan_arahkan_truk_parkir_desc',255)->nullable()->comment('5');
            $table->tinyInteger('un9_persiapan_ganjal_roda')->nullable()->comment('6');
            $table->string('un9_persiapan_ganjal_roda_desc',255)->nullable()->comment('6');
            $table->tinyInteger('un9_persiapan_safety_cone')->nullable()->comment('7');
            $table->string('un9_persiapan_safety_cone_desc',255)->nullable()->comment('7');
            $table->tinyInteger('un9_persiapan_verifikasi_fisik')->nullable()->comment('8');
            $table->string('un9_persiapan_verifikasi_fisik_desc',255)->nullable()->comment('8');
            $table->tinyInteger('un9_persiapan_sopir_serahkan_kunci')->nullable()->comment('9');
            $table->string('un9_persiapan_sopir_serahkan_kunci_desc',255)->nullable()->comment('9');
            $table->tinyInteger('un9_persiapan_sopir_kenek_leave_unloading')->nullable()->comment('10');
            $table->string('un9_persiapan_sopir_kenek_leave_unloading_desc',255)->nullable()->comment('10');
            $table->tinyInteger('un9_persiapan_isotank_bersih')->nullable()->comment('11');
            $table->string('un9_persiapan_isotank_bersih_desc',255)->nullable()->comment('11');
            $table->tinyInteger('un9_persiapan_label_segel_terpasang')->nullable()->comment('12');
            $table->string('un9_persiapan_label_segel_terpasang_desc',255)->nullable()->comment('12');
            $table->tinyInteger('un9_persiapan_kenakan_ppe_tambahan')->nullable()->comment('13');
            $table->string('un9_persiapan_kenakan_ppe_tambahan_desc',255)->nullable()->comment('13');
            $table->tinyInteger('un9_persiapan_pasang_wadah_penampung')->nullable()->comment('14');
            $table->string('un9_persiapan_pasang_wadah_penampung_dec',255)->nullable()->comment('14');
            $table->tinyInteger('un9_persiapan_buka_segel_bottom_valve')->nullable()->comment('15');
            $table->string('un9_persiapan_buka_segel_bottom_valve_desc',255)->nullable()->comment('15');
            $table->tinyInteger('un9_persiapan_kirim_sample')->nullable()->comment('16');
            $table->string('un9_persiapan_kirim_sample_desc',255)->nullable()->comment('16');
            $table->tinyInteger('un9_persiapan_periksa_level_storage')->nullable()->comment('17');
            $table->string('un9_persiapan_periksa_level_storage_desc',255)->nullable()->comment('17');
            
            $table->string('un9_persiapan_18a_level_awal_kg',255)->nullable();
            $table->string('un9_persiapan_18a_level_awal_persen',255)->nullable();
            $table->string('un9_persiapan_18a_level_max_kg',255)->nullable();
            $table->string('un9_persiapan_18a_level_max_persen',255)->nullable();
            $table->string('un9_persiapan_18a_dapat_diisi_kg',255)->nullable();
            $table->string('un9_persiapan_18a_dapat_diisi_persen',255)->nullable();

            $table->tinyInteger('un9_persiapan_check_fullbody_harness_desc')->nullable()->comment('18');
            $table->tinyInteger('un9_persiapan_webbing')->nullable()->comment('18-1');
            $table->tinyInteger('un9_persiapan_D_rings')->nullable()->comment('18-2');
            $table->tinyInteger('un9_persiapan_buckles')->nullable()->comment('18-3');
            $table->tinyInteger('un9_persiapan_carabiner')->nullable()->comment('18-4');
            $table->tinyInteger('un9_persiapan_lanyard')->nullable()->comment('18-5');
            $table->tinyInteger('un9_persiapan_shockabsorber_pack')->nullable()->comment('18-6');
            $table->tinyInteger('un9_persiapan_fall_arrester')->nullable()->comment('18-7');

            $table->tinyInteger('un9_persiapan_petugas_naik_ke_isotank')->nullable()->comment('19');
            $table->string('un9_persiapan_petugas_naik_ke_isotank_desc',255)->nullable()->comment('19');

            $table->tinyInteger('un9_unloading_bottom_valve_dibuka')->nullable()->comment('1');
            $table->string('un9_unloading_bottom_valve_dibuka_desc',255)->nullable()->comment('1');
            $table->tinyInteger('un9_unloading_hidupkan_dcs')->nullable()->comment('2');
            $table->string('un9_unloading_hidupkan_dcs_desc',255)->nullable()->comment('2');
            $table->tinyInteger('un9_unloading_cek_pipa_coupling_valve_tidak_bocor')->nullable()->comment('3');
            $table->string('un9_unloading_cek_pipa_coupling_valve_tidak_bocor_desc',255)->nullable()->comment('3');
            $table->tinyInteger('un9_unloading_pastikan_unloading_aman')->nullable()->comment('4');
            $table->string('un9_unloading_pastikan_unloading_aman_desc',255)->nullable()->comment('4');
            $table->tinyInteger('un9_unloading_periksa_pompa')->nullable()->comment('5');
            $table->string('un9_unloading_periksa_pompa_desc',255)->nullable()->comment('5');

            $table->tinyInteger('un9_selesai_unloading_selesai')->nullable()->comment('1');
            $table->string('un9_selesai_unloading_selesai_desc',255)->nullable()->comment('1');
            $table->tinyInteger('un9_selesai_matikan_pompa')->nullable()->comment('2');
            $table->string('un9_selesai_matikan_pompa_dec',255)->nullable()->comment('2');
            $table->tinyInteger('un9_selesai_tutup_valve')->nullable()->comment('3');
            $table->string('un9_selesai_tutup_valve_desc',255)->nullable()->comment('3');
            $table->tinyInteger('un9_selesai_tutup_venting_system')->nullable()->comment('4');
            $table->string('un9_selesai_tutup_venting_system_desc',255)->nullable()->comment('4');
            $table->tinyInteger('un9_selesai_pastikan_wadah_penampung_masih_ada')->nullable()->comment('5');
            $table->string('un9_selesai_pastikan_wadah_penampung_masih_ada_desc',255)->nullable()->comment('5');
            $table->tinyInteger('un9_selesai_tutup_hose')->nullable()->comment('6');
            $table->string('un9_selesai_tutup_hose_desc',255)->nullable()->comment('6');
            $table->tinyInteger('un9_selesai_simpan_coupling')->nullable()->comment('7');
            $table->string('un9_selesai_simpan_coupling_desc',255)->nullable()->comment('7');
            $table->tinyInteger('un9_selesai_pastikan_valve_tertutup')->nullable()->comment('8');
            $table->string('un9_selesai_pastikan_valve_tertutup_desc',255)->nullable()->comment('8');
            $table->tinyInteger('un9_selesai_lepas_pengganjal_ban')->nullable()->comment('9');
            $table->string('un9_selesai_lepas_pengganjal_ban_desc',255)->nullable()->comment('9');
            $table->tinyInteger('un9_selesai_panggil_sopir_kembali')->nullable()->comment('10');
            $table->string('un9_selesai_panggil_sopir_kembali_desc',255)->nullable()->comment('10');
            $table->tinyInteger('un9_selesai_pastikan_peralatan_tidak_terbawa_truk')->nullable()->comment('11');
            $table->string('un9_selesai_pastikan_peralatan_tidak_terbawa_truk_desc',255)->nullable()->comment('11');
            $table->tinyInteger('un9_selesai_lakukan_timbang_akhir')->nullable()->comment('12');
            $table->string('un9_selesai_lakukan_timbang_akhir_desc',255)->nullable()->comment('12');
            $table->tinyInteger('un9_selesai_pastikan_qty_pas')->nullable()->comment('13');            
            $table->tinyInteger('un9_selesai_tandatangan_serahterima')->nullable()->comment('14');            

            $table->string('un9_netto_disuratjalan',255)->nullable()->comment('Berat Netto yang tertera di Surat Jalan/DO');
            $table->string('un9_netto_hasil_timbang',255)->nullable()->comment('Berat Netto hasil penimbangan yang aktual diterima');
            $table->string('un9_pemeriksa',255)->nullable()->comment('Diperiksa Oleh: ');
            $table->string('un9_signature_employee',255)->nullable();
            $table->string('un9_signature_checker',255)->nullable();
            $table->tinyInteger('un9_status')->nullable()->comment('"0. trash", "1. aktif"');
            $table->string('un9_delete_reason',255)->nullable();
            $table->tinyInteger('un9_operator_complete')->nullable()->comment('Operator Complete');
            $table->tinyInteger('un9_checker_complete')->nullable()->comment('Pemeriksa Complete');
            $table->tinyInteger('un9_cancel_load_unload')->nullable()->comment('Tidak Jadi Unloading');
            $table->string('un9_reason_cancel_load_unload',255)->nullable()->comment('Alasan');
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
        Schema::dropIfExists('form_unloading_citric_acid');
    }
}
