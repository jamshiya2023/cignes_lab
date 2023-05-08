<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterBranchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_branch', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('branchname');
            $table->string('vatnumber');
            $table->string('crnumber')->nullable();
            $table->string('branchlogo')->nullable();
            $table->string('contactperson')->nullable();
            $table->string('contactnumber')->nullable();
            $table->string('email')->nullable();
            $table->string('address_one')->nullable();
            $table->string('address_two')->nullable();
            $table->integer('cityid')->nullable();
            $table->integer('stateid')->nullable();
            $table->integer('countryid')->nullable();
            $table->string('pincode')->nullable();
            $table->string('website')->nullable();            
            $table->string('status');
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
        Schema::dropIfExists('master_branch');
    }
}
