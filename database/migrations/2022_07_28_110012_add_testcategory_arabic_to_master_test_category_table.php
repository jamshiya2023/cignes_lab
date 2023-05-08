<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTestcategoryArabicToMasterTestCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_test_category', function (Blueprint $table) {
            $table->string('testcategory_arabic')->after('testcategory')->nullable();    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_test_category', function (Blueprint $table) {
            $table->dropColumn('testcategory_arabic');
        });
    }
}
