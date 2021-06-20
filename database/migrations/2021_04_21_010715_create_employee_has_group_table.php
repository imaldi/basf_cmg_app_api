<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeHasGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_has_group', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->comment('group_id');
            $table->foreign('role_id')->references('id')->on('m_employee_groups');
            //perlu dicari kenapa ga bisa backslash jadi default
            $table->string('model_type')->default('App\\\User');
            $table->bigInteger('model_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_has_group');
    }
}
