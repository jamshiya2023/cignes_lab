<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterSensitivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_sensitivity', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('sensitivity_name');
            $table->text('inhibition_zone')->nullable();
            $table->text('sensitivity_zone')->nullable();
            $table->text('intermediate_value')->nullable();
            $table->text('antibiotic_short_name')->nullable();
            $table->text('sensitivity_min_value')->nullable();
            $table->text('sensitivity_max_value')->nullable();
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
        Schema::dropIfExists('master_sensitivity');
    }
}
