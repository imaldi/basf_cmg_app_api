<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormInsSafetyShowerContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_ins_safety_shower_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ins_ss_form_id')->comment('berdasarkan tabel form_ins_safety_shower_forms');
            $table->foreign('ins_ss_form_id')->references('id')->on('form_ins_safety_shower_forms');
            $table->unsignedBigInteger('ins_ss_location_id')->nullable()->comment('Id berdasarkan tabel m_locations');
            $table->foreign('ins_ss_location_id')->references('id')->on('m_locations');
            $table->tinyInteger('ins_ss_leaka')->nullable()->comment('Leaka ("1=ok","2=need repair")');
            $table->tinyInteger('ins_ss_water_shower')->nullable()->comment('Water Shower ("1=ok","2=need repair")');
            $table->tinyInteger('ins_ss_water_eye_wash')->nullable()->comment('Water Eye Wash ("1=ok","2=need repair")');
            $table->tinyInteger('ins_ss_valve_or_seal')->nullable()->comment('Valve/Seal ("1=ok","2=need repair")');
            $table->tinyInteger('ins_ss_sign_board')->nullable()->comment('Sign Board ("1=ok","2=need repair")');
            $table->tinyInteger('ins_ss_cleanliness')->nullable()->comment('Cleanliness ("1=ok","2=need repair")');
            $table->tinyInteger('ins_ss_alarm_condition')->nullable()->comment('Alarm Condition ("1=ok","2=need repair")');
            $table->string('ins_ss_remarks',255)->nullable()->comment('Remark');
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
        Schema::dropIfExists('form_ins_safety_shower_contents');
    }
}
