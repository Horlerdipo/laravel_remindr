<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeletedTable extends Migration
{
    
    public function up()
    {
        Schema::create('deleted', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('count');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('deleted');
    }
}
