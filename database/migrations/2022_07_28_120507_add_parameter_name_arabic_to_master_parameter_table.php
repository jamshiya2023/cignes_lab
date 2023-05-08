<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParameterNameArabicToMasterParameterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_parameter', function (Blueprint $table) {
            $table->string('parameter_name_arabic')->after('parameter_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_parameter', function (Blueprint $table) {
            $table->dropColumn('parameter_name_arabic');
        });
    }
}
