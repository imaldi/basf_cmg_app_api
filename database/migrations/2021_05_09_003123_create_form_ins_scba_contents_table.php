<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormInsScbaContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_ins_scba_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ins_sc_form_id')->comment('berdasarkan tabel form_ins_scba_forms');
            $table->foreign('ins_sc_form_id')->references('id')->on('form_ins_scba_forms');
            $table->unsignedBigInteger('ins_sc_location_id')->nullable()->comment('Id berdasarkan tabel m_locations');
            $table->foreign('ins_sc_location_id')->references('id')->on('m_locations');
            $table->tinyInteger('ins_sc_leaka')->nullable()->comment('Leaka ("1=ok","2=need repair")');
            $table->tinyInteger('ins_sc_pressure_bar')->nullable()->comment('Presure Bar ("1=ok","2=need repair")');
            $table->tinyInteger('ins_sc_walve_or_seal')->nullable()->comment('Valve / Seal ("1=ok","2=need repair")');
            $table->tinyInteger('ins_sc_masker_condition')->nullable()->comment('Masker Condition ("1=ok","2=need repair")');
            $table->string('ins_sc_remark',255)->nullable()->comment('Remark');
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
        Schema::dropIfExists('form_ins_scba_contents');
    }
}
