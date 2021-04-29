<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->longText('comment')->nullable();
            $table->string('location')->nullable();
            $table->string('area_info')->nullable();
            $table->string('hours_in')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }
}
