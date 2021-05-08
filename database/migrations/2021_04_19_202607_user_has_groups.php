<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserHasGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_has_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->comment('group_id');
            $table->foreign('role_id')->references('id')->on('m_employee_groups');
            $table->string('model_type');
            $table->bigInteger('model_id');
            
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
