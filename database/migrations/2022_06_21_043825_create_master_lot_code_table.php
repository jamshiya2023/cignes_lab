<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterLotCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_lot_code', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('controlname');
            $table->string('lotcode');
            $table->string('const_mean')->nullable();
            $table->string('const_sd')->nullable();
            $table->integer('staffid');
            $table->integer('branchid');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_lot_code');
    }
}
