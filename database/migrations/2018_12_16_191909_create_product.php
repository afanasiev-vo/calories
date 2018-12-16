<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('description', 1024);
            $table->text('receipt')->nullable();
            $table->integer('owner_id');
            $table->string('status', 20)->default(\App\Product::ACTIVE);
            $table->string('thumbnail', 524)->nullable();
            $table->timestamps();
            $table->foreign('owner_id')->references('id')->on('users');
        });

        Schema::create('product_ingredients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('ingredient_id');
            $table->double('weight', 7, 4);
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
