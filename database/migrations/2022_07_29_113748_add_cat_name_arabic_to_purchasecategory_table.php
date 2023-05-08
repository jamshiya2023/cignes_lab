<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCatNameArabicToPurchasecategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchasecategory', function (Blueprint $table) {
            $table->string('cat_name_arabic')->after('cat_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchasecategory', function (Blueprint $table) {
            $table->dropColumn('cat_name_arabic');
        });
    }
}
