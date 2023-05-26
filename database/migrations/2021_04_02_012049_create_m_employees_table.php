<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('emp_name')->notNull();
            $table->string('emp_username')->notNull();
            $table->string('emp_email')->notNull();
            $table->string('password')->notNull();
            $table->string('emp_nik')->nullable();
            $table->date('emp_birth_date')->nullable();
            $table->string('emp_phone_number')->nullable();
            $table->integer('emp_is_spv',0)->nullable();
            $table->integer('emp_is_active',0)->nullable();
            $table->bigInteger('emp_employee_department_id')->default(3)->unsigned()->nullable();
            $table->bigInteger('emp_gender')->nullable();
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('m_employees');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
