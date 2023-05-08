<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountableToAlltestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alltests', function (Blueprint $table) {
            $table->integer('discountable')->after('testtype');
            $table->integer('staffid')->after('discountable')->nullable();
            $table->integer('branchid')->after('staffid')->nullable();
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
            $table->dropColumn('discountable');
            $table->dropColumn('staffid');
            $table->dropColumn('branchid');
        });
    }
}
