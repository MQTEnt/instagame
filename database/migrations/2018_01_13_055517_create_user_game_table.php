<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id')->unsigned();
            $table->foreign('game_id')->references('id')->on('games')
                        ->onDelete('cascade');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('cascade');

            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items')
                        ->onDelete('cascade');

            $table->integer('points');
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
        Schema::dropIfExists('game_user');
    }
}
