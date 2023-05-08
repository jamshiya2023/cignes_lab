<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContainerNameArabicToMasterContainerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_container', function (Blueprint $table) {
            $table->string('container_name_arabic')->after('container_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_container', function (Blueprint $table) {
            $table->dropColumn('container_name_arabic');
        });
    }
}
