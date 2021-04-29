<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAttendancesTable extends Migration
{
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->unsignedBigInteger('bsid_id')->nullable();
            $table->foreign('bsid_id', 'bsid_fk_3792009')->references('id')->on('business_accounts');
            $table->unsignedBigInteger('employeeid_id')->nullable();
            $table->foreign('employeeid_id', 'employeeid_fk_3792010')->references('id')->on('employees');
        });
    }
}
