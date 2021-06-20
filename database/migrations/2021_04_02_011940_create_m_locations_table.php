<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('loc_name');
            $table->string('loc_desc')->nullable();
            $table->integer('loc_is_active')->nullable();
            $table->bigInteger('loc_department_id')->nullable();
            $table->string('loc_module')->nullable()->comment('Lokasi spesifik untuk module tertentu');
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
        Schema::dropIfExists('m_locations');
    }
}
