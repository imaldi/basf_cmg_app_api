<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormInsH2sFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_ins_h2s_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ins_h2_name',255)->nullable()->comment('GS-F-5002-DEPMMYYXX');
            $table->timestamp('ins_h2_submited_date')->nullable()->comment('tanggal submit');
            $table->unsignedBigInteger('ins_h2_inspector_id')->nullable()->comment('Id inspektor');
            $table->foreign('ins_h2_inspector_id')->references('id')->on('m_employees');
            $table->timestamp('ins_h2_approved_date')->nullable()->comment('Tanggal approval oleh supervisor');
            $table->unsignedBigInteger('ins_h2_inspector_spv_id')->nullable()->comment('ID Supervisor');
            $table->foreign('ins_h2_inspector_spv_id')->references('id')->on('m_employees');
            $table->string('ins_h2_notes',255)->nullable()->comment('Catatan');
            $table->tinyInteger('ins_h2_status')->nullable()->comment('status form: 
                1. in progress
                2. waiting spv approve = inspector sudah submit dan menunggu di approve oleh supervisornya
                3. completed = supervisor sudah approve');
            $table->tinyInteger('ins_h2_is_active')->nullable()->comment('1 = Aktif //jika tidak aktif maka data tidak dimunculkan');
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
        Schema::dropIfExists('form_ins_h2s_forms');
    }
}
