<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterParameterEquipmentMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_parameter_equipment_method', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parameter_id');
            $table->integer('equipment_id')->nullable();
            $table->string('equipment_test_id')->nullable();
            $table->string('result_value')->nullable();
            $table->string('duration')->nullable();
            $table->string('equation')->nullable();
            $table->integer('method_id')->nullable();
            $table->integer('decimal_nos')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('master_parameter_equipment_method');
    }
}
