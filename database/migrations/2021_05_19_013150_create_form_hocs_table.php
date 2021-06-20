<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormHocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_hocs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hoc_name',255)->nullable()->comment('HOC name');
            $table->unsignedBigInteger('hoc_issuer_id')->nullable()->comment('hoc reported by');
            $table->foreign('hoc_issuer_id')->references('id')->on('m_employees');
            $table->timestamp('hoc_issuer_submited_date')->nullable()->comment('Date of event  / observation');
            $table->string('hoc_site',255)->nullable()->comment('site');
            $table->unsignedBigInteger('hoc_area_id')->nullable()->comment('area of event');
            $table->foreign('hoc_area_id')->references('id')->on('m_locations');
            $table->string('hoc_specific_location',255)->nullable()->comment('specific location');
            $table->string('hoc_type',255)->nullable()->comment('hoc type');
            $table->string('hoc_type_sub',255)->nullable()->comment('hoc sub type');
            $table->string('hoc_type_sub_other',255)->nullable()->comment('hoc sub type text');
            $table->string('hoc_action',255)->nullable()->comment('hoc action');
            $table->string('hoc_photo',255)->nullable()->comment('hoc photo');
            $table->string('hoc_further_action',255)->nullable()->comment('hoc further action');
            $table->unsignedBigInteger('hoc_department')->nullable()->comment('hoc department');
            $table->foreign('hoc_department')->references('id')->on('m_departments');
            $table->unsignedBigInteger('hoc_pic')->nullable()->comment('hoc pic');
            $table->foreign('hoc_pic')->references('id')->on('m_employees');
            $table->tinyInteger('hoc_status')->references('id')->on('hoc status (
                "1. Waiting Spv. acknowledge", 
                "2. Waiting Spv. Pic Approve", 
                "3. Rejected", "4. In Progress", 
                "5. Waiting Spv. Pic Confirm", 
                "6.  Completed")');
            $table->timestamp('hoc_completion_date')->nullable()->comment('hoc completion date');
            $table->string('hoc_comment',255)->nullable()->comment('hoc comment');
            $table->string('hoc_action_plan',255)->nullable()->comment('hoc action plan');
            $table->unsignedBigInteger('hoc_issuer_dept')->nullable()->comment('hoc department origin');
            $table->foreign('hoc_issuer_dept')->references('id')->on('m_departments');
            $table->date('hoc_due_date')->nullable()->comment('due date');
            $table->string('hoc_followup_photo',255)->nullable()->comment('followup photo');
            $table->tinyInteger('hoc_is_active')->nullable()->comment('1 = Aktif //jika tidak aktif maka data tidak dimunculkan');
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
        Schema::dropIfExists('form_hocs');
    }
}
