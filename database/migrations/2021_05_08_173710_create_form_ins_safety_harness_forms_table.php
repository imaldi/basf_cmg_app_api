<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormInsSafetyHarnessFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_ins_safety_harness_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ins_sh_name',255)->nullable()->comment('GS-F-3014-2DEPMMYYXX');
            $table->timestamp('ins_sh_submited_date')->nullable()->comment('Tanggal inspektor submit form');
            $table->unsignedBigInteger('ins_sh_inspector_id')->nullable()->comment('ID inspektor submit form');
            $table->foreign('ins_sh_inspector_id')->references('id')->on('m_employees');
            $table->timestamp('ins_sh_approved_date')->nullable()->comment('Tanggal supervisor inspektor approve form');
            $table->unsignedBigInteger('ins_sh_inspector_spv_id')->nullable()->comment('ID Supervisor inspektor approve form');
            $table->foreign('ins_sh_inspector_spv_id')->references('id')->on('m_employees');
            $table->string('ins_sh_cp_actions',255)->nullable()->comment('Corrective and preventive actions');
            $table->tinyInteger('ins_sh_status')->nullable()->comment('status form: 
                1. in progress
                2. waiting spv approve = inspector sudah submit dan menunggu di approve oleh supervisornya
                3. completed = supervisor sudah approve');
            $table->tinyInteger('ins_sh_is_active')->nullable()->comment('1 = Aktif //jika tidak aktif maka data tidak dimunculkan');
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
        Schema::dropIfExists('form_ins_safety_harness_forms');
    }
}
