<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormAttendancePersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_attendance_personal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('att_p_employee_id')->nullable();
            $table->foreign('att_p_employee_id')->references('id')->on('m_employees');
            $table->unsignedBigInteger('att_p_department_id')->nullable();
            $table->foreign('att_p_department_id')->references('id')->on('m_departments');
            $table->string('att_p_score',255)->nullable();
            $table->string('att_p_signature',255)->nullable();
            $table->date('att_p_date')->nullable();
            $table->string('att_p_remark',255)->nullable();
            $table->unsignedBigInteger('att_p_attendance_id')->nullable();
            $table->foreign('att_p_attendance_id')->references('id')->on('form_attendance_lists');
            $table->tinyInteger('att_p_person_type')->nullable()->comment('"1=employee", "2=free text"');
            $table->string('att_p_person_name',255)->nullable();
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
        Schema::dropIfExists('form_attendance_personal');
    }
}
