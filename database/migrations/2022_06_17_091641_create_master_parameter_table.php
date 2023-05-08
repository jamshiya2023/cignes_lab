<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterParameterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_parameter', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('parameter_name');
            $table->string('short_code')->nullable();
            $table->string('lis_parameter_code')->nullable();
            $table->string('label_heading')->nullable();
            $table->string('final_result')->nullable();
            $table->integer('staffid');
            $table->integer('branchid');
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
        Schema::dropIfExists('master_parameter');
    }
}
