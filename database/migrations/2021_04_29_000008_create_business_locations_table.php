<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessLocationsTable extends Migration
{
    public function up()
    {
        Schema::create('business_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bs_id');
            $table->string('name');
            $table->string('coordinates')->nullable();
            $table->string('qr')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
