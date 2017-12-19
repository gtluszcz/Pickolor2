<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('likes');
            $table->string('hex')->unique();
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::create('color_user', function (Blueprint $table) {

            $table->integer('user_id');
            $table->integer('color_id');
            $table->primary(['user_id','color_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colors');

        Schema::dropIfExists('color_user');
    }
}
