<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForm5sesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_5ses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('form_5s_name',255)->nullable()->comment('GS-F-0011-1DEPMMYYXX');
            $table->timestamp('form_5s_submit_date')->nullable()->comment('Tanggal saat submit');
            $table->unsignedBigInteger('form_5s_auditor_id')->nullable()->comment('ID auditor submit form');
            $table->foreign('form_5s_auditor_id')->references('id')->on('m_employees');
            $table->unsignedBigInteger('form_5s_dept_id')->nullable()->comment('Department/bangunan');
            $table->foreign('form_5s_dept_id')->references('id')->on('m_departments');
            $table->unsignedBigInteger('form_5s_area_id')->nullable()->comment('Area');
            $table->foreign('form_5s_area_id')->references('id')->on('m_locations');
            $table->tinyInteger('form_5s_concise_score')->nullable()->comment('Ringkas Nilai');
            $table->string('form_5s_consice_desc',255)->nullable()->comment('Ringkas Keterangan');
            $table->string('form_5s_consice_photo',255)->nullable()->comment('Ringkas Foto After');
            $table->tinyInteger('form_5s_neat_score')->nullable()->comment('Rapi Nilai');
            $table->string('form_5s_neat_desc',255)->nullable()->comment('Rapi Keterangan');
            $table->string('form_5s_neat_photo',255)->nullable()->comment('Rapi Foto After');
            $table->tinyInteger('form_5s_clean_score')->nullable()->comment('Resik Nilai');
            $table->string('form_5s_clean_desc',255)->nullable()->comment('Resik Keterangan');
            $table->string('form_5s_clean_photo',255)->nullable()->comment('Resik Foto After');
            $table->tinyInteger('form_5s_care_score')->nullable()->comment('Rawat Nilai');
            $table->string('form_5s_care_desc',255)->nullable()->comment('Rawat Keterangan');
            $table->string('form_5s_care_photo',255)->nullable()->comment('Rawat Foto After');
            $table->tinyInteger('form_5s_diligent_score')->nullable()->comment('Rajin Nilai');
            $table->string('form_5s_diligent_desc',255)->nullable()->comment('Rajin Keterangan');
            $table->string('form_5s_diligent_photo',255)->nullable()->comment('Rajin Foto After');
            $table->bigInteger('form_5s_total_score')->nullable()->comment('Score');
            $table->tinyInteger('form_5s_status')->nullable()->comment('Status Form 5s : 1. Draft, 2.Waiting Approval 3.Approved');
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
        Schema::dropIfExists('form_5ses');
    }
}
