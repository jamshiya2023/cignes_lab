<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterParameterReferenceRangeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_parameter_reference_range', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parameter_id');            
            $table->string('lowertype')->nullable();
            $table->string('lowervalue')->nullable();            
            $table->string('lowerchronological')->nullable();
            $table->string('highertype')->nullable();
            $table->string('highervalue')->nullable();
            $table->string('higherchronological')->nullable();
            $table->string('malevalue')->nullable();
            $table->string('minmalevalue')->nullable();
            $table->string('maxmalevalue')->nullable();
            $table->string('femalevalue')->nullable();
            $table->string('minfemalevalue')->nullable();
            $table->string('maxfemalevalue')->nullable();
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
        Schema::dropIfExists('master_parameter_reference_range');
    }
}
