<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CodeTableCreate extends Migration
{
    public function up()
    {
        Schema::create('code', function ($table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('pick');
            $table->string('pnd');
            $table->string('position');
            $table->integer('tmu1');
            $table->integer('tmu2');
            $table->integer('tmu3');

            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('code');
    }
}
