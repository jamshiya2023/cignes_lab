<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTubeNameArabicToMasterTubeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_tube', function (Blueprint $table) {
            $table->string('tube_name_arabic')->after('tube_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_tube', function (Blueprint $table) {
            $table->dropColumn('tube_name_arabic');
        });
    }
}
