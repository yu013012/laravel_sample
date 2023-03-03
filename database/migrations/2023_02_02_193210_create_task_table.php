<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_table', function (Blueprint $table) {
            $table->integer('user_table_id')->length(4);
            $table->string('title');
            $table->string('naiyou');
            $table->integer('zyoutai')->length(1);
            $table->integer('kigen_y')->length(4);
            $table->integer('kigen_m')->length(2);
            $table->integer('kigen_d')->length(2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_table');
    }
};
