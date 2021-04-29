<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('business_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bsid')->unique();
            $table->string('bs_name');
            $table->string('bs_location')->nullable();
            $table->string('bs_contact');
            $table->string('bs_email')->nullable();
            $table->string('bs_logo')->nullable();
            $table->string('bs_industry')->nullable();
            $table->integer('employees')->nullable();
            $table->string('access_code')->nullable();
            $table->datetime('date_created')->nullable();
            $table->timestamps();
        });
    }
}
