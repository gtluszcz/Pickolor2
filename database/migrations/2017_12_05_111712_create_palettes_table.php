<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalettesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palettes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('title');
            $table->integer('color1_id');
            $table->integer('color2_id');
            $table->integer('color3_id');
            $table->integer('color4_id');
            $table->integer('color5_id');
            $table->integer('views');
            $table->integer('likes');
            $table->timestamps();
        });

        Schema::create('palette_user', function (Blueprint $table) {

            $table->integer('user_id');
            $table->integer('palette_id');
            $table->primary(['user_id','palette_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('palettes');
        Schema::dropIfExists('palette_user');
    }
}
