<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaxidToAlltestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alltests', function (Blueprint $table) {
            $table ->string('tax_id')->nullable()->after('singletestids');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alltests', function (Blueprint $table) {
            $table->dropColumn('tax_id');
        });
    }
}
