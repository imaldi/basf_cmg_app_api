<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormAttendanceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_attendance_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('att_created_by_id')->nullable()->comment('join tabel m_employees');
            $table->foreign('att_created_by_id')->references('id')->on('m_employees');
            $table->unsignedBigInteger('att_register_by_dept')->nullable()->comment('join tabel m_department');
            $table->foreign('att_register_by_dept')->references('id')->on('m_departments');
            $table->string('att_topic1',255)->nullable()->comment('Topic 1');
            $table->string('att_topic2',255)->nullable()->comment('Topic 2');
            $table->string('att_reference',255)->nullable()->comment('Reference');
            $table->timestamp('att_date')->nullable()->comment('Date');
            $table->unsignedBigInteger('att_place')->nullable()->comment('Place');
            $table->foreign('att_place')->references('id')->on('m_locations');
            $table->unsignedBigInteger('att_pic')->nullable()->comment('PIC');
            $table->foreign('att_pic')->references('id')->on('m_employees');
            $table->unsignedBigInteger('att_category')->nullable()->comment('Category');
            $table->foreign('att_category')->references('id')->on('form_attendance_categories');
            $table->string('att_with_test',255)->nullable()->comment('With Test');
            $table->string('att_signature',255)->nullable();
            $table->tinyInteger('att_is_active')->nullable()->comment('1 = Aktif //jika tidak aktif maka data tidak dimunculkan');
            $table->string('att_additional_remark',255)->nullable();
            $table->integer('att_jml_participant')->nullable()->comment('Number of participant');
            $table->integer('att_total_hours')->nullable();
            $table->integer('att_total_manhours')->nullable();
            $table->string('att_place_others',255)->nullable();
            $table->string('att_category_others',255)->nullable();
            $table->string('att_trainer_signature',255)->nullable();
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
        Schema::dropIfExists('form_attendance_lists');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
