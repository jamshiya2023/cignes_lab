<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSampleTypeNameArabicToMasterSampletypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_sampletype', function (Blueprint $table) {
            $table->string('sample_type_name_arabic')->after('sample_type_name')->nullable();             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_sampletype', function (Blueprint $table) {
            $table->dropColumn('sample_type_name_arabic');
        });
    }
}
