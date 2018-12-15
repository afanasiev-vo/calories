<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('ingredients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('thumbnail', 1024)->nullable();
            $table->enum('status', ['ACTIVE', 'HOLD']);
            $table->text("description")->nullable();
            $table->string('state', 128)->nullable();
            $table->integer('owner_id');
            $table->timestamps();
            $table->foreign('owner_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredients');
    }
}
