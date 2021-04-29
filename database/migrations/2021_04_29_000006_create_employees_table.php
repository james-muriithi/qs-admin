<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employeeid')->unique();
            $table->string('name')->nullable();
            $table->string('department')->nullable();
            $table->string('designation')->nullable();
            $table->string('potraits')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->datetime('timestamp')->nullable();
            $table->string('gender')->nullable();
            $table->string('genid')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
