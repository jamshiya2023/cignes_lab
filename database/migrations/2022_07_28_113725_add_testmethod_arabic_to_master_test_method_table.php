<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTestmethodArabicToMasterTestMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_test_method', function (Blueprint $table) {
            $table->string('testmethod_arabic')->after('testmethod')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_test_method', function (Blueprint $table) {
            $table->dropColumn('testmethod_arabic');
        });
    }
}
