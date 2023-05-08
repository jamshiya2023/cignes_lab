<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRejectNoteToTestresultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('testresult', function (Blueprint $table) {
            $table->text('reject_note')->after('reject_reason')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('testresult', function (Blueprint $table) {
            //
            $table->dropColumn('reject_note');
        });
    }
}
