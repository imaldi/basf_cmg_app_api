<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInsSkNotesToInsSpillKitForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ins_spill_kit_forms', function (Blueprint $table) {
            $table->string('ins_sk_notes',255)->default('api');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ins_spill_kit_forms', function (Blueprint $table) {
            //
        });
    }
}
