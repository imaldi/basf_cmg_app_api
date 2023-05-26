<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormUnloadingFaC12Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_unloading_fa_c12', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('un1_persiapan_memakai_ppe')->nullable()->comment('1');
            $table->tinyInteger('un1_persiapan_cek_hose_piping')->nullable()->comment('2');
            $table->tinyInteger('un1_persiapan_safety_shower')->nullable()->comment('3');
            $table->tinyInteger('un1_persiapan_operator_terima_dokumen')->nullable()->comment('4');
            $table->tinyInteger('un1_persiapan_arahkan_truk_parkir')->nullable()->comment('5');
            $table->tinyInteger('un1_perisapan_ganjal_roda')->nullable()->comment('6');
            $table->tinyInteger('un1_persiapan_safety_cone')->nullable()->comment('7');
            $table->tinyInteger('un1_persiapan_verifikasi_fisik')->nullable()->comment('8');
            $table->tinyInteger('un1_persiapan_sopir_serahkan_kunci')->nullable()->comment('9');
            $table->tinyInteger('un1_persiapan_sopir_kenek_leave_unloading')->nullable()->comment('10');
            $table->tinyInteger('un1_persiapan_isotank_bersih')->nullable()->comment('11');
            $table->tinyInteger('un1_persiapan_label_segel_terpasang')->nullable()->comment('12');
            $table->tinyInteger('un1_persiapan_kenakan_ppe_tambahan')->nullable()->comment('13');
            $table->tinyInteger('un1_persiapan_pasang_penampung_tetesan')->nullable()->comment('14');
            $table->tinyInteger('un1_persiapan_cek_coupling_station')->nullable()->comment('15');
            $table->tinyInteger('un1_persiapan_bukasegel_ambil_sampel')->nullable()->comment('16');
            $table->tinyInteger('un1_persiapan_kirim_sample')->nullable()->comment('17');
            $table->tinyInteger('un1_persiapan_18a_level_awal_kg')->nullable()->comment('18');
            $table->tinyInteger('un1_persiapan_webbing')->nullable()->comment('19-1');
            $table->tinyInteger('un1_persiapan_d_rings')->nullable()->comment('19-2');
            $table->tinyInteger('un1_persiapan_buckles')->nullable()->comment('19-3');
            $table->tinyInteger('un1_persiapan_carabiner')->nullable()->comment('19-4');
            $table->tinyInteger('un1_persiapan_lanyard')->nullable()->comment('19-5');
            $table->tinyInteger('un1_persiapan_shockabsorber_pack')->nullable()->comment('19-6');
            $table->tinyInteger('un1_persiapan_fall_arrester')->nullable()->comment('19-7');
            $table->tinyInteger('un1_persiapan_petugas_naik_body_isotank')->nullable()->comment('20');
            $table->tinyInteger('un1_unloading_buttom_valve_dibuka_penuh')->nullable()->comment('1');
            $table->tinyInteger('un1_unloading_hidupkan_mesinDCS')->nullable()->comment('2');
            $table->tinyInteger('un1_unloading_cek_pipa_coupling_valve_tidak_bocor')->nullable()->comment('3');
            $table->tinyInteger('un1_unloading_pastikan_unloading_aman')->nullable()->comment('4');
            $table->tinyInteger('un1_unloading_periksa_pompa')->nullable()->comment('5');
            $table->tinyInteger('un1_selesai_unloading_selesai')->nullable()->comment('1');
            $table->tinyInteger('un1_selesai_matikan_pompa')->nullable()->comment('2');
            $table->tinyInteger('un1_selesai_tutup_valve')->nullable()->comment('3');
            $table->tinyInteger('un1_selesai_petugas_naik_tutup_venting_system')->nullable()->comment('4');
            $table->tinyInteger('un1_selesai_pastikan_wadah_penampung_masih_ada')->nullable()->comment('5');
            $table->tinyInteger('un1_selesai_tutup_hose_dg_caphose')->nullable()->comment('6');
            $table->tinyInteger('un1_selesai_simpanan_coupling_dg_aman')->nullable()->comment('7');
            $table->tinyInteger('un1_selesai_periksa_valve_ditutup')->nullable()->comment('8');
            $table->tinyInteger('un1_selesai_panggil_sopir_kembali')->nullable()->comment('9');
            $table->tinyInteger('un1_selesai_lepas_pengganjal_roda_safetycone')->nullable()->comment('10');
            $table->tinyInteger('un1_selesai_pastikan_peralatan_tidak_terbawa_truck')->nullable()->comment('11');
            $table->tinyInteger('un1_selesai_lakukan_timbang_akhir')->nullable()->comment('12');
            $table->tinyInteger('un1_selesai_pastikan_qty_pas')->nullable()->comment('13');
            $table->tinyInteger('un1_selesai_tandatangan_serahterima')->nullable()->comment('14');
            $table->tinyInteger('un1_status')->nullable()->comment('"0. trash", "1. aktif"');
            $table->tinyInteger('un1_operator_complate')->nullable()->comment('Operator Complete');
            $table->tinyInteger('un1_checker_complete')->nullable()->comment('Pemeriksa Complete');
            $table->tinyInteger('un1_cancel_load_unload')->nullable()->comment('Tidak Jadi Unloading');


            $table->string('un1_report_code',255)->nullable()->comment('random code 9 character kombinasi huruf dan angka');
            $table->string('un1_nama_produk',255)->nullable()->comment('nama produk');
            $table->string('un1_batch_no',255)->nullable()->comment('batch no');
            $table->string('un1_no_storage1',255)->nullable()->comment('no storage 1');
            $table->string('un1_level_awal1',255)->nullable()->comment('level awal 1');
            $table->string('un1_level_akhir1',255)->nullable()->comment('level awal 1');
            $table->string('un1_no_storage2',255)->nullable()->comment('no storage 2');
            $table->string('un1_level_awal2',255)->nullable()->comment('level awal 2');
            $table->string('un1_level_akhir2',255)->nullable()->comment('level akhir 2');
            $table->string('un1_jml_dimuat',255)->nullable()->comment('jumlah dimuat ... kg');
            $table->string('un1_persiapan_memakai_ppe_desc',255)->nullable()->comment('1');
            $table->string('un1_persiapan_cek_hose_piping_desc',255)->nullable()->comment('2');
            $table->string('un1_persiapan_safety_shower_desc',255)->nullable()->comment('3');
            $table->string('un1_persiapan_operator_terima_dokumen_desc',255)->nullable()->comment('4');
            $table->string('un1_persiapan_arahkan_truk_parkir_desc',255)->nullable()->comment('5');
            $table->string('un1_perisapan_ganjal_roda_desc',255)->nullable()->comment('6');
            $table->string('un1_persiapan_safery_cone_desc',255)->nullable()->comment('7');
            $table->string('un1_persiapan_verifikasi_fisik_desc',255)->nullable()->comment('8');
            $table->string('un1_persiapan_sopir_serahkan_kunci_desc',255)->nullable()->comment('9');
            $table->string('un1_persiapan_sopir_kenek_leave_unloading_desc',255)->nullable()->comment('10');
            $table->string('un1_persiapan_isotank_bersih_desc',255)->nullable()->comment('11');
            $table->string('un1_persiapan_label_segel_terpasang_desc',255)->nullable()->comment('12');
            $table->string('un1_persiapan_kenakan_ppe_tambahan_desc',255)->nullable()->comment('13');
            $table->string('un1_persiapan_pasang_penampung_tetesan_desc',255)->nullable()->comment('14');
            $table->string('un1_persiapan_cek_coupling_station_desc',255)->nullable()->comment('15');
            $table->string('un1_persiapan_bukasegel_ambil_sampel_desc',255)->nullable()->comment('16');
            $table->string('un1_persiapan_kirim_sample_desc',255)->nullable()->comment('17');
            $table->string('un1_persiapan_18a_level_awal_persen',255)->nullable()->comment('18');
            $table->string('un1_persiapan_18a_level_max_kg',255)->nullable()->comment('18');
            $table->string('un1_persiapan_18a_level_max_persen',255)->nullable()->comment('18');
            $table->string('un1_persiapan_18a_level_diisi_kg',255)->nullable()->comment('18');
            $table->string('un1_persiapan_18a_level_diisi_persen',255)->nullable()->comment('18');
            $table->string('un1_persiapan_18b_level_awal_kg',255)->nullable()->comment('18');
            $table->string('un1_persiapan_18b_level_awal_persen',255)->nullable()->comment('18');
            $table->string('un1_persiapan_18b_level_max_kg',255)->nullable()->comment('18');
            $table->string('un1_persiapan_18b_level_max_persen',255)->nullable()->comment('18');
            $table->string('un1_persiapan_18b_level_diisi_kg',255)->nullable()->comment('18');
            $table->string('un1_persiapan_18b_level_diisi_persen',255)->nullable()->comment('18');
            $table->string('un1_persiapan_check_fullbody_harness_desc',255)->nullable()->comment('19');
            $table->string('un1_persiapan_petugas_naik_body_isotank_desc',255)->nullable()->comment('20');
            $table->string('un1_unloading_buttom_valve_dibuka_penuh_desc',255)->nullable()->comment('1');
            $table->string('un1_unloading_hidupkan_mesinDCS_desc',255)->nullable()->comment('2');
            $table->string('un1_unloading_cek_pipa_coupling_valve_tidak_bocor_desc',255)->nullable()->comment('3');
            $table->string('un1_unloading_pastikan_unloading_aman_desc',255)->nullable()->comment('4');
            $table->string('un1_unloading_periksa_pompa_desc',255)->nullable()->comment('5');
            $table->string('un1_selesai_unloading_selesai_desc',255)->nullable()->comment('1');
            $table->string('un1_selesai_matikan_pompa_desc',255)->nullable()->comment('2');
            $table->string('un1_selesai_tutup_valve_desc',255)->nullable()->comment('3');
            $table->string('un1_selesai_petugas_naik_tutup_venting_system_desc',255)->nullable()->comment('4');
            $table->string('un1_selesai_pastikan_wadah_penampung_masih_ada_desc',255)->nullable()->comment('5');
            $table->string('un1_selesai_tutup_hose_dg_caphose_desc',255)->nullable()->comment('6');
            $table->string('un1_selesai_simpanan_coupling_dg_aman_desc',255)->nullable()->comment('7');
            $table->string('un1_selesai_periksa_valve_ditutup_desc',255)->nullable()->comment('8');
            $table->string('un1_selesai_panggil_sopir_kembali_desc',255)->nullable()->comment('9');
            $table->string('un1_selesai_lepas_pengganjal_roda_safetycone_desc',255)->nullable()->comment('10');
            $table->string('un1_selesai_pastikan_peralatan_tidak_terbawa_truck_desc',255)->nullable()->comment('11');
            $table->string('un1_selesai_lakukan_timbang_akhir_desc',255)->nullable()->comment('12');
            $table->string('un1_netto_disuratjalan',255)->nullable()->comment('Berat Netto yang tertera di Surat Jalan/DO');
            $table->string('un1_netto_hasil_timbang',255)->nullable()->comment('Berat Netto hasil penimbangan yang aktual diterima');
            $table->string('un1_pemeriksa',255)->nullable()->comment('Diperiksa Oleh: ');
            $table->string('un1_signature_employee',255)->nullable();
            $table->string('un1_signature_checker',255)->nullable();
            $table->string('un1_delete_reason',255)->nullable();
            $table->string('un1_reason_cancel_load_unload',255)->nullable()->comment('Alasan');

            $table->unsignedBigInteger('un1_employee_id')->nullable()->comment('join tabel m_employees');
            $table->foreign('un1_employee_id')->references('id')->on('m_employees');
            $table->unsignedBigInteger('un1_report_kendaraan_id')->nullable()->comment('join tabel form_gate_check');
            $table->foreign('un1_report_kendaraan_id')->references('id')->on('form_gate_check');
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
        Schema::dropIfExists('form_unloading_fa_c12');
    }
}
