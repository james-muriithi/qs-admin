<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEmployeesTable extends Migration
{
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->unsignedBigInteger('bsid_id')->nullable();
            $table->foreign('bsid_id', 'bsid_fk_3791898')->references('id')->on('business_accounts');
        });
    }
}
