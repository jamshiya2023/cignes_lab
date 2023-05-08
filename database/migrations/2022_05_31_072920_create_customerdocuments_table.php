<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerdocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customerdocuments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cust_id');
            $table->integer('documenttype_id');
            $table->string('documentnumber');
            $table->string('documentexpirydate');
            $table->string('documentfilename');
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
        Schema::dropIfExists('customerdocuments');
    }
}
