<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormInsFumeHoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_ins_fume_hoods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ins_fh_name',255)->nullable()->comment('GS-F-5001-2DEPMMYYXX');
            $table->timestamp('ins_fh_submited_date')->nullable()->comment('Tanggal inspektor submit form');
            $table->unsignedBigInteger('ins_fh_inspector_id')->nullable()->comment('Id inspektor');
            $table->foreign('ins_fh_inspector_id')->references('id')->on('m_employees');
            $table->timestamp('ins_fh_approved_date')->nullable()->comment('Tanggal approval oleh supervisor');
            $table->unsignedBigInteger('ins_fh_inspector_spv_id')->nullable()->comment('ID Supervisor');
            $table->foreign('ins_fh_inspector_spv_id')->references('id')->on('m_employees');
            $table->string('ins_fh_QC1_opening_height',255)->nullable()->comment('Fume Hood QC - 1 Opening Height (cm)');
            $table->string('ins_fh_QC1_a_f_standart',255)->nullable()->comment('Fume Hood QC - 1 Air Flow Standard');
            $table->string('ins_fh_QC1_a_f_results',255)->nullable()->comment('Fume Hood QC - 1 Air Flow Result');
            $table->string('ins_fh_QC1_remarks',255)->nullable()->comment('Fume Hood QC - 1 Remarks');
            $table->string('ins_fh_QC2_opening_height',255)->nullable()->comment('Fume Hood QC - 2 Opening Height (cm)');
            $table->string('ins_fh_QC2_a_f_standart',255)->nullable()->comment('Fume Hood QC - 2 Air Flow Standard');
            $table->string('ins_fh_QC2_a_f_results',255)->nullable()->comment('Fume Hood QC - 2 Air Flow Result');
            $table->string('ins_fh_QC2_remarks',255)->nullable()->comment('Fume Hood QC - 2 Remarks');
            $table->string('ins_fh_QC3_opening_height',255)->nullable()->comment('Fume Hood QC - 3 Opening Height (cm)');
            $table->string('ins_fh_QC3_a_f_standart',255)->nullable()->comment('Fume Hood QC - 3 Air Flow Standard');
            $table->string('ins_fh_QC3_a_f_results',255)->nullable()->comment('Fume Hood QC - 3 Air Flow Result');
            $table->string('ins_fh_QC3_remarks',255)->nullable()->comment('Fume Hood QC - 3 Remarks');
            $table->string('ins_fh_QC4_opening_height',255)->nullable()->comment('Fume Hood QC - 4 Opening Height (cm)');
            $table->string('ins_fh_QC4_a_f_standart',255)->nullable()->comment('Fume Hood QC - 4 Air Flow Standard');
            $table->string('ins_fh_QC4_a_f_results',255)->nullable()->comment('Fume Hood QC - 4 Air Flow Result');
            $table->string('ins_fh_QC4_remarks',255)->nullable()->comment('Fume Hood QC - 4 Remarks');
            $table->string('ins_fh_QC5_opening_height',255)->nullable()->comment('Fume Hood QC - 5 Opening Height (cm)');
            $table->string('ins_fh_QC5_a_f_standart',255)->nullable()->comment('Fume Hood QC - 5 Air Flow Standard');
            $table->string('ins_fh_QC5_a_f_results',255)->nullable()->comment('Fume Hood QC - 5 Air Flow Result');
            $table->string('ins_fh_QC5_remarks',255)->nullable()->comment('Fume Hood QC - 5 Remarks');
            $table->tinyInteger('ins_fh_status')->nullable()->comment('status form: 
                1. in progress
                2. waiting spv approve = inspector sudah submit dan menunggu di approve oleh supervisornya
                3. completed = supervisor sudah approve');
            $table->tinyInteger('ins_fh_is_active')->nullable()->comment('1 = Aktif //jika tidak aktif maka data tidak dimunculkan');
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
        Schema::dropIfExists('form_ins_fume_hoods');
    }
}
