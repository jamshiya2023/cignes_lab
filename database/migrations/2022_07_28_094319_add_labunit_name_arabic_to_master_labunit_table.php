<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLabunitNameArabicToMasterLabunitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_labunit', function (Blueprint $table) {
            $table->string('labunit_name_arabic')->after('labunit_name')->nullable();             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_labunit', function (Blueprint $table) {
            $table->dropColumn('labunit_name_arabic');

        });
    }
}
