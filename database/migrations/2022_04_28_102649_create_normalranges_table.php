<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNormalrangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('normalranges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('singletest_id');
            $table->string('agefrom');
            $table->string('ageto');
            $table->string('generalrange');
            $table->string('malerange')->nullable();
            $table->string('femalerange')->nullable();
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
        Schema::dropIfExists('normalranges');
    }
}
