<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormGateCheckTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_gate_check', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('gate_report_status')->nullable();
            $table->tinyInteger('gate_is_in')->nullable();
            $table->tinyInteger('gate_is_out')->nullable();
            $table->tinyInteger('gate_formulir_sopir_telp_darurat')->nullable();
            $table->tinyInteger('gate_kondisi_cukup_istirahat')->nullable();
            $table->tinyInteger('gate_kondisi_tidak_pengaruh_obat_alkohol')->nullable();
            $table->tinyInteger('gate_APD')->nullable();
            $table->tinyInteger('gate_traffic_tool')->nullable();
            $table->tinyInteger('gate_senter')->nullable();
            $table->tinyInteger('gate_kotak_p3k')->nullable();
            $table->tinyInteger('gate_pemadam_kebakaran')->nullable();
            $table->tinyInteger('gate_spill_kit')->nullable();
            $table->tinyInteger('gate_b_sarung_tangan')->nullable();
            $table->tinyInteger('gate_b_respirator')->nullable();
            $table->tinyInteger('gate_b_plakat_tanda_bahaya')->nullable();
            $table->tinyInteger('gate_b_battery_breaker')->nullable();
            $table->tinyInteger('gate_b_hazard')->nullable();
            $table->tinyInteger('gate_kend_kemudi_rem_berfungsi')->nullable();
            $table->tinyInteger('gate_kend_sabuk_pengaman_berfungsi')->nullable();
            $table->tinyInteger('gate_kend_lampu_nyala')->nullable();
            $table->tinyInteger('gate_kend_kaca')->nullable();
            $table->tinyInteger('gate_kend_ban')->nullable();
            $table->tinyInteger('gate_kend_ban_not_vulkanisir')->nullable();
            $table->tinyInteger('gate_kend_dongkrak_toolkit')->nullable();
            $table->tinyInteger('gate_kend_tutup_tangki')->nullable();
            $table->tinyInteger('gate_kend_chasis')->nullable();
            $table->tinyInteger('gate_kend_tutup_cairan_aki')->nullable();
            $table->tinyInteger('gate_kend_twist_lock')->nullable();
            $table->tinyInteger('gate_kend_landing_leg')->nullable();
            $table->tinyInteger('gate_kend_kontainer')->nullable();
            $table->tinyInteger('gate_kend_valve')->nullable();
            $table->tinyInteger('gate_kend_cleanliness_certificate')->nullable();
            $table->tinyInteger('gate_kend_oli_tidak_bocor')->nullable();
            $table->tinyInteger('gate_kend_tachograph')->nullable();
            $table->tinyInteger('gate_pintu_kanan')->nullable();
            $table->tinyInteger('gate_pintu_kiri')->nullable();
            $table->tinyInteger('gate_tdk_ada_benda_asing_laci_dashboard')->nullable();
            $table->tinyInteger('gate_tdk_ada_benda_asing_diatas_dashboard')->nullable();
            $table->tinyInteger('gate_tdk_ada_benda_asing_dicelah_kursi')->nullable();
            $table->tinyInteger('gate_tdk_ada_benda_asing_dibawah_kursi')->nullable();
            $table->tinyInteger('gate_tdk_ada_benda_asing_dibelakang_kursi')->nullable();
            $table->tinyInteger('gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu')->nullable();
            $table->tinyInteger('gate_bagian_atap_rapi_tdk_ada_benda_asing')->nullable();
            $table->tinyInteger('gate_is_approve')->nullable();
            $table->tinyInteger('gate_email_sent')->nullable();
            $table->tinyInteger('gate_exit_dokumen_pengantar_barang_lengkap')->nullable();
            $table->tinyInteger('gate_exit_muatan_disegel')->nullable();
            $table->tinyInteger('gate_exit_tidak_tercecer')->nullable();
            $table->tinyInteger('gate_exit_petunjuk_darurat_transportasi')->nullable();
            $table->string('gate_report_code',255)->nullable();
            $table->string('gate_formulir_sopir_telp_darurat_desc',255)->nullable();
            $table->string('gate_kondisi_cukup_istirahat_desc',255)->nullable();
            $table->string('gate_kondisi_tidak_pengaruh_obat_alkohol_desc',255)->nullable();
            $table->string('gate_APD_desc',255)->nullable();
            $table->string('gate_traffic_tool_desc',255)->nullable();
            $table->string('gate_senter_desc',255)->nullable();
            $table->string('gate_kotak_p3k_desc',255)->nullable();
            $table->string('gate_pemadam_kebakaran_desc',255)->nullable();
            $table->string('gate_spill_kit_desc',255)->nullable();
            $table->string('gate_sarung_tangan_desc',255)->nullable();
            $table->string('gate_respirator_desc',255)->nullable();
            $table->string('gate_plakat_tanda_bahaya_desc',255)->nullable();
            $table->string('gate_battery_breaker_desc',255)->nullable();
            $table->string('gate_hazard_desc',255)->nullable();
            $table->string('gate_kend_kemudi_rem_berfungsi_desc',255)->nullable();
            $table->string('gate_kend_sabuk_pengaman_berfungsi_desc',255)->nullable();
            $table->string('gate_kend_lampu_nyala_desc',255)->nullable();
            $table->string('gate_kend_kaca_desc',255)->nullable();
            $table->string('gate_kend_ban_desc',255)->nullable();
            $table->string('gate_kend_dongkrak_toolkit_desc',255)->nullable();
            $table->string('gate_kend_tutup_tangki_desc',255)->nullable();
            $table->string('gate_kend_tutup_cairan_aki_desc',255)->nullable();
            $table->string('gate_kend_chasis_desc',255)->nullable();
            $table->string('gate_kend_twist_lock_desc',255)->nullable();
            $table->string('gate_kend_landing_leg_desc',255)->nullable();
            $table->string('gate_kend_kontainer_desc',255)->nullable();
            $table->string('gate_kend_valve_desc',255)->nullable();
            $table->string('gate_kend_cleanliness_certificate_desc',255)->nullable();
            $table->string('gate_kend_oli_tidak_bocor_desc',255)->nullable();
            $table->string('gate_kend_tachograph_desc',255)->nullable();
            $table->string('gate_pintu_kanan_desc',255)->nullable();
            $table->string('gate_pintu_kiri_desc',255)->nullable();
            $table->string('gate_tdk_ada_benda_asing_laci_dashboard_desc',255)->nullable();
            $table->string('gate_tdk_ada_benda_asing_diatas_dashboard_desc',255)->nullable();
            $table->string('gate_tdk_ada_benda_asing_dicelah_kursi_desc',255)->nullable();
            $table->string('gate_tdk_ada_benda_asing_dibawah_kursi_desc',255)->nullable();
            $table->string('gate_tdk_ada_benda_asing_dibelakang_kursi_desc',255)->nullable();
            $table->string('gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu_desc',255)->nullable();
            $table->string('gate_bagian_atap_rapi_tdk_ada_benda_asing_desc',255)->nullable();
            $table->string('gate_not_approve_reason',255)->nullable();
            $table->string('gate_exit_dokumen_pengantar_barang_lengkap_desc',255)->nullable();
            $table->string('gate_exit_muatan_disegel_desc',255)->nullable();
            $table->string('gate_exit_tidak_tercecer_desc',255)->nullable();
            $table->string('gate_exit_petunjuk_darurat_transportasi_desc',255)->nullable();
            $table->string('gate_exit_plakat_tanda_bahaya_terpasang_desc',255)->nullable();
            $table->string('gate_signature_employee_check_in',255)->nullable();
            $table->string('gate_delete_reason',255)->nullable();
            $table->string('gate_approve_admin_message',255)->nullable();
            $table->string('gate_signature_driver_check_in',255)->nullable();
            $table->string('gate_signature_employee_check_out',255)->nullable();
            $table->string('gate_signature_driver_check_out',255)->nullable();
            $table->string('gateable_type',255)->nullable();
            $table->unsignedBigInteger('gate_check_in_employee_id')->nullable()->comment('join tabel m_employees');
            $table->unsignedBigInteger('gate_check_out_employee_id')->nullable()->comment('join tabel m_employees');
            $table->unsignedBigInteger('gate_approve_admin')->nullable()->comment('join tabel m_employees');
            $table->integer('gateable_id')->nullable();
            $table->foreign('gate_check_in_employee_id')->references('id')->on('m_employees');
            $table->foreign('gate_check_out_employee_id')->references('id')->on('m_employees');
            $table->foreign('gate_approve_admin')->references('id')->on('m_employees');
            $table->timestamp('gate_exit_date')->nullable();
            $table->timestamp('gate_approve_admin_date')->nullable();
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
        Schema::dropIfExists('form_gate_check');
    }
}
