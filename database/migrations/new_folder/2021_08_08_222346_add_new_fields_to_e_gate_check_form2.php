<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToEGateCheckForm2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_gate_check', function (Blueprint $table) {
            // $table->string('gate_nama_angkutan',255)->nullable();
            // $table->string('gate_nomor_plat',255)->nullable();
            // $table->string('gate_nomor_tangki',255)->nullable();
            // $table->string('gate_nomor_JO_DO',255)->nullable();
            // $table->string('gate_nama_driver',255)->nullable();
            // $table->string('gate_nomor_telp',255)->nullable();
            // $table->string('gate_jenis_sim',255)->nullable();
            // $table->string('gate_nomor_sim',255)->nullable();

            $table->text('gate_nama_angkutan')->nullable();
            $table->text('gate_nomor_plat')->nullable();
            $table->text('gate_nomor_tangki')->nullable();
            $table->text('gate_nomor_JO_DO')->nullable();
            $table->text('gate_nama_driver')->nullable();
            $table->text('gate_nomor_telp')->nullable();
            $table->text('gate_jenis_sim')->nullable();
            $table->text('gate_nomor_sim')->nullable();

            $table->date('rk_masa_berlaku_SIM')->nullable();
            $table->date('rk_masa_berlaku_STNK')->nullable();
            $table->date('gate_masa_berlaku_kir')->nullable();
            $table->datetime('gate_loading_date')->nullable();

            $table->text('gate_nama_produk')->nullable();
            $table->text('gate_jenis_kendaraan')->nullable();
            $table->text('gate_loading_type')->nullable()->comment('loading/unloading');
            $table->tinyInteger('gate_tipe_pelanggan')->nullable();
            $table->tinyInteger('gate_loading_status')->nullable();
            // $table->string('gate_report_code',255)->nullable()->comment('random code generation');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('e_gate_check_form', function (Blueprint $table) {
            //
        });
    }
}
