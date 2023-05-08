<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleCollectionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_status_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cust_id')->nullable();
            $table->integer('reg_id')->nullable();
            $table->integer('test_id')->nullable();
            $table->integer('reject_reason')->nullable();
            $table->text('reject_note')->nullable();
            $table->string('sample_rejected_date_time')->nullable();
            $table->text('sample_collection_note')->nullable();
            $table->string('sample_collected_date_time')->nullable();  
            $table->string('sample_received_date_time')->nullable();                        
            $table->string('collection_status')->nullable();
            $table->integer('staff_id')->nullable();
            $table->integer('branch_id')->nullable();
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
        Schema::dropIfExists('sample_collection_details');
    }
}
