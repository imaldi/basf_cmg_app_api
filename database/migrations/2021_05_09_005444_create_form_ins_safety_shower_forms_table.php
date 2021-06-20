<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormInsSafetyShowerFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_ins_safety_shower_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ins_ss_name',255)->nullable()->comment('GS-F-3007-0DEPMMYYXX');
            $table->timestamp('ins_ss_submited_date')->nullable()->comment('Tanggal inspektor submit form');
            $table->unsignedBigInteger('ins_ss_inspector_id')->nullable()->comment('Id inspektor');
            $table->foreign('ins_ss_inspector_id')->references('id')->on('m_employees');
            $table->timestamp('ins_ss_approved_date')->nullable()->comment('Tanggal supervisor inspektor approve form');
            $table->unsignedBigInteger('ins_ss_checker_id')->nullable()->comment('ID Supervisor inspektor approve form');
            $table->foreign('ins_ss_checker_id')->references('id')->on('m_employees');
            $table->string('ins_ss_cp_actions',255)->nullable()->comment('Corrective and preventive actions');
            $table->tinyInteger('ins_ss_status')->nullable()->comment('status form: 
                1. in progress
                2. waiting spv approve = inspector sudah submit dan menunggu di approve oleh supervisornya
                3. completed = supervisor sudah approve');
            $table->tinyInteger('ins_ss_is_active')->nullable()->comment('1 = Aktif //jika tidak aktif maka data tidak dimunculkan');
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
        Schema::dropIfExists('form_ins_safety_shower_forms');
    }
}
