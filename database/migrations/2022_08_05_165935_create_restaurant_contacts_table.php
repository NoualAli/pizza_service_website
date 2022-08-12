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
        Schema::create('restaurant_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id');
            $table->enum('type', ['Mobile', 'Fix', 'Email']);
            $table->string('value');

            $table->foreign('restaurant_id')->on('restaurants')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant_contacts');
    }
};