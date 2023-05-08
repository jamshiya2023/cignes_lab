<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestresultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testresult', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cust_id');
            $table->integer('reg_id');
            $table->integer('test_id');
            $table->text('reject_reason')->nullable();
            $table->text('unittest')->nullable();
            $table->text('sample_collection_note')->nullable();
            $table->string('sample_collected_date_time')->nullable();
            $table->string('sample_received_date_time')->nullable(); 
            $table->string('status');
            $table->string('staff_id')->nullable();
            $table->string('branch_id')->nullable(); 
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
        Schema::dropIfExists('testresult');
    }
}
