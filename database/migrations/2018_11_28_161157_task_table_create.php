<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TaskTableCreate extends Migration
{
    public function up()
    {
        Schema::create('task', function ($table) {
            $table->increments('id');
            $table->string('type');
            $table->string('description')->nullable();
            $table->string('plant')->nullable();
            $table->string('area')->nullable();
            $table->string('cost_center')->nullable();
            $table->float('welding_time')->default(0);
            $table->float('turning_time')->default(0);
            $table->float('setup_time')->default(0);
            $table->jsonb('operators')->default('[]');

            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('task');
    }
}
