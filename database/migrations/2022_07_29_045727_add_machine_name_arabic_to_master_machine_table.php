<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMachineNameArabicToMasterMachineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_machine', function (Blueprint $table) {
            $table->string('machine_name_arabic')->after('machine_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_machine', function (Blueprint $table) {
            $table->dropColumn('machine_name_arabic');
        });
    }
}
