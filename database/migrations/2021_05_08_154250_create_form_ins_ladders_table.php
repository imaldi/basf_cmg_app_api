<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormInsLaddersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_ins_ladders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ins_la_name',255)->nullable()->comment('GS-F-5003-2DEPMMYYXX');
            $table->string('ins_la_brand',255)->nullable()->comment('Merk Tangga');
            $table->string('ins_la_specification',255)->nullable()->comment('Spesifikasi Tangga');
            $table->string('ins_la_ladder_no',255)->nullable()->comment('Nomor tangga ("Engineering-1","Engineering-2","Lab QC-1","Lab EMC-1")');
            $table->timestamp('ins_la_inspection_date')->nullable()->comment('Diperiksa tanggal');
            $table->string('ins_la_upper_condition',255)->nullable()->comment('Kondisi sepatu atas ("slip","trip","fall")');
            $table->string('ins_la_bottom_condition',255)->nullable()->comment('Kondisi sepatu bawah ("slip","trip","fall")');
            $table->string('ins_la_bottom_condition_desc',255)->nullable()->comment('Kondisi sepatu bawah - keterangan');
            $table->string('ins_la_fastener_condition',255)->nullable()->comment('Kondisi pengikat ("slip","trip","fall")');
            $table->string('ins_la_fastener_condition_desc',255)->nullable()->comment('Kondisi pengikat ("slip","trip","fall")');
            $table->string('ins_la_construction_condition',255)->nullable()->comment('Kondisi konstruksi / badan Alat ("slip","trip","fall")');
            $table->string('ins_la_construction_condition_desc',255)->nullable()->comment('Kondisi konstruksi / badan Alat  - keterangan');
            $table->string('ins_la_stairs_condition',255)->nullable()->comment('Kondisi anak tangga ("slip","trip","fall")');
            $table->string('ins_la_stairs_condition_desc',255)->nullable()->comment('Kondisi anak tangga  - keterangan');
            $table->unsignedBigInteger('ins_la_inspector_id')->nullable()->comment('Pemeriksa');
            $table->foreign('ins_la_inspector_id')->references('id')->on('m_employees');
            $table->timestamp('ins_la_submited_date')->nullable()->comment('Tanggal pemeriksaan (ketika inspektor tekan tomtol submit)');
            $table->unsignedBigInteger('ins_la_inspector_spv_id')->nullable()->comment('ID Supervisor');
            $table->foreign('ins_la_inspector_spv_id')->references('id')->on('m_employees');
            $table->timestamp('ins_la_approved_date')->nullable()->comment('Tanggal approval oleh supervisor');
            $table->tinyInteger('ins_la_status')->nullable()->comment('status form: 
                1. in progress
                2. waiting spv approve = inspector sudah submit dan menunggu di approve oleh supervisornya
                3. completed = supervisor sudah approve');
            $table->tinyInteger('ins_la_is_active')->nullable()->comment('1 = Aktif //jika tidak aktif maka data tidak dimunculkan');
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
        Schema::dropIfExists('form_ins_ladders');
    }
}
