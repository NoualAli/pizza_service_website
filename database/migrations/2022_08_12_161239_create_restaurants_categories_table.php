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
        Schema::create('restaurants_categories', function (Blueprint $table) {
            $table->foreignId('restaurant_id');
            $table->foreignId('category_id');

            $table->foreign('restaurant_id')->on('restaurants')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->on('categories')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants_categories');
    }
};