<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('itemname');
            $table->string('serialnumber')->nullable();
            $table->string('itemcode');         
            $table->integer('category_id');
            $table->integer('subcategory_id')->nullable();            
            $table->integer('brand_id');
            $table->string('itemcost');
            $table->string('sellingprice');
            $table->string('vatmethod')->nullable();
            $table->integer('itemvat')->nullable();
            $table->string('expirydate');
            $table->integer('unit_id');
            $table->string('openingstock')->nullable();
            $table->string('alertquantity')->nullable();
            $table->integer('staff_id');
            $table->integer('branch_id');
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
        Schema::dropIfExists('stock');
    }
}
