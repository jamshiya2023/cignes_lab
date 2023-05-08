<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('balanceamount')->after('paidamount')->nullable(); 
            $table->integer('staff_id')->after('paymentmethod')->nullable(); 
            $table->integer('branchid')->after('staff_id')->nullable();
            $table->string('paymentdate')->after('branchid')->nullable(); 
            $table->string('paymenttime')->after('paymentdate')->nullable(); 
           
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {            
            $table->dropColumn('balanceamount');
            $table->dropColumn('staff_id');
            $table->dropColumn('branchid');
            $table->dropColumn('paymentdate');
            $table->dropColumn('paymenttime');

        });
    }
}
