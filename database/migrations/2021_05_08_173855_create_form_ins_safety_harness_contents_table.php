<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormInsSafetyHarnessContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_ins_safety_harness_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ins_sh_form_id')->comment('berdasarkan tabel form_ins_safety_harness_forms');
            $table->foreign('ins_sh_form_id')->references('id')->on('form_ins_safety_harness_forms');
            $table->unsignedBigInteger('ins_sh_location_id')->nullable()->comment('Id berdasarkan tabel m_locations');
            $table->foreign('ins_sh_location_id')->references('id')->on('m_locations');
            $table->tinyInteger('ins_sh_webbing')->nullable()->comment('Webbing ("1=ok","2=need repair")');
            $table->tinyInteger('ins_sh_d_rings')->nullable()->comment('D-rings ("1=ok","2=need repair")');
            $table->tinyInteger('ins_sh_attachment_buckles')->nullable()->comment('Attachment Buckles ("1=ok","2=need repair")');
            $table->tinyInteger('ins_sh_hook_or_carabiner')->nullable()->comment('Hook/Carabiner ("1=ok","2=need repair")');
            $table->tinyInteger('ins_sh_web_lanyard')->nullable()->comment('Web Lanyard ("1=ok","2=need repair")');
            $table->tinyInteger('ins_sh_rope_lanyard')->nullable()->comment('Rope Lanyard ("1=ok","2=need repair")');
            $table->tinyInteger('ins_sh_shock_absorber_pack')->nullable()->comment('Shock Adsorber Pack ("1=ok","2=need repair")');
            $table->string('ins_sh_remark',255)->nullable()->comment('Remark');
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
        Schema::dropIfExists('form_ins_safety_harness_contents');
    }
}
