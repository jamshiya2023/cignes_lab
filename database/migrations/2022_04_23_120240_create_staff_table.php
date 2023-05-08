<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->integer('department_id');
            $table->integer('designation_id');
            $table->string('gender');
            $table->string('dateofbirth');
            $table->string('qualification')->nullable();
            $table->string('email');
            $table->string('contactnumber');
            $table->string('specialist')->nullable();
            $table->string('profilepicture')->nullable();
            $table->string('signature')->nullable();
            $table->longText('details')->nullable();
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
        Schema::dropIfExists('staff');
    }
}
