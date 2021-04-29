<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBusinessLocationsTable extends Migration
{
    public function up()
    {
        Schema::table('business_locations', function (Blueprint $table) {
            $table->unsignedBigInteger('bsid_id')->nullable();
            $table->foreign('bsid_id', 'bsid_fk_3797087')->references('id')->on('business_accounts');
        });
    }
}
