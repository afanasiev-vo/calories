<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MergeIngredientWithCalories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingredients', function (Blueprint $table) {
            $table->double('calories', 7, 4)->nullable();
            $table->double('proteins', 7, 4)->nullable();
            $table->double('fats', 7, 4)->nullable();
            $table->double('carbohydrates', 7, 4)->nullable();
            $table->integer('gi')->nullable();
            $table->dropForeign(['calories_id']);
            $table->dropColumn('calories_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropColumn([
                'calories', 'proteins', 'fats', 'carbohydrates', 'gi'
            ]);

            $table->integer('calories_id');
            $table->foreign('calories_id')->references('id')->on('calories')->onDelete('cascade');
        });
    }
}
