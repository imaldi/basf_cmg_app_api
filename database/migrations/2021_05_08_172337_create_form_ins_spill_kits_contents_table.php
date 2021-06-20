<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormInsSpillKitsContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_ins_spill_kits_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ins_sk_form_id')->comment('berdasarkan tabel form_ins_spill_kit_forms');
            $table->foreign('ins_sk_form_id')->references('id')->on('form_ins_spill_kit_forms');
            $table->unsignedBigInteger('ins_sk_location_id')->nullable()->comment('Id berdasarkan tabel m_locations');
            $table->foreign('ins_sk_location_id')->references('id')->on('m_locations');
            $table->tinyInteger('ins_sk_box_condition')->nullable()->comment('Box Condition ("1=ok","2=need repair")');
            $table->tinyInteger('ins_sk_contents')->nullable()->comment('Contents ("1=ok","2=need repair")');
            $table->tinyInteger('ins_sk_documents')->nullable()->comment('Document ("1=ok","2=need repair")');
            $table->string('ins_sk_remark',255)->nullable()->comment('Remark');
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
        Schema::dropIfExists('form_ins_spill_kits_contents');
    }
}
