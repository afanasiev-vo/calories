<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Eat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description', 1024)->nullable();
            $table->integer('owner_id');
            $table->string('status', 20)->default(\App\Eat::ACTIVE);
            $table->timestamps();
            $table->foreign('owner_id')->references('id')->on('users');
        });

        Schema::create('eat_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('eat_id');
            $table->integer('product_id');
            $table->double('weight', 7, 4);
            $table->foreign('eat_id')->references('id')->on('eats')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('eats', function (Blueprint $table) {
//            $table->dropColumn([
//                'calories', 'proteins', 'fats', 'carbohydrates', 'gi'
//            ]);
//
//            $table->foreign('calories_id')->references('id')->on('calories')->onDelete('cascade');
//        });
    }
}
