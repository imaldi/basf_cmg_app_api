<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormInsH2sContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_ins_h2s_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ins_h2_form_id')->nullable()->comment('berdasarkan tabel form_ins_h2s_forms');
            $table->foreign('ins_h2_form_id')->references('id')->on('form_ins_h2s_forms');
            $table->unsignedBigInteger('ins_h2_location_id')->nullable()->comment('Id berdasarkan tabel m_locations');
            $table->foreign('ins_h2_location_id')->references('id')->on('m_locations');
            $table->boolean('ins_h2_check_05_percentage')->nullable()->comment('H2S Concentration (%) at 0,5 m ("true=check","false=uncheck")');
            $table->boolean('ins_h2_check_10_percentage')->nullable()->comment('H2S Concentration (%) at 1,0 m ("true=check","false=uncheck")');
            $table->boolean('ins_h2_check_lel_percentage')->nullable()->comment('% Lel ("true=check","false=uncheck")');
            $table->string('ins_h2_remark',255)->nullable()->comment('Remark');
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
        Schema::dropIfExists('form_ins_h2s_contents');
    }
}
