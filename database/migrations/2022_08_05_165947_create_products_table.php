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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->decimal('price');
            $table->decimal('price_medium')->nullable();
            $table->decimal('price_large')->nullable();
            $table->foreignId('menu_id')->nullable();
            $table->foreignId('restaurant_id');
            $table->timestamps();

            $table->foreign('restaurant_id')->on('restaurants')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('menu_id')->on('menus')->references('id')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};