<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForm5sMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_5s_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('form_5s_m_dept_id')->nullable()->comment('Department/bangunan');
            $table->foreign('form_5s_m_dept_id')->references('id')->on('m_departments');
            $table->unsignedBigInteger('form_5s_m_area_id')->nullable()->comment('area');
            $table->foreign('form_5s_m_area_id')->references('id')->on('m_locations');
            $table->string('form_5s_m_area_photo',255)->nullable()->comment('area foto');
            $table->unsignedBigInteger('form_5s_m_pic_id')->nullable()->comment('pic');
            $table->foreign('form_5s_m_pic_id')->references('id')->on('m_employees');
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
        Schema::dropIfExists('form_5s_masters');
    }
}
