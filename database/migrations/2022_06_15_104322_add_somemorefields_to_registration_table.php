<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomemorefieldsToRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registration', function (Blueprint $table) {
            $table->string('maritalstatus')->after('age')->nullable();
            $table->string('bloodgroup')->after('maritalstatus')->nullable();
            $table->string('emergencynumber')->after('bloodgroup')->nullable();
            $table->longtext('healthissue')->after('emergencynumber')->nullable();
            $table->string('insuranceno')->after('sample_status')->nullable();
            $table->string('insuranceprovider')->after('insuranceno')->nullable();
            $table->string('insurancecardno')->after('insuranceprovider')->nullable();
            $table->string('insuranceexpirydate')->after('insurancecardno')->nullable();
            $table->string('morediscount')->after('insuranceexpirydate')->nullable();
            $table->integer('staffid')->after('morediscount')->nullable();
            $table->integer('discountstaffid')->after('staffid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registration', function (Blueprint $table) {
            $table->dropColumn('maritalstatus');
            $table->dropColumn('bloodgroup');
            $table->dropColumn('emergencynumber');
            $table->dropColumn('healthissue');
            $table->dropColumn('insuranceno');
            $table->dropColumn('insuranceprovider');
            $table->dropColumn('insurancecardno');
            $table->dropColumn('insuranceexpirydate');
            $table->dropColumn('morediscount');
            $table->dropColumn('staffid');
            $table->dropColumn('discountstaffid');
        });
    }
}
