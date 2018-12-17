<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveTableCalories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('calories');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('calories', function (Blueprint $table) {
            $table->increments('id');
            $table->double('calories', 7, 4);
            $table->double('proteins', 7, 4);
            $table->double('fats', 7, 4);
            $table->double('carbohydrates', 7, 4);
            $table->integer('gi');
        });
    }
}
