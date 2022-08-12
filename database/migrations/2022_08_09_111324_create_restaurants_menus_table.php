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
        Schema::create('restaurants_menus', function (Blueprint $table) {
            $table->foreignId('restaurant_id');
            $table->foreignId('menu_id');

            $table->foreign('restaurant_id')->on('restaurants')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('menu_id')->on('menus')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant_menus');
    }
};